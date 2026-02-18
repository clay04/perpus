<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function show($id)
    {
        $book = Book::with(['file', 'previewRule'])->findOrFail($id);

        $activeLoan = $book->peminjaman()
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->first();

        $isAvailable = $book->stok > 0;

        return view('pages.user.book-detail', compact('book', 'activeLoan', 'isAvailable'));
    }
}
