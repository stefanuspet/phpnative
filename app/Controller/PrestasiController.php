<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Prestasi;

class PrestasiController
{
    protected $blade;
    protected $filesystem;

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
    // Extract the id from the URI
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

    // Check if a file has been uploaded
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['foto'];

        // Generate a unique file name
        $uniqueId = uniqid();
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = "{$uniqueId}.{$fileExtension}";

        // Move the uploaded file to the desired location
        $destinationPath = 'uploads/' . $fileName; // Set your upload directory
        if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
            // Save the file path in the database
            $prestasi->foto = $fileName;
        } else {
            // Handle the error if the file cannot be moved
            // Log an error or throw an exception
            throw new Exception('Failed to move uploaded file.');
        }
    } else {
        // Handle the case where no file was uploaded or an error occurred
        if (isset($_FILES['foto'])) {
            // Log the specific upload error
            throw new Exception('File upload error: ' . $_FILES['foto']['error']);
        }
    }

    // Save the prestasi record
    $prestasi->save();

    // Redirect back to the previous page
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

    // Fetch the existing record
    $prestasi = Prestasi::where('id', $id)->first();
    
    // Update fields
    $prestasi->nama = $request['nama'];
    $prestasi->tingkat = $request['tingkat'];
    $prestasi->peringkat = $request['peringkat'];
    $prestasi->waktu_dapat = $request['waktu_dapat'];

    // Check if a file has been uploaded
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['foto'];

        // Generate a unique file name
        $uniqueId = uniqid();
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = "{$uniqueId}.{$fileExtension}";

        // Move the uploaded file to the desired location
        $destinationPath = 'uploads/' . $fileName; // Set your upload directory
        if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
            // Save the file path in the database
            $prestasi->foto = $fileName;
        } else {
            // Handle the error if the file cannot be moved
            throw new Exception('Failed to move uploaded file.');
        }
    }

    // Save the prestasi record
    $prestasi->save();

    // Redirect back to the previous page
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
