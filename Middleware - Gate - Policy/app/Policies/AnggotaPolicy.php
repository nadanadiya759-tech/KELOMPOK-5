<?php

namespace App\Policies;

use App\Models\Anggota;
use App\Models\User;

class AnggotaPolicy
{
    // Boleh mengubah data INI?
    public function update(User $user, Anggota $anggota): bool
    {
        return $user->hasRole('admin');
    }

    // Boleh menghapus data INI? (kartu yang masih Aktif harus dinonaktifkan dulu)
    public function delete(User $user, Anggota $anggota): bool
    {
        return $user->hasRole('admin')
            && $anggota->status_id_card !== 'Aktif';
    }

    // Boleh mencetak kartu INI?
    public function cetak(User $user, Anggota $anggota): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $user->hasRole('anggota')
            && $user->nomor_kartu === $anggota->nomor_kartu
            && $anggota->status_id_card !== 'Nonaktif';
    }
}