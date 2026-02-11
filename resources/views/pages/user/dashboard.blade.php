@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
        <h4>📚 Katalog Buku</h4>

        <div class="d-flex gap-2">
            <a href="{{ route('user.riwayat') }}" class="btn btn-outline-primary btn-sm">
            Riwayat
            </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
        </div>
    </div>

    <div class="row g-3">

        @foreach($books as $book)
        <div class="col-md-3">
            <div class="card shadow-sm h-100">

                    <div class="card-body d-flex flex-column">

                    <strong>{{ $book->judul }}</strong>

                    <small class="text-muted">
                        Stok: {{ $book->stok }}
                    </small>

                    <div class="mt-auto">
                        <a href="{{ route('user.books.show',$book->id) }}"
                            class="btn btn-primary btn-sm w-100">
                            View
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
