<?php

namespace App\Controller;

use App\Model\Latihan;


use App\Model\Anggota;

use App\Model\Majelis;
use App\Model\ForgetPass;


class ForgetPassController
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
        // Get the input data
      
        $role = $request['role']; // Role (Atlet or Majelis)
        $status = 'pending'; // default status for forget password request

        // Initialize variables for name and role confirmation
        $nomor = '';
        $credential = 0;
        // echo("aaa");
        
        // Confirm data based on the selected role
        if ($role === 'Atlet') {
            // Get the dojo input
            $dojo = $request['dojo']; // Dojo name or ID
            $nama = $request['name_atlet']; // Nama (Name)
            // Find Atlet data by Nama and Dojo
            $atlet = Anggota::where('nama', $nama)->where('id_dojo', $dojo)->first();
            // echo($atlet);

            if (!$atlet) {
                header('Location: /forget-pass');
                $_SESSION['error'] = "Atlet tidak ditemukan. Nama: $nama, ID Dojo: $dojo";
            }

            // Set the nomor (from Anggota table)
            $nomor = $atlet->nomor; // Assuming 'nomor_induk' is used for Atlet
            $name = $atlet->nama;
            $credential = $atlet->nomor_induk;

        } elseif ($role === 'Majelis') {
            // Get the tahun_gabung input
            $tahunGabung = $request['tahun_gabung']; // Tahun Gabung (Joining Year)
            $nama = $request['name_majelis']; // Nama (Name)
            // Find Majelis data by Nama and Tahun Gabung
            $majelis = Majelis::where('nama', $nama)->where('tahun_gabung', $tahunGabung)->first();

            if (!$majelis) {
                header('Location: /forget-pass');
                $_SESSION['error'] = 'Majelis tidak ditemukan';
            }

            // Set the nomor (from Majelis table)
            $nomor = $request['nomor_telepon']; // Assuming 'nomor_telepon' is used for Majelis
            $name = $majelis->nama;
            $credential = $majelis->nit;

        } 

        // Create a new ForgetPass record
        $forgetPass = new ForgetPass();
        $forgetPass->nama = $name;
        $forgetPass->role = $role;
        $forgetPass->nomor = $nomor;
        $forgetPass->status = $status;
        $forgetPass->credential = $credential;
        // Save the record to the database
        $forgetPass->save();
        $_SESSION['error'] = null;
        $_SESSION['success'] = "Berhasil mengirim permintaan lupa password. Anda akan segera dihubungi oleh admin";

        header('Location: /forget-pass');
        
        // Redirect with success message
        // return redirect()->route('login')->with('success', 'Password reset request submitted successfully.');
    }

    public function update($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        // Find the ForgetPass record by its ID
        $pass = ForgetPass::find($id);

        // Check if the record exists
        if ($pass) {
            // Toggle the status between "pending" and "selesai"
            if ($pass->status === 'pending') {
                $pass->status = 'selesai';
            } elseif ($pass->status === 'selesai') {
                $pass->status = 'pending';
            }

            // Save the updated record
            $pass->save();
        }

        // Redirect back to the forget-pass dashboard
        header('Location: /dashboard/forget-pass');
    }


    // destroy
    public function destroy($request)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);

        $pass = ForgetPass::find($id);
        $pass->delete();
        header('Location: /dashboard/forget-pass');
    }

    public function reset()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uri = strtok($requestUri, '?');
        $pathSegments = explode('/', $uri);
        $id = end($pathSegments);
        $latihan = Latihan::find($id);
        $latihan->catatan = null;
        $latihan->save();
        if ($_SESSION['user']['role'] == 'anggota') {
            header('Location: /dashboard-anggota/latihan');
        } else if ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/latihan/show/' . $latihan->id_anggota);
        } else {
            header('Location: /dashboard/latihan');
        }
    }
}
