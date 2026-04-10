<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-search text-warning mb-4" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>

        <h1 class="display-4 fw-bold text-dark mb-2">404</h1>
        <h3 class="mb-3">Halaman Tidak Ditemukan.</h3>
        <p class="text-muted mb-4">Waduh, sepertinya kamu tersesat. Halaman yang kamu cari tidak ada di sistem ini atau URL-nya salah ketik.</p>
        
        <a href="{{ url()->previous() }}" class="btn btn-secondary px-4 me-2">Kembali</a>
        
        <a href="{{ url('/') }}" class="btn btn-primary px-4">Ke Halaman Utama</a>
    </div>

</body>
</html>