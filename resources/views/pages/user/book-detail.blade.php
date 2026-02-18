@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('user.home') }}" class="btn btn-sm btn-secondary mb-3">
            Kembali
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">

                {{-- COVER --}}
                <div class="col-md-4 text-center">
                    @if($book->file)
                        <img
                            src="{{ route('books.cover', $book->id) }}"
                            class="img-fluid rounded shadow-sm"
                            style="max-height: 320px; object-fit: cover;">
                    @else
                        <div class="border rounded p-4 text-muted">
                            Tidak ada cover
                        </div>
                    @endif
                </div>

                {{-- METADATA --}}
                <div class="col-md-8">
                    <h4 class="mb-3">{{ $book->judul }}</h4>

                    <table class="table table-sm">
                        <tr>
                            <th width="150">Penulis</th>
                            <td>{{ $book->penulis ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $book->penerbit ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{ $book->isbn ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $book->tahun_terbit ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kota Terbit</th>
                            <td>{{ $book->kota_terbit ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Edisi</th>
                            <td>{{ $book->edisi ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $book->kategori ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>
                                <span class="badge bg-{{ $book->stok > 0 ? 'success' : 'danger' }}">
                                    {{ $book->stok }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $book->status == 'tersedia' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    {{-- ACTION BUTTON --}}
                    <div class="mt-3">

                        @if($activeLoan)
                            <button class="btn btn-secondary" disabled>
                                Sedang Dipinjam
                            </button>

                            <a href="{{ route('user.riwayat') }}" class="btn btn-outline-primary">
                                Lihat Peminjaman
                            </a>

                        @elseif(!$isAvailable)
                            <button class="btn btn-danger" disabled>
                                Stok Habis
                            </button>

                        @else
                            <form action="{{ route('user.peminjaman.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <input type="hidden" name="tanggal_pinjam" value="{{ now()->toDateString() }}">
                                <input type="hidden" name="tanggal_kembali" value="{{ now()->addDays(7)->toDateString() }}">

                                <button class="btn btn-primary">
                                    Pinjam Buku
                                </button>
                            </form>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- DETAIL PEMINJAMAN --}}
    @if($activeLoan)
        <div class="card shadow-sm mt-3 border-0">
            <div class="card-body">
                <h5 class="mb-3">Detail Peminjaman</h5>

                <table class="table table-sm mb-0">
                    <tr>
                        <th width="180">Tanggal Pinjam</th>
                        <td>{{ $activeLoan->tanggal_pinjam->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ $activeLoan->tanggal_kembali->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-info">
                                {{ ucfirst($activeLoan->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

</div>
@endsection
