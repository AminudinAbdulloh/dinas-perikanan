<?php

declare(strict_types=1);

/** @var array<string, mixed>|null $video */
$v = $video ?? [];
$isEdit = $video !== null;
$youtubeDefault = old('youtube_input', $isEdit ? (string) ($v['youtube_url'] ?? '') : '');
?>

<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit Video' : 'Tambah Video' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/galeri-video') ?>">Galeri Video</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit Video Galeri' : 'Tambah Video Galeri' ?></h1>
    <p class="text-secondary mb-0">
        Tempel tautan YouTube (watch, youtu.be, shorts, embed) atau ID video 11 karakter. Tanggal di situs mengikuti waktu entri pertama dibuat.
    </p>
</div>

<?php
$errs = session()->getFlashdata('errors');
if (is_array($errs) && $errs !== []) { ?>
    <div class="alert alert-danger rounded-3">
        <ul class="mb-0 ps-3">
            <?php foreach ($errs as $err) { ?>
                <li><?= esc(is_string($err) ? $err : (string) $err) ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">
        <form method="post" action="<?= esc($formAction, 'attr') ?>" novalidate>
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Judul</label>
                <input type="text" class="form-control form-control-lg rounded-3" id="title" name="title" required
                    maxlength="255" value="<?= esc(old('title', (string) ($v['title'] ?? ''))) ?>">
            </div>

            <div class="mb-4">
                <label for="youtube_input" class="form-label fw-semibold">Tautan atau ID YouTube</label>
                <textarea class="form-control rounded-3 font-monospace" id="youtube_input" name="youtube_input" rows="2" required maxlength="512"
                    placeholder="https://www.youtube.com/watch?v=..."><?= esc($youtubeDefault) ?></textarea>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/galeri-video') ?>">Kembali</a>
                <?php if ($isEdit && ($v['youtube_url'] ?? '') !== '') : ?>
                    <a class="btn btn-outline-secondary rounded-3" href="<?= esc((string) $v['youtube_url'], 'attr') ?>"
                        target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka di YouTube
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
