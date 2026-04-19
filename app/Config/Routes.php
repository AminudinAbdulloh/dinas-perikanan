<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Beranda::index');
$routes->get('berita', 'Beranda::berita');
$routes->get('berita/(:num)', 'Beranda::beritaDetail/$1');
$routes->get('pengumuman', 'Beranda::page/pengumuman');
$routes->group('galeri', static function ($routes) {
    $routes->get('foto', 'Beranda::galeriFoto');
    $routes->get('foto/(:num)', 'Beranda::galeriFotoDetail/$1');
    $routes->get('video', 'Beranda::galeriVideo');
});

$routes->group('profil', static function ($routes) {
    $routes->get('sejarah', 'Beranda::page/profil/sejarah');
    $routes->get('visi-misi', 'Beranda::page/profil/visi-misi');
    $routes->get('tupoksi', 'Beranda::page/profil/tupoksi');
    $routes->get('struktur', 'Beranda::page/profil/struktur');
    $routes->get('pejabat', 'Beranda::page/profil/pejabat');
    $routes->get('pegawai', 'Beranda::page/profil/pegawai');
    $routes->get('kontak', 'Beranda::page/profil/kontak');
});

// $routes->group('publikasi', static function ($routes) {
//     $routes->get('renstra', 'Beranda::page/publikasi/renstra');
//     $routes->get('renja', 'Beranda::page/publikasi/renja');
//     $routes->get('lakip', 'Beranda::page/publikasi/lakip');
//     $routes->get('pk', 'Beranda::page/publikasi/pk');
// });

$routes->group('layanan', static function ($routes) {
    $routes->get('alur-permohonan', 'Beranda::page/layanan/alur-permohonan-informasi');
    $routes->get('form-permohonan', 'Beranda::page/layanan/form-permohonan-informasi');
    $routes->get('form-keberatan', 'Beranda::page/layanan/form-keberatan-informasi');
});

$routes->group('informasi', static function ($routes) {
    $routes->get('daftar-informasi', 'Beranda::page/informasi/daftar-informasi-publik');
    $routes->get('informasi-dikecualikan', 'Beranda::page/informasi/informasi-dikecualikan');
    $routes->get('informasi-berkala', 'Beranda::page/informasi/informasi-berkala');
    $routes->get('informasi-serta-merta', 'Beranda::page/informasi/informasi-serta-merta');
    $routes->get('informasi-setiap-saat', 'Beranda::page/informasi/informasi-setiap-saat');
    // $routes->get('laporan-layanan', 'Beranda::page/informasi/laporan-layanan-informasi');
});

$routes->get('faq', 'Beranda::page/faq');
$routes->get('kebijakan-privasi', 'Beranda::page/kebijakan-privasi');
