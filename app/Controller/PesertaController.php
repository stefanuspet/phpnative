<?php

namespace App\Controller;

use App\Model\Peserta;

class PesertaController
{
    protected $blade;

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
        $peserta = new Peserta();
        $peserta->id_kegiatan = $request['id_kegiatan'];
        $peserta->id_anggota = $_SESSION['user']['id'];
        $peserta->tanggal_daftar = date('Y-m-d');
        // if peserta already exist
        if (Peserta::where('id_kegiatan', $request['id_kegiatan'])->where('id_anggota', $_SESSION['user']['id'])->exists()) {
            if ($_SESSION['user']['role'] == 'anggota') {
                header('Location: /dashboard-anggota/kegiatan');
                // if succes give message
                $_SESSION['error'] = 'Anda sudah mendaftar kegiatan ini';
            } else {
                header('Location: /dashboard/kegiatan/show/' . $request['id_kegiatan']);
            }
            exit();
        }
        $peserta->save();
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/kegiatan');
            // if succes give message
            $_SESSION['success'] = 'Berhasil mendaftar kegiatan';
        } else {
            header('Location: /dashboard/kegiatan/show/' . $request['id_kegiatan']);
        }
        // header('Location: /dashboard/peserta');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $peserta = Peserta::find($id);
        $peserta->nama = $request['nama'];
        $peserta->email = $request['email'];
        $peserta->no_hp = $request['no_hp'];
        $peserta->save();
        header('Location: /dashboard/peserta');
    }

    public function destroy($request)
    {
        $id_kegiatan = $request['id_kegiatan'];
        $id_anggota = $request['id_anggota'];

        $peserta = Peserta::where('id_kegiatan', $id_kegiatan)->where('id_anggota', $id_anggota)->first();
        $peserta->delete();

        // if succes give message
        $_SESSION['success'] = 'Berhasil membatalkan pendaftaran kegiatan';
        header('Location: /dashboard-anggota/kegiatan');
    }
}
