<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?><?= esc($photo['title']) ?> - Galeri Foto<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/beranda.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper galeri-foto-detail-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content">
        <div class="container px-sm-5 px-lg-0">
            <div class="content-card galeri-foto-detail-card">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-8">
                        <article class="photo-detail-article">
                            <div class="photo-detail-meta mb-3">
                                <span><i class="bi bi-calendar-event me-1"></i><?= esc($photo['date']) ?></span>
                            </div>

                            <div class="photo-detail-image">
                                <img src="<?= esc($photo['image']) ?>" alt="<?= esc($photo['title']) ?>">
                            </div>

                            <div class="photo-detail-caption mt-3">
                                <h2><?= esc($photo['title']) ?></h2>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-4">
                        <aside class="photo-related-box">
                            <h3 class="photo-related-title"><i class="bi bi-images me-2"></i>Foto Lainnya</h3>
                            <div class="photo-related-list">
                                <?php foreach ($relatedPhotos as $relatedPhoto): ?>
                                    <a href="<?= base_url('galeri/foto/' . (int) $relatedPhoto['id']) ?>"
                                        class="photo-related-item">
                                        <img src="<?= esc($relatedPhoto['image']) ?>"
                                            alt="<?= esc($relatedPhoto['title']) ?>">
                                        <div>
                                            <h4><?= esc($relatedPhoto['title']) ?></h4>
                                            <p class="mb-0"><i
                                                    class="bi bi-calendar-event me-1"></i><?= esc($relatedPhoto['date']) ?>
                                            </p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <a href="<?= base_url('galeri/foto') ?>" class="photo-related-all-link">Kembali ke Galeri
                                Foto <i class="bi bi-arrow-right"></i></a>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>