@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('user.home') }}" class="btn btn-sm btn-secondary mb-3">
    ← Kembali
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($book->file)
            <img
                src="{{ route('books.cover',$book->id) }}"
                class="card-img-top"
                style="height:220px; object-fit:cover;">
            @endif

            <h4>{{ $book->judul }}</h4>

            <p>{{ $book->deskripsi ?? '-' }}</p>

            <ul>
                <li>Penulis: {{ $book->penulis ?? '-' }}</li>
                <li>Stok: {{ $book->stok }}</li>
            </ul>

            <button class="btn btn-primary">
                Pinjam Buku
            </button>

        </div>
    </div>

</div>
@endsection
