<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Majelis extends Model
{
    protected $table = 'majelis';
    protected $primaryKey = 'nit';

    public $timestamps = true;

    protected $fillable = [
        'nit',
        'nama',
        'tahun_gabung',
        'jenis_kelamin',
        'alamat',
        'jabatan',
        'tingkat_sabuk',
        'spesialis',
        'foto',
        'tanggal_lahir',
        'tempat_lahir',
        'created_at',
        'updated_at',
    ];
}
