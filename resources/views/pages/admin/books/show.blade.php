@extends('layouts.admin')

@section('title', 'Detail Buku')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Buku</h3>

        <div>
            <a href="{{ route('admin.books.edit', $book->id) }}"
               class="btn btn-warning btn-sm">
                Edit
            </a>

            <a href="{{ route('admin.books.index') }}"
               class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>
    </div>

    <!-- CARD DETAIL -->
    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-borderless mb-0">
                <tr>
                    <th width="200">Judul</th>
                    <td>{{ $book->judul }}</td>
                </tr>

                <tr>
                    <th>ISBN</th>
                    <td>{{ $book->isbn }}</td>
                </tr>

                <tr>
                    <th>Penulis</th>
                    <td>{{ $book->penulis }}</td>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <td>{{ $book->kategori }}</td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>{{ $book->stok }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge 
                            {{ $book->status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>{{ $book->created_at->format('d M Y H:i') }}</td>
                </tr>

                <tr>
                    <th>Terakhir Update</th>
                    <td>{{ $book->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

        </div>
    </div>

</div>
@endsection
