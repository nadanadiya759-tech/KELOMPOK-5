@extends('layouts.app')
@section('title', $area->exists ? 'Edit Area' : 'Tambah Area')
@section('content')
<section class="card form-card"><h1>{{ $area->exists ? 'Edit Area' : 'Tambah Area' }}</h1><p>Lengkapi informasi fasilitas dan area perpustakaan.</p>
<form method="POST" action="{{ $area->exists ? route('area.update',$area) : route('area.store') }}">@csrf @if($area->exists) @method('PUT') @endif
<label for="nama">Nama Area</label><input id="nama" name="nama_area" maxlength="100" value="{{ old('nama_area',$area->nama_area) }}" required>
<label for="lantai">Nomor Lantai</label><input id="lantai" type="number" name="nomor_lantai" min="0" max="999" value="{{ old('nomor_lantai',$area->nomor_lantai) }}" required>
<fieldset><legend>Fasilitas</legend>
<input type="hidden" name="ada_stopkontak" value="0"><label class="check"><input type="checkbox" name="ada_stopkontak" value="1" @checked(old('ada_stopkontak',$area->ada_stopkontak))> Stopkontak</label>
<input type="hidden" name="ada_wifi" value="0"><label class="check"><input type="checkbox" name="ada_wifi" value="1" @checked(old('ada_wifi',$area->ada_wifi))> WiFi</label></fieldset>
<label for="status">Ketersediaan Area</label><select id="status" name="ketersediaan_area" required><option value="">Pilih ketersediaan</option>@foreach(['tersedia','tidak tersedia'] as $status)<option value="{{ $status }}" @selected(old('ketersediaan_area',$area->ketersediaan_area)===$status)>{{ ucfirst($status) }}</option>@endforeach</select>
<div class="actions"><a href="{{ route('area.index') }}">Kembali</a><button type="submit">Simpan Area</button></div></form></section>
@endsection
