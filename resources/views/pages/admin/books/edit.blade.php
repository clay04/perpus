@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Edit Buku</h3>

        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Update buku gagal. Silakan periksa kembali data yang diinput.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- FORM -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $book->judul) }}">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn"
                               class="form-control @error('isbn') is-invalid @enderror"
                               value="{{ old('isbn', $book->isbn) }}">
                        @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis"
                               class="form-control @error('penulis') is-invalid @enderror"
                               value="{{ old('penulis', $book->penulis) }}">
                        @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori"
                               class="form-control @error('kategori') is-invalid @enderror"
                               value="{{ old('kategori', $book->kategori) }}">
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok"
                               class="form-control @error('stok') is-invalid @enderror"
                               value="{{ old('stok', $book->stok) }}" min="0">
                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
