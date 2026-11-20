<!DOCTYPE html>
<html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title', 'Fasilitas & Area') | Perpustakaan Digital</title>
<link rel="stylesheet" href="{{ asset('css/area.css') }}"></head>
<body><nav><a href="{{ route('area.index') }}">Perpustakaan Digital</a><div>
@auth <span>{{ auth()->user()->username }}</span><form class="inline" action="{{ route('logout') }}" method="POST">@csrf<button>Logout</button></form>
@else <a href="{{ route('login') }}">Login Admin</a> @endauth
</div></nav><main>
@if(session('success'))<p class="success" role="status">{{ session('success') }}</p>@endif
@if($errors->any())<div class="error" role="alert"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')</main></body></html>
