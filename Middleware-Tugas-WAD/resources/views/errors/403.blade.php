<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            max-width: 450px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 80px;
            color: #dc2626;
            margin: 0;
        }

        p {
            color: #475569;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>403</h1>
        <h2>Akses Ditolak</h2>

        <p>
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}
        </p>

        <a href="{{ route('area.index') }}">
            Kembali ke Daftar Area
        </a>
    </div>
</body>

</html>