<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;


class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_anggota',
        'nama',
        'tahun',
        'tingkat',
        'created_at',
        'updated_at',
        'foto'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'nid');
    }
}
