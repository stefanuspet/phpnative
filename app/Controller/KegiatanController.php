<?php

namespace App\Controller;

use App\Model\Kegiatan;

class KegiatanController
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
        $kegiatan = new Kegiatan();
        $kegiatan->nama = $request['nama'];
        $kegiatan->tanggal = $request['tanggal'];
        $kegiatan->lokasi = $request['lokasi'];
        $kegiatan->save();
        header('Location: /dashboard/kegiatan');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $kegiatan = Kegiatan::find($id);
        $kegiatan->nama = $request['nama'];
        $kegiatan->tanggal = $request['tanggal'];
        $kegiatan->lokasi = $request['lokasi'];
        $kegiatan->save();
        header('Location: /dashboard/kegiatan');
    }

    public function destroy()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $kegiatan = Kegiatan::find($id);
        $kegiatan->delete();
        header('Location: /dashboard/kegiatan');
    }
}
