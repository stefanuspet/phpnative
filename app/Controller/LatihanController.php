<?php

namespace App\Controller;

use App\Model\Latihan;

class LatihanController
{
    protected $blade;

    public function __construct($blade)
    {
        session_start();
        $this->blade = $blade;
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }
    }

    // destroy
    public function destroy($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $latihan = Latihan::find($request['id']);
        var_dump($latihan);
        $latihan->delete();
        header("Location: /dashboard/latihan/show/{$id}");
    }
}
