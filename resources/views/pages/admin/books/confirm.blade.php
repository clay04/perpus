@extends('layouts.admin')

@section('title', 'Konfirmasi Hapus')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card shadow-sm" style="max-width: 400px;">
        <div class="card-body text-center">
            <h5 class="mb-3">Konfirmasi Hapus</h5>
            <p>
                Yakin ingin menghapus buku:
                <strong>{{ $book->judul }}</strong>?
            </p>

            <form method="POST"
                  action="{{ route('admin.books.destroy', $book->id) }}">
                @csrf
                @method('DELETE')

                <a href="{{ url()->previous() }}"
                   class="btn btn-secondary">
                    Batal
                </a>

                <button type="submit"
                        class="btn btn-danger">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
