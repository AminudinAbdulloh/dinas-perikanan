<style>
    :root {
        --dkp-blue: #2563eb;
        --dkp-cyan: #06b6d4;
    }

    .logo-box {
        width: 60px;
        height: 60px;
    }

    .navbar {
        padding: 0.75rem 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    @media (min-width: 992px) {
        .dropdown-menu .dropdown-submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
            min-width: 280px;
        }

        .dropdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }

        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .dropend:hover>.dropdown-submenu {
            display: block;
        }
    }

    [data-bs-theme="dark"] .navbar {
        background-color: #111827 !important;
        border-bottom: 1px solid #1f2937;
    }
</style>

<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
            <div class="logo-box d-flex align-items-center justify-content-center me-3">
                <img src="<?= base_url('images/logo_prov_papua_tengah.png')?>" alt="Logo" class="h-100">
            </div>
            <div class="d-flex flex-column gap-1">
                <span class="fw-bold fs-5 lh-1">Dinas Kelautan dan Perikanan</span>
                <small class="text-secondary opacity-90 fs-9">Provinsi Papua Tengah</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link px-3 fw-medium" href="<?= base_url('/') ?>">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Profil</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="<?= base_url('profil/sejarah') ?>">Sejarah</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('profil/visi-misi') ?>">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('profil/tupoksi') ?>">Tugas Pokok dan Fungsi</a>
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('profil/struktur') ?>">Struktur Organisasi</a>
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('profil/pejabat') ?>">Profil Pejabat
                                Struktural</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('profil/pegawai') ?>">Daftar Pegawai</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('profil/kontak') ?>">Alamat dan Kontak</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Program</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="<?= base_url('program/renstra') ?>">Rencana Strategis</a>
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('program/renja') ?>">Rencana Kerja</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('program/lakip') ?>">Laporan Kinerja</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('program/pk') ?>">Perjanjian Kinerja</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Data &amp; Informasi</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li class="dropend">
                            <a class="dropdown-item" href="#">
                                Layanan Publik <i class="bi bi-chevron-right ms-2" style="font-size: 0.7rem;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-submenu border-0 shadow">
                                <li><a class="dropdown-item" href="<?= base_url('informasi/alur-permohonan') ?>">Alur
                                        Permohonan</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('informasi/form-permohonan') ?>">Form
                                        Permohonan</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('informasi/form-keberatan') ?>">Form
                                        Keberatan</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('informasi/daftar-informasi') ?>">Daftar
                                        Informasi Publik</a></li>
                                <li><a class="dropdown-item"
                                        href="<?= base_url('informasi/informasi-dikecualikan') ?>">Informasi
                                        Dikecualikan</a></li>
                                <li><a class="dropdown-item"
                                        href="<?= base_url('informasi/informasi-berkala') ?>">Informasi Berkala</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('berita') ?>">Berita</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Galeri</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="<?= base_url('galeri/foto') ?>">Foto</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('galeri/video') ?>">Video</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 fw-medium" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Menu Lainnya</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="<?= base_url('faq') ?>">FAQ</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('kebijakan-privasi') ?>">Kebijakan Privasi</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-light rounded-3 border-0" id="themeToggle" title="Toggle Theme">
                    <i class="bi bi-moon-stars" id="themeIcon"></i>
                </button>
                <a href="<?= base_url('login') ?>"
                    class="btn btn-primary px-4 rounded-3 fw-medium d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const htmlElement = document.documentElement;

    // Terapkan tema tersimpan saat halaman dimuat
    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-bs-theme', savedTheme);
    themeIcon.className = savedTheme === 'light' ? 'bi bi-moon-stars' : 'bi bi-sun';

    themeToggle.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        htmlElement.setAttribute('data-bs-theme', newTheme);
        themeIcon.className = newTheme === 'light' ? 'bi bi-moon-stars' : 'bi bi-sun';
        localStorage.setItem('theme', newTheme);
    });
</script>