<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Gate: hanya admin yang boleh mengelola data anggota
        Gate::define('kelola-anggota', fn (User $user) => $user->hasRole('admin'));

        // Gate: hanya anggota yang akunnya terhubung ke nomor kartu
        Gate::define('kartu-saya', fn (User $user) => $user->hasRole('anggota') && $user->nomor_kartu !== null);
    }
}