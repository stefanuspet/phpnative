<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Prestasi;

class PrestasiController
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
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);


        $prestasi = new Prestasi();
        $prestasi->id_anggota = $id;
        $prestasi->nama = $request['nama'];
        $prestasi->tingkat = $request['tingkat'];
        $prestasi->peringkat = $request['peringkat'];
        $prestasi->waktu_dapat = $request['waktu_dapat'];
        $prestasi->save();
        // back to prev page
        header('Location: /dashboard/anggota/show/' . $id);
    }

    public function update($request)
    {
        // Mendapatkan URL yang diakses
        $requestUri = $_SERVER['REQUEST_URI'];

        // Menghapus query string jika ada
        $uri = strtok($requestUri, '?');

        // Memecah URL menjadi segmen
        $pathSegments = explode('/', $uri);
        // Mendapatkan {id} dan {id_anggota}
        $id_anggota = end($pathSegments); // Segmen terakhir
        $id = prev($pathSegments); // Segmen sebelum terakhir

        $prestasi = Prestasi::where('id', $id)->first();
        $prestasi->nama = $request['nama'];
        $prestasi->tingkat = $request['tingkat'];
        $prestasi->peringkat = $request['peringkat'];
        $prestasi->waktu_dapat = $request['waktu_dapat'];
        $prestasi->save();
        header('Location: /dashboard/anggota/show/' . $id_anggota);
    }

    public function destroy($request)
    {
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
        header("Pragma: no-cache"); // HTTP 1.0
        header("Expires: 0");   
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id_anggota = end($pathSegments);
        var_dump($id_anggota);
        $id = $request['id'];
        $prestasi = Prestasi::find($id);
        $prestasi->delete();
        header('Location: /dashboard/anggota/show/' . $id_anggota);
        
    }
}
