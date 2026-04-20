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

        $routes->get('konten/alur-informasi', 'KontenAlurInformasi::index');
        $routes->get('konten/alur-informasi/edit', 'KontenAlurInformasi::edit');
        $routes->post('konten/alur-informasi/update', 'KontenAlurInformasi::update', ['filter' => 'csrf']);

        $routes->get('konten/permohonan-informasi', 'KontenPermohonanInformasi::index');
        $routes->get('konten/permohonan-informasi/(:num)', 'KontenPermohonanInformasi::detail/$1');
        $routes->post('konten/permohonan-informasi/(:num)/status', 'KontenPermohonanInformasi::updateStatus/$1', ['filter' => 'csrf']);
        $routes->post('konten/permohonan-informasi/(:num)/hapus', 'KontenPermohonanInformasi::delete/$1', ['filter' => 'csrf']);

        $routes->get('konten/keberatan-informasi', 'KontenKeberatanInformasi::index');
        $routes->get('konten/keberatan-informasi/(:num)', 'KontenKeberatanInformasi::detail/$1');
        $routes->post('konten/keberatan-informasi/(:num)/status', 'KontenKeberatanInformasi::updateStatus/$1', ['filter' => 'csrf']);
        $routes->post('konten/keberatan-informasi/(:num)/hapus', 'KontenKeberatanInformasi::delete/$1', ['filter' => 'csrf']);

        $routes->get('konten/berita', 'KontenBerita::index');
        $routes->get('konten/berita/tambah', 'KontenBerita::create');
        $routes->post('konten/berita/simpan', 'KontenBerita::store', ['filter' => 'csrf']);
        $routes->get('konten/berita/(:num)/edit', 'KontenBerita::edit/$1');
        $routes->post('konten/berita/(:num)/update', 'KontenBerita::update/$1', ['filter' => 'csrf']);
        $routes->post('konten/berita/(:num)/hapus', 'KontenBerita::delete/$1', ['filter' => 'csrf']);

        $routes->get('konten/galeri-foto', 'KontenGaleriFoto::index');
        $routes->get('konten/galeri-foto/tambah', 'KontenGaleriFoto::create');
        $routes->post('konten/galeri-foto/simpan', 'KontenGaleriFoto::store', ['filter' => 'csrf']);
        $routes->get('konten/galeri-foto/(:num)/edit', 'KontenGaleriFoto::edit/$1');
        $routes->post('konten/galeri-foto/(:num)/update', 'KontenGaleriFoto::update/$1', ['filter' => 'csrf']);
        $routes->post('konten/galeri-foto/(:num)/hapus', 'KontenGaleriFoto::delete/$1', ['filter' => 'csrf']);

        $routes->get('konten/galeri-video', 'KontenGaleriVideo::index');
        $routes->get('konten/galeri-video/tambah', 'KontenGaleriVideo::create');
        $routes->post('konten/galeri-video/simpan', 'KontenGaleriVideo::store', ['filter' => 'csrf']);
        $routes->get('konten/galeri-video/(:num)/edit', 'KontenGaleriVideo::edit/$1');
        $routes->post('konten/galeri-video/(:num)/update', 'KontenGaleriVideo::update/$1', ['filter' => 'csrf']);
        $routes->post('konten/galeri-video/(:num)/hapus', 'KontenGaleriVideo::delete/$1', ['filter' => 'csrf']);

        $routes->get('konten/informasi-publik', 'KontenInformasiPublik::index');
        $routes->get('konten/informasi-publik/tambah', 'KontenInformasiPublik::create');
        $routes->post('konten/informasi-publik/simpan', 'KontenInformasiPublik::store', ['filter' => 'csrf']);
        $routes->get('konten/informasi-publik/(:num)/edit', 'KontenInformasiPublik::edit/$1');
        $routes->post('konten/informasi-publik/(:num)/update', 'KontenInformasiPublik::update/$1', ['filter' => 'csrf']);
        $routes->post('konten/informasi-publik/(:num)/hapus', 'KontenInformasiPublik::delete/$1', ['filter' => 'csrf']);

        $routes->get('konten/kategori-publikasi', 'KontenKategoriPublikasi::index');
        $routes->get('konten/kategori-publikasi/tambah', 'KontenKategoriPublikasi::create');
        $routes->post('konten/kategori-publikasi/simpan', 'KontenKategoriPublikasi::store', ['filter' => 'csrf']);
        $routes->get('konten/kategori-publikasi/(:num)/edit', 'KontenKategoriPublikasi::edit/$1');
        $routes->post('konten/kategori-publikasi/(:num)/update', 'KontenKategoriPublikasi::update/$1', ['filter' => 'csrf']);
        $routes->post('konten/kategori-publikasi/(:num)/hapus', 'KontenKategoriPublikasi::delete/$1', ['filter' => 'csrf']);

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
    $routes->post('form-permohonan-informasi/kirim', 'Beranda::submitPermohonan', ['filter' => 'csrf']);
    $routes->post('form-permohonan-informasi/lacak', 'Beranda::lacakPermohonan', ['filter' => 'csrf']);
    $routes->get('form-keberatan-informasi', 'Beranda::page/layanan/form-keberatan-informasi');
    $routes->post('form-keberatan-informasi/kirim', 'Beranda::submitKeberatan', ['filter' => 'csrf']);
});

$routes->group('informasi', static function ($routes) {
    $routes->get('daftar-informasi-publik', static fn () => redirect()->to(base_url('publikasi/daftar-informasi-publik')));
    $routes->get('informasi-berkala', 'Beranda::informasiPublik/informasi-berkala');
    $routes->get('informasi-serta-merta', 'Beranda::informasiPublik/informasi-serta-merta');
    $routes->get('informasi-setiap-saat', 'Beranda::informasiPublik/informasi-setiap-saat');
    $routes->get('informasi-dikecualikan', 'Beranda::informasiPublik/informasi-dikecualikan');
});

$routes->group('publikasi', static function ($routes) {
    $routes->get('(:segment)', 'Beranda::publikasiList/$1');
    $routes->get('(:segment)/(:num)', 'Beranda::publikasiDetail/$1/$2');
});

$routes->get('faq', 'Beranda::page/faq');
$routes->get('kebijakan-privasi', 'Beranda::page/kebijakan-privasi');
