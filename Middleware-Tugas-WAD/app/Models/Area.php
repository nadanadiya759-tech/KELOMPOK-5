<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Area extends Model {
    protected $table = 'fasilitas_area';
    protected $primaryKey = 'id_area';
    public $timestamps = false;
    protected $fillable = ['nama_area','nomor_lantai','ada_stopkontak','ada_wifi','ketersediaan_area'];
    protected function casts(): array { return ['ada_stopkontak'=>'boolean','ada_wifi'=>'boolean']; }
}
