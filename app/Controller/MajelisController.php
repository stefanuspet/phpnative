<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\DojoMajelis;
use App\Model\Majelis;
use App\Model\Dojo;
use App\Model\User;

class MajelisController
{
    protected $blade;
    protected $filesystem;

    public function __construct($blade, $filesystem)
    {
        session_start();
        $this->blade = $blade;
        $this->filesystem = $filesystem;
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }
    }

    // store
    public function store($request)
    {
        // Validate the request data
        $nit = $request['nit'];
        $nama = $request['nama'];
        $tahun_gabung = $request['tahun_gabung'];
        $jenis_kelamin = $request['jenis_kelamin'];
        $alamat = $request['alamat'];
        $jabatan = $request['jabatan'];
        $tingkat_sabuk = $request['tingkat_sabuk'];
        $spesialis = $request['spesialis'];
        $tanggal_lahir = $request['tanggal_lahir'];
        $tempat_lahir = $request['tempat_lahir'];

        if (Majelis::where('nit', $nit)->exists() || Anggota::where('nid', $nit)->exists() || User::where('credential_id', $nit)->exists()) {
            header('Location: /dashboard/majelis/create');
            $_SESSION['error'] = 'NIT sudah Terpakai';
            exit();
        }

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];

            // Menghasilkan nama file unik
            $uniqueId = uniqid(); // Menghasilkan ID unik
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = "{$uniqueId}.{$fileExtension}";

            $fileContent = file_get_contents($file['tmp_name']);
            $this->filesystem->write($fileName, $fileContent);

            $majelis = Majelis::create([
                'nit' => $nit,
                'nama' => $nama,
                'tahun_gabung' => $tahun_gabung,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'jabatan' => $jabatan,
                'tingkat_sabuk' => $tingkat_sabuk,
                'spesialis' => $spesialis,
                'tanggal_lahir' => $tanggal_lahir,
                'tempat_lahir' => $tempat_lahir,
                'foto' => $fileName
            ]);

            $majelis->save();
        } else {
            // eror
            $_SESSION['error'] = 'Foto tidak boleh kosong';
        }

        header('Location: /dashboard/majelis');
    }

    // update
    public function update($request): void
    {

        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        // Validate the request data
        $nit = $request['nit'];
        $nama = $request['nama'];
        $tahun_gabung = $request['tahun_gabung'];
        $jenis_kelamin = $request['jenis_kelamin'];
        $alamat = $request['alamat'];
        $jabatan = $request['jabatan'];
        $tingkat_sabuk = $request['tingkat_sabuk'];
        $spesialis = $request['spesialis'];
        $tanggal_lahir = $request['tanggal_lahir'];
        $tempat_lahir = $request['tempat_lahir'];

        $majelis = Majelis::find($id);

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];

            // Menghasilkan nama file unik
            $uniqueId = uniqid(); // Menghasilkan ID unik
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = "{$uniqueId}.{$fileExtension}";

            $fileContent = file_get_contents($file['tmp_name']);
            $this->filesystem->write($fileName, $fileContent);

            $majelis->update([
                'nit' => $nit,
                'nama' => $nama,
                'tahun_gabung' => $tahun_gabung,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'jabatan' => $jabatan,
                'tingkat_sabuk' => $tingkat_sabuk,
                'spesialis' => $spesialis,
                'tanggal_lahir' => $tanggal_lahir,
                'tempat_lahir' => $tempat_lahir,
                'foto' => $fileName
            ]);
        } else {
            $majelis->update([
                'nit' => $nit,
                'nama' => $nama,
                'tahun_gabung' => $tahun_gabung,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'jabatan' => $jabatan,
                'tingkat_sabuk' => $tingkat_sabuk,
                'spesialis' => $spesialis,
                'tanggal_lahir' => $tanggal_lahir,
                'tempat_lahir' => $tempat_lahir
            ]);
        }

        header('Location: /dashboard/majelis');
    }

    //destroy
    public function destroy($request): void
    {
        $majelis = Majelis::find($request['id']);
        $majelis->delete();
        header('Location: /dashboard/majelis');
    }
}
