@extends('layouts.app')

@section('title', 'Login - Perpustakaan Digital')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="custom-card-box p-4 bg-white shadow-sm">
            <h3 class="mb-3 text-center">Login</h3>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required value="{{ old('username') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary w-100">Kembali ke Beranda</a>
            </form>
        </div>
    </div>
</div>
@endsection
