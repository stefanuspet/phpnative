<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;


class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';

    public $timestamps = true;

    protected $fillable = [
        'id_prestasi',
        'id_anggota',
        'nama_prestasi',
        'tahun',
        'tingkat',
        'created_at',
        'updated_at'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'nid');
    }
}
