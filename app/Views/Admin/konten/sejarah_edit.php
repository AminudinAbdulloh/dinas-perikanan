<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?>Edit Sejarah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/sejarah') ?>">Sejarah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1">Edit Konten Sejarah</h1>
    <p class="text-secondary mb-0">
        Ubah judul, deskripsi, dan isi konten sejarah.
    </p>
</div>

<?php
$errs = session()->getFlashdata('errors');
if (is_array($errs) && $errs !== []) { ?>
    <div class="alert alert-danger rounded-3">
        <ul class="mb-0 ps-3">
            <?php foreach ($errs as $err) { ?>
                <li><?= esc(is_string($err) ? $err : (string) $err) ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">
        <form method="post" action="<?= base_url('admin/konten/sejarah/update') ?>" novalidate>
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Judul halaman</label>
                <input type="text" class="form-control form-control-lg rounded-3" id="title" name="title" required
                    maxlength="255" value="<?= esc(old('title', $page['title'] ?? '')) ?>">
            </div>

            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">Deskripsi singkat</label>
                <textarea class="form-control rounded-3" id="description" name="description" rows="2" maxlength="500"
                    placeholder="Muncul sebagai pengantar / meta deskripsi"><?= esc(old('description', $page['description'] ?? '')) ?></textarea>
                <div class="form-text">Maksimal 500 karakter.</div>
            </div>

            <div class="mb-4">
                <label for="body" class="form-label fw-semibold">Isi sejarah</label>
                <textarea class="form-control rounded-3 admin-richtext-source" id="body" name="body" rows="14"><?= old('body', $page['body'] ?? '', false) ?></textarea>
                <div class="form-text">
                    Kosongkan isi untuk memakai teks bawaan sistem sampai Anda mengisi dan menyimpan konten.
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/sejarah') ?>">
                    Kembali
                </a>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('profil/sejarah') ?>" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di situs
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script>
(function () {
    const form = document.querySelector('form[action*="konten/sejarah/update"]');
    if (!form) return;

    tinymce.init({
        selector: '#body',
        height: 520,
        menubar: false,
        license_key: 'gpl',
        branding: false,
        promotion: false,
        resize: true,
        toolbar_mode: 'wrap',
        toolbar_sticky: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount',
            'hr', 'pagebreak', 'nonbreaking', 'emoticons',
        ].join(' '),
        toolbar: [
            'undo redo | styles | bold italic underline strikethrough subscript superscript | removeformat',
            'fontfamily fontsize blocks | forecolor backcolor',
            'alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent',
            'table | link image media | charmap emoticons hr pagebreak nonbreaking',
            'fullscreen code preview | help',
        ].join(' | '),
        style_formats: [
            { title: 'Judul 2', format: 'h2' },
            { title: 'Judul 3', format: 'h3' },
            { title: 'Judul 4', format: 'h4' },
            { title: 'Paragraf', format: 'p' },
            { title: 'Kutipan', format: 'blockquote' },
            { title: 'Kode pratinjau', format: 'pre' },
        ],
        block_formats: 'Paragraf=p; Judul 2=h2; Judul 3=h3; Judul 4=h4; Judul 5=h5; Judul 6=h6',
        font_family_formats: 'Public Sans=Public Sans,system-ui,sans-serif;Arial=arial,helvetica,sans-serif;Georgia=georgia,serif;Times New Roman=times new roman,times,serif;Verdana=verdana,geneva,sans-serif;Courier New=courier new,monospace;',
        font_size_formats: '8pt 10pt 11pt 12pt 14pt 15pt 16pt 18pt 20pt 24pt 28pt 32pt 36pt',
        link_default_protocol: 'https',
        relative_urls: false,
        remove_script_host: false,
        image_title: true,
        image_description: true,
        automatic_uploads: false,
        media_live_embeds: true,
        content_css: [
            'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap',
        ],
        content_style: 'body { font-family: "Public Sans", system-ui, sans-serif; font-size: 15px; line-height: 1.65; margin: 1rem; max-width: 52rem; }',
        extended_valid_elements: 'iframe[src|width|height|frameborder|allowfullscreen|title|loading|referrerpolicy|sandbox|class],img[src|alt|title|width|height|loading|class],span[style|class]',
        setup: function (editor) {
            editor.on('change input undo redo', function () {
                editor.save();
            });
        },
    });

    form.addEventListener('submit', function () {
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }
    });
})();
</script>
<?= $this->endSection() ?>
