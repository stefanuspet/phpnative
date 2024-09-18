<?php

namespace App\Controller;

use App\Model\User;

class UserController
{
    protected $blade;

    public function __construct($blade)
    {
        $this->blade = $blade; // Menyimpan instance BladeOne yang di-passing dari index
    }
    public function index()
    {
        $user = User::where('credential_id', 123)->first();
        echo $this->blade->run("user", ["name" => $user->role]);
    }
}
