<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'nomor_kartu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_kartu',
        'nama_anggota',
        'tipe_keanggotaan',
        'status_id_card',
    ];
}