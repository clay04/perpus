<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        return view('pages.admin.dashboard', [
            'totalBooks' => Book::count(),
            'totalUsers' => User::count(),

            'latestBooks' => Book::latest()->limit(5)->get(),
            'latestUsers' => User::latest()->limit(5)->get(),
        ]);
    }

}
