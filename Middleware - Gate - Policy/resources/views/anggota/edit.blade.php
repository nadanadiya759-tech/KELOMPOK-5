@extends('layouts.app')

@section('title', 'Edit Data Anggota')

@section('content')
<div class="custom-card-box">
    <h1 class="mb-4">Edit Data Anggota</h1>

    <form action="{{ route('anggota.update', $anggota) }}" method="POST">
        @csrf
        @method('PUT')
        @include('anggota._form', ['anggota' => $anggota])

        <button type="submit" class="btn btn-warning">Update Data</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
