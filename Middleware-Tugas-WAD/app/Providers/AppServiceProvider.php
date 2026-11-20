<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Area;
use App\Policies\AreaPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
            Gate::policy(Area::class, AreaPolicy::class);

        // Admin dan petugas boleh menambah fasilitas
        Gate::define('tambah-area', function (User $user) {
            return in_array($user->role, ['admin', 'petugas']);
        });

        // Admin dan petugas boleh mengedit fasilitas
        Gate::define('edit-area', function (User $user) {
            return in_array($user->role, ['admin', 'petugas']);
        });

        // Hanya admin boleh menghapus fasilitas
        Gate::define('hapus-area', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
