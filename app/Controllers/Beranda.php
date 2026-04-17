<?php

namespace App\Controllers;

use App\Models\BerandaModel;

class Beranda extends BaseController
{
    public function __construct(
        private readonly BerandaModel $berandaModel = new BerandaModel()
    ) {
    }

    public function index(): string
    {
        $data = [
            'services' => $this->berandaModel->getServices(),
            'newsList' => $this->berandaModel->getNewsList(),
            'galleryPhotos' => $this->berandaModel->getGalleryPhotos(),
            'latestVideos' => $this->berandaModel->getLatestVideos(),
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
        ];

        return view('public/index', $data);
    }

    public function page(string $slug, ?string $subSlug = null): string
    {
        $path = $subSlug ? $slug . '/' . $subSlug : $slug;
        $pageData = $this->berandaModel->getPublicPageData($path);

        if ($pageData === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'pageData' => $pageData,
        ];

        return view('public/page', $data);
    }

    public function berita(): string
    {
        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'newsList' => $this->berandaModel->getNewsList(),
            'pageData' => [
                'title' => 'Berita',
                'description' => 'Informasi dan kegiatan terbaru Dinas Kelautan dan Perikanan Provinsi Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Berita', 'href' => null],
                ],
            ],
        ];

        return view('public/berita', $data);
    }

    public function beritaDetail(int $id): string
    {
        $news = $this->berandaModel->getNewsDetail($id);

        if ($news === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'news' => $news,
            'popularNews' => $this->berandaModel->getPopularNews((int) $news['id']),
            'pageData' => [
                'title' => $news['title'],
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Berita', 'href' => base_url('berita')],
                    ['label' => $news['title'], 'href' => null],
                ],
            ],
        ];

        return view('public/berita_detail', $data);
    }

    public function galeriFoto(): string
    {
        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'galleryPhotos' => $this->berandaModel->getGalleryPhotos(),
            'pageData' => [
                'title' => 'Galeri Foto',
                'description' => 'Dokumentasi visual kegiatan dan potensi sektor kelautan dan perikanan Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Galeri Foto', 'href' => null],
                ],
            ],
        ];

        return view('public/galeri_foto', $data);
    }

    public function galeriVideo(): string
    {
        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'latestVideos' => $this->berandaModel->getLatestVideos(),
            'pageData' => [
                'title' => 'Galeri Video',
                'description' => 'Kumpulan video kegiatan, edukasi, dan profil sektor kelautan serta perikanan Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Galeri Video', 'href' => null],
                ],
            ],
        ];

        return view('public/galeri_video', $data);
    }
}