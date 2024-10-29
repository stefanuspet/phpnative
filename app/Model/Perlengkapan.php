<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;


class Perlengkapan extends Model
{
    protected $table = 'perlengkapan';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama',
        'ukuran',
        'jumlah',
        'foto',
        'created_at',
        'updated_at',
        
    ];
}
