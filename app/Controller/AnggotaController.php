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
        if($request['nomor_induk']){
            if ($request['nomor_induk'] == Anggota::where('nomor_induk', $request['nomor_induk'])->exists() || $request['nomor_induk'] == Majelis::where('nit', $request['nomor_induk'])->exists() || $request['nomor_induk'] == User::where('credential_id', $request['nomor_induk'])->exists()) {
                header('Location: /dashboard/anggota/create');
                $_SESSION['error'] = 'Nomor Induk sudah Terpakai';
                exit();
            }
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
            $anggota->nomor_induk = $request['nomor_induk'];
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

    // Check the status of 'anggota'
    if ($request['status'] === 'Anggota Biasa') {
        // If status is 'Anggota Biasa', set nomor_induk to empty
        $anggota->nomor_induk = '';
    } else {
        // If status is not 'Anggota Biasa', check nomor_induk
        if (isset($request['nomor_induk']) && !empty($request['nomor_induk'])) {
            // Only check for duplicates if old_nomor_induk is different from nomor_induk
            if (isset($request['old_nomor_induk']) && $request['old_nomor_induk'] !== $request['nomor_induk']) {
                // Check for duplicates
                if (Anggota::where('nomor_induk', $request['nomor_induk'])->exists() ||
                    Majelis::where('nit', $request['nomor_induk'])->exists() ||
                    User::where('credential_id', $request['nomor_induk'])->exists()) {
                    $_SESSION['error'] = 'Nomor Induk sudah Terpakai';
                    echo $_SESSION['error'];
                    exit();
                }
        
                // Check if old_nomor_induk exists in User table
                $user = User::where('credential_id', $request['old_nomor_induk'])->first();
                if ($user) {
                    // Update User credential_id with the new nomor_induk
                    $user->credential_id = $request['nomor_induk'];
                    $user->save(); // Save the updated User record
                }
            }
        
            // Update nomor_induk if it is unique or if old_nomor_induk is the same as nomor_induk
            $anggota->nomor_induk = $request['nomor_induk'];
        }
        
    }

    // Handle file upload for foto
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

    // Update other fields
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

    // Save the updated record
    $anggota->save();

    // Redirect back to the anggota page
    header('Location: /dashboard/anggota');
    exit();
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
        $anggota = Anggota::where('nomor_induk', $_SESSION['user']['id'])->first();
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
        $peserta = Peserta::where('id_anggota', $_SESSION['user']['nid'])->get();
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
        $prestasi = Prestasi::where('id_anggota', $_SESSION['user']['nid'])->get();
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
        $latihan = Latihan::where('id_anggota', $_SESSION['user']['nid'])->get();
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

    public function pembayaranEdit()
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
        $pembayaran = Pembayaran::find($id);
        echo $this->blade->run("AnggotaViews.Pembayaran.edit", ['pembayaran' => $pembayaran]);
    }

    public function pembayaran()
    {
        if ($_SESSION['user']['role'] != 'anggota') {
            header('Location: /error');
        }
        // pembayaran where id_anggota = id_anggota
        $pembayaran = Pembayaran::where('id_anggota', $_SESSION['user']['nid'])->get();
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
