<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class ForgetPass extends Model
{
    protected $table = 'forgetpass';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'credential',
        'nama',
        'role',
        'nomor',
        'status',
        'created_at',
        'updated_at',
    ];
}
