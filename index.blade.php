<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - Data Penerbit</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #3498db;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        h2 {
            color: #2c3e50;
            margin: 0;
        }
        .btn-tambah {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .btn-tambah:hover { background-color: #27ae60; }
        
        .btn-logout {
            background-color: #e74c3c;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        .btn-logout:hover { background-color: #c0392b; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #34495e;
            color: white;
        }
        tr:hover { background-color: #f5f5f5; }

        .btn-aksi {
            padding: 6px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }
        .btn-edit { background-color: #f1c40f; color: #333; }
        .btn-edit:hover { background-color: #d4ac0d; }
        .btn-hapus { background-color: #e74c3c; }
        .btn-hapus:hover { background-color: #c0392b; }
        
        .alert {
            padding: 12px 15px;
            background-color: #2ecc71;
            color: white;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-top">
        <h2>📚 Daftar Penerbit - Perpustakaan Digital</h2>
        
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn-logout">🚪 Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('penerbit.create') }}" class="btn-tambah">+ Tambah Penerbit Baru</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penerbit</th>
                <th>Wilayah Asal</th>
                <th>Nama Sales</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penerbit as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_penerbit }}</td>
                <td>{{ $p->wilayah_asal }}</td>
                <td>{{ $p->nama_sales }}</td>
                <td>{{ $p->telepon_sales }}</td>
                <td>{{ $p->email_sales }}</td>
                <td>
                    <a href="{{ route('penerbit.edit', $p->id_penerbit) }}" class="btn-aksi btn-edit">Edit</a>
                    
                    <form action="{{ route('penerbit.destroy', $p->id_penerbit) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus penerbit ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-aksi btn-hapus">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; color: #888;">Belum ada data penerbit.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>