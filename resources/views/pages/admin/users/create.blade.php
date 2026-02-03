@extends('layouts.admin')
@section('title', 'Buat User')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Tambah User</h3>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Gagal membuat User. Silakan periksa kembali data yang diinput.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" 
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" 
                                name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" 
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" 
                                name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" 
                                name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection