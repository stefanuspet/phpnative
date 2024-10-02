<?php

use FastRoute\RouteCollector;

// Fungsi untuk mengatur routing
return function (RouteCollector $r) {
    // guest
    $r->addRoute('GET', '/', 'AuthController@index');
    $r->addRoute('POST', '/login', 'AuthController@login');
    $r->addRoute('GET', '/logout', 'AuthController@logout');
    $r->addRoute('GET', '/register', 'AuthController@register');
    $r->addRoute('POST', '/register/create', 'AuthController@registerStore');
    $r->addRoute('GET', '/register/majelis', 'AuthController@registerMajelis');
    $r->addRoute('GET', '/register/anggota', 'AuthController@registerAnggota');
    $r->addRoute('POST', '/register/majelis/create', 'AuthController@registerMajelisStore');
    $r->addRoute('POST', '/register/anggota/create', 'AuthController@registerAnggotaStore');
    $r->addRoute('GET', '/register/guest', 'AuthController@registerAnggotaDojo');



    // ************************************ ADMIN ************************************
    $r->addRoute('GET', '/dashboard', 'AdminController@index');

    $r->addRoute('GET', '/dashboard/cabang', 'AdminController@cabang');
    $r->addRoute('GET', '/dashboard/cabang/create', 'AdminController@createDojo');
    $r->addRoute('GET', '/dashboard/cabang/show/{id}', 'AdminController@showDetailDojo');
    $r->addRoute('GET', '/dashboard/cabang/edit/{id}', 'AdminController@editDojo');
    $r->addRoute('GET', '/dashboard/cabang-bone', 'AdminController@cabangBone');
    $r->addRoute('GET', '/dashboard/cabang-makasar', 'AdminController@cabangMakasar');
    $r->addRoute('GET', '/dashboard/cabang-gowa', 'AdminController@cabangGowa');

    $r->addRoute('GET', '/dashboard/majelis', 'AdminController@majelis');
    $r->addRoute('GET', '/dashboard/majelis/create', 'AdminController@createMajelis');
    $r->addRoute('GET', '/dashboard/majelis/edit/{id}', 'AdminController@editMajelis');

    $r->addRoute('GET', '/dashboard/anggota', 'AdminController@anggota');
    $r->addRoute('GET', '/dashboard/anggota/create', 'AdminController@createAnggota');
    $r->addRoute('GET', '/dashboard/anggota/edit/{id}', 'AdminController@editAnggota');
    $r->addRoute('GET', '/dashboard/anggota/show/{id}', 'AdminController@showAnggotaByid');
    $r->addRoute('GET', '/dashboard/anggota-atlet', 'AdminController@showAnggotaAtlet');
    $r->addRoute('GET', '/dashboard/anggota-biasa', 'AdminController@showAnggotaBiasa');

    $r->addRoute('GET', '/dashboard/latihan', 'AdminController@latihan');
    $r->addRoute('GET', '/dashboard/latihan/show/{id}', 'AdminController@showlatihanByid');

    $r->addRoute('GET', '/dashboard/pembayaran', 'AdminController@pembayaran');
    $r->addRoute('GET', '/dashboard/pembayaran/show/{id}', 'AdminController@showPembayaranByid');

    $r->addRoute('GET', '/dashboard/kegiatan', 'AdminController@kegiatan');
    $r->addRoute('GET', '/dashboard/kegiatan/show/{id}', 'AdminController@showKegiatanByid');
    $r->addRoute('GET', '/dashboard/kegiatan/create', 'AdminController@createKegiatan');
    $r->addRoute('GET', '/dashboard/kegiatan/edit/{id}', 'AdminController@editKegiatan');

    $r->addRoute('GET', '/dashboard/prestasi', 'AdminController@prestasi');
    $r->addRoute('GET', '/dashboard/prestasi/create/{id_anggota}', 'AdminController@createPrestasi');
    $r->addRoute('GET', '/dashboard/prestasi/edit/{id}/{id_anggota}', 'AdminController@editPrestasi');

    $r->addRoute('GET', '/dashboard/pengurus', 'AdminController@pengurus');
    $r->addRoute('GET', '/dashboard/pengurus/create', 'AdminController@createPengurus');
    $r->addRoute('GET', '/dashboard/pengurus/edit/{id}', 'AdminController@editPengurus');

    $r->addRoute('GET', '/dashboard/dojoMajelis', 'AdminController@dojoMajelis');





    // ************************************ ANGGOTA ************************************
    $r->addRoute('GET', '/dashboard-anggota', 'AnggotaController@index');
    $r->addRoute('GET', '/dashboard-anggota/kegiatan', 'AnggotaController@kegiatan');
    $r->addRoute('GET', '/dashboard-anggota/kegiatan-terdaftar', 'AnggotaController@kegiatanbyUser');
    $r->addRoute('GET', '/dashboard-anggota/prestasi', 'AnggotaController@prestasi');
    $r->addRoute('GET', '/dashboard-anggota/latihan', 'AnggotaController@latihan');
    $r->addRoute('GET', '/dashboard-anggota/latihan/create', 'AnggotaController@latihanCreate');
    $r->addRoute('GET', '/dashboard-anggota/latihan/edit/{id}', 'AnggotaController@latihanEdit');
    $r->addRoute('GET', '/dashboard-anggota/pembayaran', 'AnggotaController@pembayaran');
    $r->addRoute('GET', '/dashboard-anggota/pembayaran/create', 'AnggotaController@pembayaranCreate');
    $r->addRoute('GET', '/dashboard-anggota/pembayaran/edit/{id}', 'AnggotaController@pembayaranEdit');






    // ************************************ MAJELIS ************************************
    $r->addRoute('GET', '/dashboard-majelis', 'MajelisController@index');
    $r->addRoute('GET', '/dashboard-majelis/kegiatan', 'MajelisController@kegiatan');
    $r->addRoute('GET', '/dashboard-majelis/cabang', 'MajelisController@cabang');
    $r->addRoute('GET', '/dashboard-majelis/cabang/show/{id}', 'MajelisController@showDetailDojo');
    $r->addRoute('GET', '/dashboard-majelis/anggota', 'MajelisController@anggota');
    $r->addRoute('GET', '/dashboard-majelis/anggota/show/{id}', 'MajelisController@showAnggotaByid');
    $r->addRoute('GET', '/dashboard-majelis/anggota/create', 'MajelisController@anggotaCreate');
    $r->addRoute('GET', '/dashboard-majelis/anggota/edit/{id}', 'MajelisController@editAnggota');
    $r->addRoute('GET', '/dashboard-majelis/latihan/show/{id}', 'MajelisController@showlatihanByid');
    $r->addRoute('GET', '/dashboard-majelis/latihan/edit/{id}', 'MajelisController@latihanEdit');
    $r->addRoute('GET', '/dashboard-majelis/pembayaran/show/{id}', 'MajelisController@showPembayaranByid');



    // ======================================== CRUD ========================================
    // Dojo
    $r->addRoute('POST', '/dashboard/cabang/store', 'DojoController@store');
    $r->addRoute('POST', '/dashboard/cabang/update/{id}', 'DojoController@update');
    $r->addRoute('POST', '/dashboard/cabang/delete/{id}', 'DojoController@destroy');

    // Majelis
    $r->addRoute('POST', '/dashboard/majelis/store', 'MajelisController@store');
    $r->addRoute('POST', '/dashboard/majelis/update/{id}', 'MajelisController@update');
    $r->addRoute('POST', '/dashboard/majelis/delete/{id}', 'MajelisController@destroy');

    // anggota
    $r->addRoute('POST', '/dashboard/anggota/store', 'AnggotaController@store');
    $r->addRoute('POST', '/dashboard/anggota/update/{id}', 'AnggotaController@update');
    $r->addRoute('POST', '/dashboard/anggota/delete/{id}', 'AnggotaController@destroy');

    // latihan
    $r->addRoute('POST', '/dashboard/latihan/store', 'LatihanController@store');
    $r->addRoute('POST', '/dashboard/latihan/update/{id}', 'LatihanController@update');
    $r->addRoute('POST', '/dashboard/latihan/delete/{id}', 'LatihanController@destroy');
    $r->addRoute('POST', '/dashboard/latihan/reset/{id}', 'LatihanController@reset');

    // kegiatan
    $r->addRoute('POST', '/dashboard/kegiatan/store', 'KegiatanController@store');
    $r->addRoute('POST', '/dashboard/kegiatan/update/{id}', 'KegiatanController@update');
    $r->addRoute('POST', '/dashboard/kegiatan/delete/{id}', 'KegiatanController@destroy');

    //peserta
    $r->addRoute('POST', '/dashboard/peserta/store', 'PesertaController@store');
    $r->addRoute('POST', '/dashboard/peserta/update/{id}', 'PesertaController@update');
    $r->addRoute('POST', '/dashboard/peserta/delete', 'PesertaController@destroy');

    // prestasi
    $r->addRoute('POST', '/dashboard/prestasi/store/{id_anggota}', 'PrestasiController@store');
    $r->addRoute('POST', '/dashboard/prestasi/update/{id}/{id_anggota}', 'PrestasiController@update');
    $r->addRoute('POST', '/dashboard/prestasi/delete/{id}/{id_anggota}', 'PrestasiController@destroy');

    // pengurus
    $r->addRoute('POST', '/dashboard/pengurus/store', 'PengurusController@store');
    $r->addRoute('POST', '/dashboard/pengurus/update/{id}', 'PengurusController@update');
    $r->addRoute('POST', '/dashboard/pengurus/delete/{id}', 'PengurusController@destroy');

    // dojoMajelis
    $r->addRoute('POST', '/dashboard/dojoMajelis/store', 'DojoMajelisController@store');
    $r->addRoute('POST', '/dashboard/dojoMajelis/update/{id}', 'DojoMajelisController@update');
    $r->addRoute('POST', '/dashboard/dojoMajelis/delete', 'DojoMajelisController@destroy');

    // pembayaran
    $r->addRoute('POST', '/dashboard/pembayaran/store', 'PembayaranController@store');
    $r->addRoute('POST', '/dashboard/pembayaran/update/{id}', 'PembayaranController@update');
    $r->addRoute('POST', '/dashboard/pembayaran/delete/{id}', 'PembayaranController@destroy');


    //errors
    $r->addRoute('GET', '/error', function () {
        echo "
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    font-family: Arial, sans-serif;
                    background-color: #f8f8f8;
                }
    
                .center-content {
                    text-align: center;
                }
    
                h1 {
                    font-size: 2rem;
                    color: #ff4c4c;
                }
    
                p {
                    font-size: 1.2rem;
                    color: #333;
                }
    
                #countdown {
                    font-weight: bold;
                    color: #007bff;
                }
            </style>
    
            <div class='center-content'>
                <h1>Error 405 - Method Not Allowed</h1>
                <p>Anda akan dialihkan ke halaman utama dalam <span id='countdown'>5</span> detik...</p>
            </div>
    
            <script>
                var countdownElement = document.getElementById('countdown');
                var countdown = 5; // Mulai dari 5 detik
    
                var interval = setInterval(function() {
                    countdown--;
                    countdownElement.textContent = countdown;
    
                    if (countdown <= 0) {
                        clearInterval(interval);
                        window.location.href = '/'; // Redirect setelah countdown selesai
                    }
                }, 1000); // Kurangi setiap 1 detik
            </script>
        ";
    });
};
