<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\DojoMajelis;
use App\Model\Majelis;
use App\Model\Dojo;
use App\Model\Kegiatan;
use App\Model\Latihan;
use App\Model\Pembayaran;
use App\Model\Prestasi;
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

        if (Majelis::where('nit', $nit)->exists() || Anggota::where('nomor_induk', $nit)->exists() || User::where('credential_id', $nit)->exists()) {
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

    public function update($request): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments); // Extract the ID from the URI

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
        $old_nit = $request['old_nit']; // Assume this is passed in the request

        // Check for duplicates
        if ($nit !== $old_nit) {
            if (
                Majelis::where('nit', $nit)->exists() ||
                Anggota::where('nomor_induk', $nit)->exists() ||
                User::where('credential_id', $nit)->exists()
            ) {
                $_SESSION['error'] = "Nomor Induk sudah Terpakai. Old NIT: $old_nit, New NIT: $nit";
                echo $_SESSION['error'];
                exit();
            }
        }


        // Find the existing Majelis record
        $majelis = Majelis::find($id);
        if (!$majelis) {
            die('Majelis not found');
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

            // Update Majelis record with new data
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
            // Update Majelis record without new foto
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

        // Check if old_nit exists in User table
        if (isset($old_nit) && User::where('credential_id', $old_nit)->exists()) {
            // Update DojoMajelis with the new nit
            User::where('credential_id', $old_nit)->update(['credential_id' => $nit]);
        }

        // Check if old_nit exists in User table
        if (isset($old_nit) && DojoMajelis::where('id_majelis', $old_nit)->exists()) {
            // Update DojoMajelis with the new nit
            DojoMajelis::where('id_majelis', $id)->update(['id_majelis' => $nit]);
        }

        // Redirect back to the Majelis page
        header('Location: /dashboard/majelis');
        exit();
    }


    public function destroy($request): void
    {
        // Find the Majelis record based on the ID
        $majelis = Majelis::find($request['id']);
        if (!$majelis) {
            die('Majelis not found');
        }

        // Get the NIT of the Majelis
        $nit = $majelis->nit;

        // Delete related entries from the User table
        User::where('credential_id', $nit)->delete();

        // Delete related entries from the DojoMajelis table
        DojoMajelis::where('id_majelis', $majelis->id)->delete();

        // Delete the Majelis record
        $majelis->delete();

        // Redirect back to the Majelis page
        header('Location: /dashboard/majelis');
        exit();
    }


    public function index()
    {
        $majelis = Majelis::where('nit', $_SESSION['user']['id'])->first();
        $count_dojo = DojoMajelis::where('id_majelis', $majelis->nit)->count();
        $dojomajelist = DojoMajelis::where('id_majelis', $majelis->nit)->get();
        $count_anggota = 0;
        foreach ($dojomajelist as $dojomajelis) {
            $count_anggota += Anggota::where('id_dojo', $dojomajelis->id_dojo)->count();
        }

        // format tanggal lahir dd-mm-yyyy
        $majelis->tanggal_lahir = date('d-m-Y', strtotime($majelis->tanggal_lahir));
        echo $this->blade->run("majelisViews.Dashboard", ['majelis' => $majelis, 'count_dojo' => $count_dojo, 'count_anggota' => $count_anggota]);
    }

    public function kegiatan()
    {
        $kegiatan = Kegiatan::all();
        // format tanggal
        foreach ($kegiatan as $k) {
            $k->tanggal = date('d-m-Y', strtotime($k->tanggal));
        }
        echo $this->blade->run("MajelisViews.Kegiatan.index", ['kegiatan' => $kegiatan]);
    }

    public function cabang()
    {
        $majelis = Majelis::where('nit', $_SESSION['user']['id'])->first();
        $dojomajelist = DojoMajelis::where('id_majelis', $majelis->nit)->get();
        $dojos = [];
        foreach ($dojomajelist as $dojomajelis) {
            $dojos[] = Dojo::where('id', $dojomajelis->id_dojo)->first();
        }

        // count anggota
        foreach ($dojos as $dojo) {
            $dojo->count_anggota = Anggota::where('id_dojo', $dojo->id)->count();
        }
        echo $this->blade->run("MajelisViews.Dojo.index", ['dojos' => $dojos]);
    }

    public function showDetailDojo()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        // Retrieve single record by ID
        $dojo = Dojo::find($id);
        // add count anggota
        $dojo->count_anggota = Dojo::find($id)->anggota()->count();

        // getd dojomajelis by dojo id
        $dojoMajelis = DojoMajelis::where('id_dojo', $id)->get();
        // get majelis by dojoMajelis
        $majelis = [];
        foreach ($dojoMajelis as $dm) {
            $majelis[] = Majelis::find($dm->id_majelis);
        }

        $anggota = Anggota::where('id_dojo', $id)->get();
        // format anggota->tanggal_lahir dd-mm-yyyy
        foreach ($anggota as $a) {
            $a->tanggal_lahir = date('d-m-Y', strtotime($a->tanggal_lahir));
        }


        if (!$dojo) {
            echo "Dojo not found.";
            exit();
        }

        echo $this->blade->run(
            "majelisViews.Dojo.showDetail",
            [
                'dojo' => $dojo,
                'majelis' => $majelis,
                'anggota' => $anggota
            ]
        );
    }

    public function showAnggotaByid()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $anggota = Anggota::find($id);

        // add count prestasi
        $anggota->count_prestasi = Anggota::find($id)->prestasi()->count();

        // add dojo name to anggota
        $anggota->dojo = Dojo::find($anggota->id_dojo);

        // get prestasi by anggota
        $prestasi = Prestasi::where('id_anggota', $id)->get();

        // format tanggal lahir dd-mm-yyyy
        $anggota->tanggal_lahir = date('d-m-Y', strtotime($anggota->tanggal_lahir));

        // format prestasi->waktu_dapat dd-mm-yyyy
        foreach ($prestasi as $p) {
            $p->waktu_dapat = date('d-m-Y', strtotime($p->waktu_dapat));
        }

        echo $this->blade->run(
            "MajelisViews.Anggota.show",
            [
                'anggota' => $anggota,
                'prestasi' => $prestasi
            ]
        );
    }

    public function anggota()
    {
        $majelis = Majelis::where('nit', $_SESSION['user']['id'])->first();
        $dojomajelist = DojoMajelis::where('id_majelis', $majelis->nit)->get();
        $dojos = [];
        foreach ($dojomajelist as $dojomajelis) {
            $dojos[] = Dojo::where('id', $dojomajelis->id_dojo)->first();
        }

        $anggota = collect();
        foreach ($dojos as $dojo) {
            $anggota = $anggota->merge(Anggota::where('id_dojo', $dojo->id)->get());
        }

        // var_dump($anggota);
        echo $this->blade->run("MajelisViews.Anggota.index", ['anggota' => $anggota]);
    }

    public function anggotaCreate()
    {
        if ($_SESSION['user']['role'] != 'majelis') {
            header('Location: /error');
        }
        $dojomajelis = DojoMajelis::where('id_majelis', $_SESSION['user']['id'])->get();
        $dojos = [];
        foreach ($dojomajelis as $dm) {
            $dojos[] = Dojo::find($dm->id_dojo);
        }

        echo $this->blade->run("MajelisViews.Anggota.create", ['dojos' => $dojos]);
    }

    public function editAnggota()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $anggota = Anggota::find($id);

        $dojomajelis = DojoMajelis::where('id_majelis', $_SESSION['user']['id'])->get();
        $dojos = [];

        foreach ($dojomajelis as $dm) {
            $dojos[] = Dojo::find($dm->id_dojo);
        }

        echo $this->blade->run(
            "adminViews.Anggota.edit",
            [
                'anggota' => $anggota,
                'dojos' => $dojos
            ]
        );
    }

    public function showlatihanByid()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $anggota = Anggota::find($id);
        $latihan = Latihan::where('id_anggota', $id)->get();
        // Format date time created-at to dd-mm-yyyy
        foreach ($latihan as $l) {
            $l->created_at = date('d-m-Y', strtotime($l->created_at));
        }


        echo $this->blade->run(
            "MajelisViews.Latihan.show",
            [
                'anggota' => $anggota,
                'latihan' => $latihan
            ]
        );
    }
    public function showpembayaranByid()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $anggota = Anggota::find($id);
        $pembayaran = Pembayaran::where('id_anggota', $id)->get();
        // Format date time created-at to dd-mm-yyyy
        foreach ($pembayaran as $p) {
            $p->created_at = date('d-m-Y', strtotime($p->created_at));
        }

        echo $this->blade->run(
            "MajelisViews.Pembayaran.show",
            [
                'anggota' => $anggota,
                'pembayaran' => $pembayaran
            ]
        );
    }

    public function latihanCreate()
    {
        if ($_SESSION['user']['role'] != 'majelis') {
            header('Location: /error');
        }
        echo $this->blade->run("MajelisViews.Latihan.create");
    }

    public function latihanEdit()
    {
        if ($_SESSION['user']['role'] != 'majelis') {
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
        echo $this->blade->run("MajelisViews.Latihan.edit", ['latihan' => $latihan]);
    }
}
