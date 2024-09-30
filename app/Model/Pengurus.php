<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama',
        'jabatan',
        'created_at',
        'updated_at',
    ];
}
