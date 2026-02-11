<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home() {
        $book = Book::all();

        return view('pages.user.dashboard', compact('books'));
    }

    public function riwayat() 
    {
        $peminjaman = Peminjaman::with('book')->where('user_id', auth()->id())->latest()->get();

        return view('pages.user.riwayat', compact('peminjaman'));
    }
}
