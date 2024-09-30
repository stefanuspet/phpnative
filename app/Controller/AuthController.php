<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Dojo;
use App\Model\Majelis;
use App\Model\User;

class AuthController
{
    protected $blade;

    public function __construct($blade)
    {
        session_start();
        $this->blade = $blade;

        // Cek apakah URL adalah '/logout'
        $currentUri = $_SERVER['REQUEST_URI'];

        if ($currentUri !== '/logout' && isset($_SESSION['user'])) {
            switch ($_SESSION['user']['role']) {
                case 'admin':
                    header('Location: /dashboard');
                    exit();
                case 'anggota':
                    header('Location: /dashboard-anggota');
                    exit();
                case 'majelis':
                    header('Location: /dashboard-majelis');
                    exit();
            }
        }
    }

    public function index()
    {
        echo $this->blade->run("authViews.Login");
    }

    public function register()
    {
        echo $this->blade->run("authViews.Register");
    }

    public function registerStore($request)
    {
        $credential_id = $request['cred_id'];

        if (!$credential_id) {
            $_SESSION['error'] = 'Credential ID tidak diberikan';
            header('Location: /register');
            exit();
        }
        // chech if credential_id is already exist on table user
        $majelis = Majelis::where('nit', $credential_id)->first();
        $anggota = Anggota::where('nid', $credential_id)->first();
        $user = User::where('credential_id', $credential_id)->first();
        if ($user) {
            header('Location: /register');
            $_SESSION['error'] = 'Credential ID sudah ada';
            exit();
        } else if ($majelis) {
            $_SESSION['credential_id'] = $credential_id;
            header('Location: /register/majelis');
            exit();
        } else if ($anggota) {
            $_SESSION['credential_id'] = $credential_id;
            header('Location: /register/anggota');
            exit();
        } else {
            header('Location: /register');
            $_SESSION['error'] = 'Credential ID tidak ditemukan';

            exit();
        }
    }

    public function registerMajelis()
    {
        $credential_id = $_SESSION['credential_id'];
        $majelis = Majelis::where('nit', $credential_id)->first();
        echo $this->blade->run("authViews.RegisterMajelis", ['majelis' => $majelis]);
    }

    public function registerAnggota()
    {
        // get seesion credential_id
        $credential_id = $_SESSION['credential_id'];
        // get anggota data
        $anggota = Anggota::where('nid', $credential_id)->first();
        $dojos = Dojo::all();

        echo $this->blade->run("authViews.RegisterAnggota", ['anggota' => $anggota, 'dojos' => $dojos]);
    }

    public function registerMajelisStore($request)
    {
        $credential_id = $_SESSION['credential_id'];

        $user = new User();
        $user->credential_id = $credential_id;
        // check request password and confirm_password is equal?
        if ($request['password'] !== $request['confirm_password']) {
            header('Location: /register/majelis');
            $_SESSION['error'] = 'Password tidak sama';
            exit();
        }
        $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
        $user->role = 'majelis';
        $user->save();

        // delete session credential_id
        unset($_SESSION['credential_id']);

        header('Location: /');
    }

    public function registerAnggotaStore($request)
    {
        $credential_id = $_SESSION['credential_id'];

        $user = new User();
        $user->credential_id = $credential_id;
        // check request password and confirm_password is equal?
        if ($request['password'] !== $request['confirm_password']) {
            header('Location: /register/anggota');
            $_SESSION['error'] = 'Password tidak sama';
            exit();
        }
        $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
        $user->role = 'anggota';
        $user->save();

        // delete session credential_id
        unset($_SESSION['credential_id']);

        header('Location: /');
    }

    public function login($request)
    {
        $cred_id = $request['cred_id'];
        $password = $request['password'];

        $user = User::where('credential_id', $cred_id)->first();

        if ($user && password_verify($password, $user->password)) {
            // if user is anggota and status atlet
            if ($user->role == 'anggota') {
                $_SESSION['user'] = [
                    'id' => $user->credential_id,
                    'role' => $user->role,
                    'status' => Anggota::where('nid', $user->credential_id)->first()->status
                ];
            } else {

                $_SESSION['user'] = [
                    'id' => $user->credential_id,
                    'role' => $user->role
                ];
            }
            switch ($user->role) {
                case 'admin':
                    header('Location: /dashboard');
                    break;
                case 'anggota':
                    header('Location: /dashboard-anggota');
                    break;
                case 'majelis':
                    header('Location: /dashboard-majelis');
                    break;
            }
        } else {
            header('Location: /');
            $_SESSION['error'] = 'Credential ID atau Password salah';
            exit();
        }
    }

    public function logout()
    {
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        header('Location: /');
    }
}
