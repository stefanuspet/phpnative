<?php

namespace App\Controller;

use App\Model\Dojo;

class DojoController
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
        // Validate the request data
        $nama = $request['nama'];
        $lokasi = $request['lokasi'];
        $cabang = $request['cabang'];

        // validate cabang must Gowa || Makasar || Bone
        if ($cabang != 'Gowa' && $cabang != 'Makasar' && $cabang != 'Bone') {
            $_SESSION['error'] = 'Credential ID atau Password salah';
            header('Location: /dashboard/cabang/create');
        }

        Dojo::create([
            'nama' => $nama,
            'lokasi' => $lokasi,
            'cabang' => $cabang
        ]);

        header('Location: /dashboard/cabang');

        // header('Location: /dashboard/cabang');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $nama = $request['nama'];
        $lokasi = $request['lokasi'];
        $cabang = $request['cabang'];

        if ($cabang != 'Gowa' && $cabang != 'Makasar' && $cabang != 'Bone') {
            $_SESSION['error'] = 'Credential ID atau Password salah';
            header('Location: /dashboard/cabang/create');
        }
        $dojo = Dojo::find($id);
        $dojo->nama = $nama;
        $dojo->lokasi = $lokasi;
        $dojo->cabang = $cabang;
        $dojo->save();

        header('Location: /dashboard/cabang');
    }

    public function destroy($request)
    {
        $dojo = Dojo::find($request['id']);
        $dojo->delete();
        header('Location: /dashboard/cabang');
    }
}
