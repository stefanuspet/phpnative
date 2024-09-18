<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Kegiatan;
use App\Model\Majelis;
use App\Model\Peserta;
use App\Model\Prestasi;
use App\Model\User;

class AnggotaController
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

    public function store($request)
    {
        if ($request['nid'] == Anggota::where('nid', $request['nid'])->exists() || $request['nid'] == Majelis::where('nit', $request['nid'])->exists() || $request['nid'] == User::where('credential_id', $request['nid'])->exists()) {
            header('Location: /dashboard/anggota/create');
            $_SESSION['error'] = 'NID sudah Terpakai';
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

            $anggota = new Anggota();
            $anggota->nid = $request['nid'];
            $anggota->id_dojo = $request['id_dojo'];
            $anggota->nama = $request['nama'];
            $anggota->jenis_kelamin = $request['jenis_kelamin'];
            $anggota->alamat = $request['alamat'];
            $anggota->tahun_gabung = $request['tahun_gabung'];
            $anggota->status = $request['status'];
            $anggota->tingkat_sabuk = $request['tingkat_sabuk'];
            $anggota->nomor = $request['nomor'];
            $anggota->foto = $fileName;
            $anggota->tanggal_lahir = $request['tanggal_lahir'];
            $anggota->tempat_lahir = $request['tempat_lahir'];
            $anggota->save();
        } else {
            // eror
            $_SESSION['error'] = 'Foto tidak boleh kosong';
        }

        header('Location: /dashboard/anggota');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $anggota = Anggota::find($id);
        $anggota->nid = $request['nid'];
        $anggota->id_dojo = $request['id_dojo'];
        $anggota->nama = $request['nama'];
        $anggota->jenis_kelamin = $request['jenis_kelamin'];
        $anggota->alamat = $request['alamat'];
        $anggota->tahun_gabung = $request['tahun_gabung'];
        $anggota->status = $request['status'];
        $anggota->tingkat_sabuk = $request['tingkat_sabuk'];
        $anggota->nomor = $request['nomor'];
        $anggota->tanggal_lahir = $request['tanggal_lahir'];
        $anggota->tempat_lahir = $request['tempat_lahir'];
        $anggota->save();

        header('Location: /dashboard/anggota');
    }

    public function destroy($request)
    {
        $anggota = Anggota::find($request['id']);
        $anggota->delete();

        header('Location: /dashboard/anggota');
    }
}
