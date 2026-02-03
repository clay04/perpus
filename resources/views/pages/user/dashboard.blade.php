@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">Dashboard Peminjaman</h3>
            <small class="text-muted">Riwayat dan peminjaman buku</small>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger btn-sm">
                Logout
            </button>
        </form>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    {{-- Action --}}
    <div class="mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamModal">
            Pinjam Buku
        </button>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Tgl Dikembalikan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $p)
                    <tr>
                        <td>{{ $p->book->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                        <td>
                            @if($p->tanggal_dikembalikan)
                                {{ \Carbon\Carbon::parse($p->tanggal_dikembalikan)->format('d M Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status === 'dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Belum ada peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Pinjam --}}
<div class="modal fade" id="pinjamModal">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('user.peminjaman.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📚 Pinjam Buku</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Buku</label>
                        <select class="form-control" name="book_id" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">
                                    {{ $book->judul }} (stok: {{ $book->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" name="tanggal_pinjam" required>
                    </div>

                    <div>
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tanggal_kembali" required>
                    </div>
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
