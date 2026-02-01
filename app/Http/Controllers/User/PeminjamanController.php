<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
            $peminjaman = Peminjaman::with('book')->where('user_id', auth()->id())->latest()->get();

            return view('pages.user.peminjaman.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:tbl_books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stok < 1) {
            return back()->withErrors('Stok buku habis');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        $book->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function dashboard()
    {
        return view('pages.user.dashboard', [
            'books' => Book::where('stok', '>', 0)->get(),
            'peminjaman' => Peminjaman::with('book')
                ->where('user_id', auth()->id())
                ->latest()
                ->get()
        ]);
    }

}
