<?= $this->extend('layouts/template_admin') ?>

<?php
$isEdit = isset($item);
?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit Kategori Publikasi' : 'Tambah Kategori Publikasi' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/tipe-publikasi') ?>">Kategori Publikasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit Kategori Publikasi' : 'Tambah Kategori Publikasi' ?></h1>
    <p class="text-secondary mb-0">
        Isi form di bawah untuk <?= $isEdit ? 'mengubah' : 'menambahkan' ?> kategori publikasi utama.
    </p>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 p-md-5">
        <?= form_open($formAction) ?>
        <div class="row g-4">
            <div class="col-md-8">
                <label for="name" class="form-label fw-semibold">Nama Kategori Publikasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" name="name"
                    value="<?= old('name', $item['name'] ?? '') ?>" required placeholder="Contoh: Perencanaan">
                <?php if (session('errors.name')) : ?>
                    <div class="invalid-feedback"><?= session('errors.name') ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <label for="sort_order" class="form-label fw-semibold">Urutan</label>
                <input type="number" class="form-control rounded-3 <?= session('errors.sort_order') ? 'is-invalid' : '' ?>" id="sort_order" name="sort_order"
                    value="<?= old('sort_order', $item['sort_order'] ?? 0) ?>">
                <div class="form-text">Urutan tampil di menu navigasi. Angka lebih kecil tampil lebih dulu.</div>
            </div>

            <div class="col-12 mt-5">
                <hr class="mt-0 mb-4 border-secondary-subtle">
                <button type="submit" class="btn btn-primary rounded-3 px-4 me-2">
                    <i class="bi bi-save me-1"></i> Simpan Kategori
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/tipe-publikasi') ?>">Kembali</a>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endSection() ?>
