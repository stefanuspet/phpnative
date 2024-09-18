<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dojo extends Model
{
    protected $table = 'dojos';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'nama',
        'lokasi',
        'cabang',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_dojo', 'id');
    }
}
