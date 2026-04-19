<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?: 'Admin' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/theme-tokens.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <?= $this->renderSection('styles') ?>
</head>

<body class="admin-app-body">
    <?php
    helper('url');
    $nav = $adminNav ?? 'dashboard';
    $sidebarNav = static function (string $key, string $label, string $href, string $icon, bool $disabled = false) use ($nav): string {
        $active = $nav === $key ? 'active' : '';
        if ($disabled) {
            return '<span class="admin-sidebar-link admin-sidebar-link--muted ' . $active . '">'
                . '<i class="bi ' . esc($icon, 'attr') . '"></i>'
                . '<span>' . esc($label) . '</span>'
                . '<span class="admin-sidebar-badge">nanti</span></span>';
        }

        return '<a class="admin-sidebar-link ' . $active . '" href="' . esc($href, 'attr') . '">'
            . '<i class="bi ' . esc($icon, 'attr') . '"></i>'
            . '<span>' . esc($label) . '</span></a>';
    };
    ?>

    <header class="admin-topbar border-bottom bg-body shadow-sm">
        <div class="container-fluid px-3 px-lg-4 py-2 py-lg-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2 flex-grow-1 flex-lg-grow-0 min-w-0">
                <button class="btn btn-outline-secondary btn-sm rounded-3 d-lg-none flex-shrink-0" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#adminSidebarCanvas" aria-controls="adminSidebarCanvas"
                    aria-label="Buka menu">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="d-flex align-items-center gap-2 min-w-0">
                    <span class="admin-brand-badge rounded-3 px-3 py-2 fw-semibold small flex-shrink-0">Admin</span>
                    <span class="text-secondary small text-truncate d-none d-sm-inline">Dinas Kelautan dan Perikanan Papua Tengah</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 gap-sm-3 flex-shrink-0">
                <a class="btn btn-outline-primary btn-sm rounded-3 d-none d-sm-inline-flex align-items-center" href="<?= base_url('/') ?>"
                    target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Situs
                </a>
                <span class="text-secondary small text-truncate" style="max-width: 9rem;">
                    <i class="bi bi-person-circle me-1"></i><?= esc(session('admin_name') ?? 'Admin') ?>
                </span>
                <a class="btn btn-outline-secondary btn-sm rounded-3" href="<?= base_url('admin/logout') ?>">
                    <i class="bi bi-box-arrow-right me-sm-1"></i><span class="d-none d-sm-inline">Keluar</span>
                </a>
            </div>
        </div>
    </header>

    <div class="admin-shell d-lg-flex">
        <aside class="admin-sidebar d-none d-lg-flex flex-column border-end bg-body flex-shrink-0">
            <nav class="admin-sidebar-nav flex-grow-1 py-3 px-2">
                <p class="admin-sidebar-label px-3 mb-2">Menu</p>
                <?= $sidebarNav('dashboard', 'Dashboard', base_url('admin/dashboard'), 'bi-speedometer2') ?>
                <p class="admin-sidebar-label px-3 mb-2 mt-4">Konten situs</p>
                <?= $sidebarNav('konten-sejarah', 'Sejarah', base_url('admin/konten/sejarah'), 'bi-clock-history') ?>
                <?= $sidebarNav('konten-visi-misi', 'Visi & Misi', base_url('admin/konten/visi-misi'), 'bi-bullseye') ?>
                <?= $sidebarNav('konten-tupoksi', 'Tupoksi', base_url('admin/konten/tupoksi'), 'bi-list-check') ?>
                <?= $sidebarNav('konten-struktur', 'Struktur Organisasi', base_url('admin/konten/struktur'), 'bi-diagram-3') ?>
                <?= $sidebarNav('konten-pejabat', 'Profil Pejabat Struktural', base_url('admin/konten/pejabat'), 'bi-person-vcard') ?>
                <?= $sidebarNav('konten-pegawai', 'Daftar Pegawai', base_url('admin/konten/pegawai'), 'bi-people') ?>
                <?= $sidebarNav('konten-kontak', 'Alamat dan Kontak', base_url('admin/konten/kontak'), 'bi-geo-alt') ?>
                <?= $sidebarNav('konten-berita', 'Berita', base_url('admin/konten/berita'), 'bi-newspaper') ?>
                <?= $sidebarNav('mod-pengumuman', 'Pengumuman', '#', 'bi-megaphone', true) ?>
                <?= $sidebarNav('konten-galeri-foto', 'Galeri Foto', base_url('admin/konten/galeri-foto'), 'bi-images') ?>
                <?= $sidebarNav('mod-ppid', 'Informasi Publik', '#', 'bi-journal-text', true) ?>
            </nav>
            <div class="admin-sidebar-footer border-top p-3 small text-secondary">
                Halaman Sejarah, Visi & Misi, Tupoksi, Struktur Organisasi, Profil Pejabat Struktural, Daftar Pegawai, Alamat & Kontak, Berita, dan Galeri Foto dapat dikelola di sini; modul lain mengikuti roadmap CMS.
            </div>
        </aside>

        <div class="offcanvas offcanvas-start admin-offcanvas text-bg-light d-lg-none" tabindex="-1" id="adminSidebarCanvas"
            aria-labelledby="adminSidebarCanvasLabel">
            <div class="offcanvas-header border-bottom">
                <h2 class="offcanvas-title h6 mb-0" id="adminSidebarCanvasLabel">Menu admin</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
            </div>
            <div class="offcanvas-body p-0">
                <nav class="admin-sidebar-nav py-2 px-2">
                    <?= $sidebarNav('dashboard', 'Dashboard', base_url('admin/dashboard'), 'bi-speedometer2') ?>
                    <p class="admin-sidebar-label px-3 mb-2 mt-3">Konten situs</p>
                    <?= $sidebarNav('konten-sejarah', 'Sejarah', base_url('admin/konten/sejarah'), 'bi-clock-history') ?>
                    <?= $sidebarNav('konten-visi-misi', 'Visi & Misi', base_url('admin/konten/visi-misi'), 'bi-bullseye') ?>
                    <?= $sidebarNav('konten-tupoksi', 'Tupoksi', base_url('admin/konten/tupoksi'), 'bi-list-check') ?>
                    <?= $sidebarNav('konten-struktur', 'Struktur Organisasi', base_url('admin/konten/struktur'), 'bi-diagram-3') ?>
                    <?= $sidebarNav('konten-pejabat', 'Profil Pejabat Struktural', base_url('admin/konten/pejabat'), 'bi-person-vcard') ?>
                    <?= $sidebarNav('konten-pegawai', 'Daftar Pegawai', base_url('admin/konten/pegawai'), 'bi-people') ?>
                    <?= $sidebarNav('konten-kontak', 'Alamat dan Kontak', base_url('admin/konten/kontak'), 'bi-geo-alt') ?>
                    <?= $sidebarNav('konten-berita', 'Berita', base_url('admin/konten/berita'), 'bi-newspaper') ?>
                    <?= $sidebarNav('mod-pengumuman', 'Pengumuman', '#', 'bi-megaphone', true) ?>
                    <?= $sidebarNav('konten-galeri-foto', 'Galeri Foto', base_url('admin/konten/galeri-foto'), 'bi-images') ?>
                    <?= $sidebarNav('mod-ppid', 'Informasi Publik', '#', 'bi-journal-text', true) ?>
                </nav>
            </div>
        </div>

        <main class="admin-main flex-grow-1 min-w-0 px-3 px-lg-4 py-4">
            <?php if ($flash = session()->getFlashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <?= esc($flash) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <?php if ($flash = session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    <?= esc($flash) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>
