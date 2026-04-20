<?php
$v = $item ?? [];
$isEdit = $item !== null;
?>

<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit Kategori Publikasi' : 'Tambah Kategori Publikasi' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/kategori-publikasi') ?>">Kategori Publikasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit Kategori Publikasi' : 'Tambah Kategori Publikasi' ?></h1>
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
                <label for="name" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg rounded-3" id="name" name="name" required
                    maxlength="255" value="<?= esc(old('name', (string) ($v['name'] ?? ''))) ?>"
                    placeholder="Contoh: Laporan Kinerja">
            </div>

            <div class="mb-4">
                <label for="publication_type" class="form-label fw-semibold">Kategori Publikasi Induk <span class="text-danger">*</span></label>
                <select class="form-select rounded-3" id="publication_type" name="publication_type" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($typeLabels as $slug => $label) : ?>
                        <option value="<?= esc($slug) ?>"
                            <?= old('publication_type', (string) ($v['publication_type'] ?? '')) === $slug ? 'selected' : '' ?>>
                            <?= esc($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="sort_order" class="form-label fw-semibold">Urutan</label>
                <input type="number" class="form-control rounded-3" id="sort_order" name="sort_order"
                    value="<?= esc(old('sort_order', (string) ($v['sort_order'] ?? '0'))) ?>" min="0">
                <div class="form-text">Angka lebih kecil ditampilkan lebih dulu.</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/kategori-publikasi') ?>">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
