<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Detail Permohonan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$status = (string) ($item['status'] ?? 'diterima');
$badgeClass = \App\Models\InformationRequestModel::statusBadgeClass($status);
$statusLabel = \App\Models\InformationRequestModel::statusLabel($status);
$dateLabel = \App\Models\InformationRequestModel::displayDateFromRow($item);
?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/permohonan-informasi') ?>">Permohonan Informasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1">Permohonan <?= esc((string) ($item['registration_number'] ?? '')) ?></h1>
    <p class="text-secondary mb-0">
        Diajukan pada <?= esc($dateLabel) ?> · Status: <span class="badge rounded-pill <?= esc($badgeClass) ?>"><?= esc($statusLabel) ?></span>
    </p>
</div>

<div class="row g-4">
    <!-- Detail Data -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold mb-4">Data Pemohon</h2>

                <div class="row g-3 mb-4">
                    <div class="col-sm-4 text-secondary small">Kategori Pemohon</div>
                    <div class="col-sm-8 fw-medium"><?= esc((string) ($item['applicant_category'] ?? '')) ?></div>

                    <div class="col-sm-4 text-secondary small">Nama</div>
                    <div class="col-sm-8 fw-medium"><?= esc((string) ($item['name'] ?? '')) ?></div>

                    <div class="col-sm-4 text-secondary small">Pekerjaan</div>
                    <div class="col-sm-8"><?= esc((string) ($item['occupation'] ?? '')) ?></div>

                    <div class="col-sm-4 text-secondary small">Alamat</div>
                    <div class="col-sm-8"><?= nl2br(esc((string) ($item['address'] ?? ''))) ?></div>

                    <div class="col-sm-4 text-secondary small">Identitas</div>
                    <div class="col-sm-8"><?= esc((string) ($item['identity_type'] ?? '')) ?> — <?= esc((string) ($item['identity_number'] ?? '')) ?></div>

                    <div class="col-sm-4 text-secondary small">Telepon</div>
                    <div class="col-sm-8"><?= esc((string) ($item['phone'] ?? '')) ?></div>

                    <div class="col-sm-4 text-secondary small">Email</div>
                    <div class="col-sm-8"><a href="mailto:<?= esc((string) ($item['email'] ?? ''), 'attr') ?>"><?= esc((string) ($item['email'] ?? '')) ?></a></div>
                </div>

                <h2 class="h5 fw-bold mb-3">Detail Permohonan</h2>

                <div class="row g-3">
                    <div class="col-sm-4 text-secondary small">Rincian Informasi</div>
                    <div class="col-sm-8"><?= nl2br(esc((string) ($item['information_detail'] ?? ''))) ?></div>

                    <div class="col-sm-4 text-secondary small">Tujuan Penggunaan</div>
                    <div class="col-sm-8"><?= nl2br(esc((string) ($item['information_purpose'] ?? ''))) ?></div>

                    <div class="col-sm-4 text-secondary small">Cara Mendapatkan</div>
                    <div class="col-sm-8"><?= esc((string) ($item['obtain_method'] ?? '')) ?></div>

                    <div class="col-sm-4 text-secondary small">Cara Salinan</div>
                    <div class="col-sm-8"><?= esc((string) ($item['copy_method'] ?? '')) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold mb-3">Perbarui Status</h2>

                <form method="post" action="<?= base_url('admin/konten/permohonan-informasi/' . (int) $item['id'] . '/status') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold small">Status</label>
                        <select class="form-select rounded-3" id="status" name="status">
                            <?php foreach ($statuses as $slug => $label) : ?>
                                <option value="<?= esc($slug) ?>" <?= $status === $slug ? 'selected' : '' ?>><?= esc($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="admin_notes" class="form-label fw-semibold small">Catatan Admin</label>
                        <textarea class="form-control rounded-3" id="admin_notes" name="admin_notes" rows="4"
                            placeholder="Opsional: tambahkan catatan internal..."><?= esc((string) ($item['admin_notes'] ?? '')) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-3 w-100">
                        <i class="bi bi-check2-circle me-1"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mt-3">
            <div class="card-body p-4">
                <h2 class="h6 fw-bold mb-2 text-danger">Zona Berbahaya</h2>
                <p class="small text-secondary mb-3">Tindakan ini tidak dapat dibatalkan.</p>
                <form method="post" action="<?= base_url('admin/konten/permohonan-informasi/' . (int) $item['id'] . '/hapus') ?>"
                    onsubmit="return confirm('Hapus permohonan ini secara permanen?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline-danger rounded-3 btn-sm">
                        <i class="bi bi-trash me-1"></i>Hapus Permohonan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
