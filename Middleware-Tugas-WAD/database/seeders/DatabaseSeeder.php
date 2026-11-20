<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
    ['username' => 'admin'],
    ['password' => 'admin123', 'role' => 'admin']
);

User::firstOrCreate(
    ['username' => 'petugas'],
    ['password' => 'petugas123', 'role' => 'petugas']
);

User::firstOrCreate(
    ['username' => 'pengguna'],
    ['password' => 'pengguna123', 'role' => 'pengguna']
    );
    }
}
