<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<style>
    .hero-section {
        position: relative;
        height: 600px;
        overflow: hidden;
    }

    .hero-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(30, 58, 138, 0.9), rgba(30, 64, 175, 0.8), transparent);
        z-index: -1;
    }

    .badge-custom {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: rgba(6, 182, 212, 0.2);
        border: 1px solid rgba(165, 243, 252, 0.3);
        border-radius: 50rem;
        color: #ecfeff;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-outline-white {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(4px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline-white:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    /* Services Section */
    .service-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
    }

    .service-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb15, #06b6d415);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #2563eb;
        flex-shrink: 0;
    }

    .section-padding {
        padding: 80px 0;
        background-color: #f1f5f9;
    }

    /* Card Style */
    .service-card {
        text-decoration: none;
        display: block;
        height: 100%;
        padding: 1.5rem;
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .service-card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
        border-color: var(--bs-blue-600) !important;
        transform: translateY(-5px);
    }

    /* Icon Container */
    .icon-box {
        width: 56px;
        height: 56px;
        background-color: #c7dfff;
        color: var(--bs-blue-600);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .service-card:hover .icon-box {
        background-color: #2563eb;
        color: #fff;
    }

    /* Text Hover */
    .service-card h3 {
        font-size: 1.125rem;
        color: #212529;
        transition: color 0.3s ease;
    }

    .service-card:hover h3 {
        color: var(--bs-blue-600);
    }

    .service-description {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    [data-bs-theme="dark"] .service-card {
        background-color: #0f172a !important;
        border-color: #1e293b !important;
    }

    [data-bs-theme="dark"] .service-card:hover {
        border-color: #3b82f6 !important;
        background-color: #1e293b !important;
    }

    [data-bs-theme="dark"] .service-card h3 {
        color: #f8fafc;
    }

    [data-bs-theme="dark"] .service-description {
        color: #94a3b8;
    }

    [data-bs-theme="dark"] .icon-box {
        background-color: rgba(37, 99, 235, 0.15);
        color: #60a5fa;
    }

    [data-bs-theme="dark"] #layanan {
        background-color: #030712;
    }

    [data-bs-theme="dark"] .text-dark-white {
        color: white !important;
    }

    [data-bs-theme="dark"] .text-muted {
        color: #94a3b8 !important;
    }

    /* News Section */
    .news-section {
        padding: 80px 0;
        background-color: #ffffff;
    }

    .news-card {
        background-color: #f1f5f9;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
        height: 100%;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .news-card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }

    .news-meta {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .news-title {
        color: #111827;
        font-size: 1.25rem;
    }

    .news-excerpt {
        color: #4b5563;
    }

    .news-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .news-content {
        padding: 1.5rem;
    }

    /* Gallery Section */
    .gallery-section {
        padding: 80px 0;
        background-color: #f1f5f9;
    }

    .gallery-link {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .gallery-link:hover {
        text-decoration: underline;
    }

    .gallery-item {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border-radius: 0.75rem;
        text-decoration: none;
        display: block;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.08);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-caption {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 1rem;
    }

    .gallery-category {
        font-size: 0.75rem;
        color: #60a5fa;
        margin-bottom: 0.25rem;
    }

    .gallery-title {
        margin: 0;
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 600;
    }

    /* Video Section */
    .video-section {
        padding: 80px 0;
        background-color: #ffffff;
    }

    .video-link {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .video-link:hover {
        text-decoration: underline;
    }

    .video-card {
        text-decoration: none;
        display: block;
        height: 100%;
        cursor: pointer;
        background-color: #f1f5f9;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem;
        transition: box-shadow 0.3s ease, transform 0.3s ease, border-color 0.3s ease;
    }

    .video-card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        border-color: #2563eb;
        transform: translateY(-4px);
    }

    .video-thumb-wrap {
        position: relative;
        aspect-ratio: 16 / 9;
        border-radius: 0.75rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .video-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .video-card:hover .video-thumb {
        transform: scale(1.05);
    }

    .video-overlay {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.4);
        transition: background-color 0.3s ease;
    }

    .video-card:hover .video-overlay {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .video-play-center {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-play-btn {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.9);
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .video-card:hover .video-play-btn {
        transform: scale(1.1);
        background-color: #ffffff;
    }

    .video-duration {
        position: absolute;
        bottom: 0.75rem;
        right: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.35rem;
        background-color: rgba(0, 0, 0, 0.8);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .video-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .video-title {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        transition: color 0.3s ease;
    }

    .video-card:hover .video-title {
        color: #2563eb;
    }

    @media (max-width: 991.98px) {
        .hero-section {
            height: auto;
            min-height: 560px;
            padding: 100px 0 70px;
        }

        .hero-overlay {
            background: linear-gradient(to bottom, rgba(30, 58, 138, 0.88), rgba(30, 64, 175, 0.82), rgba(30, 58, 138, 0.65));
        }

        .hero-section .display-4 {
            font-size: 2rem;
        }

        .hero-section .lead {
            font-size: 1rem !important;
        }

        .hero-section .btn {
            width: 100%;
            justify-content: center;
        }

        .section-padding,
        .news-section {
            padding: 64px 0;
        }

        .news-image {
            height: 200px;
        }
    }

    @media (max-width: 575.98px) {
        .hero-section {
            min-height: 500px;
            padding: 90px 0 56px;
        }

        .hero-section .display-4 {
            font-size: 1.65rem;
        }

        .badge-custom {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
        }

        .service-card,
        .news-content {
            padding: 1.15rem;
        }

        .news-title {
            font-size: 1.1rem;
        }

        .news-image {
            height: 180px;
        }

        #berita .d-flex.align-items-end {
            align-items: flex-start !important;
        }
    }

    [data-bs-theme="dark"] .news-section {
        background-color: #101828;
    }

    [data-bs-theme="dark"] .news-card {
        background-color: #1e2939;
        border-color: #1f2937;
    }

    [data-bs-theme="dark"] .news-meta,
    [data-bs-theme="dark"] .news-excerpt {
        color: #9ca3af;
    }

    [data-bs-theme="dark"] .news-title {
        color: #f9fafb;
    }

    [data-bs-theme="dark"] .gallery-section {
        background-color: #030712;
    }

    [data-bs-theme="dark"] .gallery-link {
        color: #60a5fa;
    }

    [data-bs-theme="dark"] .video-section {
        background-color: #111827;
    }

    [data-bs-theme="dark"] .video-link {
        color: #60a5fa;
    }

    [data-bs-theme="dark"] .video-meta {
        color: #9ca3af;
    }

    [data-bs-theme="dark"] .video-card {
        background-color: #1e2939;
        border-color: #1f2937;
    }

    [data-bs-theme="dark"] .video-card:hover {
        border-color: #3b82f6;
        background-color: #253042;
    }

    [data-bs-theme="dark"] .video-title {
        color: #f9fafb;
    }

    [data-bs-theme="dark"] .video-card:hover .video-title {
        color: #60a5fa;
    }

    .video-modal .modal-content {
        background-color: #000;
        border: 0;
        border-radius: 0.75rem;
    }

    .video-modal .btn-close {
        filter: invert(1) grayscale(100%);
    }
</style>

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <img src="https://images.unsplash.com/photo-1689505630546-bebf6e52dce2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080"
        alt="Perikanan Papua Tengah" class="hero-bg-img">
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
                    Mengelola dan mengembangkan potensi perikanan dan kelautan untuk kesejahteraan masyarakat Papua
                    Tengah
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

<!-- Services Section -->
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
                    <a href="<?= base_url($service['link']) ?>" class="service-card shadow-sm">
                        <div class="icon-box">
                            <i class="bi <?= esc($service['icon']) ?> fs-3"></i>
                        </div>
                        <h3 class="fw-bold"><?= esc($service['title']) ?></h3>
                        <p class="service-description"><?= esc($service['description']) ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- News Section -->
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
                        <img src="<?= esc($news['image']) ?>" alt="<?= esc($news['title']) ?>" class="news-image">
                        <div class="news-content">
                            <div class="d-flex align-items-center gap-2 news-meta mb-3">
                                <i class="bi bi-file-earmark-text"></i>
                                <time><?= esc($news['date']) ?></time>
                            </div>
                            <h3 class="fw-bold mb-3 news-title"><?= esc($news['title']) ?></h3>
                            <p class="mb-4 news-excerpt"><?= esc($news['excerpt']) ?></p>
                            <a href="<?= base_url('berita/' . $news['id']) ?>"
                                class="link-primary fw-semibold text-decoration-none">
                                Baca Selengkapnya <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
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
                    <a href="<?= base_url('galeri/foto/' . $photo['id']) ?>" class="gallery-item">
                        <img src="<?= esc($photo['image']) ?>" alt="<?= esc($photo['title']) ?>" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <div class="gallery-category"><?= esc($photo['category']) ?></div>
                                <p class="gallery-title"><?= esc($photo['title']) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
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
                    <a href="#" class="video-card js-video-trigger" data-youtube-id="<?= esc($video['youtube_id']) ?>"
                        data-video-title="<?= esc($video['title']) ?>">
                        <div class="video-thumb-wrap">
                            <img src="<?= esc('https://img.youtube.com/vi/' . $video['youtube_id'] . '/hqdefault.jpg') ?>"
                                alt="<?= esc($video['title']) ?>" class="video-thumb">
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
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="modal fade video-modal" id="videoPlayerModal" tabindex="-1" aria-labelledby="videoPlayerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white" id="videoPlayerModalLabel">Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="ratio ratio-16x9">
                    <iframe id="youtubePlayerFrame" src="" title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const videoModalEl = document.getElementById('videoPlayerModal');
        const playerFrame = document.getElementById('youtubePlayerFrame');
        const modalTitle = document.getElementById('videoPlayerModalLabel');
        const triggers = document.querySelectorAll('.js-video-trigger');

        if (!videoModalEl || !playerFrame || !modalTitle || !triggers.length || typeof bootstrap === 'undefined') {
            return;
        }

        const videoModal = new bootstrap.Modal(videoModalEl);

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function (event) {
                event.preventDefault();

                const youtubeId = trigger.getAttribute('data-youtube-id');
                const videoTitle = trigger.getAttribute('data-video-title') || 'Video';

                if (!youtubeId) {
                    return;
                }

                modalTitle.textContent = videoTitle;
                playerFrame.src = 'https://www.youtube.com/embed/' + encodeURIComponent(youtubeId) + '?autoplay=1&rel=0';
                videoModal.show();
            });
        });

        videoModalEl.addEventListener('hidden.bs.modal', function () {
            playerFrame.src = '';
            modalTitle.textContent = 'Video';
        });
    });
</script>
<?= $this->endSection() ?>