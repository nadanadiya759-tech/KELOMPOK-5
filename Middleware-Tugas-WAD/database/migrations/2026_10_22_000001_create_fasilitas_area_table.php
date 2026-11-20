<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('fasilitas_area')) return;
        Schema::create('fasilitas_area',function(Blueprint $table) {
            $table->increments('id_area'); $table->string('nama_area',100);
            $table->text('nomor_lantai'); $table->boolean('ada_stopkontak');
            $table->boolean('ada_wifi'); $table->enum('ketersediaan_area',['tersedia','tidak tersedia']);
        });
    }
    public function down(): void {
        // This table may predate Laravel. Preserve existing library data on rollback.
    }
};
