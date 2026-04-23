<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BerandaModel;
use App\Models\InformationRequestModel;
use App\Models\InformationObjectionModel;
use App\Models\NewsArticleModel;
use App\Models\GalleryPhotoModel;
use App\Models\GalleryVideoModel;

class Dashboard extends BaseController
{
    protected $helpers = ['url'];

    public function index(): string
    {
        $berandaModel   = new BerandaModel();
        $requestModel   = model(InformationRequestModel::class);
        $objectionModel = model(InformationObjectionModel::class);
        $newsModel      = model(NewsArticleModel::class);
        $photoModel     = model(GalleryPhotoModel::class);
        $videoModel     = model(GalleryVideoModel::class);

        // Stats – guard with tableReady to avoid errors on fresh installs
        $totalBerita = \App\Models\NewsArticleModel::tableReady()
            ? $newsModel->countAllResults()
            : 0;

        $totalGaleriFoto = \App\Models\GalleryPhotoModel::tableReady()
            ? $photoModel->countAllResults()
            : 0;

        $totalGaleriVideo = \App\Models\GalleryVideoModel::tableReady()
            ? $videoModel->countAllResults()
            : 0;

        // Permohonan masuk (semua status)
        $permohonanMasuk = InformationRequestModel::tableReady()
            ? $requestModel->countAllResults()
            : 0;

        // Total permohonan bulan ini
        $thisMonth = date('Y-m');
        $permohonanBulanIni = InformationRequestModel::tableReady()
            ? $requestModel->where("DATE_FORMAT(created_at, '%Y-%m')", $thisMonth)->countAllResults()
            : 0;

        // Keberatan aktif (status diterima atau diproses)
        $keberatanAktif = InformationObjectionModel::tableReady()
            ? $objectionModel->whereIn('status', ['diterima', 'diproses'])->countAllResults()
            : 0;

        // Antrian perlu ditindak: permohonan & keberatan dengan status diterima/diproses
        $antrianPermohonan = InformationRequestModel::tableReady()
            ? $requestModel->whereIn('status', ['diterima', 'diproses'])->orderBy('created_at', 'ASC')->findAll(10)
            : [];

        $antrianKeberatan = InformationObjectionModel::tableReady()
            ? $objectionModel->whereIn('status', ['diterima', 'diproses'])->orderBy('created_at', 'ASC')->findAll(10)
            : [];

        return view('admin/dashboard', [
            'title'    => 'Dashboard Admin',
            'adminNav' => 'dashboard',
            'stats'    => [
                'permohonan_masuk'      => $permohonanMasuk,
                'keberatan_aktif'       => $keberatanAktif,
                'permohonan_bulan_ini'  => $permohonanBulanIni,
                'berita'                => $totalBerita,
                'galeri_foto'           => $totalGaleriFoto,
                'galeri_video'          => $totalGaleriVideo,
            ],
            'antrianPermohonan' => $antrianPermohonan,
            'antrianKeberatan'  => $antrianKeberatan,
            'quickLinks' => [
                [
                    'label'       => 'Permohonan Informasi',
                    'description' => 'Kelola permohonan masuk',
                    'href'        => base_url('admin/konten/permohonan-informasi'),
                    'icon'        => 'bi-envelope-paper',
                ],
                [
                    'label'       => 'Keberatan Informasi',
                    'description' => 'Tindak keberatan aktif',
                    'href'        => base_url('admin/konten/keberatan-informasi'),
                    'icon'        => 'bi-exclamation-triangle',
                ],
                [
                    'label'       => 'Kelola Berita',
                    'description' => 'Tambah dan edit artikel',
                    'href'        => base_url('admin/konten/berita'),
                    'icon'        => 'bi-pencil-square',
                ],
                [
                    'label'       => 'Galeri Foto',
                    'description' => 'Unggah dan urutkan album',
                    'href'        => base_url('admin/konten/galeri-foto'),
                    'icon'        => 'bi-image',
                ],
                [
                    'label'       => 'Galeri Video',
                    'description' => 'Daftar video kegiatan',
                    'href'        => base_url('admin/konten/galeri-video'),
                    'icon'        => 'bi-collection-play',
                ],
                [
                    'label'       => 'Pengumuman',
                    'description' => 'Kelola pengumuman resmi',
                    'href'        => base_url('admin/pengumuman'),
                    'icon'        => 'bi-megaphone',
                ],
                [
                    'label'       => 'Informasi Publik',
                    'description' => 'Daftar informasi PPID',
                    'href'        => base_url('admin/konten/informasi-publik'),
                    'icon'        => 'bi-journal-text',
                ],
                [
                    'label'       => 'Beranda Situs',
                    'description' => 'Tampilan pengunjung publik',
                    'href'        => base_url('/'),
                    'icon'        => 'bi-house-door',
                ],
            ],
        ]);
    }
}
