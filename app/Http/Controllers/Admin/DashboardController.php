<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $books = Book::latest()->get();
        return view('pages.admin.dashboard', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isbn' => 'required|unique:tbl_books,isbn',
            'penulis' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        Book::create([
            'judul'    => $request->judul,
            'isbn'     => $request->isbn,
            'penulis'  => $request->penulis,
            'kategori' => $request->kategori,
            'stok'     => $request->stok,
            'status'   => $request->stok > 0 ? 'tersedia' : 'tidak tersedia',
        ]);

        return back()->with('success', 'Buku berhasil ditambahkan.');
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
}
