<?php

require '../vendor/autoload.php';
require '../bootstrap.php';

use FastRoute\RouteCollector;

// Path ke file routes
$routeFile = __DIR__ . '/../routes/web.php';

// Pastikan file routing ada
if (!file_exists($routeFile)) {
    die('Routing file does not exist.');
}

// Buat dispatcher untuk rute
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) use ($routeFile) {
    // Muat rute dari file routes/web.php
    $routeDefinition = require $routeFile;
    // Panggil fungsi untuk mendefinisikan rute
    $routeDefinition($r);
});

// Ambil metode HTTP dan URI
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Hapus query string dari URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Dispatch rute
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

// Handle rute berdasarkan hasil dispatch
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header('HTTP/1.1 404 Not Found');
        echo '404 - Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        header('HTTP/1.1 405 Method Not Allowed');
        echo '405 - Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // Cek apakah handler adalah Closure atau string
        if (is_callable($handler)) {
            // Jika Closure, panggil Closure dengan variabel yang sesuai
            call_user_func_array($handler, $vars);
        } else {
            // Jika handler adalah string dalam format 'Controller@method'
            list($controllerName, $methodName) = explode("@", $handler, 2);

            // Autoload controller
            $controllerClass = 'App\\Controller\\' . $controllerName;

            // Kirim instance $blade ke dalam constructor controller
            $controller = new $controllerClass($blade, $filesystem); // <-- $blade dari bootstrap.php

            // Panggil metode controller
            if (method_exists($controller, $methodName)) {
                if (in_array($methodName, ['store', 'update', 'destroy', 'login', 'registerStore', 'registerAnggotaStore', 'registerMajelisStore'])) {
                    $controller->$methodName($_REQUEST);
                } else {
                    $controller->$methodName();
                }
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo 'Method not found';
            }
        }
        break;
}

// Debugging: Tampilkan rute yang terdaftar
error_reporting(E_ALL);
ini_set('display_errors', 1);
spl_autoload_register(function ($class) {
    echo "Trying to load: $class\n";
});
