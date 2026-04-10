<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7fa; }
        .login-card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card login-card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary"><i class="bi bi-box-seam"></i> Inventaris</h3>
                            <p class="text-muted">Silakan login ke akun Anda</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger p-2 mb-3 text-center" style="font-size: 14px;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('login.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted fw-semibold">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control border-start-0 bg-light" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control border-start-0 bg-light" name="password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">MASUK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
