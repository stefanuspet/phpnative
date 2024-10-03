<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Prestasi;
use App\Model\Majelis;
use App\Model\Dojo;
use App\Model\DojoMajelis;
use App\Model\Kegiatan;
use App\Model\Latihan;
use App\Model\Pembayaran;
use App\Model\Pengurus;

class AdminController
{
    protected $blade;

    public function __construct($blade)
    {
        session_start();
        $this->blade = $blade;
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        } else if ($_SESSION['user']['role'] != 'admin') {
            header('Location: /error');
        }
    }
    public function index()
    {
        $count_anggota = Anggota::count();
        $count_prestasi = Prestasi::count();
        $count_majelis = Majelis::count();
        $count_dojo = Dojo::count();
        echo $this->blade->run(
            "adminViews.Dashboard",
            [
                'count_anggota' => $count_anggota,
                'count_prestasi' => $count_prestasi,
                'count_majelis' => $count_majelis,
                'count_dojo' => $count_dojo
            ]
        );
    }

    public function cabang()
{
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // If search query exists, filter the dojos by name or another field
    if (!empty($search)) {
        $dojos = Dojo::whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])->get();
    } else {
        $dojos = Dojo::all();
    }

    // Get anggota count for each dojo
    foreach ($dojos as $dojo) {
        $dojo->count_anggota = Dojo::find($dojo->id)->anggota()->count();
    }

    echo $this->blade->run(
        "adminViews.Dojo.index",
        [
            'dojos' => $dojos,
            'search' => $search // Passing the search term to the view
        ]
    );
}



    public function cabangBone()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // If search query exists, filter the dojos by name (case-insensitive) and cabang 'Bone'
        if (!empty($search)) {
            $dojos = Dojo::where('cabang', 'Bone')
                ->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])
                ->get();
        } else {
            // Only filter by cabang 'Bone' if no search term is provided
            $dojos = Dojo::where('cabang', 'Bone')->get();
        }

        // Get anggota count for each dojo
        foreach ($dojos as $dojo) {
            $dojo->count_anggota = Dojo::find($dojo->id)->anggota()->count();
        }

        echo $this->blade->run(
            "adminViews.Dojo.index",
            [
                'dojos' => $dojos,
                'search' => $search // Passing the search term to the view
            ]
        );
    }


    public function cabangMakasar()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // If search query exists, filter the dojos by name (case-insensitive) and cabang 'Makasar'
        if (!empty($search)) {
            $dojos = Dojo::where('cabang', 'Makasar')
                ->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])
                ->get();
        } else {
            // Only filter by cabang 'Makasar' if no search term is provided
            $dojos = Dojo::where('cabang', 'Makasar')->get();
        }

        // Get anggota count for each dojo
        foreach ($dojos as $dojo) {
            $dojo->count_anggota = Dojo::find($dojo->id)->anggota()->count();
        }

        echo $this->blade->run(
            "adminViews.Dojo.index",
            [
                'dojos' => $dojos,
                'search' => $search // Passing the search term to the view
            ]
        );
    }

    public function cabangGowa()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // If search query exists, filter the dojos by name (case-insensitive) and cabang 'Gowa'
        if (!empty($search)) {
            $dojos = Dojo::where('cabang', 'Gowa')
                ->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])
                ->get();
        } else {
            // Only filter by cabang 'Gowa' if no search term is provided
            $dojos = Dojo::where('cabang', 'Gowa')->get();
        }

        // Get anggota count for each dojo
        foreach ($dojos as $dojo) {
            $dojo->count_anggota = Dojo::find($dojo->id)->anggota()->count();
        }

        echo $this->blade->run(
            "adminViews.Dojo.index",
            [
                'dojos' => $dojos,
                'search' => $search // Passing the search term to the view
            ]
        );
    }

    // public function showDetailDojoBone()
    // {
    //     $dojos = Dojo::where('cabang', 'Bone')->get();
    //     // get anggota in every dojo

    //     foreach ($dojos as $dojo) {
    //         $dojo->count_anggota = Dojo::find($dojo->id)->anggota()->count();
    //     }

    //     echo $this->blade->run(
    //         "adminViews.Dojo.index",
    //         [
    //             'dojos' => $dojos
    //         ]
    //     );
    // }

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
            "adminViews.Dojo.showDetail",
            [
                'dojo' => $dojo,
                'majelis' => $majelis,
                'anggota' => $anggota
            ]
        );
    }


    public function createDojo()
    {
        echo $this->blade->run(
            "adminViews.Dojo.create"
        );
    }

    public function editDojo()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $dojo = Dojo::find($id);
        echo $this->blade->run(
            "adminViews.Dojo.edit",
            [
                'dojo' => $dojo
            ]
        );
    }

    public function majelis()
    {
        $majelis = Majelis::all();
        echo $this->blade->run(
            "adminViews.Majelis.index",
            [
                'majelis' => $majelis
            ]
        );
    }

    public function createMajelis()
    {
        echo $this->blade->run(
            "adminViews.Majelis.create"
        );
    }

    public function editMajelis()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $majelis = Majelis::find($id);
        echo $this->blade->run(
            "adminViews.Majelis.edit",
            [
                'majelis' => $majelis
            ]
        );
    }

    public function anggota()
    {
        $anggota = Anggota::all();
        // get anggota dojo
        foreach ($anggota as $a) {
            $a->dojo = Dojo::find($a->id_dojo);
        }
        // add count total prestasi
        foreach ($anggota as $a) {
            $a->count_prestasi = Anggota::find($a->nid)->prestasi()->count();
        }
        echo $this->blade->run(
            "adminViews.Anggota.index",
            [
                'anggota' => $anggota
            ]
        );
    }

    public function createAnggota()
    {
        $dojos = Dojo::all();
        echo $this->blade->run(
            "adminViews.Anggota.create",
            [
                'dojos' => $dojos
            ]
        );
    }

    public function editAnggota()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $anggota = Anggota::find($id);
        $dojos = Dojo::all();
        echo $this->blade->run(
            "adminViews.Anggota.edit",
            [
                'anggota' => $anggota,
                'dojos' => $dojos
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
            "adminViews.Anggota.show",
            [
                'anggota' => $anggota,
                'prestasi' => $prestasi
            ]
        );
    }

    public function showAnggotaAtlet()
    {
        $anggota = Anggota::where('status', 'Atlet')->get();
        // get anggota dojo
        foreach ($anggota as $a) {
            $a->dojo = Dojo::find($a->id_dojo);
        }
        // add count total prestasi
        foreach ($anggota as $a) {
            $a->count_prestasi = Anggota::find($a->nid)->prestasi()->count();
        }
        echo $this->blade->run(
            "adminViews.Anggota.index",
            [
                'anggota' => $anggota
            ]
        );
    }
    public function showAnggotaBiasa()
    {
        $anggota = Anggota::where('status', 'Anggota Biasa')->get();
        // get anggota dojo
        foreach ($anggota as $a) {
            $a->dojo = Dojo::find($a->id_dojo);
        }
        // add count total prestasi
        foreach ($anggota as $a) {
            $a->count_prestasi = Anggota::find($a->nid)->prestasi()->count();
        }
        echo $this->blade->run(
            "adminViews.Anggota.index",
            [
                'anggota' => $anggota
            ]
        );
    }

    public function latihan()
    {
        $anggota = Anggota::all();
        echo $this->blade->run(
            "adminViews.Latihan.index",
            [
                'anggota' => $anggota
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
            "adminViews.Latihan.show",
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
            "adminViews.Pembayaran.show",
            [
                'anggota' => $anggota,
                'pembayaran' => $pembayaran
            ]
        );
    }
    public function kegiatan()
    {
        $kegiatan = Kegiatan::all();
        // count peserta
        foreach ($kegiatan as $k) {
            $k->count_peserta = Kegiatan::find($k->id)->peserta()->count();
        }
        // get dd on kegiatan->date
        foreach ($kegiatan as $k) {
            $k->day = date('d', strtotime($k->tanggal));
        }
        //get month years on kegiatan->date
        foreach ($kegiatan as $k) {
            $k->month = date('F Y', strtotime($k->tanggal));
        }
        echo $this->blade->run(
            "adminViews.Kegiatan.index",
            [
                'kegiatan' => $kegiatan
            ]
        );

        // var_dump($kegiatan);
    }

    public function showKegiatanById()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $kegiatan = Kegiatan::find($id);
        // count perserta
        $kegiatan->count_peserta = Kegiatan::find($id)->peserta()->count();
        // format tanggal kegiatan day Mother Year
        $kegiatan->date = date('d F Y', strtotime($kegiatan->tanggal));
        $peserta = Kegiatan::find($id)->peserta()->get();
        // add anggota to peserta
        foreach ($peserta as $p) {
            $p->anggota = Anggota::find($p->id_anggota);
        }

        // format tanggal lahir dd-mm-yyyy
        foreach ($peserta as $p) {
            $p->anggota->tanggal_lahir = date('d-m-Y', strtotime($p->anggota->tanggal_lahir));
        }

        // add

        echo $this->blade->run(
            "adminViews.Kegiatan.showDetail",
            [
                'kegiatan' => $kegiatan,
                'peserta' => $peserta
            ]
        );
    }

    public function createKegiatan()
    {
        echo $this->blade->run(
            "adminViews.Kegiatan.create"
        );
    }

    public function editKegiatan()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $kegiatan = Kegiatan::find($id);
        echo $this->blade->run(
            "adminViews.Kegiatan.edit",
            [
                'kegiatan' => $kegiatan
            ]
        );
    }

    public function prestasi()
    {
        $prestasi = Prestasi::all();
        // add anggota to prestasi
        foreach ($prestasi as $p) {
            $p->anggota = Anggota::find($p->id_anggota);
        }
        // format tanggal lahir dd-mm-yyyy
        foreach ($prestasi as $p) {
            $p->anggota->tanggal_lahir = date('d-m-Y', strtotime($p->anggota->tanggal_lahir));
        }
        echo $this->blade->run(
            "adminViews.Prestasi.index",
            [
                'prestasi' => $prestasi
            ]
        );
    }

    public function createPrestasi()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $anggota = Anggota::find($id);
        echo $this->blade->run(
            "adminViews.Prestasi.create",
            [
                'anggota' => $anggota
            ]
        );
    }

    public function editPrestasi()
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

        $prestasi = Prestasi::find($id);
        echo $this->blade->run(
            "adminViews.Prestasi.edit",
            [
                'prestasi' => $prestasi,
                'id_anggota' => $id_anggota
            ]
        );
    }

    public function pengurus()
    {
        $pengurus = Pengurus::orderByRaw("FIELD(jabatan, 'Ketua Dewan Pembina', 'Anggota Dewan Pembina', 'Ketua umum', 'Sekretaris umum', 'Bendahara umum', 'Ketua staf pelatih', 'Ketua majelis sabuk hitam', 'Bidang Prestasi', 'Perwasitan', 'Usaha dan dana', 'Humas')")->get();
        echo $this->blade->run(
            "adminViews.Pengurus.index",
            [
                'pengurus' => $pengurus
            ]
        );
    }


    public function createPengurus()
    {
        echo $this->blade->run(
            "adminViews.Pengurus.create"
        );
    }

    public function editPengurus()
    {
        // Mendapatkan URL yang diakses
        $requestUri = $_SERVER['REQUEST_URI'];

        // Menghapus query string jika ada
        $uri = strtok($requestUri, '?');

        // Memecah URL menjadi segmen
        $pathSegments = explode('/', $uri);
        // Mendapatkan {id} dan {id_anggota}
        $id = end($pathSegments); // Segmen terakhir

        $pengurus = Pengurus::find($id);
        echo $this->blade->run(
            "adminViews.Pengurus.edit",
            [
                'pengurus' => $pengurus
            ]
        );
    }

    public function dojoMajelis()
    {
        $dojoMajelis = DojoMajelis::all();
        // get dojo and majelis
        foreach ($dojoMajelis as $dm) {
            $dm->dojo = Dojo::find($dm->id_dojo);
            $dm->majelis = Majelis::find($dm->id_majelis);
        }

        $dojoall = Dojo::all();

        $majelisall = Majelis::all();
        echo $this->blade->run(
            "adminViews.DojoMajelis.index",
            [
                'dojoMajelis' => $dojoMajelis,
                'dojoall' => $dojoall,
                'majelisall' => $majelisall
            ]
        );
    }
}
