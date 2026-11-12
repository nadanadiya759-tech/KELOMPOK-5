<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Anggota extends Model
{
    use HasFactory;

    public const TIPE = ['Mahasiswa', 'Dosen', 'Umum'];
    public const STATUS = ['Belum Dicetak', 'Aktif', 'Nonaktif', 'Hilang'];

    protected $table = 'anggota';
    protected $primaryKey = 'nomor_kartu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_kartu',
        'nama_anggota',
        'email',
        'no_hp',
        'alamat',
        'tipe_keanggotaan',
        'status_id_card',
        'tanggal_daftar',
        'masa_berlaku',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'date',
            'masa_berlaku' => 'date',
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'nomor_kartu', 'nomor_kartu');
    }

    /**
     * Aturan validasi dipakai bareng sama controller web & API.
     * nomor_kartu cuma divalidasi pas create (PK nggak boleh diubah).
     */
    public static function validationRules(bool $isCreate): array
    {
        $rules = [
            'nama_anggota'     => ['required', 'string', 'max:100'],
            'email'            => ['nullable', 'email', 'max:100'],
            'no_hp'            => ['nullable', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'alamat'           => ['nullable', 'string', 'max:255'],
            'tipe_keanggotaan' => ['required', Rule::in(self::TIPE)],
            'status_id_card'   => ['required', Rule::in(self::STATUS)],
            'tanggal_daftar'   => ['nullable', 'date'],
            'masa_berlaku'     => ['nullable', 'date'],
        ];

        if ($isCreate) {
            // huruf/angka/strip aja, soalnya nomor kartu dipakai di URL
            $rules['nomor_kartu'] = [
                'required', 'string', 'max:30',
                'regex:/^[A-Za-z0-9\-]+$/',
                'unique:anggota,nomor_kartu',
            ];
        }

        return $rules;
    }
}
