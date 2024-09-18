<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_anggota',
        'bulan',
        'bukti_pembayaran',
        'created_at',
        'updated_at',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'nid');
    }
}
