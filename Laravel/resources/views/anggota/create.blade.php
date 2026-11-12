<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="container mt-4">
    <div class="custom-card-box">
        <h1 class="mb-4">Tambah Data Anggota</h1>

        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nomor Kartu (NIM)</label>
                <input type="text" class="form-control @error('nomor_kartu') is-invalid @enderror" name="nomor_kartu" value="{{ old('nomor_kartu') }}" required>
                @error('nomor_kartu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota" value="{{ old('nama_anggota') }}" required>
                @error('nama_anggota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tipe Keanggotaan</label>
                <input type="text" class="form-control @error('tipe_keanggotaan') is-invalid @enderror" name="tipe_keanggotaan" value="{{ old('tipe_keanggotaan') }}" required>
                @error('tipe_keanggotaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Status ID Card</label>
                <input type="text" class="form-control @error('status_id_card') is-invalid @enderror" name="status_id_card" value="{{ old('status_id_card') }}" required>
                @error('status_id_card')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>