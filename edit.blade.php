<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - Edit Penerbit</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #f1c40f;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        .btn-update { background-color: #f1c40f; color: #333; }
        .btn-update:hover { background-color: #d4ac0d; }
        .btn-kembali { background-color: #95a5a6; color: white; }
        .btn-kembali:hover { background-color: #7f8c8d; }
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📝 Edit Data Penerbit</h2>

    <!-- Form Pengiriman Data ke Method Update di Controller -->
    <form action="{{ route('penerbit.update', $penerbit->id_penerbit) }}" method="POST">
        @csrf
        @method('PUT') <!-- Wajib di Laravel untuk proses Update/Put data -->

        <div class="form-group">
            <label for="nama_penerbit">Nama Penerbit</label>
            <input type="text" id="nama_penerbit" name="nama_penerbit" value="{{ old('nama_penerbit', $penerbit->nama_penerbit) }}" required>
            @error('nama_penerbit') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="wilayah_asal">Wilayah Asal</label>
            <input type="text" id="wilayah_asal" name="wilayah_asal" value="{{ old('wilayah_asal', $penerbit->wilayah_asal) }}" required>
            @error('wilayah_asal') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nama_sales">Nama Sales</label>
            <input type="text" id="nama_sales" name="nama_sales" value="{{ old('nama_sales', $penerbit->nama_sales) }}" required>
            @error('nama_sales') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="telepon_sales">Telepon Sales</label>
            <input type="text" id="telepon_sales" name="telepon_sales" value="{{ old('telepon_sales', $penerbit->telepon_sales) }}" required>
            @error('telepon_sales') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email_sales">Email Sales</label>
            <input type="email" id="email_sales" name="email_sales" value="{{ old('email_sales', $penerbit->email_sales) }}" required>
            @error('email_sales') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-update">Perbarui Data</button>
            <a href="{{ route('penerbit.index') }}" class="btn btn-kembali">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
