<style>
    :root {
        --footer-bg: #f1f5f9;
        --footer-text: #0f172a;
        --footer-card-bg: #ffffff;
        --footer-muted: #64748b;
        --footer-link: #475569;
        --footer-divider: #e2e8f0;
        --footer-stat-bg: #ffffff;
        --footer-copyright: #64748b;
    }

    [data-bs-theme="dark"] {
        --footer-bg: #030712;
        --footer-text: #ffffff;
        --footer-card-bg: #1f2937;
        --footer-muted: #9ca3af;
        --footer-link: #9ca3af;
        --footer-divider: #1f2937;
        --footer-stat-bg: #1f2937;
        --footer-copyright: #6b7280;
    }

    .custom-footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
        padding: 60px 0 20px 0;
        border-top: 1px solid var(--footer-divider);
    }

    .footer-card {
        background-color: var(--footer-card-bg);
        border: 1px solid transparent;
        border-radius: 12px;
        padding: 25px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .footer-card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        border-color: #0d6efd;
        transform: translateY(-5px);
    }

    [data-bs-theme="dark"] .footer-card:hover {
        background-color: #253042;
    }

    .icon-box {
        width: 56px;
        height: 56px;
        background-color: #c7dfff;
        color: #0d6efd;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        font-size: 1.5rem;
        line-height: 1;
    }

    .footer-card:hover .icon-box {
        background-color: #2563eb;
        color: #fff;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 12px;
        font-size: 0.9rem;
        color: var(--footer-muted);
    }

    .contact-item i {
        margin-right: 15px;
        color: #3b82f6;
    }

    .stat-box {
        background-color: var(--footer-stat-bg);
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        margin-top: 30px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px auto;
        color: white;
        font-size: 1.2rem;
    }

    .list-unstyled li {
        margin-bottom: 10px;
    }

    .list-unstyled a {
        text-decoration: none;
        color: var(--footer-link);
        transition: 0.3s;
    }

    .list-unstyled a:hover {
        color: #3b82f6;
    }

    .copyright {
        text-align: center;
        color: var(--footer-copyright);
        font-size: 0.85rem;
        margin-top: 40px;
    }

    .stat-label {
        color: var(--footer-muted) !important;
    }
</style>

<footer class="custom-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-card">
                    <div class="icon-box"><i class="bi bi-building"></i></div>
                    <h5 class="fw-bold mb-4">Dinas Kelautan dan Perikanan - Daerah Istimewa Yogyakarta</h5>
                    <div class="contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>Jalan Sagan No. III/4, Kelurahan Terban, Kemantren Gondokusuman, Kota Yogyakarta, DIY
                            55223</span>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-envelope"></i>
                        <span>dislautkan@jogjaprov.go.id</span>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone"></i>
                        <span>(0274) 512386</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-card">
                    <div class="icon-box"><i class="bi bi-info-square"></i></div>
                    <h5 class="fw-bold mb-4">Informasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="bi bi-circle-fill me-2"
                                    style="font-size: 0.5rem; color: #3b82f6;"></i> Berita Terbaru</a></li>
                        <li><a href="#"><i class="bi bi-circle-fill me-2"
                                    style="font-size: 0.5rem; color: #3b82f6;"></i> Galeri Foto</a></li>
                        <li><a href="#"><i class="bi bi-circle-fill me-2"
                                    style="font-size: 0.5rem; color: #3b82f6;"></i> Galeri Video</a></li>
                        <li><a href="#"><i class="bi bi-circle-fill me-2"
                                    style="font-size: 0.5rem; color: #3b82f6;"></i> Pemberitahuan Privasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-card">
                    <div class="icon-box"><i class="bi bi-globe"></i></div>
                    <h5 class="fw-bold mb-4">Media Sosial</h5>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="bi bi-instagram me-3"></i> Instagram</a></li>
                        <li><a href="#"><i class="bi bi-youtube me-3"></i> YouTube</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="stat-box">
            <div class="row g-3">
                <div class="col-6 col-md-2">
                    <div class="stat-icon" style="background-color: #3b82f6;"><i class="bi bi-people"></i></div>
                    <small class="d-block stat-label">Pengunjung Hari Ini</small>
                    <h4 class="fw-bold mt-1">6</h4>
                </div>
                <div class="col-6 col-md-2">
                    <div class="stat-icon" style="background-color: #10b981;"><i class="bi bi-file-earmark-text"></i>
                    </div>
                    <small class="d-block stat-label">Views Hari Ini</small>
                    <h4 class="fw-bold mt-1">24</h4>
                </div>
                <div class="col-6 col-md-2">
                    <div class="stat-icon" style="background-color: #f59e0b;"><i class="bi bi-people-fill"></i></div>
                    <small class="d-block stat-label">Pengunjung 7 Hari</small>
                    <h4 class="fw-bold mt-1">121</h4>
                </div>
                <div class="col-6 col-md-2">
                    <div class="stat-icon" style="background-color: #a855f7;"><i class="bi bi-bar-chart-line"></i></div>
                    <small class="d-block stat-label">Total Pengunjung</small>
                    <h4 class="fw-bold mt-1">4.350</h4>
                </div>
                <div class="col-6 col-md-2">
                    <div class="stat-icon" style="background-color: #6366f1;"><i class="bi bi-eye"></i></div>
                    <small class="d-block stat-label">Total Views</small>
                    <h4 class="fw-bold mt-1">35.232</h4>
                </div>
                <div class="col-6 col-md-2">
                    <div class="stat-icon" style="background-color: #14b8a6;"><i class="bi bi-clock"></i></div>
                    <small class="d-block stat-label">Terakhir Diperbarui</small>
                    <h4 class="fw-bold mt-1" style="font-size: 1.1rem;">16 Apr 2026</h4>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; 2026 Dislautkan D.I. Yogyakarta. All rights reserved.</p>
        </div>
    </div>
</footer>