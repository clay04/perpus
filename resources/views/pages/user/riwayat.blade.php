@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('user.home') }}" class="btn btn-sm btn-secondary mb-3">
        ← Kembali
    </a>

    <h5>Riwayat Peminjaman</h5>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>

    <tbody>
        @foreach($peminjaman as $p)
        <tr>
            <td>{{ $p->book->judul }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @endforeach
    </tbody>

    </table>

</div>
@endsection
