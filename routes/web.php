<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    if (auth()->check()) {
        return match (auth()->user()->role->value) {
            'admin' => redirect('/admin'),
            'user'  => redirect('/user'),
        };
    }

    return app(AuthController::class)->loginForm();
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/admin', function () {
//         return view('pages.admin.dashboard');
//     });
// });

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [PeminjamanController::class, 'dashboard'])->name('dashboard');

    // Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [DashboardController::class, 'index']);

    // CRUD BOOKS
    Route::post('/books', [DashboardController::class, 'store']);
    Route::put('/books/{book}', [DashboardController::class, 'update']);
    Route::delete('/books/{book}', [DashboardController::class, 'destroy']);

    // User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});