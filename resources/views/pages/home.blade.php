@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="text-center col-md-8">

        <h1 class="fw-bold mb-3">
            Selamat Datang di Sistem Informasi Perpustakaan
        </h1>

        <p class="text-muted mb-4">
            Ini adalah tampilan awal dari sistem informasi Perpustakaan.
            Silahkan login untuk mngakses sistem.
        </p>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
            Login
        </a>

    </div>
</div>
@endsection
