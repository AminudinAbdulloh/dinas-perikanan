<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<style>
    .hero-section {
        position: relative;
        height: 600px;
        overflow: hidden;
    }

    .hero-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(30, 58, 138, 0.9), rgba(30, 64, 175, 0.8), transparent);
        z-index: -1;
    }

    .badge-custom {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: rgba(6, 182, 212, 0.2);
        border: 1px solid rgba(165, 243, 252, 0.3);
        border-radius: 50rem;
        color: #ecfeff;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-outline-white {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(4px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline-white:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    /* Services Section */
    .service-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
    }

    .service-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb15, #06b6d415);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #2563eb;
        flex-shrink: 0;
    }

    .section-padding {
        padding: 80px 0;
    }

    /* Card Style */
    .service-card {
        text-decoration: none;
        display: block;
        height: 100%;
        padding: 1.5rem;
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .service-card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
        border-color: var(--bs-blue-600) !important;
        transform: translateY(-5px);
    }

    /* Icon Container */
    .icon-box {
        width: 56px;
        height: 56px;
        background-color: #eff6ff;
        color: var(--bs-blue-600);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .service-card:hover .icon-box {
        background-color: var(--bs-blue-600);
        color: #fff;
    }

    /* Text Hover */
    .service-card h3 {
        font-size: 1.125rem;
        color: #212529;
        transition: color 0.3s ease;
    }

    .service-card:hover h3 {
        color: var(--bs-blue-600);
    }

    .service-description {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    /* Dark Mode Support (Manual) */
    @media (prefers-color-scheme: dark) {
        body {
            background-color: #0f172a;
        }

        .service-card {
            background-color: #1e293b;
            border-color: #334155;
        }

        .service-card h3 {
            color: #f8fafc;
        }

        .service-description {
            color: #94a3b8;
        }

        .icon-box {
            background-color: rgba(37, 99, 235, 0.1);
            color: #60a5fa;
        }

        .text-dark-white {
            color: white !important;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <img src="https://images.unsplash.com/photo-1689505630546-bebf6e52dce2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080"
        alt="Perikanan Papua Tengah" class="hero-bg-img">
    <div class="hero-overlay"></div>

    <div class="container px-4 px-lg-5">
        <div class="row">
            <div class="col-lg-8 animate-up">
                <div class="mb-4">
                    <span class="badge-custom">Pemerintah Provinsi Papua Tengah</span>
                </div>
                <h1 class="display-4 fw-bold text-white mb-4">
                    Dinas Kelautan dan Perikanan Provinsi Papua Tengah
                </h1>
                <p class="lead text-light mb-5 fs-5">
                    Mengelola dan mengembangkan potensi perikanan dan kelautan untuk kesejahteraan masyarakat Papua
                    Tengah
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#layanan" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="bi bi-grid me-2"></i>Layanan Publik
                    </a>
                    <a href="<?= base_url('profil/sejarah') ?>" class="btn btn-outline-white btn-lg px-4 py-3">
                        <i class="bi bi-info-circle me-2"></i>Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="layanan" class="section-padding">
    <div class="container px-4 px-lg-5">

        <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
            <h2 class="fw-bold display-6 mb-3 text-dark-white">Layanan Utama</h2>
            <p class="text-muted fs-5">
                Layanan Informasi Publik Dinas Perikanan dan Kelautan Papua Tengah
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/alur-permohonan" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-clipboard-check fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Alur Permohonan Informasi Publik</h3>
                    <p class="service-description">Panduan dan prosedur pengajuan permohonan informasi publik</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/form-permohonan" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-file-earmark-text fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Form Permohonan Informasi</h3>
                    <p class="service-description">Formulir pengajuan permohonan informasi publik secara online</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/form-keberatan" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-shield-exclamation fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Form Keberatan Informasi</h3>
                    <p class="service-description">Formulir pengajuan keberatan atas permohonan informasi</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/daftar-informasi" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-file-earmark-search fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Daftar Informasi Publik</h3>
                    <p class="service-description">Katalog dan daftar informasi publik yang tersedia</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/informasi-dikecualikan" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-lock fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Daftar Informasi Dikecualikan</h3>
                    <p class="service-description">Informasi publik yang dikecualikan dari layanan informasi</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/informasi-setiap-saat" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Informasi Setiap Saat</h3>
                    <p class="service-description">Informasi publik yang dapat diakses setiap saat</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/informasi-berkala" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-calendar-event fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Informasi Berkala</h3>
                    <p class="service-description">Informasi publik yang disediakan secara berkala</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="/informasi/laporan-layanan" class="service-card shadow-sm">
                    <div class="icon-box">
                        <i class="bi bi-bar-chart-line fs-3"></i>
                    </div>
                    <h3 class="fw-bold">Laporan Layanan Informasi</h3>
                    <p class="service-description">Laporan dan statistik layanan informasi publik</p>
                </a>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>