<?php
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;
use eftec\bladeone\BladeOne;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

$adapter = new LocalFilesystemAdapter(__DIR__ . '/storage/uploads');
$filesystem = new Filesystem($adapter);

$GLOBALS['filesystem'] = $filesystem;

// Load .env (jika menggunakan vlucas/phpdotenv)
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Konfigurasi database dengan Eloquent
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Konfigurasi Blade template engine
$views = __DIR__ . '/app/Views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
