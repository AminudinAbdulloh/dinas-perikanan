<style>
    :root {
        --dkp-blue: #2563eb;
        --dkp-cyan: #06b6d4;
    }

    .logo-box {
        width: 65px;
        height: 65px;
    }

    .navbar {
        padding: 0.55rem 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        min-width: 0;
    }

    .brand-text {
        min-width: 0;
    }

    .brand-title {
        white-space: wrap;
    }

    .navbar-actions {
        margin-top: 0.5rem;
    }

    .submenu-toggle i {
        transition: transform 0.2s ease;
    }

    .theme-toggle-btn {
        background-color: #0d6efd;
        color: #ffffff;
    }

    .theme-toggle-btn:hover,
    .theme-toggle-btn:focus {
        background-color: #1d4ed8;
        color: #ffffff;
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

    @media (min-width: 992px) and (max-width: 1199.98px) {
        .navbar .container-fluid {
            align-items: center;
        }

        .navbar-nav {
            row-gap: 0.25rem;
        }

        .navbar-nav .nav-link {
            white-space: normal;
            line-height: 1.2;
            text-align: center;
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
    }

    [data-bs-theme="dark"] .navbar {
        background-color: #101828 !important;
        border-bottom: 1px solid #1f2937;
    }

    [data-bs-theme="dark"] .dropdown-menu {
        background-color: #1e2939;
    }

    [data-bs-theme="dark"] .offcanvas {
        background-color: #101828;
        color: #e5e7eb;
    }

    [data-bs-theme="dark"] .theme-toggle-btn {
        background-color: #ffffff;
        color: #1f2937;
    }

    @media (max-width: 991.98px) {
        .navbar .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .logo-box {
            width: 44px;
            height: 44px;
            margin-right: 0.75rem !important;
        }

        .brand-title {
            font-size: 0.85rem !important;
            white-space: normal;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 0.72rem;
        }

        .offcanvas {
            width: min(86vw, 360px) !important;
        }

        .offcanvas-header {
            border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        }

        .offcanvas-body {
            padding: 1rem;
        }

        .navbar-nav .nav-link {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }

        .dropdown-menu {
            border: 0;
            box-shadow: none !important;
            padding-left: 0.75rem;
            display: block;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-6px);
            transform-origin: top;
            visibility: hidden;
            pointer-events: none;
            transition: max-height 0.28s ease, opacity 0.22s ease, transform 0.22s ease, visibility 0.22s ease;
        }

        .dropdown-item {
            white-space: normal;
        }

        .dropdown-submenu {
            position: static !important;
            min-width: 100%;
            margin-left: 0.25rem;
        }

        .dropdown-menu.show {
            max-height: 1000px;
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
            pointer-events: auto;
        }

        .dropend.show>.submenu-toggle i {
            transform: rotate(90deg);
        }

        .navbar-actions {
            margin-top: 0.75rem;
            width: 100%;
            justify-content: space-between;
        }

        .navbar-actions .btn-primary {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
            <div class="logo-box d-flex align-items-center justify-content-center me-3">
                <img src="<?= base_url('images/logo_prov_papua_tengah.png') ?>" alt="Logo" class="h-100">
            </div>
            <div class="d-flex flex-column gap-1 brand-text">
                <span class="fw-bold fs-5 lh-1 brand-title">Dinas Kelautan dan Perikanan</span>
                <small class="text-secondary opacity-90 fs-9 brand-subtitle">Provinsi Papua Tengah</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end offcanvas-lg" tabindex="-1" id="navbarNav" aria-labelledby="navbarNavLabel">
            <div class="offcanvas-header d-lg-none">
                <h5 class="offcanvas-title fw-semibold" id="navbarNavLabel">Menu Navigasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav mx-lg-auto">
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
                                    role="button" data-mobile-dropdown="true" aria-expanded="false">
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
                                                <a class="dropdown-item submenu-toggle" href="<?= esc($sub['link']) ?>"
                                                    data-submenu-toggle="true">
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

                <div class="d-flex align-items-center gap-2 navbar-actions">
                    <button class="btn rounded-3 border-0 theme-toggle-btn" id="themeToggle" title="Toggle Theme">
                        <i class="bi bi-moon-stars" id="themeIcon"></i>
                    </button>
                    <a href="<?= base_url('login') ?>"
                        class="btn btn-primary px-4 rounded-3 fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const htmlElement = document.documentElement;
    const offcanvasNav = document.getElementById('navbarNav');

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

    const resetMobileDropdownState = () => {
        document.querySelectorAll('.navbar-nav .dropdown.show').forEach((item) => {
            item.classList.remove('show');
            item.querySelector(':scope > .dropdown-menu')?.classList.remove('show');
            item.querySelector('[data-mobile-dropdown="true"]')?.setAttribute('aria-expanded', 'false');
        });

        document.querySelectorAll('.navbar-nav .dropend.show').forEach((item) => {
            item.classList.remove('show');
            item.querySelector('.dropdown-submenu')?.classList.remove('show');
        });
    };

    const closeNestedSubmenus = (dropdownParent) => {
        dropdownParent.querySelectorAll('.dropend.show').forEach((sub) => {
            sub.classList.remove('show');
            sub.querySelector('.dropdown-submenu')?.classList.remove('show');
        });
    };

    document.querySelectorAll('[data-submenu-toggle="true"]').forEach((toggle) => {
        toggle.addEventListener('click', (event) => {
            if (window.innerWidth >= 992) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            const parent = toggle.closest('.dropend');
            const submenu = parent?.querySelector('.dropdown-submenu');

            if (!parent || !submenu) {
                return;
            }

            const siblings = parent.parentElement?.querySelectorAll('.dropend.show');
            siblings?.forEach((item) => {
                if (item !== parent) {
                    item.classList.remove('show');
                    item.querySelector('.dropdown-submenu')?.classList.remove('show');
                }
            });

            parent.classList.toggle('show');
            submenu.classList.toggle('show');
        });
    });

    document.querySelectorAll('[data-mobile-dropdown="true"]').forEach((toggle) => {
        toggle.addEventListener('click', (event) => {
            if (window.innerWidth >= 992) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            const parent = toggle.closest('.dropdown');
            const menu = parent?.querySelector(':scope > .dropdown-menu');

            if (!parent || !menu) {
                return;
            }

            document.querySelectorAll('.navbar-nav .dropdown.show').forEach((item) => {
                if (item !== parent) {
                    item.classList.remove('show');
                    item.querySelector(':scope > .dropdown-menu')?.classList.remove('show');
                    closeNestedSubmenus(item);
                    item.querySelector('[data-mobile-dropdown="true"]')?.setAttribute('aria-expanded', 'false');
                }
            });

            const willShow = !menu.classList.contains('show');
            parent.classList.toggle('show', willShow);
            menu.classList.toggle('show', willShow);
            toggle.setAttribute('aria-expanded', willShow ? 'true' : 'false');

            if (!willShow) {
                closeNestedSubmenus(parent);
            }
        });
    });

    offcanvasNav?.addEventListener('hide.bs.offcanvas', () => {
        resetMobileDropdownState();
    });
</script>