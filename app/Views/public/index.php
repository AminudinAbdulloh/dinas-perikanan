<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?>Beranda - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/beranda.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('js/beranda.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <img
        src="https://images.unsplash.com/photo-1689505630546-bebf6e52dce2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080"
        alt="Perikanan Papua Tengah"
        class="hero-bg-img"
    >
    <div class="hero-overlay"></div>

    <div class="container px-4 px-lg-2">
        <div class="row">
            <div class="col-lg-8 animate-up">
                <div class="mb-4">
                    <span class="badge-custom">Pemerintah Provinsi Papua Tengah</span>
                </div>
                <h1 class="display-4 fw-bold text-white mb-4">
                    Dinas Kelautan dan Perikanan Provinsi Papua Tengah
                </h1>
                <p class="text-light mb-5 fs-5">
                    Mengelola dan mengembangkan potensi perikanan dan kelautan untuk kesejahteraan masyarakat Papua Tengah
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#layanan" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="bi bi-grid me-2"></i>Layanan Publik
                    </a>
                    <a href="<?= base_url('profil/sejarah') ?>" class="btn btn-outline-white btn-lg px-4 py-3">
                        <i class="bi bi-info-circle me-2"></i>Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Utama -->
<section id="layanan" class="section-padding">
    <div class="container px-4 px-lg-2">
        <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
            <h2 class="fw-bold display-6 mb-3 text-dark-white">Layanan Utama</h2>
            <p class="text-muted fs-5">
                Layanan Informasi Publik Dinas Perikanan dan Kelautan Papua Tengah
            </p>
        </div>

        <div class="row g-4">
            <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?= base_url(esc($service['link'])) ?>" class="service-card shadow-sm">
                        <div class="icon-box">
                            <i class="bi <?= esc($service['icon']) ?> fs-3"></i>
                        </div>
                        <h3 class="fw-bold"><?= esc($service['title']) ?></h3>
                        <p class="service-description"><?= esc($service['description']) ?></p>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Berita Terkini -->
<section id="berita" class="news-section">
    <div class="container px-4 px-lg-2">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5">
            <div>
                <h2 class="fw-bold display-6 mb-3 text-dark-white">Berita Terkini</h2>
                <p class="text-muted fs-5 mb-0">Informasi dan kegiatan terbaru Dinas Perikanan dan Kelautan</p>
            </div>
            <a href="<?= base_url('berita') ?>" class="link-primary fw-semibold text-decoration-none">
                Lihat Semua
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($newsList as $news): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="news-card">
                        <img
                            src="<?= esc($news['image']) ?>"
                            alt="<?= esc($news['title']) ?>"
                            class="news-image"
                        >
                        <div class="news-content">
                            <div class="d-flex align-items-center gap-2 news-meta mb-3">
                                <i class="bi bi-file-earmark-text"></i>
                                <time><?= esc($news['date']) ?></time>
                            </div>
                            <h3 class="fw-bold mb-3 news-title"><?= esc($news['title']) ?></h3>
                            <p class="mb-4 news-excerpt"><?= esc($news['excerpt']) ?></p>
                            <a href="<?= base_url('berita/' . (int) $news['id']) ?>"
                               class="link-primary fw-semibold text-decoration-none">
                                Baca Selengkapnya <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Galeri Foto -->
<section id="galeri" class="gallery-section">
    <div class="container px-4 px-lg-2">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5">
            <div>
                <h2 class="fw-bold display-6 mb-3 text-dark-white">Galeri Foto</h2>
                <p class="text-muted fs-5 mb-0">Dokumentasi kegiatan dan potensi perikanan Papua Tengah</p>
            </div>
            <a href="<?= base_url('galeri/foto') ?>" class="gallery-link">
                <i class="bi bi-image fs-5"></i>
                Lihat Semua
            </a>
        </div>

        <div class="row g-3 g-md-4">
            <?php foreach ($galleryPhotos as $photo): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="<?= base_url('galeri/foto/' . (int) $photo['id']) ?>" class="gallery-item">
                        <img
                            src="<?= esc($photo['image']) ?>"
                            alt="<?= esc($photo['title']) ?>"
                            class="gallery-image"
                        >
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <div class="gallery-category"><?= esc($photo['category']) ?></div>
                                <p class="gallery-title"><?= esc($photo['title']) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Video Terbaru -->
<section id="video" class="video-section">
    <div class="container px-4 px-lg-2">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5">
            <div>
                <h2 class="fw-bold display-6 mb-3 text-dark-white">Video Terbaru</h2>
                <p class="text-muted fs-5 mb-0">Video dokumentasi dan profil perikanan Papua Tengah</p>
            </div>
            <a href="<?= base_url('galeri/video') ?>" class="video-link">
                <i class="bi bi-play-fill fs-5"></i>
                Lihat Semua
            </a>
        </div>

        <div class="row g-4 g-lg-5">
            <?php foreach ($latestVideos as $video): ?>
                <div class="col-md-6 col-lg-4">
                    <a
                        href="#"
                        class="video-card js-video-trigger"
                        data-youtube-id="<?= esc($video['youtube_id']) ?>"
                        data-video-title="<?= esc($video['title']) ?>"
                    >
                        <div class="video-thumb-wrap">
                            <img
                                src="https://img.youtube.com/vi/<?= esc($video['youtube_id']) ?>/hqdefault.jpg"
                                alt="<?= esc($video['title']) ?>"
                                class="video-thumb"
                            >
                            <div class="video-overlay"></div>
                            <div class="video-play-center">
                                <div class="video-play-btn">
                                    <i class="bi bi-play-fill"></i>
                                </div>
                            </div>
                            <div class="video-duration"><?= esc($video['duration']) ?></div>
                        </div>

                        <div class="video-meta">
                            <i class="bi bi-play-circle"></i>
                            <time><?= esc($video['date']) ?></time>
                        </div>
                        <h3 class="video-title"><?= esc($video['title']) ?></h3>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Modal Video Player -->
<div
    class="modal fade video-modal"
    id="videoPlayerModal"
    tabindex="-1"
    aria-labelledby="videoPlayerModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white" id="videoPlayerModalLabel">Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="ratio ratio-16x9">
                    <iframe
                        id="youtubePlayerFrame"
                        src=""
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>