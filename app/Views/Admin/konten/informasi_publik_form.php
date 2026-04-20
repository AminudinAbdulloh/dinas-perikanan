<?php

declare(strict_types=1);

/** @var array<string, mixed>|null $item */
$v = $item ?? [];
$isEdit = $item !== null;
?>

<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit Informasi Publik' : 'Tambah Informasi Publik' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/informasi-publik') ?>">Informasi Publik</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit Informasi Publik' : 'Tambah Informasi Publik' ?></h1>
    <p class="text-secondary mb-0">
        Isi data informasi publik. Untuk kategori selain "Dikecualikan", pilih juga kategori dan sub-kategori publikasi.
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

            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="title" name="title" required
                            maxlength="500" value="<?= esc(old('title', (string) ($v['title'] ?? ''))) ?>"
                            placeholder="Contoh: Laporan Kinerja Tahun 2024">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Deskripsi / Ringkasan</label>
                        <textarea class="form-control rounded-3" id="description" name="description" rows="4" maxlength="5000"
                            placeholder="Deskripsi singkat isi informasi"><?= esc(old('description', (string) ($v['description'] ?? ''))) ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="document" class="form-label fw-semibold">Berkas Dokumen</label>
                        <?php if ($isEdit && trim((string) ($v['file_path'] ?? '')) !== '') : ?>
                            <div class="mb-2">
                                <a href="<?= base_url($v['file_path']) ?>" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary rounded-3">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i><?= esc((string) ($v['file_name'] ?? 'Lihat berkas')) ?>
                                </a>
                                <input type="hidden" name="current_file" value="<?= esc((string) $v['file_path']) ?>">
                                <input type="hidden" name="current_file_name" value="<?= esc((string) ($v['file_name'] ?? '')) ?>">
                            </div>
                            <small class="text-secondary d-block mb-2">Unggah file baru untuk mengganti berkas saat ini.</small>
                        <?php endif; ?>
                        <input type="file" class="form-control rounded-3" id="document" name="document"
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.webp,.zip,.rar">
                        <div class="form-text">Maks. 25 MB. Format: PDF, DOC, XLS, PPT, gambar, ZIP/RAR.</div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <div class="card bg-body-tertiary border-0 rounded-3 p-3 mb-3">
                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">Kategori Informasi <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="category" name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $slug => $label) : ?>
                                    <option value="<?= esc($slug) ?>"
                                        <?= old('category', (string) ($v['category'] ?? '')) === $slug ? 'selected' : '' ?>>
                                        <?= esc($label) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Publication fields (hidden when dikecualikan) -->
                        <div id="publication-fields">
                            <div class="mb-3">
                                <label for="publication_type" class="form-label fw-semibold">Kategori Publikasi</label>
                                <select class="form-select rounded-3" id="publication_type" name="publication_type">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($pubTypeLabels as $slug => $label) : ?>
                                        <option value="<?= esc($slug) ?>"
                                            <?= old('publication_type', (string) ($v['publication_type'] ?? '')) === $slug ? 'selected' : '' ?>>
                                            <?= esc($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="publication_category_id" class="form-label fw-semibold">Sub-Kategori Publikasi</label>
                                <select class="form-select rounded-3" id="publication_category_id" name="publication_category_id">
                                    <option value="">-- Pilih --</option>
                                    <?php
                                    $currentPubCat = (int) old('publication_category_id', (string) ($v['publication_category_id'] ?? ''));
                                    foreach ($pubCategories as $pc) : ?>
                                        <option value="<?= (int) $pc['id'] ?>"
                                            data-type="<?= esc((string) ($pc['publication_type'] ?? '')) ?>"
                                            <?= $currentPubCat === (int) $pc['id'] ? 'selected' : '' ?>>
                                            <?= esc((string) ($pc['name'] ?? '')) ?>
                                            (<?= esc(\App\Models\PublicationCategoryModel::publicationTypeLabel((string) ($pc['publication_type'] ?? ''))) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label fw-semibold">Tahun</label>
                            <input type="number" class="form-control rounded-3" id="year" name="year"
                                min="1900" max="2099" value="<?= esc(old('year', (string) ($v['year'] ?? ''))) ?>"
                                placeholder="<?= date('Y') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="responsible_party" class="form-label fw-semibold">Penanggung Jawab</label>
                            <input type="text" class="form-control rounded-3" id="responsible_party" name="responsible_party"
                                maxlength="255" value="<?= esc(old('responsible_party', (string) ($v['responsible_party'] ?? ''))) ?>"
                                placeholder="Contoh: Sekretariat">
                        </div>

                        <div class="mb-3">
                            <label for="time_period" class="form-label fw-semibold">Jangka Waktu</label>
                            <input type="text" class="form-control rounded-3" id="time_period" name="time_period"
                                maxlength="100" value="<?= esc(old('time_period', (string) ($v['time_period'] ?? ''))) ?>"
                                placeholder="Contoh: Setiap tahun">
                        </div>

                        <div class="mb-3">
                            <label for="information_format" class="form-label fw-semibold">Bentuk Informasi</label>
                            <input type="text" class="form-control rounded-3" id="information_format" name="information_format"
                                maxlength="100" value="<?= esc(old('information_format', (string) ($v['information_format'] ?? ''))) ?>"
                                placeholder="Contoh: Softfile / Cetak">
                        </div>

                        <div>
                            <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3" id="status" name="status" required>
                                <?php
                                $currentStatus = old('status', ($isEdit && (int) ($v['is_published'] ?? 0) === 1) ? 'publish' : 'draft');
                                ?>
                                <option value="draft" <?= $currentStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option value="publish" <?= $currentStatus === 'publish' ? 'selected' : '' ?>>Terbit</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/informasi-publik') ?>">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    const pubFields = document.getElementById('publication-fields');
    const pubTypeSelect = document.getElementById('publication_type');
    const pubCatSelect = document.getElementById('publication_category_id');

    function togglePubFields() {
        const isDikecualikan = categorySelect.value === 'dikecualikan';
        pubFields.style.display = isDikecualikan ? 'none' : 'block';
        if (isDikecualikan) {
            pubTypeSelect.value = '';
            pubCatSelect.value = '';
        }
    }

    function filterPubCategories() {
        const selectedType = pubTypeSelect.value;
        const options = pubCatSelect.querySelectorAll('option[data-type]');
        options.forEach(function(opt) {
            if (selectedType === '' || opt.getAttribute('data-type') === selectedType) {
                opt.style.display = '';
            } else {
                opt.style.display = 'none';
                if (opt.selected) opt.selected = false;
            }
        });
    }

    categorySelect.addEventListener('change', togglePubFields);
    pubTypeSelect.addEventListener('change', filterPubCategories);

    togglePubFields();
    filterPubCategories();
});
</script>
<?= $this->endSection() ?>
