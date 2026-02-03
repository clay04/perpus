@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail User</h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

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
            </div>
        </div>
    </div>

</div>
@endsection
