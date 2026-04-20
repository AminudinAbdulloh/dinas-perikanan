<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Konten Kebijakan Privasi<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kebijakan Privasi</li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1">Konten Kebijakan Privasi</h1>
    <p class="text-secondary mb-0">
        Halaman pengelolaan konten untuk
        <a href="<?= base_url('kebijakan-privasi') ?>" target="_blank" rel="noopener noreferrer">kebijakan-privasi</a>.
        Klik tombol Edit untuk masuk ke form editor.
    </p>
</div>

<?php if (session()->has('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="h5 fw-bold mb-1">Kebijakan Privasi</h2>
                <p class="text-secondary mb-0 small">Aturan mengenai pengumpulan dan perlindungan data pengguna</p>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-primary rounded-3 px-4" href="<?= base_url('admin/konten/kebijakan-privasi/edit') ?>">
                    <i class="bi bi-pencil-square me-1"></i>Edit Konten
                </a>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('kebijakan-privasi') ?>" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di situs
                </a>
            </div>
        </div>

        <div class="small text-secondary mb-3">
            <?php if (($policy['updated_at'] ?? '') !== '') : ?>
                Terakhir diperbarui: <?= esc((string) $policy['updated_at']) ?>
            <?php else : ?>
                Konten masih kosong.
            <?php endif; ?>
        </div>

        <div class="admin-preview-prose border rounded-4 p-3 p-lg-4 bg-body-tertiary">
            <?php if (($isHtmlBody ?? false) && trim((string) ($previewBody ?? '')) !== '') : ?>
                <?= $previewBody ?>
            <?php elseif (trim((string) ($policy['content'] ?? '')) !== '') : ?>
                <?php
                $text = trim((string) ($policy['content'] ?? ''));
                $paragraphs = preg_split("/\R{2,}/", $text) ?: [];
                ?>
                <?php foreach ($paragraphs as $paragraph) : ?>
                    <p><?= esc((string) $paragraph) ?></p>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-file-earmark-text display-4 mb-3 opacity-50"></i>
                    <p class="mb-0">Konten kebijakan privasi belum diisi.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
