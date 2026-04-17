<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?><?= esc($news['title']) ?> - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/beranda.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper berita-detail-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content">
        <div class="container px-sm-5 px-lg-0">
            <div class="content-card berita-detail-card">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-8">
                        <article class="detail-article">
                            <div class="detail-header mb-4">
                                <div class="detail-meta d-flex flex-wrap align-items-center gap-3 mt-3">
                                    <span><i class="bi bi-calendar-event me-1"></i><?= esc($news['date']) ?></span>
                                    <span><i class="bi bi-person me-1"></i><?= esc($news['author'] ?? 'Admin') ?></span>
                                    <span><i class="bi bi-eye me-1"></i><?= esc($news['views'] ?? '0') ?> views</span>
                                    <span><i class="bi bi-clock me-1"></i><?= esc($news['readTime'] ?? '0 min') ?> read</span>
                                </div>
                            </div>

                            <div class="detail-share mb-4">
                                <span class="fw-semibold me-2">Bagikan:</span>
                                <?php
                                $shareUrl = urlencode(current_url());
                                $shareTitle = urlencode((string) ($news['title'] ?? ''));
                                ?>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>&text=<?= $shareTitle ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $shareUrl ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="https://wa.me/?text=<?= $shareTitle . '%20' . $shareUrl ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="mailto:?subject=<?= $shareTitle ?>&body=<?= $shareUrl ?>" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>

                            <div class="detail-featured-image mb-4">
                                <img src="<?= esc($news['image']) ?>" alt="<?= esc($news['title']) ?>">
                            </div>

                            <div class="detail-content">
                                <?= $news['content'] ?? '' ?>
                            </div>

                            <?php if (!empty($news['tags']) && is_array($news['tags'])): ?>
                                <div class="detail-tags mt-4 pt-4 border-top">
                                    <span class="fw-semibold me-2">Tags:</span>
                                    <?php foreach ($news['tags'] as $tag): ?>
                                        <span class="badge rounded-pill text-bg-light border"><?= esc((string) $tag) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    </div>

                    <div class="col-lg-4">
                        <aside class="popular-news-box">
                            <h3 class="popular-title"><i class="bi bi-graph-up-arrow me-2"></i>Berita Terpopuler</h3>
                            <div class="popular-list">
                                <?php foreach ($popularNews as $article): ?>
                                    <a href="<?= base_url('berita/' . (int) $article['id']) ?>" class="popular-item">
                                        <img src="<?= esc($article['image']) ?>" alt="<?= esc($article['title']) ?>">
                                        <div>
                                            <h4><?= esc($article['title']) ?></h4>
                                            <p class="mb-1"><i class="bi bi-calendar-event me-1"></i><?= esc($article['date']) ?></p>
                                            <p class="mb-0"><i class="bi bi-eye me-1"></i><?= esc($article['views']) ?></p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <a href="<?= base_url('berita') ?>" class="popular-all-link">Lihat Semua Berita <i class="bi bi-arrow-right"></i></a>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
