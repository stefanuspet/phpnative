<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    protected $table = 'latihans';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_anggota',
        'progres',
        'catatan',
        'created_at',
        'updated_at',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'nid');
    }
}
