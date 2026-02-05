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
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger delete-form-user">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addUser">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah User</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="name" placeholder="Nama" required>
                    <input class="form-control mb-2" name="username" placeholder="Username" required>
                    <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
                    <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>

                    <select class="form-control" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    @foreach($users as $user)
    <div class="modal fade" id="showUser{{ $user->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Detail User</h5>
                </div>
                <div class="modal-body">
                    <p><b>Nama:</b> {{ $user->name }}</p>
                    <p><b>Username:</b> {{ $user->username }}</p>
                    <p><b>Email:</b> {{ $user->email }}</p>
                    <p><b>Role:</b> {{ ucfirst($user->role->value) }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($users as $user)
    <div class="modal fade" id="editUser{{ $user->id }}">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit User</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="name" value="{{ $user->name }}">
                    <input class="form-control mb-2" name="username" value="{{ $user->username }}">
                    <input class="form-control mb-2" name="email" value="{{ $user->email }}">

                    <select class="form-control" name="role">
                        <option value="user" @selected($user->role=='user')>User</option>
                        <option value="admin" @selected($user->role=='admin')>Admin</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    @endforeach

    @foreach($users as $user)
    <div class="modal fade" id="deleteUser" action="admin/users/{{ $user->id }}">
        <div class="modal-dialog modal-sm">
            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>Hapus user <b>{{ $user->name }}</b>?</p>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection