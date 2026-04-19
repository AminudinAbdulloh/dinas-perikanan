<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Galeri Foto<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4 d-flex flex-wrap align-items-start justify-content-between gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Galeri Foto</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold text-body mb-1">Galeri Foto</h1>
        <p class="text-secondary mb-0">
            Kelola foto yang tampil di beranda dan halaman galeri publik.
        </p>
    </div>
    <a class="btn btn-primary rounded-3" href="<?= base_url('admin/konten/galeri-foto/tambah') ?>">
        <i class="bi bi-plus-lg me-1"></i>Tambah foto
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 88px;">Pratinjau</th>
                        <th>Judul</th>
                        <th class="d-none d-md-table-cell">Tanggal</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (($photos ?? []) === []) : ?>
                        <tr>
                            <td colspan="4" class="px-4 py-5 text-center text-secondary">
                                Belum ada foto. <a href="<?= base_url('admin/konten/galeri-foto/tambah') ?>">Unggah foto pertama</a>
                                atau jalankan <code class="small">php spark db:seed GalleryPhotoSeeder</code> untuk contoh data.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($photos as $row) : ?>
                            <?php
                            $thumb = \App\Models\GalleryPhotoModel::publicImageUrl((string) ($row['image'] ?? ''));
                            $dateLabel = \App\Models\GalleryPhotoModel::displayDateFromRow($row);
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <?php if ($thumb !== '') : ?>
                                        <img src="<?= esc($thumb, 'attr') ?>" alt="" class="rounded-2 border" style="width: 64px; height: 64px; object-fit: cover;">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="fw-medium"><?= esc((string) ($row['title'] ?? '')) ?></span>
                                    <div class="small text-secondary d-md-none"><?= esc($dateLabel) ?></div>
                                </td>
                                <td class="text-secondary small d-none d-md-table-cell"><?= esc($dateLabel) ?></td>
                                <td class="pe-4 text-end text-nowrap">
                                    <a class="btn btn-sm btn-light border rounded-3"
                                        href="<?= base_url('galeri/foto/' . (int) $row['id']) ?>" target="_blank" rel="noopener noreferrer">Lihat</a>
                                    <a class="btn btn-sm btn-outline-primary rounded-3"
                                        href="<?= base_url('admin/konten/galeri-foto/' . (int) $row['id'] . '/edit') ?>">Edit</a>
                                    <form method="post" action="<?= base_url('admin/konten/galeri-foto/' . (int) $row['id'] . '/hapus') ?>"
                                        class="d-inline" onsubmit="return confirm('Hapus foto ini dari galeri?');">
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
