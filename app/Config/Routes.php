<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Beranda::index');

$routes->group('profil', static function ($routes) {
    $routes->get('sejarah', 'Beranda::page/profil/sejarah');
    $routes->get('visi-misi', 'Beranda::page/profil/visi-misi');
    $routes->get('tupoksi', 'Beranda::page/profil/tupoksi');
    $routes->get('struktur', 'Beranda::page/profil/struktur');
    $routes->get('pejabat', 'Beranda::page/profil/pejabat');
    $routes->get('pegawai', 'Beranda::page/profil/pegawai');
    $routes->get('kontak', 'Beranda::page/profil/kontak');
});

$routes->group('program', static function ($routes) {
    $routes->get('renstra', 'Beranda::page/program/renstra');
    $routes->get('renja', 'Beranda::page/program/renja');
    $routes->get('lakip', 'Beranda::page/program/lakip');
    $routes->get('pk', 'Beranda::page/program/pk');
});

$routes->group('informasi', static function ($routes) {
    $routes->get('alur-permohonan', 'Beranda::page/informasi/alur-permohonan');
    $routes->get('form-permohonan', 'Beranda::page/informasi/form-permohonan');
    $routes->get('form-keberatan', 'Beranda::page/informasi/form-keberatan');
    $routes->get('daftar-informasi', 'Beranda::page/informasi/daftar-informasi');
    $routes->get('informasi-dikecualikan', 'Beranda::page/informasi/informasi-dikecualikan');
    $routes->get('informasi-berkala', 'Beranda::page/informasi/informasi-berkala');
    $routes->get('informasi-setiap-saat', 'Beranda::page/informasi/informasi-setiap-saat');
    $routes->get('laporan-layanan', 'Beranda::page/informasi/laporan-layanan');
});

$routes->get('faq', 'Beranda::page/faq');
$routes->get('kebijakan-privasi', 'Beranda::page/kebijakan-privasi');
