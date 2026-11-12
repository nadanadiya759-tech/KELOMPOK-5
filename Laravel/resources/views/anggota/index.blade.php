<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container kotak my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Sistem Manajemen Perpustakaan Digital</h1>
            <div>
                @auth
                    <span class="me-2 text-muted">Halo, {{ Auth::user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login Admin</a>
                @endauth
            </div>
        </div>
        
        @auth
            <a href="{{ route('anggota.create') }}" class="btn btn-primary mb-3">+ Tambah Anggota</a>
        @endauth

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped bg-white">
            <thead>
                <tr>
                    <th>Nomor Kartu (NIM)</th>
                    <th>Nama Anggota</th>
                    <th>Tipe Keanggotaan</th>
                    <th>Status ID Card</th>
                    @auth
                        <th>Aksi</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota as $row)
                    <tr>
                        <td>{{ $row->nomor_kartu }}</td>
                        <td>{{ $row->nama_anggota }}</td>
                        <td>{{ $row->tipe_keanggotaan }}</td>
                        <td>{{ $row->status_id_card }}</td>
                        @auth
                            <td>
                                <a href="{{ route('anggota.edit', $row->nomor_kartu) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('anggota.destroy', $row->nomor_kartu) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Auth::check() ? 5 : 4 }}" class="text-center">Belum ada data anggota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>