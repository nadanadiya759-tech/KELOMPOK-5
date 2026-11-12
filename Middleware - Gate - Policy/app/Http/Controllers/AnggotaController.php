<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // TAMU + semua role: daftar anggota (data yang tampil dibedakan di view)
    public function index(Request $request)
    {
        $user = $request->user();
        $cari = trim((string) $request->query('q', ''));

        $anggota = Anggota::query()
            ->when($cari !== '', function ($query) use ($cari, $user) {
                $query->where(function ($w) use ($cari, $user) {
                    $w->where('nama_anggota', 'like', "%{$cari}%");
                    // tamu cuma boleh cari lewat nama, biar nomor kartu nggak bisa ditebak
                    if ($user) {
                        $w->orWhere('nomor_kartu', 'like', "%{$cari}%");
                    }
                });
            })
            ->orderBy('nama_anggota')
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(Anggota::validationRules(true));
        $data['tanggal_daftar'] = $data['tanggal_daftar'] ?? now()->toDateString();

        Anggota::create($data);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $anggota->update($request->validate(Anggota::validationRules(false)));

        return redirect()->route('anggota.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        // users.nomor_kartu otomatis jadi NULL (nullOnDelete di migration)
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus.');
    }

    // ANGGOTA: shortcut ke kartu miliknya sendiri
    public function kartuSaya(Request $request)
    {
        $nomorKartu = $request->user()->nomor_kartu;

        abort_if(! $nomorKartu, 404, 'Akun ini belum terhubung ke data anggota.');

        return redirect()->route('anggota.cetak', $nomorKartu);
    }

        // aturan siapa boleh cetak sudah dijaga AnggotaPolicy::cetak lewat route
    public function cetak(Anggota $anggota)
    {
        return view('anggota.cetak', compact('anggota'));
    }
}
