@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center col-md-8">

        <h1 class="fw-bold mb-3">
            Welcome to Perpustakaan UNKLAB
        </h1>

        <p class="text-muted mb-4">
            This is the home page of the library application.  
            Please login to access the system.
        </p>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
            Login
        </a>

    </div>
</div>
@endsection
