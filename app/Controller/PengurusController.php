<?php

namespace App\Controller;

use App\Model\Pengurus;

class PengurusController
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
        $pengurus = new Pengurus();
        $pengurus->nama = $request['nama'];
        $pengurus->jabatan = $request['jabatan'];
        $pengurus->save();

        var_dump($pengurus);
        header('Location: /dashboard/pengurus');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $pengurus = Pengurus::find($id);
        $pengurus->nama = $request['nama'];
        $pengurus->jabatan = $request['jabatan'];
        $pengurus->save();
        header('Location: /dashboard/pengurus');
    }

    public function destroy($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $pengurus = Pengurus::find($id);
        $pengurus->delete();
        header('Location: /dashboard/pengurus');
    }
}
