@extends('layouts.admin')
@section('title', 'Manajemen User')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Manajemen User</h3>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
            + Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped mb-0 align-middle">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role->value) }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.users.destroy', $user) }}"
                        method="POST"
                        class="d-inline delete-user-form">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="btn btn-sm btn-danger btn-delete-user">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
</div>

@endsection