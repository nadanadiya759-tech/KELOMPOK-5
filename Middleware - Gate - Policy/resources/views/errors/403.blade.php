@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
@php
    $pesan = $exception->getMessage();
    if ($pesan === '' || $pesan === 'This action is unauthorized.') {
        $pesan = 'Anda tidak memiliki hak akses.';
    }
@endphp

<div class="custom-card-box text-center">
    <h1 class="display-1 fw-bold text-danger">403</h1>
    <p class="lead">{{ $pesan }}</p>
    <a href="{{ route('anggota.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection