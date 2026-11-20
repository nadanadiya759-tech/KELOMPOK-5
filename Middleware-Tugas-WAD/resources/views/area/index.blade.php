@extends('layouts.app')
@section('title', 'Daftar Fasilitas & Area')
@section('content')
    <header>
        <div>
            <p class="eyebrow">PERPUSTAKAAN DIGITAL</p>
            <h1>Data Fasilitas Area</h1>
            <p>Kelola informasi fasilitas dan area perpustakaan dalam satu tempat.</p>
            @auth                
@can('tambah-area')
                    <a class="button" href="{{ route('area.create') }}">
                        + Tambah Area
                    </a>
                @endcan
            @endauth
    </header>
    <section class="card table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama Area</th>
                    <th>Nomor Lantai</th>
                    <th>Fasilitas</th>
                    <th>Ketersediaan Area</th>@auth<th>Aksi</th>@endauth
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $area)
                    <tr>
                        <td>{{ $area->nama_area }}</td>
                        <td>{{ $area->nomor_lantai }}</td>
                        <td>{{ $area->ada_stopkontak ? 'Stopkontak ' : '' }}{{ $area->ada_wifi ? 'WiFi' : '' }}{{ !$area->ada_stopkontak && !$area->ada_wifi ? '-' : '' }}
                        </td>
                        <td><span
                                class="badge {{ $area->ketersediaan_area === 'tersedia' ? 'available' : '' }}">{{ ucfirst($area->ketersediaan_area) }}</span>
                        </td>

                        @auth
                            <td>
                                <div class="actions">
            @can('edit-area')
    <a href="{{ route('area.edit', $area) }}">Edit</a>
        @endcan                                
            @can('hapus-area')
                                        <form class="inline" method="POST" action="{{ route('area.destroy', $area) }}"
                                            onsubmit="return confirm('Yakin hapus area ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="danger">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        @endauth

                @empty
                        <tr>
                            <td colspan="{{ auth()->check() ? 5 : 4 }}">Belum ada data area.</td>
                    </tr>@endforelse
            </tbody>
        </table>
    </section>
@endsection