@extends('layouts.app')
@section('title', 'Create User')

@if(session('success'))
    <div style="color: green">
        {{ session('success') }}
    </div>
@endif

@section('content')
    @if(session('success'))
        <div style="color: green">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/admin/users">
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>username</label>
            <input type="text" name="username" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <label>Role</label>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection