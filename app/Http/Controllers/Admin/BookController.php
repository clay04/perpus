<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookFile;
use App\Models\BookPreviewRule;
use App\Services\PdfMetadataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('pages.admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('pages.admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'nullable|mimes:pdf|max:20480',
            'judul' => 'nullable',
            'isbn' => 'nullable|unique:tbl_books,isbn',
            'penulis' => 'nullable',
            'kategori' => 'nullable',
            'stok' => 'nullable|integer|min:0',
        ]);

        $judul = $request->judul;
        $penulis = $request->penulis;
        $pages = null;
        $remotePath = null;

        if ($request->hasFile('file'))
        {
            $uploadedFile = $request->file('file');
            $localTmpPath = $uploadedFile->getRealPath();

            if (!file_exists($localTmpPath)) {
                throw new \Exception('File upload tidak ditemukan di sistem');
            }

            $meta = PdfMetadataService::extract($localTmpPath);

            $judul ??= $meta['title'] ?? 'Judul tidak terdeteksi';
            $penulis ??= $meta['author'] ?? 'Tidak diketahui';
            $pages ??= $meta['pages'];
        }

        $book = Book::create([
            'judul'    => $judul,
            'isbn'     => $request->isbn,
            'penulis'  => $penulis,
            'kategori' => $request->kategori,
            'stok'     => $request->stok,
            'status'   => $request->stok > 0 ? 'tersedia' : 'tidak tersedia',
        ]);

        if ($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $localPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $originalName = $file->getClientOriginalName();

            $remotePath = env('DB_FILE_STORAGE_PATH')."/book_{$book->id}.pdf";

            $process = Process::run(
                "scp -i " . env('DB_FILE_SERVER_KEY') .
                " -P " . env('DB_FILE_SERVER_PORT') . " " .
                $localTmpPath . " " .
                env('DB_FILE_SERVER_USER') . "@" .
                env('DB_FILE_SERVER_HOST') . ":" .
                $remotePath
            );

            if (!$process->successful()) {
                dd($process->errorOutput());
            }

            BookFile::create([
                'book_id'     => $book->id,
                'file_name'   => $originalName,
                'file_path'   => $remotePath,
                'file_type'   => 'pdf',
                'file_size'   => $fileSize,
                'total_pages' => $pages,
            ]);

            BookPreviewRule::create([
                'book_id' => $book->id,
                'preview_pages' => 5,
            ]);

            //unlink($localTmpPath);
        }

        return back()->with('success', 'Buku berhasil ditambahkan.');
    }

    public function preview(Book $book)
    {
        $remotePath = $book->file->file_path;
        $tmpPath = storage_path("app/tmp_book_{$book->id}.pdf");

        $process = Process::timeout(120)->run(
            "scp -i " . env('DB_FILE_SERVER_KEY') .
            " -P " . env('DB_FILE_SERVER_PORT') . " " .
            env('DB_FILE_SERVER_USER') . "@" .
            env('DB_FILE_SERVER_HOST') . ":" .
            $remotePath . " " .
            $tmpPath
        );

        if (!$process->successful()) {
            dd($process->errorOutput());
        }

        return response()->file($tmpPath)->deleteFileAfterSend(true);
    }

    public function show(Book $book)
    {
        return view('pages.admin.books.show', [
            'book' => $book,
            'fileUrl' => route('admin.books.preview', $book->id),
            'previewPages' => $book->previewRule->preview_pages ?? 5
            ]);
    }

    public function edit(Book $book)
    {
        return view('pages.admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required',
            'isbn' => 'required|unique:tbl_books,isbn,'.$book->id,
            'penulis' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $book->update([
            ...$request->all(),
            'status' => $request->stok > 0 ? 'tersedia' : 'tidak tersedia',
        ]);

        return back()->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Buku berhasil dihapus.');
    }

    public function parsePdf(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan'
            ], 422);
        }

        $file = $request->file('file');

        if (!$file->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak valid'
            ], 422);
        }

        $meta = PdfMetadataService::extract($file->getRealPath());

        return response()->json([
            'success' => true,
            'title'   => $meta['title'] ?? '',
            'author' => $meta['author'] ?? '',
            'pages'  => $meta['pages'] ?? null,
        ]);
    }

}
