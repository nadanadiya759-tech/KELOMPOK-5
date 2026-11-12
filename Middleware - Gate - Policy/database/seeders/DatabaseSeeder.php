<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // data anggota contoh (anggota dulu, soalnya users.nomor_kartu refer ke sini)
            $contoh = [
            ['2301010001', 'NADA NADIYA', 'Mahasiswa', 'Aktif'],
            ['2301010002', 'AZ ZAKY MUHARRAM', 'Mahasiswa', 'Belum Dicetak'],
            ['2301010003', 'M RIZKI RAMADHANI', 'Dosen', 'Nonaktif'],
            ['2301010004', 'TIMOTHY WILLBERT JACONIAS NARUA', 'Umum', 'Hilang'],
        ];

           foreach ($contoh as [$nomor, $nama, $tipe, $status]) {
            Anggota::updateOrCreate(
                ['nomor_kartu' => $nomor],
                [
                    'nama_anggota' => $nama,
                    'tipe_keanggotaan' => $tipe,
                    'status_id_card' => $status,
                    'tanggal_daftar' => now()->toDateString(),
                    'masa_berlaku' => now()->addYears(4)->toDateString(),
                ]
            );
        }

        User::updateOrCreate(['username' => 'admin'], [
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nomor_kartu' => null,
        ]);

        User::updateOrCreate(['username' => 'jaky'], [
            'password' => Hash::make('anggota123'),
            'role' => 'anggota',
            'nomor_kartu' => '2301010001',
        ]);
    }
}
