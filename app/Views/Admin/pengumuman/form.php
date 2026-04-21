<?php

declare(strict_types=1);

/** @var array<string, mixed>|null $pengumuman */
$p = $pengumuman ?? [];
$isEdit = $pengumuman !== null;
?>

<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit Pengumuman' : 'Tambah Pengumuman' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pengumuman') ?>">Pengumuman</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit Pengumuman' : 'Tambah Pengumuman Baru' ?></h1>
    <p class="text-secondary mb-0">
        <?= $isEdit ? 'Perbarui informasi dan berkas pengumuman.' : 'Tambahkan pengumuman baru untuk ditampilkan di website.' ?>
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
        <form method="post" action="<?= esc($formAction, 'attr') ?>" enctype="multipart/form-data" novalidate>
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="judul" class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg rounded-3" id="judul" name="judul" required
                    maxlength="255" placeholder="Contoh: Pengumuman Surat Edaran..."
                    value="<?= esc(old('judul', (string) ($p['judul'] ?? ''))) ?>">
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control rounded-3" id="deskripsi" name="deskripsi" rows="6" required
                    placeholder="Tuliskan detail pengumuman..."><?= esc(old('deskripsi', (string) ($p['deskripsi'] ?? ''))) ?></textarea>
            </div>

            <div class="mb-4">
                <label for="berkas" class="form-label fw-semibold">Berkas Dokumen</label>
                <input type="file" class="form-control rounded-3" id="berkas" name="berkas" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                <div class="form-text">Mendukung PDF, DOC, DOCX, JPG, PNG. Maksimal 5MB. Biarkan kosong jika tidak ingin mengubah berkas.</div>
                <?php if ($isEdit && !empty($p['berkas'])): ?>
                    <div class="mt-2">
                        <a href="<?= base_url('uploads/pengumuman/' . $p['berkas']) ?>" target="_blank" class="badge bg-info-subtle text-info text-decoration-none rounded-pill">Lihat Berkas Saat Ini</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/pengumuman') ?>">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
