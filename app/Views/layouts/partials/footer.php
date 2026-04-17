<?php
$footerData = $footerData ?? [];
$agency = $footerData['agency'] ?? [];
$informationLinks = $footerData['informationLinks'] ?? [];
$socialLinks = $footerData['socialLinks'] ?? [];
$stats = $footerData['stats'] ?? [];
$copyright = $footerData['copyright'] ?? '';
?>

<footer class="custom-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-card">
                    <div class="icon-box"><i class="bi bi-building"></i></div>
                    <h5 class="fw-bold mb-4"><?= esc($agency['name'] ?? '-') ?></h5>
                    <?php foreach ($agency['contacts'] ?? [] as $contact): ?>
                        <div class="contact-item">
                            <i class="bi <?= esc($contact['icon'] ?? '') ?>"></i>
                            <span><?= esc($contact['text'] ?? '') ?></span>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-card">
                    <div class="icon-box"><i class="bi bi-info-square"></i></div>
                    <h5 class="fw-bold mb-4">Informasi</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($informationLinks as $link): ?>
                            <li>
                                <a href="<?= esc($link['url'] ?? '#') ?>">
                                    <i class="bi bi-circle-fill me-2 footer-link-bullet"></i>
                                    <?= esc($link['label'] ?? '') ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-card">
                    <div class="icon-box"><i class="bi bi-globe"></i></div>
                    <h5 class="fw-bold mb-4">Media Sosial</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($socialLinks as $social): ?>
                            <li>
                                <a href="<?= esc($social['url'] ?? '#') ?>">
                                    <i class="bi <?= esc($social['icon'] ?? '') ?> me-3"></i>
                                    <?= esc($social['label'] ?? '') ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="stat-box">
            <div class="row g-3">
                <?php foreach ($stats as $stat): ?>
                    <div class="col-6 col-md-2">
                        <div class="stat-icon <?= esc($stat['colorClass'] ?? 'stat-color-blue') ?>">
                            <i class="bi <?= esc($stat['icon'] ?? '') ?>"></i>
                        </div>
                        <small class="d-block stat-label"><?= esc($stat['label'] ?? '') ?></small>
                        <h4 class="fw-bold mt-1 <?= !empty($stat['small']) ? 'stat-value-small' : '' ?>">
                            <?= esc($stat['value'] ?? '') ?>
                        </h4>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; <?= esc($copyright) ?></p>
        </div>
    </div>
</footer>