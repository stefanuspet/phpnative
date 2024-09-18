<?php

use FastRoute\RouteCollector;

// Fungsi untuk mengatur routing
return function (RouteCollector $r) {
    // guest
    $r->addRoute('GET', '/', 'AuthController@index');
    $r->addRoute('POST', '/login', 'AuthController@login');
    $r->addRoute('GET', '/logout', 'AuthController@logout');

    // ************************************ ADMIN ************************************
    $r->addRoute('GET', '/dashboard', 'AdminController@index');

    $r->addRoute('GET', '/dashboard/cabang', 'AdminController@cabang');
    $r->addRoute('GET', '/dashboard/cabang/create', 'AdminController@createDojo');
    $r->addRoute('GET', '/dashboard/cabang/show/{id}', 'AdminController@showDetailDojo');
    $r->addRoute('GET', '/dashboard/cabang/edit/{id}', 'AdminController@editDojo');

    $r->addRoute('GET', '/dashboard/majelis', 'AdminController@majelis');
    $r->addRoute('GET', '/dashboard/majelis/create', 'AdminController@createMajelis');
    $r->addRoute('GET', '/dashboard/majelis/edit/{id}', 'AdminController@editMajelis');

    $r->addRoute('GET', '/dashboard/anggota', 'AdminController@anggota');
    $r->addRoute('GET', '/dashboard/anggota/create', 'AdminController@createAnggota');
    $r->addRoute('GET', '/dashboard/anggota/edit/{id}', 'AdminController@editAnggota');
    $r->addRoute('GET', '/dashboard/anggota/show/{id}', 'AdminController@showAnggotaByid');

    $r->addRoute('GET', '/dashboard/latihan', 'AdminController@latihan');
    $r->addRoute('GET', '/dashboard/latihan/show/{id}', 'AdminController@showlatihanByid');

    $r->addRoute('GET', '/dashboard/pembayaran', 'AdminController@pembayaran');
    $r->addRoute('GET', '/dashboard/pembayaran/show/{id}', 'AdminController@showPembayaranByid');

    // ************************************ ANGGOTA ************************************
    $r->addRoute('GET', '/dashboard-anggota', 'AnggotaController@index');


    // ************************************ MAJELIS ************************************
    $r->addRoute('GET', '/dashboard-majelis', 'MajelisController@index');


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
