<?php

namespace App\Controller;

use App\Model\Kegiatan;

class KegiatanController
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
        $kegiatan = new Kegiatan();
        $kegiatan->nama = $request['nama'];
        $kegiatan->tanggal = $request['tanggal'];
        $kegiatan->lokasi = $request['lokasi'];

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // Handle file upload
            $file = $_FILES['foto'];
    
            // Generate unique file name
            $uniqueId = uniqid();
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = "{$uniqueId}.{$fileExtension}";
    
            $destinationPath = 'uploads/' . $fileName; // Set your upload directory
            if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
                // Save the file path in the database
                $kegiatan->foto = $fileName;
            } else {
                // Handle the error if the file cannot be moved
                // Log an error or throw an exception
                throw new Exception('Failed to move uploaded file.');
            }
          
        }
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

    // Update existing fields
    $kegiatan->nama = $request['nama'];
    $kegiatan->tanggal = $request['tanggal'];
    $kegiatan->lokasi = $request['lokasi'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        $file = $_FILES['foto'];

        // Generate unique file name
        $uniqueId = uniqid();
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = "{$uniqueId}.{$fileExtension}";

        $destinationPath = 'uploads/' . $fileName; // Set your upload directory
        if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
            // Save the new file path in the database
            $kegiatan->foto = $fileName;
        } else {
            // Handle the error if the file cannot be moved
            throw new Exception('Failed to move uploaded file.');
        }
    }

    // Save the updated Kegiatan instance to the database
    $kegiatan->save();

    // Redirect to the Kegiatan list
    header('Location: /dashboard/kegiatan');
    exit; // Important to prevent further script execution
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
