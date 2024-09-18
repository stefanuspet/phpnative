<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';
    protected $primaryKey = 'id_kegiatan';

    public $timestamps = true;

    protected $fillable = [
        'id_kegiatan',
        'nama_kegiatan',
        'tanggal',
        'jam',
        'tempat',
        'keterangan',
        'created_at',
        'updated_at',
    ];

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_kegiatan', 'id_kegiatan');
    }
}
