<?php

namespace App\Model;

use illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'credential_id';

    public $timestamps = true;

    protected $fillable = [
        'credential_id',
        'password',
        'role',
        'created_at',
        'updated_at',
        'id_role'
    ];
}
