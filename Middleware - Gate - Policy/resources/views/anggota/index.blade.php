@extends('layouts.app')

@section('title', 'Sistem Manajemen Perpustakaan Digital')

@section('content')
@php $user = auth()->user(); @endphp

<div class="custom-card-box">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Sistem Manajemen Perpustakaan Digital</h1>
        <div>
            @if($user)
                <span class="me-2 text-muted">Halo, {{ $user->username }} ({{ $user->role }})</span>
                @can('kartu-saya')
                    <a href="{{ route('anggota.kartu-saya') }}" class="btn btn-outline-primary btn-sm">Kartu Saya</a>
                @endcan
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
        <div>
            @can('kelola-anggota')
                <a href="{{ route('anggota.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
            @endcan
        </div>
        <form method="GET" action="{{ route('anggota.index') }}" class="d-flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm"
                   placeholder="{{ $user ? 'Cari nama / nomor kartu' : 'Cari nama' }}">
            <button type="submit" class="btn btn-sm btn-outline-secondary">Cari</button>
        </form>
    </div>

    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                @if($user)<th>Nomor Kartu (NIM)</th>@endif
                <th>Nama Anggota</th>
                <th>Tipe Keanggotaan</th>
                @if($user)
                    <th>Status ID Card</th>
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($anggota as $row)
                @php
                    $warna = [
                        'Aktif' => 'success',
                        'Belum Dicetak' => 'secondary',
                        'Nonaktif' => 'warning',
                        'Hilang' => 'danger',
                    ][$row->status_id_card] ?? 'secondary';
                @endphp
                <tr>
                    @if($user)<td>{{ $row->nomor_kartu }}</td>@endif
                    <td>{{ $row->nama_anggota }}</td>
                    <td>{{ $row->tipe_keanggotaan }}</td>
                    @if($user)
                        <td><span class="badge badge-status text-bg-{{ $warna }}">{{ $row->status_id_card }}</span></td>
                        <td>
                            @can('cetak', $row)
                                <a href="{{ route('anggota.cetak', $row) }}" class="btn btn-info btn-sm">Cetak ID</a>
                            @endcan

                            @can('update', $row)
                                <a href="{{ route('anggota.edit', $row) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan

                            @can('delete', $row)
                                <form action="{{ route('anggota.destroy', $row) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            @endcan
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $user ? 5 : 2 }}" class="text-center">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $anggota->links() }}
</div>
@endsection
