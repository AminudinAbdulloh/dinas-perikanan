<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Dashboard Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <h1 class="h3 fw-bold text-body mb-1">Dashboard</h1>
    <p class="text-secondary mb-0">
        Ringkasan layanan PPID dan konten publik.
        Anda masuk sebagai <strong><?= esc(session('admin_email') ?? '') ?></strong>.
    </p>
</div>

<!-- Stats Cards Row 1: PPID -->
<div class="row g-3 g-xl-4 mb-3">
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 4px solid #0d6efd !important;">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3" style="background: rgba(13,110,253,.12);">
                    <i class="bi bi-envelope-paper fs-4 text-primary"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Permohonan Masuk</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['permohonan_masuk'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Total permohonan informasi</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 4px solid #dc3545 !important;">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3" style="background: rgba(220,53,69,.12);">
                    <i class="bi bi-exclamation-triangle fs-4 text-danger"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Keberatan Aktif</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['keberatan_aktif'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Perlu tindak lanjut segera</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 4px solid #198754 !important;">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3" style="background: rgba(25,135,84,.12);">
                    <i class="bi bi-calendar-check fs-4 text-success"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Total Permohonan Bulan Ini</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['permohonan_bulan_ini'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1"><?= date('F Y') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards Row 2: Konten -->
<div class="row g-3 g-xl-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3 text-primary">
                    <i class="bi bi-newspaper fs-4"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Total Berita</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['berita'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Artikel dipublikasikan</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3 text-primary">
                    <i class="bi bi-images fs-4"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Total Galeri Foto</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['galeri_foto'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Album kegiatan tersedia</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3 text-primary">
                    <i class="bi bi-camera-video fs-4"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Total Galeri Video</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['galeri_video'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Video kegiatan terdaftar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Aktivitas Terbaru -->
    <div class="col-xl-7">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h5 fw-bold mb-0">
                        <i class="bi bi-activity text-primary me-2 fs-6"></i>Aktivitas Terbaru
                    </h2>
                    <p class="small text-secondary mb-0 mt-1">Konten yang baru ditambahkan atau diperbarui.</p>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-3">
                <?php if (empty($aktivitasTerbaru)) : ?>
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-secondary fs-1 d-block mb-2"></i>
                        <p class="text-secondary small mb-0">Belum ada aktivitas konten.</p>
                    </div>
                <?php else : ?>
                    <ul class="list-unstyled mb-0 dashboard-activity-feed">
                        <?php foreach ($aktivitasTerbaru as $item) : ?>
                            <li class="d-flex gap-3 pb-3 mb-3 border-bottom border-light-subtle">
                                <span class="dashboard-activity-icon rounded-3 d-inline-flex align-items-center justify-content-center flex-shrink-0"
                                      style="background:<?= esc($item['color_bg']) ?>; color:<?= esc($item['color']) ?>; width:38px; height:38px;">
                                    <i class="bi <?= esc($item['icon']) ?> fs-6"></i>
                                </span>
                                <div class="min-w-0 flex-grow-1 overflow-hidden">
                                    <p class="fw-semibold mb-0 text-truncate small"><?= esc($item['title']) ?></p>
                                    <p class="mb-0 small text-secondary">
                                        <span class="badge rounded-pill" style="background:<?= esc($item['color_bg']) ?>; color:<?= esc($item['color']) ?>; font-weight:600;"><?= esc($item['type_label']) ?></span>
                                        &nbsp;<?= esc($item['time_label']) ?>
                                    </p>
                                </div>
                                <?php if (!empty($item['url'])) : ?>
                                    <a href="<?= esc($item['url'], 'attr') ?>" class="btn btn-sm btn-outline-secondary rounded-3 py-0 px-2 flex-shrink-0 align-self-center">Lihat</a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Antrian Perlu Ditindak -->
    <div class="col-xl-5">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between gap-2">
                <div>
                    <h2 class="h5 fw-bold mb-0">
                        <i class="bi bi-bell-fill text-warning me-2 fs-6"></i>Antrian Perlu Ditindak
                    </h2>
                    <p class="small text-secondary mb-0 mt-1">Permohonan & keberatan yang belum selesai.</p>
                </div>
            </div>
            <div class="card-body p-4">

                <?php if (empty($antrianPermohonan) && empty($antrianKeberatan)) : ?>
                    <div class="text-center py-4">
                        <i class="bi bi-check-circle text-success fs-1 d-block mb-2"></i>
                        <p class="text-secondary small mb-0">Tidak ada antrian yang perlu ditindak.</p>
                    </div>
                <?php else : ?>

                    <?php if (!empty($antrianPermohonan)) : ?>
                        <p class="fw-semibold small text-uppercase text-secondary mb-2 mt-1">Permohonan Informasi</p>
                        <ul class="list-unstyled mb-3">
                            <?php foreach ($antrianPermohonan as $item) : ?>
                                <li class="d-flex align-items-center gap-2 py-2 border-bottom border-light-subtle">
                                    <span class="badge <?= \App\Models\InformationRequestModel::statusBadgeClass($item['status']) ?> rounded-pill flex-shrink-0">
                                        <?= esc(\App\Models\InformationRequestModel::statusLabel($item['status'])) ?>
                                    </span>
                                    <span class="small text-truncate flex-grow-1"><?= esc($item['registration_number']) ?> &mdash; <?= esc($item['name']) ?></span>
                                    <a href="<?= base_url('admin/konten/permohonan-informasi/' . (int)$item['id']) ?>"
                                        class="btn btn-sm btn-outline-primary rounded-3 flex-shrink-0 py-0 px-2">
                                        Tindak
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if (!empty($antrianKeberatan)) : ?>
                        <p class="fw-semibold small text-uppercase text-secondary mb-2 mt-1">Keberatan Informasi</p>
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($antrianKeberatan as $item) : ?>
                                <li class="d-flex align-items-center gap-2 py-2 border-bottom border-light-subtle">
                                    <span class="badge <?= \App\Models\InformationObjectionModel::statusBadgeClass($item['status']) ?> rounded-pill flex-shrink-0">
                                        <?= esc(\App\Models\InformationObjectionModel::statusLabel($item['status'])) ?>
                                    </span>
                                    <span class="small text-truncate flex-grow-1"><?= esc($item['registration_number']) ?> &mdash; <?= esc($item['name']) ?></span>
                                    <a href="<?= base_url('admin/konten/keberatan-informasi/' . (int)$item['id']) ?>"
                                        class="btn btn-sm btn-outline-danger rounded-3 flex-shrink-0 py-0 px-2">
                                        Tindak
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
