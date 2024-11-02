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
        'nominal',
        'created_at',
        'updated_at',
        'catatan'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'nid');
    }
}
