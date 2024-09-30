<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_kegiatan',
        'tanggal',
        'lokasi',
        'created_at',
        'updated_at',
    ];

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_kegiatan', 'id');
    }
}
