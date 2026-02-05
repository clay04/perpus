<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow border-0" style="max-width: 420px;">
    <div class="card-body text-center p-5">
        <h1 class="display-1 fw-bold text-warning">403</h1>
        <h4 class="mb-3">Akses Ditolak</h4>
        <p class="text-muted">
            Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>

        <a href="{{ url('/') }}" class="btn btn-secondary mt-3">
            Kembali ke Beranda
        </a>
    </div>
</div>

</body>
</html>
