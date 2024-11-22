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
        $peserta->id_anggota = $_SESSION['user']['nid'];
        $peserta->tanggal_daftar = date('Y-m-d');
        $peserta->status = "pending";
        // if peserta already exist
        if (Peserta::where('id_kegiatan', $request['id_kegiatan'])->where('id_anggota', $_SESSION['user']['nid'])->exists()) {
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
    // Get the current URI and extract the ID from the URL
    // $requestUri = $_SERVER['REQUEST_URI'];
    // $uri = strtok($requestUri, '?');
    // $pathSegments = explode('/', $uri);
    // $id = end($pathSegments);
    $id= $request['id'];
    // $id_kegiatan= $request['kegiatan_id'];
    
    // Find the Peserta by ID
    $peserta = Peserta::find($id);

    // Check if 'catatan' exists in the request, and update status accordingly
    if (isset($request['catatan']) && !empty($request['catatan'])) {
        $peserta->status = $request['catatan'];  // If catatan exists, set status to "catatan"
    } else {
        $peserta->status = 'diterima';  // Otherwise, set status to "diterima"
    }

    // Save the updated Peserta data
    $peserta->save();
    // echo($id_kegiatan);
    // Redirect back to the peserta dashboard
    header('Location: /dashboard-majelis/kegiatan/show/'. $request['kegiatan_id']);
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
