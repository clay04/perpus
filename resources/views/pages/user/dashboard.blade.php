@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container mt-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">

        <div class="mb-3 mb-md-0">
            <h3 class="mb-0 fw-bold">Sistem Informasi Perpustakaan</h3>
            <small class="text-muted">Katalog Buku</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('user.riwayat') }}" 
            class="btn btn-outline-primary btn-sm">
                <i class="bi bi-clock-history me-1"></i>
                Riwayat
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Logout
                </button>
            </form>
        </div>

    </div>

    <div class="row g-3">

       <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach($books as $book)
        <div class="col-md-3 col-lg-2">
            <div class="book-card">

                <div class="book-cover">
                    <img class="book-img" src="{{ route('books.cover',$book->id) }}" data-fallback="/images/no-cover.jpg">
                </div>

                <div class="book-meta">

                    <h6>{{ $book->judul }}</h6>

                    <small class="text-muted">
                        Stok {{ $book->stok }}
                    </small>

                    <a href="{{ route('user.books.show',$book->id) }}"
                    class="btn btn-outline-primary btn-sm w-100 mt-2">
                        Lihat Buku
                    </a>

                </div>

            </div>
        </div>
        @endforeach

        </div>

    </div>
</div>
@endsection
