@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail User</h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($user->role->value) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                    Edit User
                </a>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamModal">
                    Pinjamkan Buku
                </button>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Peminjaman Buku</h5>
        </div>

        <div class="card-body">
            @if($peminjaman->count())
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Tanggal dikembalikan</th>
                        <th>Status</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
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
                            <span class="badge bg-{{ $p->status == 'dipinjam' ? 'warning' : 'success' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            @if($p->status == 'dipinjam')
                            <form method="POST" action="{{ route('admin.peminjaman.kembali', $p->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-success">
                                    Kembalikan
                                </button>
                            </form>
                            @else
                            <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-muted mb-0">User belum pernah meminjam buku.</p>
            @endif
        </div>
    </div>

    <div class="modal fade" id="pinjamModal">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.users.pinjam', $user->id) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Pinjamkan Buku</h5>
                    </div>

                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">Buku</label>
                            <select name="book_id" class="form-control" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    @if($book->stok > 0)
                                        <option value="{{ $book->id }}">
                                            {{ $book->judul }} (stok: {{ $book->stok }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control" required>
                        </div>

                        <div>
                            <label>Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control" required>
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
</div>
@endsection
