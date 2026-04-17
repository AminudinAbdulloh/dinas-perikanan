<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?>Galeri Foto - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

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
                <div class="row g-3 g-md-4">
                    <?php foreach ($galleryPhotos as $photo): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="#" class="gallery-item">
                                <img src="<?= esc($photo['image']) ?>" alt="<?= esc($photo['title']) ?>" class="gallery-image">
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
        </div>
    </section>
</div>
<?= $this->endSection() ?>
