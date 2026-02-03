<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Request $request, User $user) 
    {
        $request->validate([
            'book_id' => 'required|exists:tbl_books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stok < 1) {
            return back()->withErrors('Stok buku habis');
        }

        Peminjaman::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        
        $book->decrement('stok');

        if ($book->stok === 0) {
            $book->update(['status' => 'tidak tersedia']);
        }

        return back()->with('success', 'Buku berhasil dipinjamkan ke user');
    }

    public function kembali(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back();
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => Carbon::now(),
        ]);

        $peminjaman->book->increment('stok');

        $peminjaman->book->update([
            'status' => 'tersedia'
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan');
    }

}
