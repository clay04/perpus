<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('pages.user.book-detail', compact('book'));
    }
}
