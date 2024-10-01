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

    public function store($request)
    {
        $latihan = new Latihan();
        $latihan->id_anggota = $_SESSION['user']['nid'];
        $latihan->progres = $request['progres'];
        $latihan->catatan = isset ($request ['catatan']) ? $request['catatan']:'';
        $latihan->save();
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/latihan');
        } else if ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/latihan');
        } else {
            header('Location: /dashboard/latihan');
        }
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $latihan = Latihan::find($id);
        if (isset($request['progres'])) {
            $latihan->progres = $request['progres'];
        }
        if (isset($request['catatan'])) {
            # code...
            $latihan->catatan = $request['catatan'];
        }
        $latihan->save();

        // fint user using latihan id

        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/latihan');
        } else if ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/latihan/show/' . $latihan->id_anggota);
        } else {
            header('Location: /dashboard/latihan');
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
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/latihan');
        } elseif ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/latihan');
        } else {
            header("Location: /dashboard/latihan/show/{$id}");
        }
    }

    public function reset()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $latihan = Latihan::find($id);
        $latihan->catatan = null;
        $latihan->save();
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/latihan');
        } else if ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/latihan/show/' . $latihan->id_anggota);
        } else {
            header('Location: /dashboard/latihan');
        }
    }
}
