<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }
// untuk menyimmpan
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kartu' => 'required|unique:anggota,nomor_kartu',
            'nama_anggota' => 'required',
            'tipe_keanggotaan' => 'required',
            'status_id_card' => 'required',
        ]);

        Anggota::create([
            'nomor_kartu' => $request->nomor_kartu,
            'nama_anggota' => $request->nama_anggota,
            'tipe_keanggotaan' => $request->tipe_keanggotaan,
            'status_id_card' => $request->status_id_card,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(string $nomor_kartu)
    {
        $anggota = Anggota::findOrFail($nomor_kartu);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $nomor_kartu)
    {
        $anggota = Anggota::findOrFail($nomor_kartu);
        
        $request->validate([
            'nama_anggota' => 'required',
            'tipe_keanggotaan' => 'required',
            'status_id_card' => 'required',
        ]);

        $anggota->update([
            'nama_anggota' => $request->nama_anggota,
            'tipe_keanggotaan' => $request->tipe_keanggotaan,
            'status_id_card' => $request->status_id_card,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $nomor_kartu)
    {
        $anggota = Anggota::findOrFail($nomor_kartu);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus.');
    }
}