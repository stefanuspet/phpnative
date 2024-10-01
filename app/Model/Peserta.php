<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_kegiatan',
        'id_anggota',
        'tanggal_daftar',
        'created_at',
        'updated_at',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'nid');
    }
}
