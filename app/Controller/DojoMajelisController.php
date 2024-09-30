<?php

namespace App\Controller;

use App\Model\DojoMajelis;

class DojoMajelisController
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
        // check if the request is already exist
        $majelis = DojoMajelis::where('id_dojo', $request['id_dojo'])->where('id_majelis', $request['id_majelis'])->first();
        if ($majelis) {
            header('Location: /dashboard/dojoMajelis');
            $_SESSION['error'] = 'Data sudah ada';
            exit();
        } else {
            $majelis = new DojoMajelis();
            $majelis->id_dojo = $request['id_dojo'];
            $majelis->id_majelis = $request['id_majelis'];
            $majelis->save();
            header('Location: /dashboard/dojoMajelis');
        }
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $majelis = DojoMajelis::find($id);
        $majelis->nama = $request['nama'];
        $majelis->tanggal = $request['tanggal'];
        $majelis->lokasi = $request['lokasi'];
        $majelis->save();
        header('Location: /dashboard/majelis');
    }

    public function destroy($request)
    {
        // Gunakan query builder untuk menghapus berdasarkan id_dojo dan id_majelis
        $deletedRows = DojoMajelis::where('id_dojo', $request['id_dojo'])
            ->where('id_majelis', $request['id_majelis'])
            ->delete();

        // Set pesan berdasarkan hasil operasi delete
        if ($deletedRows) {
            $_SESSION['success'] = 'Data berhasil dihapus';
        } else {
            $_SESSION['error'] = 'Data tidak ditemukan atau sudah dihapus';
        }

        // Redirect setelah operasi selesai
        header('Location: /dashboard/dojoMajelis');
        exit();
    }
}
