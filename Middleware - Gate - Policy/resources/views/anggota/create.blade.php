@extends('layouts.app')

@section('title', 'Tambah Data Anggota')

@section('content')
<div class="custom-card-box">
    <h1 class="mb-4">Tambah Data Anggota</h1>

    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
        @include('anggota._form', ['anggota' => null])

        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
