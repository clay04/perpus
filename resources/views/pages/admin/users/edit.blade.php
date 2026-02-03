@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Edit User</h3>
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
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name"
                            class="form-control"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username"
                            class="form-control"
                            value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                            class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role', $user->role->value) }}" readonly required>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
