<?php

namespace App\Controller;

use App\Model\Perlengkapan;

class PerlengkapanController
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
        $perlengkapan = new Perlengkapan();
        $perlengkapan->nama = $request['nama'];
        $perlengkapan->ukuran = $request['ukuran'];
        $perlengkapan->jumlah = $request['jumlah'];
        $perlengkapan->status = $request['status'];

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
                $perlengkapan->foto = $fileName;
            } else {
                // Handle the error if the file cannot be moved
                // Log an error or throw an exception
                throw new Exception('Failed to move uploaded file.');
            }
          
        }
        $perlengkapan->save();
        header('Location: /dashboard/perlengkapan');
    }

    public function update($request)
{
    $requestUri = $_SERVER['REQUEST_URI'];
    $uri = strtok($requestUri, '?');
    $pathSegments = explode('/', $uri);
    $id = end($pathSegments);
    $perlengkapan = Perlengkapan::find($id);

    // Update existing fields
    $perlengkapan->nama = $request['nama'];
    $perlengkapan->ukuran = $request['ukuran'];
    $perlengkapan->jumlah = $request['jumlah'];
    $perlengkapan->status = $request['status'];

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
            $perlengkapan->foto = $fileName;
        } else {
            // Handle the error if the file cannot be moved
            throw new Exception('Failed to move uploaded file.');
        }
    }

    // Save the updated Perlengkapan instance to the database
    $perlengkapan->save();

    // Redirect to the Perlengkapan list
    header('Location: /dashboard/perlengkapan');
    exit; // Important to prevent further script execution
}


    public function destroy()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $perlengkapan = Perlengkapan::find($id);
        $perlengkapan->delete();
        header('Location: /dashboard/perlengkapan');
    }
}
