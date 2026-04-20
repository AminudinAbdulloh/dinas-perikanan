<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Dashboard Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <h1 class="h3 fw-bold text-body mb-1">Dashboard</h1>
    <p class="text-secondary mb-0">
        Ringkasan konten publik dan akses cepat ke halaman situs.
        Anda masuk sebagai <strong><?= esc(session('admin_email') ?? '') ?></strong>.
    </p>
</div>

<div class="row g-3 g-xl-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card admin-stat-card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4 d-flex align-items-start gap-3">
                <div class="admin-stat-icon rounded-3 text-primary">
                    <i class="bi bi-newspaper fs-4"></i>
                </div>
                <div>
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Berita</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['berita'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Entri di data sampel beranda</p>
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
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Foto galeri</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['galeri_foto'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Album kegiatan ditampilkan di publik</p>
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
                    <p class="small text-secondary text-uppercase fw-semibold mb-1 letter-spacing-tight">Video</p>
                    <p class="h2 fw-bold mb-0"><?= (int) ($stats['galeri_video'] ?? 0) ?></p>
                    <p class="small text-secondary mb-0 mt-1">Cuplikan video unggulan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                <h2 class="h5 fw-bold mb-0">Akses cepat</h2>
                <p class="small text-secondary mb-0 mt-1">Pratinjau halaman seperti dilihat pengunjung (tab baru).</p>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <?php foreach ($quickLinks as $link) : ?>
                        <div class="col-md-6">
                            <a href="<?= esc($link['href'], 'attr') ?>" target="_blank" rel="noopener noreferrer"
                                class="admin-quick-link card h-100 border rounded-4 text-decoration-none text-body">
                                <div class="card-body p-3 d-flex align-items-center gap-3">
                                    <span class="admin-quick-icon rounded-3 d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="bi <?= esc($link['icon'], 'attr') ?> fs-5 text-primary"></i>
                                    </span>
                                    <div class="min-w-0">
                                        <span class="fw-semibold d-block text-truncate"><?= esc($link['label']) ?></span>
                                        <span class="small text-secondary"><?= esc($link['description']) ?></span>
                                    </div>
                                    <i class="bi bi-box-arrow-up-right text-secondary small ms-auto flex-shrink-0"></i>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <h2 class="h5 fw-bold mb-0">Berita terbaru</h2>
                    <p class="small text-secondary mb-0 mt-1">Judul dari data yang sama dengan halaman publik.</p>
                </div>
                <a class="btn btn-sm btn-outline-primary rounded-3" href="<?= base_url('berita') ?>" target="_blank" rel="noopener noreferrer">
                    Lihat semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 border-0">Judul</th>
                                <th class="border-0 d-none d-md-table-cell">Tanggal</th>
                                <th class="pe-4 border-0 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latestNews as $news) : ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-medium"><?= esc($news['title']) ?></span>
                                        <div class="small text-secondary d-md-none"><?= esc($news['date']) ?></div>
                                    </td>
                                    <td class="text-secondary small d-none d-md-table-cell"><?= esc($news['date']) ?></td>
                                    <td class="pe-4 text-end">
                                        <a class="btn btn-sm btn-light border rounded-3" href="<?= base_url('berita/' . (int) $news['id']) ?>"
                                            target="_blank" rel="noopener noreferrer">
                                            Buka
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <!-- <div class="card border-0 shadow-sm rounded-4 admin-hint-card mb-4">
            <div class="card-body p-4">
                <h2 class="h6 fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-primary"></i>Keamanan
                </h2>
                <p class="small text-secondary mb-0">
                    Ubah kata sandi default akun admin setelah database diisi melalui seeder.
                    Gunakan sandi panjang dan unik; batasi siapa saja yang memiliki akses ke URL <code class="small">/admin</code>.
                </p>
            </div>
        </div> -->

        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                <h2 class="h6 fw-bold mb-0">Roadmap modul</h2>
                <p class="small text-secondary mb-0 mt-1">Fitur pengelolaan konten dari panel ini.</p>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0 admin-roadmap">
                    <?php foreach ($upcomingModules as $mod) : ?>
                        <li class="d-flex gap-3 pb-3 mb-3 border-bottom border-light-subtle">
                            <span class="admin-roadmap-icon rounded-3 d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="bi <?= esc($mod['icon'], 'attr') ?> text-primary"></i>
                            </span>
                            <div>
                                <span class="fw-semibold d-block"><?= esc($mod['title']) ?></span>
                                <span class="small text-secondary"><?= esc($mod['detail']) ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
