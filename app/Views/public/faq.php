<?= $this->extend('layouts/template_public') ?>

<?= $this->section('title') ?><?= esc($pageData['title'] ?? 'FAQ') ?> - Dinas Kelautan dan Perikanan Papua Tengah<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('css/public-page.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/faq-public.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="public-page-wrapper">
    <?= $this->include('public/partials/hero_header') ?>

    <section class="public-page-content">
        <div class="container px-sm-5 px-lg-0">
            <div class="content-card">
                <div class="faq-section">

                    <div class="faq-intro">
                        <div class="faq-intro-icon">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <h2>Pertanyaan yang Sering Diajukan</h2>
                        <p>Temukan jawaban atas pertanyaan umum terkait layanan Dinas Kelautan dan Perikanan Provinsi Papua Tengah.</p>
                    </div>

                    <?php if (($faqs ?? []) === []) : ?>
                        <div class="faq-empty">
                            <div class="faq-empty-icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <h3>Belum ada FAQ</h3>
                            <p>Pertanyaan yang sering diajukan belum tersedia saat ini.</p>
                        </div>
                    <?php else : ?>
                        <div class="faq-accordion" id="faqAccordion">
                            <?php foreach ($faqs as $idx => $faq) : ?>
                                <div class="faq-item" id="faq-item-<?= $idx ?>">
                                    <button
                                        type="button"
                                        class="faq-question"
                                        aria-expanded="false"
                                        aria-controls="faq-answer-<?= $idx ?>"
                                        onclick="toggleFaq(<?= $idx ?>)"
                                    >
                                        <span class="faq-q-number"><?= $idx + 1 ?></span>
                                        <span class="faq-q-text"><?= esc((string) ($faq['question'] ?? '')) ?></span>
                                        <span class="faq-q-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </span>
                                    </button>
                                    <div class="faq-answer" id="faq-answer-<?= $idx ?>" role="region">
                                        <div class="faq-answer-inner">
                                            <p><?= nl2br(esc((string) ($faq['answer'] ?? ''))) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function toggleFaq(index) {
    const item = document.getElementById('faq-item-' + index);
    const btn = item.querySelector('.faq-question');
    const isActive = item.classList.contains('active');

    // Close all items
    document.querySelectorAll('.faq-item').forEach(function(el) {
        el.classList.remove('active');
        el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
    });

    // Toggle clicked item
    if (!isActive) {
        item.classList.add('active');
        btn.setAttribute('aria-expanded', 'true');
    }
}
</script>
<?= $this->endSection() ?>
