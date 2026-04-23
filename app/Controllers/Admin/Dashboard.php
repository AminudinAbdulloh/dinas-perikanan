<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BerandaModel;
use App\Models\InformationRequestModel;
use App\Models\InformationObjectionModel;
use App\Models\NewsArticleModel;
use App\Models\GalleryPhotoModel;
use App\Models\GalleryVideoModel;
use App\Models\PengumumanModel;

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

        // ---- Aktivitas Terbaru ----
        $aktivitas = [];

        // Berita terbaru
        if (\App\Models\NewsArticleModel::tableReady()) {
            $beritaList = $newsModel->orderBy('created_at', 'DESC')->findAll(5);
            foreach ($beritaList as $row) {
                $aktivitas[] = [
                    'title'      => $row['title'] ?? '(Tanpa Judul)',
                    'type_label' => 'Berita',
                    'icon'       => 'bi-newspaper',
                    'color'      => '#0d6efd',
                    'color_bg'   => 'rgba(13,110,253,.12)',
                    'created_at' => $row['created_at'],
                    'url'        => base_url('admin/konten/berita'),
                ];
            }
        }

        // Galeri foto terbaru
        if (\App\Models\GalleryPhotoModel::tableReady()) {
            $fotoList = $photoModel->orderBy('created_at', 'DESC')->findAll(5);
            foreach ($fotoList as $row) {
                $aktivitas[] = [
                    'title'      => $row['title'] ?? '(Tanpa Judul)',
                    'type_label' => 'Galeri Foto',
                    'icon'       => 'bi-images',
                    'color'      => '#198754',
                    'color_bg'   => 'rgba(25,135,84,.12)',
                    'created_at' => $row['created_at'],
                    'url'        => base_url('admin/konten/galeri-foto'),
                ];
            }
        }

        // Galeri video terbaru
        if (\App\Models\GalleryVideoModel::tableReady()) {
            $videoList = $videoModel->orderBy('created_at', 'DESC')->findAll(5);
            foreach ($videoList as $row) {
                $aktivitas[] = [
                    'title'      => $row['title'] ?? '(Tanpa Judul)',
                    'type_label' => 'Galeri Video',
                    'icon'       => 'bi-camera-video',
                    'color'      => '#dc3545',
                    'color_bg'   => 'rgba(220,53,69,.12)',
                    'created_at' => $row['created_at'],
                    'url'        => base_url('admin/konten/galeri-video'),
                ];
            }
        }

        // Pengumuman terbaru
        if (class_exists(PengumumanModel::class)) {
            try {
                $pengumumanModel = new PengumumanModel();
                $pengumumanList  = $pengumumanModel->orderBy('created_at', 'DESC')->findAll(5);
                foreach ($pengumumanList as $row) {
                    $aktivitas[] = [
                        'title'      => $row['judul'] ?? $row['title'] ?? '(Tanpa Judul)',
                        'type_label' => 'Pengumuman',
                        'icon'       => 'bi-megaphone',
                        'color'      => '#fd7e14',
                        'color_bg'   => 'rgba(253,126,20,.12)',
                        'created_at' => $row['created_at'],
                        'url'        => base_url('admin/pengumuman'),
                    ];
                }
            } catch (\Throwable $e) {
                // tabel belum siap, lewati
            }
        }

        // Urutkan gabungan berdasarkan waktu terbaru
        usort($aktivitas, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));
        $aktivitas = array_slice($aktivitas, 0, 7);

        // Format label waktu
        $now = time();
        foreach ($aktivitas as &$item) {
            $ts   = strtotime($item['created_at']);
            $diff = $now - $ts;
            if ($diff < 60) {
                $item['time_label'] = 'Baru saja';
            } elseif ($diff < 3600) {
                $item['time_label'] = floor($diff / 60) . ' menit lalu';
            } elseif ($diff < 86400) {
                $item['time_label'] = floor($diff / 3600) . ' jam lalu';
            } elseif ($diff < 604800) {
                $item['time_label'] = floor($diff / 86400) . ' hari lalu';
            } else {
                $item['time_label'] = date('d M Y', $ts);
            }
        }
        unset($item);

        return view('admin/dashboard', [
            'title'              => 'Dashboard Admin',
            'adminNav'           => 'dashboard',
            'stats'              => [
                'permohonan_masuk'     => $permohonanMasuk,
                'keberatan_aktif'      => $keberatanAktif,
                'permohonan_bulan_ini' => $permohonanBulanIni,
                'berita'               => $totalBerita,
                'galeri_foto'          => $totalGaleriFoto,
                'galeri_video'         => $totalGaleriVideo,
            ],
            'antrianPermohonan'  => $antrianPermohonan,
            'antrianKeberatan'   => $antrianKeberatan,
            'aktivitasTerbaru'   => $aktivitas,
        ]);
    }
}
