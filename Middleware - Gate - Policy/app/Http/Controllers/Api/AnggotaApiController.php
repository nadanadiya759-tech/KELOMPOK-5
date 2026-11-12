<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaApiController extends Controller
{
    // GET /api/anggota  (publik / tamu) -> cuma nama + tipe
    public function index(Request $request)
    {
        $cari = trim((string) $request->query('q', ''));

        $data = Anggota::query()
            ->when($cari !== '', fn ($q) => $q->where('nama_anggota', 'like', "%{$cari}%"))
            ->orderBy('nama_anggota')
            ->paginate(10, ['nama_anggota', 'tipe_keanggotaan']);

        return response()->json($data);
    }

    // GET /api/anggota/{nomor_kartu}  (admin: semua, anggota: punya sendiri)
    public function show(Request $request, Anggota $anggota)
    {
        $user = $request->user();

        if (! $user->isAdmin() && $user->nomor_kartu !== $anggota->nomor_kartu) {
            return response()->json(['message' => 'Kamu cuma boleh melihat data milikmu sendiri.'], 403);
        }

        return response()->json(['data' => $anggota]);
    }

    // POST /api/anggota  (admin)
    public function store(Request $request)
    {
        $data = $request->validate(Anggota::validationRules(true));
        $data['tanggal_daftar'] = $data['tanggal_daftar'] ?? now()->toDateString();

        $anggota = Anggota::create($data);

        return response()->json(['data' => $anggota], 201);
    }

    // PUT /api/anggota/{nomor_kartu}  (admin)
    public function update(Request $request, Anggota $anggota)
    {
        $anggota->update($request->validate(Anggota::validationRules(false)));

        return response()->json(['data' => $anggota]);
    }

    // DELETE /api/anggota/{nomor_kartu}  (admin)
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return response()->noContent();
    }
}
