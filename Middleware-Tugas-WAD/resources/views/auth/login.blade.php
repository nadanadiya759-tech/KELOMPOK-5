@extends('layouts.app')
@section('title', 'Login Admin')
@section('content')
    <section class="card form-card">
        <h1>Login Admin</h1>
        <p>Masuk untuk mengedit dan menghapus data fasilitas area.</p>
        <form method="POST" action="{{ route('login.proses') }}">@csrf
            <label for="username">Username</label><input id="username" name="username" value="{{ old('username') }}"
                autocomplete="username" required autofocus>
            <label for="password">Password</label><input id="password" type="password" name="password"
                autocomplete="current-password" required>
            <label class="check"><input type="checkbox" name="remember" value="1"> Ingat saya</label><button
                type="submit">Masuk</button>
        </form>
    </section>
@endsection