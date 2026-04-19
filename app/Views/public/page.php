<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?><?= esc($pageData['title'] ?? 'Halaman') ?> - Dinas Kelautan dan Perikanan Papua
Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content">
        <div class="container px-sm-5 px-lg-0">
            <div class="content-card">
                <?php if (($pageData['path'] ?? '') === 'layanan/form-permohonan-informasi'): ?>
                    <?= $this->include('public/partials/form_permohonan_informasi') ?>
                <?php elseif (($pageData['path'] ?? '') === 'layanan/form-keberatan-informasi'): ?>
                    <?= $this->include('public/partials/form_keberatan_informasi') ?>
                <?php else: ?>
                    <?php
                    $contentText = trim((string) ($pageData['content'] ?? ''));
                    $paragraphs = preg_split("/\R{2,}/", $contentText) ?: [];
                    ?>

                    <?php foreach ($paragraphs as $paragraph): ?>
                        <article class="content-section">
                            <p><?= esc($paragraph) ?></p>
                        </article>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>