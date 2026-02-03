@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <h1>Dashboard User</h1>
    <p>Halaman peminjaman buku</p>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#pinjamModal">
        📚 Pinjam Buku
    </button>

    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-dark">
                Logout
            </button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $p)
            <tr>
                <td>{{ $p->book->judul }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_kembali }}</td>
                <td>{{ ucfirst($p->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="modal fade" id="pinjamModal">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('user.peminjaman.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Pinjam Buku</h5>
                    </div>

                    <div class="modal-body">
                        <select class="form-control mb-2" name="book_id" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">
                                    {{ $book->judul }} (stok: {{ $book->stok }})
                                </option>
                            @endforeach
                        </select>

                        <input type="date" class="form-control mb-2" name="tanggal_pinjam" required>
                        <input type="date" class="form-control" name="tanggal_kembali" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Pinjam</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
