<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DojoMajelis extends Model
{
    protected $table = 'dojo_majelis';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_dojo',
        'id_majelis',
        'day',
        'start_time',
        'end_time'
    ];
    protected $keyType = 'bigint';
    public $timestamps = false;
}
