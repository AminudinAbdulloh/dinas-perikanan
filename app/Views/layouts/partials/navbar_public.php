<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm py-3">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand d-flex align-items-center gap-3" href="/">
            <div class="bg-primary bg-gradient rounded-3 d-flex align-items-center justify-center text-white fw-bold shadow-sm"
                style="width: 50px; height: 50px; display: flex; justify-content: center;">
                <img src="<?= base_url('img/logo_prov_papua_tengah.png') ?>" alt="Logo" class="w-100 h-auto">
            </div>
            <div class="d-none d-sm-block">
                <div class="fw-bold text-dark lh-1" style="font-size: 1.1rem;">Dinas Perikanan dan Kelautan</div>
                <small class="text-muted">Provinsi Papua Tengah</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <?php foreach ($menu_navigasi as $m): ?>
                    <?php if (isset($m['submenu'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium px-3" href="#" role="button" data-bs-toggle="dropdown">
                                <?= $m['nama'] ?>
                            </a>
                            <ul class="dropdown-menu shadow-sm border-0 mt-2">
                                <?php foreach ($m['submenu'] as $s): ?>
                                    <li><a class="dropdown-item py-2" href="<?= $s['link'] ?>"><?= $s['nama'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-3" href="<?= $m['link'] ?>"><?= $m['nama'] ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <div class="d-flex align-items-center gap-3 ms-lg-3">
                <a href="#login" class="btn btn-primary px-4 py-2 rounded-3 fw-medium">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
            </div>
        </div>
    </div>
</nav>