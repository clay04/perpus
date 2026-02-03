<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

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

    public function show(Book $book)
    {
        return view('pages.admin.books.show', compact('book'));
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
}
