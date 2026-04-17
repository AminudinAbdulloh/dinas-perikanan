<?php

namespace App\Controllers;

use App\Models\BerandaData;

class Beranda extends BaseController
{
    public function __construct(
        private readonly BerandaData $berandaData = new BerandaData()
    ) {}

    public function index(): string
    {
        $data = [
            'services'     => $this->berandaData->getServices(),
            'newsList'     => $this->berandaData->getNewsList(),
            'galleryPhotos' => $this->berandaData->getGalleryPhotos(),
            'latestVideos' => $this->berandaData->getLatestVideos(),
        ];

        return view('public/index', $data);
    }
}