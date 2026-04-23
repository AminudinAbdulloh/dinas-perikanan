<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Edit Alamat dan Kontak<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/kontak') ?>">Alamat dan Kontak</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1">Edit Konten Alamat dan Kontak</h1>
    <p class="text-secondary mb-0">
        Atur maps, alamat, email, telepon, dan tautan sosial media.
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
        <form method="post" action="<?= base_url('admin/konten/kontak/update') ?>" novalidate>
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Judul halaman</label>
                <input type="text" class="form-control form-control-lg rounded-3" id="title" name="title" required
                    maxlength="255" value="<?= esc(old('title', $page['title'] ?? '')) ?>">
            </div>

            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">Deskripsi singkat</label>
                <textarea class="form-control rounded-3" id="description" name="description" rows="2" maxlength="500"
                    placeholder="Muncul sebagai pengantar / meta deskripsi"><?= esc(old('description', $page['description'] ?? '')) ?></textarea>
                <div class="form-text">Maksimal 500 karakter.</div>
            </div>

            <div class="border rounded-4 p-3 p-md-4 mb-4 bg-body-tertiary">
                <h2 class="h6 fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill text-primary"></i>Detail Lokasi
                </h2>
                <div class="mb-3">
                    <label for="map_embed" class="form-label fw-semibold">URL Google Maps Embed</label>
                    <textarea class="form-control rounded-3" id="map_embed" name="map_embed" rows="3"
                        placeholder="https://www.google.com/maps/embed?..."><?= esc(old('map_embed', $page['map_embed'] ?? '')) ?></textarea>
                    <div class="form-text">Bisa isi URL embed langsung atau tempel iframe Google Maps.</div>
                </div>

                <div class="mb-0">
                    <label for="address" class="form-label fw-semibold">Alamat Lengkap</label>
                    <textarea class="form-control rounded-3" id="address" name="address" rows="4"
                        placeholder="Contoh: Jalan Sagan No. 11/4, Kelurahan Terban, ..."><?= esc(old('address', $page['address'] ?? '')) ?></textarea>
                </div>
            </div>

            <div class="border rounded-4 p-3 p-md-4 mb-4 bg-body-tertiary">
                <h2 class="h6 fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-person-lines-fill text-primary"></i>Kontak Utama
                </h2>
                <div class="row g-3 mb-0">
                <div class="col-12 col-md-6">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control rounded-3" id="email" name="email"
                        value="<?= esc(old('email', $page['email'] ?? '')) ?>">
                </div>
                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label fw-semibold">Telepon</label>
                    <textarea class="form-control rounded-3" id="phone" name="phone" rows="2"
                        placeholder="Pisahkan dengan baris baru jika lebih dari satu nomor"><?= esc(old('phone', $page['phone'] ?? '')) ?></textarea>
                </div>
            </div>
            </div>

            <?php
            $socialLines = [];
            foreach (($page['socials'] ?? []) as $social) {
                $label = trim((string) ($social['label'] ?? ''));
                $url = trim((string) ($social['url'] ?? ''));
                if ($label !== '' && $url !== '') {
                    $socialLines[] = $label . '|' . $url;
                }
            }
            $socialDefault = implode("\n", $socialLines);
            ?>
            <div class="border rounded-4 p-3 p-md-4 mb-4 bg-body-tertiary">
                <h2 class="h6 fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-share-fill text-primary"></i>Sosial Media
                </h2>
                <label for="socials" class="form-label fw-semibold">Sosial Media</label>
                <textarea class="form-control rounded-3" id="socials" name="socials" rows="5"
                    placeholder="Instagram|https://instagram.com/...\nYouTube|https://youtube.com/..."><?= esc(old('socials', $socialDefault)) ?></textarea>
                <div class="form-text">Satu baris satu tautan dengan format: <code>Label|URL</code>.</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/kontak') ?>">
                    Kembali
                </a>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('profil/kontak') ?>" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di situs
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
