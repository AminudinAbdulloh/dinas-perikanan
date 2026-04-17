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
}