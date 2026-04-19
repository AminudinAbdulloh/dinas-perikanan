<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Beranda::index');

$routes->get('login', static fn () => redirect()->to(base_url('admin/login')));

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::attemptLogin', ['filter' => 'csrf']);
    $routes->get('logout', 'Auth::logout');

    $routes->group('', ['filter' => 'adminauth'], static function ($routes) {
        $routes->get('/', 'Dashboard::index');
        $routes->get('dashboard', 'Dashboard::index');

        $routes->get('konten/sejarah', 'KontenSejarah::index');
        $routes->get('konten/sejarah/edit', 'KontenSejarah::edit');
        $routes->post('konten/sejarah/update', 'KontenSejarah::update', ['filter' => 'csrf']);

        $routes->get('konten/visi-misi', 'KontenVisiMisi::index');
        $routes->get('konten/visi-misi/edit', 'KontenVisiMisi::edit');
        $routes->post('konten/visi-misi/update', 'KontenVisiMisi::update', ['filter' => 'csrf']);

        $routes->get('konten/tupoksi', 'KontenTupoksi::index');
        $routes->get('konten/tupoksi/edit', 'KontenTupoksi::edit');
        $routes->post('konten/tupoksi/update', 'KontenTupoksi::update', ['filter' => 'csrf']);
        $routes->get('konten/struktur', 'KontenStruktur::index');
        $routes->get('konten/struktur/edit', 'KontenStruktur::edit');
        $routes->post('konten/struktur/update', 'KontenStruktur::update', ['filter' => 'csrf']);
        $routes->get('konten/pejabat', 'KontenPejabat::index');
        $routes->get('konten/pejabat/edit', 'KontenPejabat::edit');
        $routes->post('konten/pejabat/update', 'KontenPejabat::update', ['filter' => 'csrf']);
        $routes->get('konten/pegawai', 'KontenPegawai::index');
        $routes->get('konten/pegawai/edit', 'KontenPegawai::edit');
        $routes->post('konten/pegawai/update', 'KontenPegawai::update', ['filter' => 'csrf']);
        $routes->get('konten/kontak', 'KontenKontak::index');
        $routes->get('konten/kontak/edit', 'KontenKontak::edit');
        $routes->post('konten/kontak/update', 'KontenKontak::update', ['filter' => 'csrf']);

        $routes->get('konten/berita', 'KontenBerita::index');
        $routes->get('konten/berita/tambah', 'KontenBerita::create');
        $routes->post('konten/berita/simpan', 'KontenBerita::store', ['filter' => 'csrf']);
        $routes->get('konten/berita/(:num)/edit', 'KontenBerita::edit/$1');
        $routes->post('konten/berita/(:num)/update', 'KontenBerita::update/$1', ['filter' => 'csrf']);
        $routes->post('konten/berita/(:num)/hapus', 'KontenBerita::delete/$1', ['filter' => 'csrf']);

        $routes->post('konten/upload-image', 'KontenMedia::uploadImage');
        $routes->post('konten/delete-image', 'KontenMedia::deleteImage');
    });
});
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
    $routes->get('alur-permohonan-informasi', 'Beranda::page/layanan/alur-permohonan-informasi');
    $routes->get('form-permohonan-informasi', 'Beranda::page/layanan/form-permohonan-informasi');
    $routes->get('form-keberatan-informasi', 'Beranda::page/layanan/form-keberatan-informasi');
});

$routes->group('informasi', static function ($routes) {
    $routes->get('daftar-informasi-publik', 'Beranda::page/informasi/daftar-informasi-publik');
    $routes->get('informasi-dikecualikan', 'Beranda::page/informasi/informasi-dikecualikan');
    $routes->get('informasi-berkala', 'Beranda::page/informasi/informasi-berkala');
    $routes->get('informasi-serta-merta', 'Beranda::page/informasi/informasi-serta-merta');
    $routes->get('informasi-setiap-saat', 'Beranda::page/informasi/informasi-setiap-saat');
    // $routes->get('laporan-layanan', 'Beranda::page/informasi/laporan-layanan-informasi');
});

$routes->get('faq', 'Beranda::page/faq');
$routes->get('kebijakan-privasi', 'Beranda::page/kebijakan-privasi');
