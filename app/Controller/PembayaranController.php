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
            $pembayaran->bulan = $request['bulan'] . '-' . $request['tahun'];
            $pembayaran->bukti_pembayaran = $fileName;
            $pembayaran->save();
        } else {
            // if dont have foto make foto default from /public/uploads/default_img.jpg
            $pembayaran = new Pembayaran();
            $pembayaran->id_anggota = $_SESSION['user']['nid'];
            $pembayaran->bulan = $request['bulan'] . '-' . $request['tahun'];
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
    // Get the ID from the request URI
    $requestUri = $_SERVER['REQUEST_URI'];
    $uri = strtok($requestUri, '?');
    $pathSegments = explode('/', $uri);
    $id = end($pathSegments);

    // Find the existing payment record
    $pembayaran = Pembayaran::find($id);
    if (!$pembayaran) {
        // Handle the case when the payment record does not exist
        header('Location: /dashboard/pembayaran');
        exit();
    }

    // Update payment details
    $pembayaran->id_anggota = $_SESSION['user']['nid'];
    // $pembayaran->tanggal_bayar = $request['tanggal']; // Assuming you have 'tanggal' in your request
    $pembayaran->bulan = $request['bulan'] . '-' . $request['tahun'];

    // Check if a new file is uploaded
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        $file = $_FILES['foto'];

        // Generate unique file name
        $uniqueId = uniqid();
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = "{$uniqueId}.{$fileExtension}";

        // Save the new file content
        $fileContent = file_get_contents($file['tmp_name']);
        $this->filesystem->write($fileName, $fileContent);

        // Update the file name in the payment record
        $pembayaran->bukti_pembayaran = $fileName;
    }

    // Save the updated payment record
    $pembayaran->save();

    // Redirect based on user role
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
