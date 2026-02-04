@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-80">
    <div class="col-md-4">

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="text-center mb-4">Login</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Masukkan username"
                               required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection