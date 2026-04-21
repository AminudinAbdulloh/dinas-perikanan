<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?><?= esc($pageData['title'] ?? 'Detail Pengumuman') ?> - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/informasi-publik.css') ?>">
<style>
.pengumuman-detail-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.pengumuman-detail-date {
    font-size: 0.95rem;
    color: var(--bs-primary);
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pengumuman-detail-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--bs-dark);
    margin-bottom: 24px;
    line-height: 1.4;
}

.pengumuman-detail-desc {
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 32px;
    font-size: 1.05rem;
}

.pengumuman-detail-section {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid rgba(0,0,0,0.05);
}

.pengumuman-detail-section h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--bs-dark);
    margin-bottom: 16px;
}

@media (max-width: 768px) {
    .pengumuman-detail-card {
        padding: 24px;
    }
    
    .pengumuman-detail-title {
        font-size: 1.5rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content pb-5">
        <div class="container px-sm-5 px-lg-0">
            <!-- Breadcrumb -->
            <div class="info-publik-topbar mb-4">
                <nav class="info-publik-breadcrumb" aria-label="breadcrumb">
                    <?php foreach ($pageData['breadcrumbs'] ?? [] as $idx => $crumb) : ?>
                        <?php if ($idx > 0) : ?>
                            <span class="separator">›</span>
                        <?php endif; ?>
                        <?php if (($crumb['href'] ?? null) !== null && $idx < count($pageData['breadcrumbs']) - 1) : ?>
                            <a href="<?= esc($crumb['href']) ?>"><?= esc(strtoupper($crumb['label'])) ?></a>
                        <?php else : ?>
                            <span class="current"><?= esc(strtoupper($crumb['label'])) ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="pengumuman-detail-card">
                        <?php
                        $createdAt = (string) ($pengumuman['created_at'] ?? '');
                        $dateLabel = '';
                        if ($createdAt !== '' && preg_match('/^(\d{4})-(\d{2})-(\d{2})/', $createdAt, $m)) {
                            $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            $dateLabel = (int)$m[3] . ' ' . $months[(int)$m[2]] . ' ' . $m[1];
                        }
                        ?>
                        
                        <div class="pengumuman-detail-date">
                            <i class="bi bi-calendar3"></i> Dipublikasikan pada <?= esc($dateLabel) ?>
                        </div>
                        
                        <h2 class="pengumuman-detail-title"><?= esc((string) ($pengumuman['judul'] ?? '')) ?></h2>
                        
                        <div class="pengumuman-detail-desc">
                            <?= nl2br(esc((string) ($pengumuman['deskripsi'] ?? ''))) ?>
                        </div>

                        <?php if (!empty($pengumuman['berkas'])) : ?>
                            <div class="pengumuman-detail-section">
                                <h3>Berkas Lampiran</h3>
                                <div class="mt-3">
                                    <a href="<?= base_url('uploads/pengumuman/' . $pengumuman['berkas']) ?>" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 d-inline-flex align-items-center">
                                        <i class="bi bi-download me-2 fs-5"></i>
                                        <span>Unduh Berkas</span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-5 pt-4 border-top">
                            <a href="<?= base_url('pengumuman') ?>" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Pengumuman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
