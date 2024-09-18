<?php

namespace App\Controller;

use App\Model\Anggota;
use App\Model\Prestasi;
use App\Model\Majelis;
use App\Model\Dojo;
use App\Model\DojoMajelis;
use App\Model\Latihan;
use App\Model\Pembayaran;

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
        $dojos = Dojo::all();
        // get anggota in every dojo

        foreach ($dojos as $dojo) {
            $dojo->count_anggota = Dojo::find($dojo->id)->anggota()->count();
        }

        echo $this->blade->run(
            "adminViews.Dojo.index",
            [
                'dojos' => $dojos
            ]
        );
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
}
