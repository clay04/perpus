@extends('layouts.admin')

@section('title', 'Manajemen Buku')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Manajemen Buku</h3>

        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr>
                            <td>{{ $books->firstItem() + $index }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->stok }}</td>
                            <td>
                                <span class="badge 
                                    {{ $book->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="{{ route('admin.books.show', $book->id) }}"
                                class="btn btn-sm btn-info">
                                    Lihat
                                </a>

                                <button
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-id="{{ $book->id }}"
                                    data-title="{{ $book->judul }}"
                                    data-action="{{ route('admin.books.destroy', $book->id) }}"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada data buku
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-3">
        {{ $books->links() }}
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p>
                            Yakin ingin menghapus buku:
                            <strong id="deleteTitle"></strong>?
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Ya, Hapus
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>
@endsection
