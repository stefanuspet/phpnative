<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DojoMajelis extends Model
{
    protected $table = 'dojo_majelis';
    protected $primaryKey = ['id_dojo', 'id_majelis'];
    public $incrementing = false;
    protected $fillable = [
        'id_dojo',
        'id_majelis'
    ];
    protected $keyType = 'bigint';
    public $timestamps = false;
}
