<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="custom-card-box p-4 bg-white shadow-sm">
                <h3 class="mb-3 text-center">Login Admin</h3>
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required value="{{ old('username') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-secondary w-100">Kembali ke Beranda</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>