<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>FAQ<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4 d-flex flex-wrap align-items-start justify-content-between gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold text-body mb-1">FAQ (Pertanyaan yang Sering Diajukan)</h1>
        <p class="text-secondary mb-0">
            Kelola daftar pertanyaan dan jawaban yang tampil di halaman FAQ situs publik.
        </p>
    </div>
    <a class="btn btn-primary rounded-3" href="<?= base_url('admin/konten/faq/tambah') ?>">
        <i class="bi bi-plus-lg me-1"></i>Tambah FAQ
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 60px;">Urutan</th>
                        <th>Pertanyaan</th>
                        <th class="d-none d-md-table-cell" style="width: 120px;">Status</th>
                        <th class="d-none d-md-table-cell" style="width: 140px;">Diperbarui</th>
                        <th class="pe-4 text-end" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (($faqs ?? []) === []) : ?>
                        <tr>
                            <td colspan="5" class="px-4 py-5 text-center text-secondary">
                                Belum ada FAQ. <a href="<?= base_url('admin/konten/faq/tambah') ?>">Tambah FAQ pertama</a>.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($faqs as $row) : ?>
                            <?php
                            $isActive = ((int) ($row['is_active'] ?? 1)) === 1;
                            $updatedAt = (string) ($row['updated_at'] ?? '');
                            $dateLabel = '';
                            if ($updatedAt !== '' && preg_match('/^(\d{4})-(\d{2})-(\d{2})/', $updatedAt, $m)) {
                                $dateLabel = $m[3] . '/' . $m[2] . '/' . $m[1];
                            }
                            ?>
                            <tr>
                                <td class="ps-4 text-center">
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill"><?= (int) ($row['sort_order'] ?? 0) ?></span>
                                </td>
                                <td>
                                    <span class="fw-medium"><?= esc((string) ($row['question'] ?? '')) ?></span>
                                    <div class="small text-secondary text-truncate d-md-none" style="max-width: 260px;">
                                        <?= esc(mb_substr(strip_tags((string) ($row['answer'] ?? '')), 0, 80)) ?>…
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php if ($isActive) : ?>
                                        <span class="badge bg-success-subtle text-success rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i>Aktif
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-warning-subtle text-warning rounded-pill">
                                            <i class="bi bi-eye-slash me-1"></i>Nonaktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-none d-md-table-cell text-secondary small"><?= esc($dateLabel) ?></td>
                                <td class="pe-4 text-end text-nowrap">
                                    <a class="btn btn-sm btn-outline-primary rounded-3"
                                        href="<?= base_url('admin/konten/faq/' . (int) $row['id'] . '/edit') ?>">Edit</a>
                                    <form method="post" action="<?= base_url('admin/konten/faq/' . (int) $row['id'] . '/hapus') ?>"
                                        class="d-inline" onsubmit="return confirm('Hapus FAQ ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
