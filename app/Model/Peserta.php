<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';
    protected $primaryKey = 'id_peserta';

    public $timestamps = true;

    protected $fillable = [
        'id_peserta',
        'id_kegiatan',
        'nid',
        'status',
        'created_at',
        'updated_at',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nid', 'nid');
    }
}
