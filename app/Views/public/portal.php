<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal - Dinas Kelautan dan Perikanan Provinsi Papua Tengah</title>
    <meta name="description" content="Portal resmi Dinas Kelautan dan Perikanan Provinsi Papua Tengah.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #0d1b3e;
            overflow-x: hidden;
        }

        /* ─── Hero ─────────────────────────────────────────────── */
        .portal-hero {
            position: relative;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            /* Removed overflow: hidden to allow dropdowns to show over footer */
        }

        .portal-hero-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
        }

        .portal-hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(10, 22, 60, 0.55);
            z-index: 1;
        }

        .portal-content {
            position: relative;
            z-index: 20;
            display: flex;
            gap: 25px;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 820px;
        }

        /* Top logo — transparan, tanpa background */
        .portal-top-logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 16px rgba(0,0,0,0.45));
        }

        .portal-top-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Judul & subtitle pills */
        .portal-title {
            background: #1d4ed8;
            color: #fff;
            font-size: clamp(1.05rem, 3vw, 1.45rem);
            font-weight: 800;
            letter-spacing: 0.08em;
            padding: 12px 36px;
            border-radius: 50px;
            text-align: center;
        }

        .portal-subtitle {
            background: #2563eb;
            color: #e0eaff;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 7px 28px;
            border-radius: 50px;
            text-align: center;
        }

        /* Icon grid */
        .portal-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px 16px;
            width: 100%;
            max-width: 960px;
            margin-bottom: 40px;
            position: relative;
        }

        .portal-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            cursor: pointer;
            position: relative;
            transition: z-index 0.3s;
            width: 140px;
        }

        .portal-item.active {
            z-index: 1000;
        }

        .portal-icon-wrap {
            width: 88px;
            height: 88px;
            border-radius: 22px;
            background: rgba(255,255,255,0.92);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.22s ease, background 0.22s ease, box-shadow 0.22s ease;
            box-shadow: 0 2px 12px rgba(0,0,0,0.18);
            overflow: hidden;
            padding: 8px;
        }

        .portal-icon-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .portal-icon-wrap i {
            font-size: 2.6rem;
            color: #1d4ed8;
        }

        .portal-item:hover .portal-icon-wrap,
        .portal-item.active .portal-icon-wrap {
            background: #fff;
            transform: translateY(-5px);
            box-shadow: 0 8px 28px rgba(29, 78, 216, 0.35);
        }

        .portal-item-label {
            color: #fff;
            font-size: 0.82rem;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1.3;
            text-shadow: 0 1px 4px rgba(0,0,0,0.5);
        }

        /* ─── Dropdown Speech Box ─────────────────────────────── */
        .portal-dropdown {
            position: absolute;
            top: calc(100% + 20px);
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            width: 280px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
            cursor: default;
            text-align: left;
            border: 1px solid rgba(255,255,255,0.2);
            z-index: 10001;
        }

        .portal-item.active .portal-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        /* Arrow (Speech Box) */
        .portal-dropdown::before {
            content: '';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 12px solid #1d4ed8;
        }

        .portal-dropdown-header {
            background: #1d4ed8;
            color: #fff;
            padding: 14px 20px;
            border-radius: 16px 16px 0 0;
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .portal-dropdown-list {
            list-style: none;
            padding: 8px 0;
            margin: 0;
            max-height: 320px;
            overflow-y: auto;
        }

        .portal-dropdown-list li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #334155;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-bottom: 1px solid #f1f5f9;
        }

        .portal-dropdown-list li:last-child a {
            border-bottom: none;
        }

        .portal-dropdown-list li a:hover {
            background: #eff6ff;
            color: #1d4ed8;
            padding-left: 28px;
        }

        .portal-dropdown-list li a i {
            font-size: 0.75rem;
            color: #2563eb;
        }

        .portal-dropdown-empty {
            padding: 20px;
            color: #94a3b8;
            font-style: italic;
            text-align: center;
            display: block;
        }

        /* Tombol beranda */
        .portal-btn {
            display: inline-block;
            background: #2563eb;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            padding: 14px 48px;
            border-radius: 50px;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease;
            box-shadow: 0 4px 18px rgba(37, 99, 235, 0.4);
        }

        .portal-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            color: #fff;
        }

        /* ─── Footer ───────────────────────────────────────────── */
        .portal-footer {
            background: #1d4ed8;
            color: #e0eaff;
            text-align: center;
            padding: 28px 20px;
            position: relative;
            z-index: 10;
        }

        .portal-footer-title {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
            color: #fff;
        }

        .portal-footer-contact {
            font-size: 0.9rem;
            margin-bottom: 12px;
            color: rgba(255,255,255,0.85);
        }

        .portal-footer-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
        }

        .portal-footer-socials {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
            padding-top: 10px;
        }

        .portal-footer-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1.5px solid rgba(255,255,255,0.45);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 0.85rem;
            color: #fff;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .portal-footer-link:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .portal-footer-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1.5px solid rgba(255,255,255,0.45);
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 0.75rem;
            color: #fff;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .portal-footer-link:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        /* ─── Responsive ──────────────────────────────────────── */
        @media (max-width: 640px) {
            .portal-grid {
                gap: 14px 10px;
            }

            .portal-item {
                width: calc(33.33% - 10px);
            }

            .portal-icon-wrap {
                width: 62px;
                height: 62px;
                border-radius: 15px;
            }

            .portal-icon-wrap i {
                font-size: 1.65rem;
            }

            .portal-title {
                padding: 10px 22px;
            }

            .portal-dropdown {
                width: calc(100vw - 48px);
                position: fixed;
                top: auto;
                bottom: 20px;
                left: 24px;
                right: 24px;
                transform: translateY(110%);
                margin-left: 0;
            }

            .portal-item.active .portal-dropdown {
                transform: translateY(0);
            }

            .portal-dropdown::before {
                display: none;
            }
        }

        @media (max-width: 400px) {
            .portal-grid {
            }

            .portal-icon-wrap {
                width: 52px;
                height: 52px;
            }
        }
    </style>
</head>
<body>

<main class="portal-hero">
    <!-- Background -->
    <img src="<?= base_url('images/paus_biru.jpg') ?>" alt="" class="portal-hero-bg" aria-hidden="true">
    <div class="portal-hero-overlay" aria-hidden="true"></div>

    <div class="portal-content">

        <!-- Logo atas (Provinsi Papua Tengah) -->
        <div class="portal-top-logo">
            <img src="<?= base_url('images/logo_prov_papua_tengah.png') ?>" alt="Logo Provinsi Papua Tengah">
        </div>

        <!-- Judul -->
        <div style="display:flex;flex-direction:column;align-items:center;gap:8px;">
            <div class="portal-title">DINAS KELAUTAN DAN PERIKANAN</div>
            <div class="portal-subtitle">Provinsi Papua Tengah</div>
        </div>

        <!-- Grid ikon -->
        <?php
        // Bangun map menu dari menuNavigasi berdasarkan nama
        $menuNavigasi = $menuNavigasi ?? [];
        $menuMap = [];
        foreach ($menuNavigasi as $m) {
            $menuMap[strtolower($m['nama'])] = $m;
            // Map first-level submenus to allow them to be top-level dropdowns (e.g. Galeri, Layanan)
            if (!empty($m['submenu'])) {
                foreach ($m['submenu'] as $sm) {
                    $menuMap[strtolower($sm['nama'])] = $sm;
                }
            }
        }

        $popupMenus = [
            'profil'    => ['title' => 'Profil',    'icon' => 'bi-building',         'menu' => $menuMap['profil']    ?? null],
            'informasi' => ['title' => 'Informasi', 'icon' => 'bi-info-circle',      'menu' => $menuMap['informasi'] ?? null],
            'publikasi' => ['title' => 'Publikasi', 'icon' => 'bi-journal-richtext',  'menu' => $menuMap['publikasi'] ?? null],
            'galeri'    => ['title' => 'Galeri',    'icon' => 'bi-images',           'menu' => $menuMap['galeri']    ?? null],
            'layanan'   => ['title' => 'Layanan',   'icon' => 'bi-grid-3x3-gap',     'menu' => $menuMap['layanan']   ?? null],
            'informasi publik' => ['title' => 'Informasi Publik', 'icon' => 'bi-file-earmark-text', 'menu' => $menuMap['informasi publik'] ?? null],
        ];
        ?>
        <div class="portal-grid" role="navigation" aria-label="Menu Portal">

            <!-- 1. Provinsi Papua Tengah -->
            <a href="https://papuatengahprov.go.id/" target="_blank" rel="noopener noreferrer"
               class="portal-item" title="Provinsi Papua Tengah">
                <div class="portal-icon-wrap">
                    <img src="<?= base_url('images/logo_prov_papua_tengah.png') ?>" alt="Logo Papua Tengah">
                </div>
                <span class="portal-item-label">Provinsi Papua Tengah</span>
            </a>

            <!-- 2. Sibapatengah -->
            <a href="https://sibapatengah.id/" target="_blank" rel="noopener noreferrer"
               class="portal-item" title="Sibapatengah">
                <div class="portal-icon-wrap">
                    <img src="<?= base_url('images/logo_prov_papua_tengah.png') ?>" alt="Logo Sibapatengah">
                </div>
                <span class="portal-item-label">Sibapatengah</span>
            </a>

            <!-- Dropdown Menus -->
            <?php foreach ($popupMenus as $key => $popup) : ?>
            <div class="portal-item portal-item-has-dropdown" tabindex="0" role="button" aria-haspopup="true" title="<?= $popup['title'] ?>">
                <div class="portal-icon-wrap">
                    <i class="bi <?= $popup['icon'] ?>"></i>
                </div>
                <span class="portal-item-label"><?= $popup['title'] ?></span>

                <!-- Dropdown (Speech Box) -->
                <div class="portal-dropdown">
                    <div class="portal-dropdown-header">
                        <i class="bi <?= $popup['icon'] ?>"></i>
                        <span><?= $popup['title'] ?></span>
                    </div>
                    <ul class="portal-dropdown-list">
                        <?php 
                        $m = $popup['menu'];
                        if ($m !== null && !empty($m['submenu'])) : 
                            foreach ($m['submenu'] as $sub) : ?>
                                <li>
                                    <a href="<?= esc($sub['link']) ?>">
                                        <i class="bi bi-chevron-right"></i>
                                        <?= esc($sub['nama']) ?>
                                    </a>
                                </li>
                            <?php endforeach;
                        elseif ($m !== null) : ?>
                            <li><a href="<?= esc($m['link']) ?>"><i class="bi bi-chevron-right"></i><?= esc($m['nama']) ?></a></li>
                        <?php else : ?>
                            <li><span class="portal-dropdown-empty">Menu belum tersedia</span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

        <!-- Tombol ke beranda -->
        <a href="<?= base_url('beranda') ?>" class="portal-btn">
            Menuju ke Beranda
        </a>

    </div>
</main>

<!-- Footer -->
<?php
$agency  = $footerData['agency']      ?? [];
$socials = $footerData['socialLinks'] ?? [];
$contacts = $agency['contacts']       ?? [];
// Petakan kontak berdasarkan ikon
$alamat  = '';
$email   = '';
$telepon = '';
foreach ($contacts as $c) {
    if (str_contains($c['icon'] ?? '', 'geo'))       $alamat  = $c['text'] ?? '';
    if (str_contains($c['icon'] ?? '', 'envelope'))  $email   = $c['text'] ?? '';
    if (str_contains($c['icon'] ?? '', 'telephone')) $telepon = $c['text'] ?? '';
}
$agencyName = $agency['name'] ?? 'Dinas Kelautan dan Perikanan Papua Tengah';
?>
<footer class="portal-footer">
    <div class="portal-footer-title"><?= esc(strtoupper($agencyName)) ?></div>
    <?php if ($alamat !== '') : ?>
        <div class="portal-footer-contact">
            <i class="bi bi-geo-alt me-1"></i><?= esc($alamat) ?>
        </div>
    <?php endif; ?>

    <!-- Baris 1: Telepon + Email -->
    <div class="portal-footer-links">
        <?php if ($telepon !== '') : ?>
            <span class="portal-footer-link">
                <i class="bi bi-telephone"></i> <?= esc($telepon) ?>
            </span>
        <?php endif; ?>
        <?php if ($email !== '') : ?>
            <a href="mailto:<?= esc($email) ?>" class="portal-footer-link">
                <i class="bi bi-envelope"></i> <?= esc($email) ?>
            </a>
        <?php endif; ?>
    </div>

    <!-- Baris 2: Sosial media (hanya jika ada) -->
    <?php $hasSocials = array_filter($socials, fn($s) => ! empty($s['url']) && $s['url'] !== '#'); ?>
    <?php if ($hasSocials) : ?>
        <div class="portal-footer-socials">
            <?php foreach ($socials as $soc) : ?>
                <?php if (! empty($soc['url']) && $soc['url'] !== '#') : ?>
                    <a href="<?= esc($soc['url']) ?>" class="portal-footer-link"
                       target="_blank" rel="noopener noreferrer">
                        <i class="bi <?= esc($soc['icon']) ?>"></i> <?= esc($soc['label']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</footer>

<script>
(function () {
    const items = document.querySelectorAll('.portal-item-has-dropdown');
    
    items.forEach(item => {
        item.addEventListener('click', function(e) {
            // If clicking a link inside the dropdown, don't toggle
            if (e.target.closest('a')) return;
            
            e.stopPropagation();
            
            const isActive = this.classList.contains('active');
            
            // Close others
            items.forEach(el => el.classList.remove('active'));
            
            if (!isActive) {
                this.classList.add('active');
            }
        });

        // Accessibility
        item.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.portal-item-has-dropdown')) {
            items.forEach(el => el.classList.remove('active'));
        }
    });

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            items.forEach(el => el.classList.remove('active'));
        }
    });
})();
</script>

</body>
</html>

