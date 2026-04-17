<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?>Galeri Video - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/beranda.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content">
        <div class="container px-sm-5 px-lg-0">
            <div class="content-card">
                <div class="row g-4 g-lg-5">
                    <?php foreach ($latestVideos as $video): ?>
                        <div class="col-md-6 col-lg-4">
                            <a href="<?= esc($video['youtube_url']) ?>" target="_blank" rel="noopener noreferrer" class="video-card">
                                <div class="video-thumb-wrap">
                                    <img src="https://img.youtube.com/vi/<?= esc($video['youtube_id']) ?>/hqdefault.jpg"
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
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
