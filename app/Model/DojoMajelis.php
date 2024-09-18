<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DojoMajelis extends Model
{
    protected $table = 'dojo_majelis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_dojo',
        'id_majelis'
    ];
    public $timestamps = false;
}
