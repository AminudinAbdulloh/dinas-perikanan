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
        background-color: #101828 !important;
        border-bottom: 1px solid #1f2937;
    }

    [data-bs-theme="dark"] .dropdown-menu {
        background-color: #1e2939;
    }
</style>

<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
            <div class="logo-box d-flex align-items-center justify-content-center me-3">
                <img src="<?= base_url('images/logo_prov_papua_tengah.png') ?>" alt="Logo" class="h-100">
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
                <?php foreach ($menu_navigasi as $menu): ?>

                <?php if (empty($menu['submenu'])): ?>
                    <li class="nav-item">
                        <a class="nav-link px-3 fw-medium" href="<?= esc($menu['link']) ?>">
                            <?= esc($menu['nama']) ?>
                        </a>
                    </li>

                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 fw-medium" href="<?= esc($menu['link']) ?>"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= esc($menu['nama']) ?>
                        </a>
                        <ul class="dropdown-menu border-0 shadow">
                            <?php foreach ($menu['submenu'] as $sub): ?>

                            <?php if (empty($sub['submenu'])): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= esc($sub['link']) ?>">
                                        <?= esc($sub['nama']) ?>
                                    </a>
                                </li>

                            <?php else: ?>
                                <li class="dropend">
                                    <a class="dropdown-item" href="<?= esc($sub['link']) ?>">
                                        <?= esc($sub['nama']) ?>
                                        <i class="bi bi-chevron-right ms-2" style="font-size: 0.7rem;"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-submenu border-0 shadow">
                                        <?php foreach ($sub['submenu'] as $subsub): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= esc($subsub['link']) ?>">
                                                <?= esc($subsub['nama']) ?>
                                            </a>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>

                            <?php endif ?>

                            <?php endforeach ?>
                        </ul>
                    </li>

                <?php endif ?>

                <?php endforeach ?>
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
    const themeIcon   = document.getElementById('themeIcon');
    const htmlElement = document.documentElement;

    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-bs-theme', savedTheme);
    themeIcon.className = savedTheme === 'light' ? 'bi bi-moon-stars' : 'bi bi-sun';

    themeToggle.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-bs-theme');
        const newTheme     = currentTheme === 'light' ? 'dark' : 'light';
        htmlElement.setAttribute('data-bs-theme', newTheme);
        themeIcon.className = newTheme === 'light' ? 'bi bi-moon-stars' : 'bi bi-sun';
        localStorage.setItem('theme', newTheme);
    });
</script>