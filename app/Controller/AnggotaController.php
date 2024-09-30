<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Kegiatan;
use App\Model\Latihan;
use App\Model\Majelis;
use App\Model\Pembayaran;
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
            // if dont have foto make foto default from /public/uploads/default_img.jpg
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
            $anggota->foto = 'default_img.jpg';
            $anggota->tanggal_lahir = $request['tanggal_lahir'];
            $anggota->tempat_lahir = $request['tempat_lahir'];
            $anggota->save();
        }

        header('Location: /dashboard/anggota');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments); // Extract the ID from the URI

        // Find the existing 'Anggota' record
        $anggota = Anggota::find($id);
        if (!$anggota) {
            // Handle case if 'Anggota' not found
            die('Anggota not found');
        }

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];

            // Generate a unique file name
            $uniqueId = uniqid();
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = "{$uniqueId}.{$fileExtension}";

            $fileContent = file_get_contents($file['tmp_name']);
            $this->filesystem->write($fileName, $fileContent);

            // Update the Anggota record with the new file name
            $anggota->foto = $fileName;
        } else {
            // If no new photo is uploaded, keep the existing photo
            if (!$anggota->foto) {
                $anggota->foto = 'default_img.jpg'; // Default photo if not already set
            }
        }

        // Update the existing Anggota record with new data
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

        $anggota->save(); // Save the updated record

        // Redirect back to the anggota page
        header('Location: /dashboard/anggota');
    }

    public function destroy($request)
    {
        $anggota = Anggota::find($request['id']);
        $anggota->delete();

        header('Location: /dashboard/anggota');
    }

    public function index()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        $anggota = Anggota::where('nid', $_SESSION['user']['id'])->first();
        // count prestasi
        $count_prestasi = Prestasi::where('id_anggota', $anggota->nid)->count();
        // count kegiatan
        $count_kegiatan = Peserta::where('id_anggota', $anggota->nid)->count();

        echo $this->blade->run("AnggotaViews.dashboard", ['anggota' => $anggota, 'count_prestasi' => $count_prestasi, 'count_kegiatan' => $count_kegiatan]);
    }

    public function kegiatan()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        $kegiatan = Kegiatan::all();
        echo $this->blade->run("AnggotaViews.Kegiatan.index", ['kegiatan' => $kegiatan]);
    }

    public function kegiatanbyUser()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        $peserta = Peserta::where('id_anggota', $_SESSION['user']['id'])->get();
        // get kegiatan 
        $kegiatan = [];
        foreach ($peserta as $p) {
            $kegiatan[] = Kegiatan::where('id', $p->id_kegiatan)->first();
        }
        echo $this->blade->run("AnggotaViews.Kegiatan.terdaftar", ['peserta' => $peserta, 'kegiatan' => $kegiatan]);
    }
    public function prestasi()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        // prestasi by user current loign
        $prestasi = Prestasi::where('id_anggota', $_SESSION['user']['id'])->get();
        // format date to d-m-Y
        foreach ($prestasi as $p) {
            $p->waktu_dapat = date('d-m-Y', strtotime($p->waktu_dapat));
        }
        echo $this->blade->run("AnggotaViews.Prestasi.index", ['prestasi' => $prestasi]);
    }

    public function latihan()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        // latihan where id_anggota = id_anggota
        $latihan = Latihan::where('id_anggota', $_SESSION['user']['id'])->get();
        // format created_at to d-m-Y
        foreach ($latihan as $l) {
            $l->created_at = date('d-m-Y', strtotime($l->created_at));
        }
        echo $this->blade->run("AnggotaViews.Latihan.index", ['latihan' => $latihan]);
    }

    public function latihanCreate()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        echo $this->blade->run("AnggotaViews.Latihan.create");
    }

    public function latihanEdit()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        // Mendapatkan URL yang diakses
        $requestUri = $_SERVER['REQUEST_URI'];

        // Menghapus query string jika ada
        $uri = strtok($requestUri, '?');

        // Memecah URL menjadi segmen
        $pathSegments = explode('/', $uri);
        // Mendapatkan {id} dan {id_anggota}
        $id = end($pathSegments); // Segmen terakhir
        $latihan = Latihan::find($id);
        echo $this->blade->run("AnggotaViews.Latihan.edit", ['latihan' => $latihan]);
    }

    public function pembayaran()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        // pembayaran where id_anggota = id_anggota
        $pembayaran = Pembayaran::where('id_anggota', $_SESSION['user']['id'])->get();
        echo $this->blade->run("AnggotaViews.Pembayaran.index", ['pembayaran' => $pembayaran]);
    }

    public function pembayaranCreate()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        echo $this->blade->run("AnggotaViews.Pembayaran.create");
    }
}
