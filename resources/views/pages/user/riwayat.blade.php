@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('user.home') }}" class="btn btn-sm btn-secondary mb-3">
        Kembali
    </a>

    <h5>Riwayat Peminjaman</h5>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Batas Pengembalian</th>
                <th>Tgl Dikembalikan</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td>{{ $p->book->judul }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_kembali }}</td>
                <td>{{ $p->tanggal_dikembalikan }}</td>
                <td>
                    <span class="badge bg-{{ $p->status == 'dipinjam' ? 'warning' : 'success' }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('user.books.show', $p->book_id) }}"
                    class="btn btn-sm btn-primary">
                        Lihat Buku
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
