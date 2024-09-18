<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';
    protected $primaryKey = 'nid';

    public $timestamps = true;

    protected $fillable = [
        'nid',
        'id_dojo',
        'nama',
        'jenis_kelamin',
        'alamat',
        'tahun_gabung',
        'status',
        'tingkat_sabuk',
        'nomor',
        'foto',
        'tanggal_lahir',
        'tempat_lahir',
        'created_at',
        'updated_at',
    ];

    public function dojo()
    {
        return $this->belongsTo(Dojo::class, 'id_dojo', 'id');
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'nid', 'nid');
    }

    public function latihan()
    {
        return $this->hasMany(Latihan::class, 'id_anggota', 'nid');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_anggota', 'nid');
    }
}
