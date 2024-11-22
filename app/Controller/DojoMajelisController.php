<?php

namespace App\Controller;

use App\Model\DojoMajelis;

class DojoMajelisController
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
        // Check if the same schedule already exists for the same majelis, regardless of dojo
        $conflictingSchedule = DojoMajelis::where('id_majelis', $request['id_majelis'])
            ->where('day', $request['day'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request['start_time'], $request['end_time']])
                    ->orWhereBetween('end_time', [$request['start_time'], $request['end_time']])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_time', '<=', $request['start_time'])
                            ->where('end_time', '>=', $request['end_time']);
                    });
            })
            ->first();

        if ($conflictingSchedule) {
            // Redirect to the dashboard
            if ($_SESSION['user']['role'] == 'admin') {
                header('Location: /dashboard/dojoMajelis');
            } else if ($_SESSION['user']['role'] == 'majelis') {
                header('Location: /dashboard-majelis/dojoMajelis');
            }
            $_SESSION['error'] = "Jadwal bentrok dengan jadwal lain yang sudah ada untuk Majelis yang sama.";
            exit();
        }

        // Store the new schedule
        $majelis = new DojoMajelis();
        $majelis->id_dojo = $request['id_dojo'];
        $majelis->id_majelis = $request['id_majelis'];
        $majelis->day = $request['day'];
        $majelis->start_time = $request['start_time'];
        $majelis->end_time = $request['end_time'];
        $majelis->save();

        // Redirect to the dashboard
        if ($_SESSION['user']['role'] == 'admin') {
            header('Location: /dashboard/dojoMajelis');
        } else if ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/dojoMajelis');
        }
    }



    public function update($request)
{
    $id = $request['id']; // Ensure $id is an integer

    // Find the existing schedule
    $majelis = DojoMajelis::find($id);
    if (!$majelis) {
        $_SESSION['error'] = "Jadwal tidak ditemukan.";
        header('Location: /dashboard/dojoMajelis');
        exit();
    }

    // Check if the updated schedule conflicts with another schedule for the same majelis
    $conflictingSchedule = DojoMajelis::where('id_majelis', $request['id_majelis'])
        ->where('day', $request['day'])
        ->where('id', '!=', $id) // Exclude the current record being updated
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request['start_time'], $request['end_time']])
                ->orWhereBetween('end_time', [$request['start_time'], $request['end_time']])
                ->orWhere(function ($query) use ($request) {
                    $query->where('start_time', '<=', $request['start_time'])
                          ->where('end_time', '>=', $request['end_time']);
                });
        })
        ->first();

    if ($conflictingSchedule) {
        $_SESSION['error'] = "Jadwal bentrok dengan jadwal lain yang sudah ada untuk Majelis yang sama.";
        header('Location: /dashboard/dojoMajelis');
        exit();
    }

    // Update the schedule
    $majelis->id_dojo = $request['id_dojo'];
    $majelis->id_majelis = $request['id_majelis'];
    $majelis->day = $request['day'];
    $majelis->start_time = $request['start_time'];
    $majelis->end_time = $request['end_time'];
    $majelis->save();

    // Redirect to the dashboard
    if ($_SESSION['user']['role'] == 'admin') {
        header('Location: /dashboard/dojoMajelis');
    } else if ($_SESSION['user']['role'] == 'majelis') {
        header('Location: /dashboard-majelis/dojoMajelis');
    }
}



    public function destroy($request)
    {
        // Gunakan query builder untuk menghapus berdasarkan id_dojo dan id_majelis
        $deletedRows = DojoMajelis::where('id', $request['id'])
            ->delete();

        // Set pesan berdasarkan hasil operasi delete
        if ($deletedRows) {
            $_SESSION['success'] = 'Data berhasil dihapus';
        } else {
            $_SESSION['error'] = 'Data tidak ditemukan atau sudah dihapus';
        }

        // Redirect setelah operasi selesai
        // Redirect back to the anggota page
        if ($_SESSION['user']['role'] == 'admin') {
            header('Location: /dashboard/dojoMajelis');
        } else if ($_SESSION['user']['role'] == 'majelis') {
            header('Location: /dashboard-majelis/dojoMajelis');
        }
        exit();
    }
}
