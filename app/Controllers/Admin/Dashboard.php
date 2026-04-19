<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BerandaModel;

class Dashboard extends BaseController
{
    protected $helpers = ['url'];

    public function __construct(
        private readonly BerandaModel $berandaModel = new BerandaModel()
    ) {
    }

    public function index(): string
    {
        $newsList = $this->berandaModel->getNewsList();
        $galleryPhotos = $this->berandaModel->getGalleryPhotos();
        $videos = $this->berandaModel->getLatestVideos();

        return view('admin/dashboard', [
            'title' => 'Dashboard Admin',
            'adminNav' => 'dashboard',
            'stats' => [
                'berita' => count($newsList),
                'galeri_foto' => count($galleryPhotos),
                'galeri_video' => count($videos),
            ],
            'latestNews' => array_slice($newsList, 0, 5),
            'quickLinks' => [
                [
                    'label' => 'Beranda situs',
                    'description' => 'Tampilan pengunjung',
                    'href' => base_url('/'),
                    'icon' => 'bi-house-door',
                ],
                [
                    'label' => 'Berita',
                    'description' => 'Daftar artikel publik',
                    'href' => base_url('berita'),
                    'icon' => 'bi-newspaper',
                ],
                [
                    'label' => 'Pengumuman',
                    'description' => 'Halaman pengumuman',
                    'href' => base_url('pengumuman'),
                    'icon' => 'bi-megaphone',
                ],
                [
                    'label' => 'Galeri foto',
                    'description' => 'Album foto kegiatan',
                    'href' => base_url('galeri/foto'),
                    'icon' => 'bi-images',
                ],
                [
                    'label' => 'Galeri video',
                    'description' => 'Koleksi video',
                    'href' => base_url('galeri/video'),
                    'icon' => 'bi-camera-video',
                ],
                [
                    'label' => 'FAQ & privasi',
                    'description' => 'Halaman informasi tambahan',
                    'href' => base_url('faq'),
                    'icon' => 'bi-question-circle',
                ],
            ],
            'upcomingModules' => [
                ['icon' => 'bi-pencil-square', 'title' => 'Editor berita', 'detail' => 'CRUD artikel, draft, dan jadwal tayang.'],
                ['icon' => 'bi-folder2-open', 'title' => 'Halaman statis', 'detail' => 'Profil, PPID, dan layanan dari panel.'],
                ['icon' => 'bi-image', 'title' => 'Media galeri', 'detail' => 'Unggah foto dan kelola tautan video.'],
                ['icon' => 'bi-people', 'title' => 'Pengguna admin', 'detail' => 'Peran, log aktivitas, dan reset sandi.'],
            ],
        ]);
    }
}
