@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
    <h1>Hallo Admin</h1>
    <p>Selamat datang di halaman dashboard admin Perpustakaan UNKLAB.</p>

    <!-- Tambah Buku -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBookModal">
        + Tambah Buku
    </button>

    <!-- Modal Tambah buku -->
    <div class="modal fade" id="addBookModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="/admin/books">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                <input class="form-control mb-2" name="judul" placeholder="Judul" required>
                <input class="form-control mb-2" name="isbn" placeholder="ISBN" required>
                <input class="form-control mb-2" name="penulis" placeholder="Penulis" required>
                <input class="form-control mb-2" name="kategori" placeholder="Kategori" required>
                <input class="form-control mb-2" type="number" name="stok" min="0" placeholder="Stok" required>
                </div>

                <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Daftar Buku -->
    <h2>Daftar Buku</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Judul</th>
            <th>ISBN</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->stok }}</td>
                <td>{{ ucfirst($book->status) }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBook{{ $book->id }}">
                    Edit
                    </button>

                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBook{{ $book->id }}">
                    Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Edit Buku -->
    @foreach($books as $book)
    <div class="modal fade" id="editBook{{ $book->id }}" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="/admin/books/{{ $book->id }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                <h5>Edit Buku</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="judul" value="{{ $book->judul }}">
                    <input class="form-control mb-2" name="isbn" value="{{ $book->isbn }}">
                    <input class="form-control mb-2" name="penulis" value="{{ $book->penulis }}">
                    <input class="form-control mb-2" name="kategori" value="{{ $book->kategori }}">
                    <input class="form-control mb-2" type="number" name="stok" value="{{ $book->stok }}">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    @endforeach

    <!-- Delete -->
    @foreach($books as $book)
    <div class="modal fade" id="deleteBook{{ $book->id }}" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <form method="POST" action="/admin/books/{{ $book->id }}">
            @csrf
            @method('DELETE')

                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p>Hapus buku <b>{{ $book->judul }}</b>?</p>

                        <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                        class="btn btn-danger">
                            Hapus
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

@endsection