<?php

namespace App\Controller;

use App\Model\Pembayaran;


class PembayaranController
{
    protected $blade;
    protected $filesystem;

    public function __construct($blade, $filesystem)
    {
        session_start();
        $this->filesystem = $filesystem;
        $this->blade = $blade;
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }
    }

    public function store($request)
    {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];

            // Menghasilkan nama file unik
            $uniqueId = uniqid(); // Menghasilkan ID unik
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = "{$uniqueId}.{$fileExtension}";

            $fileContent = file_get_contents($file['tmp_name']);
            $this->filesystem->write($fileName, $fileContent);

            $pembayaran = new Pembayaran();
            $pembayaran->id_anggota = $_SESSION['user']['nid'];
            $pembayaran->bulan = $request['bulan'];
            $pembayaran->bukti_pembayaran = $fileName;
            $pembayaran->save();
        } else {
            // if dont have foto make foto default from /public/uploads/default_img.jpg
            $pembayaran = new Pembayaran();
            $pembayaran->id_anggota = $_SESSION['user']['nid'];
            $pembayaran->bulan = $request['bulan'];
            $pembayaran->save();
        }
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/pembayaran');
        } else {
            header('Location: /dashboard/pembayaran');
        }
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $pembayaran = Pembayaran::find($id);
        $pembayaran->id_anggota = $_SESSION['user']['nid'];
        $pembayaran->id_kegiatan = $request['id_kegiatan'];
        $pembayaran->tanggal_bayar = $request['tanggal_bayar'];
        $pembayaran->nominal = $request['nominal'];
        $pembayaran->save();
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/pembayaran');
        } else {
            header('Location: /dashboard/pembayaran');
        }
    }

    // destroy
    public function destroy($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $pembayaran = Pembayaran::find($request['id']);
        var_dump($pembayaran);
        $pembayaran->delete();
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/pembayaran');
        } else {

            header("Location: /dashboard/pembayaran/show/{$id}");
        }
    }
}
