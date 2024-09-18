<?php

namespace App\Controller;

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

    public function login($request)
    {
        $cred_id = $request['cred_id'];
        $password = $request['password'];

        $user = User::where('credential_id', $cred_id)->first();

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = [
                'id' => $user->credential_id,
                'role' => $user->role
            ];
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
