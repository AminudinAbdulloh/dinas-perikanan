<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Konten Alamat dan Kontak<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alamat dan Kontak</li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1">Konten Alamat dan Kontak</h1>
    <p class="text-secondary mb-0">
        Halaman utama pengelolaan konten untuk
        <a href="<?= base_url('profil/kontak') ?>" target="_blank" rel="noopener noreferrer">profil/kontak</a>.
        Klik tombol Edit untuk mengelola maps dan data kontak.
    </p>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="h5 fw-bold mb-1"><?= esc($page['title'] ?? 'Alamat dan Kontak') ?></h2>
                <p class="text-secondary mb-0 small"><?= esc($page['description'] ?? '') ?></p>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-primary rounded-3 px-4" href="<?= base_url('admin/konten/kontak/edit') ?>">
                    <i class="bi bi-pencil-square me-1"></i>Edit Konten
                </a>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('profil/kontak') ?>" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di situs
                </a>
            </div>
        </div>

        <div class="small text-secondary mb-3">
            <?php if (($page['updated_at'] ?? '') !== '') : ?>
                Terakhir diperbarui: <?= esc((string) $page['updated_at']) ?>
            <?php else : ?>
                Konten masih menggunakan data bawaan sistem.
            <?php endif; ?>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-7">
                <div class="border rounded-4 overflow-hidden bg-body-tertiary shadow-sm" style="min-height: 360px;">
                    <?php if (trim((string) ($page['map_embed'] ?? '')) !== '') : ?>
                        <iframe
                            src="<?= esc((string) $page['map_embed'], 'attr') ?>"
                            title="Lokasi kantor"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            style="width:100%; height:100%; min-height:360px; border:0;"
                        ></iframe>
                    <?php else : ?>
                        <div class="h-100 d-flex align-items-center justify-content-center text-secondary p-4">
                            URL maps belum diisi.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="border rounded-4 p-3 p-lg-4 bg-body-tertiary h-100 shadow-sm">
                    <h3 class="h6 fw-bold mb-3">Informasi Kontak</h3>

                    <div class="d-flex gap-3 mb-3 align-items-start">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary" style="width: 40px; height: 40px;">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <div>
                            <div class="small text-secondary fw-semibold mb-1">Alamat</div>
                            <div class="mb-0"><?= nl2br(esc((string) ($page['address'] ?? '-'))) ?></div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-3 align-items-start">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary" style="width: 40px; height: 40px;">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <div>
                            <div class="small text-secondary fw-semibold mb-1">Email</div>
                            <div class="mb-0"><?= esc((string) ($page['email'] ?? '-')) ?></div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-3 align-items-start">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary" style="width: 40px; height: 40px;">
                            <i class="bi bi-telephone"></i>
                        </span>
                        <div>
                            <div class="small text-secondary fw-semibold mb-1">Telepon</div>
                            <div class="mb-0"><?= nl2br(esc((string) ($page['phone'] ?? '-'))) ?></div>
                        </div>
                    </div>

                    <h4 class="h6 fw-semibold mb-2 mt-4">Sosial Media</h4>
                    <?php if (! empty($page['socials']) && is_array($page['socials'])) : ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($page['socials'] as $social) : ?>
                                <?php
                                $socialUrl = esc((string) ($social['url'] ?? ''), 'attr');
                                ?>
                                <a
                                    class="btn btn-sm btn-outline-primary rounded-pill"
                                    href="<?= $socialUrl ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                        <?= esc((string) ($social['label'] ?? 'Tautan')) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="text-secondary small mb-0">Belum ada tautan sosial media.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
