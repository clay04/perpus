<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-lg border-0" style="max-width: 420px;">
    <div class="card-body text-center p-5">
        <h1 class="display-1 fw-bold text-danger">404</h1>
        <h4 class="mb-3">Halaman Tidak Ditemukan</h4>
        <p class="text-muted">
            Halaman yang Anda akses tidak tersedia atau telah dipindahkan.
        </p>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
            Kembali ke Halaman Sebelumnya
        </a>
    </div>
</div>

</body>
</html>
