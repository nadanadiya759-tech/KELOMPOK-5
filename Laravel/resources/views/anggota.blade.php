<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-3">Sistem Manajemen Perpustakaan Digital</h1>

        <a href="#" class="btn btn-primary mb-3">Tambah Anggota</a>

        <table class="table table-bordered table-striped bg-white">
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Nomor Kartu</th>
                    <th>Tipe Keanggotaan</th>
                    <th>Status ID Card</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $row)
                    <tr>
                        <td>{{ $row->nama_anggota }}</td>
                        <td>{{ $row->nomor_kartu }}</td>
                        <td>{{ $row->tipe_keanggotaan }}</td>
                        <td>{{ $row->status_id_card }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>