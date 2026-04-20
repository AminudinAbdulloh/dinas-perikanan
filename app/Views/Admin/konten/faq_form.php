<?php

declare(strict_types=1);

/** @var array<string, mixed>|null $faq */
$f = $faq ?? [];
$isEdit = $faq !== null;
?>

<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit FAQ' : 'Tambah FAQ' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/faq') ?>">FAQ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit FAQ' : 'Tambah FAQ Baru' ?></h1>
    <p class="text-secondary mb-0">
        <?= $isEdit ? 'Perbarui pertanyaan dan jawaban FAQ.' : 'Tambahkan pertanyaan dan jawaban baru ke halaman FAQ.' ?>
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
                <label for="question" class="form-label fw-semibold">Pertanyaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg rounded-3" id="question" name="question" required
                    maxlength="500" placeholder="Contoh: Bagaimana cara mengurus izin usaha perikanan?"
                    value="<?= esc(old('question', (string) ($f['question'] ?? ''))) ?>">
                <div class="form-text">Maksimal 500 karakter.</div>
            </div>

            <div class="mb-4">
                <label for="answer" class="form-label fw-semibold">Jawaban <span class="text-danger">*</span></label>
                <textarea class="form-control rounded-3" id="answer" name="answer" rows="6" required
                    maxlength="10000" placeholder="Tuliskan jawaban yang jelas dan informatif…"><?= esc(old('answer', (string) ($f['answer'] ?? ''))) ?></textarea>
                <div class="form-text">Mendukung teks biasa. Maksimal 10.000 karakter.</div>
            </div>

            <div class="row g-3 mb-4">
                <?php if ($isEdit) : ?>
                    <div class="col-sm-6 col-md-4">
                        <label for="sort_order" class="form-label fw-semibold">Urutan</label>
                        <input type="number" class="form-control rounded-3" id="sort_order" name="sort_order"
                            min="0" value="<?= esc(old('sort_order', (string) ($f['sort_order'] ?? '0'))) ?>">
                        <div class="form-text">Angka lebih kecil = tampil lebih atas.</div>
                    </div>
                <?php endif; ?>
                <div class="col-sm-6 col-md-4">
                    <label class="form-label fw-semibold d-block">Status</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1"
                            <?= old('is_active', (string) ($f['is_active'] ?? '1')) === '1' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Tampilkan di situs publik</label>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/faq') ?>">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
