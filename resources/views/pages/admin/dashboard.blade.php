@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Dashboard Admin</h3>

    <!-- STAT CARDS -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Buku</h6>
                    <h3>{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total User</h6>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- LATEST DATA -->
    <div class="row mt-4">

        <!-- BOOKS -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Buku Terbaru</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        @foreach($latestBooks as $book)
                            <tr>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <!-- USERS -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">User Terbaru</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        @foreach($latestUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
