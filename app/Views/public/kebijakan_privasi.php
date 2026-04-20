<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?><?= esc($pageData['title'] ?? 'Kebijakan Privasi') ?> - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content">
        <div class="container px-sm-5 px-lg-0">
            <div class="content-card">
                <article class="content-section public-page-prose">
                    <?php
                    helper('content');
                    $contentText = trim((string) ($policy['content'] ?? ''));
                    ?>
                    <?php if ($contentText !== '') : ?>
                        <?php if (is_html_string($contentText)) : ?>
                            <?= safe_admin_html($contentText) ?>
                        <?php else : ?>
                            <?php $paragraphs = preg_split("/\R{2,}/", $contentText) ?: []; ?>
                            <?php foreach ($paragraphs as $paragraph) : ?>
                                <p><?= esc($paragraph) ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-text display-4 mb-3 opacity-50"></i>
                            <p class="mb-0">Konten kebijakan privasi belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
