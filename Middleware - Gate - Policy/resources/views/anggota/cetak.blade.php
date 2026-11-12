@extends('layouts.app')

@section('title', 'Cetak ID Card - ' . $anggota->nama_anggota)

@section('content')
<div class="no-print mb-3">
    <button type="button" onclick="window.print()" class="btn btn-primary">Cetak</button>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="id-card">
    <div class="id-card-header">KARTU ANGGOTA PERPUSTAKAAN DIGITAL</div>
    <div class="id-card-body">
        <div class="id-card-nama">{{ $anggota->nama_anggota }}</div>
        <table class="id-card-info">
            <tr><td>No. Kartu</td><td>: {{ $anggota->nomor_kartu }}</td></tr>
            <tr><td>Tipe</td><td>: {{ $anggota->tipe_keanggotaan }}</td></tr>
            <tr><td>Terdaftar</td><td>: {{ $anggota->tanggal_daftar?->format('d/m/Y') ?? '-' }}</td></tr>
            <tr><td>Berlaku s/d</td><td>: {{ $anggota->masa_berlaku?->format('d/m/Y') ?? '-' }}</td></tr>
        </table>
    </div>
    <div class="id-card-footer">Status: {{ $anggota->status_id_card }}</div>
</div>
@endsection
