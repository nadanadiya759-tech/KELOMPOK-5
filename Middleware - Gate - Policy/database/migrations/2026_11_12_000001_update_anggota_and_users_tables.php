<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // profil anggota yang lebih lengkap + data buat cetak ID card
        Schema::table('anggota', function (Blueprint $table) {
            $table->string('email', 100)->nullable()->after('nama_anggota');
            $table->string('no_hp', 20)->nullable()->after('email');
            $table->string('alamat')->nullable()->after('no_hp');
            $table->date('tanggal_daftar')->nullable()->after('status_id_card');
            $table->date('masa_berlaku')->nullable()->after('tanggal_daftar');
        });

        // hubungkan akun login (users) ke data anggota -> relasi 1 user : 1 anggota
        Schema::table('users', function (Blueprint $table) {
            $table->string('nomor_kartu')->nullable()->after('role');
            $table->foreign('nomor_kartu')
                ->references('nomor_kartu')->on('anggota')
                ->nullOnDelete()->cascadeOnUpdate();
        });

        // default role jangan 'admin' lagi, bahaya kalau ada akun baru
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('anggota')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['nomor_kartu']);
            $table->dropColumn('nomor_kartu');
            $table->string('role', 20)->default('admin')->change();
        });

        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn(['email', 'no_hp', 'alamat', 'tanggal_daftar', 'masa_berlaku']);
        });
    }
};
