<?php

declare(strict_types=1);

use App\Models\NewsArticleModel;

/** @var array<string, mixed>|null $article */
$a = $article ?? [];
$isEdit = $article !== null;
$statusOld = old('status', $isEdit ? ((int) ($a['is_published'] ?? 0) === 1 ? 'publish' : 'draft') : 'draft');
$currentImg = old('current_image', (string) ($a['image'] ?? ''));
?>

<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('title') ?><?= $isEdit ? 'Edit Berita' : 'Tambah Berita' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-page-header mb-4">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/konten/berita') ?>">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
    <h1 class="h3 fw-bold text-body mb-1"><?= $isEdit ? 'Edit Berita' : 'Tambah Berita Baru' ?></h1>
    <p class="text-secondary mb-0">
        Tanggal tampil di situs mengikuti waktu artikel pertama kali dibuat. Jumlah tayangan dihitung otomatis dari kunjungan pembaca.
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
        <form method="post" action="<?= esc($formAction, 'attr') ?>" enctype="multipart/form-data" data-berita-editor novalidate>
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Judul</label>
                <input type="text" class="form-control form-control-lg rounded-3" id="title" name="title" required
                    maxlength="255" value="<?= esc(old('title', (string) ($a['title'] ?? ''))) ?>">
            </div>

            <div class="mb-4">
                <label for="excerpt" class="form-label fw-semibold">Ringkasan</label>
                <textarea class="form-control rounded-3" id="excerpt" name="excerpt" rows="3" maxlength="2000"
                    placeholder="Tampil di kartu berita dan daftar"><?= esc(old('excerpt', (string) ($a['excerpt'] ?? ''))) ?></textarea>
            </div>

            <div class="mb-4">
                <label for="featured_image" class="form-label fw-semibold">Gambar utama</label>
                <input type="file" class="form-control rounded-3" id="featured_image" name="featured_image" accept="image/jpeg,image/png,image/webp,image/gif,.jpg,.jpeg,.png,.webp,.gif"
                    <?= $isEdit ? '' : 'required' ?>>
                <div class="form-text">Format JPG, PNG, WebP, atau GIF. Maksimal 5MB.<?= $isEdit ? ' Kosongkan jika tidak ingin mengganti gambar.' : '' ?></div>
                <?php if ($isEdit && $currentImg !== '') : ?>
                    <input type="hidden" name="current_image" value="<?= esc($currentImg, 'attr') ?>">
                    <div class="mt-3 border rounded-3 p-2 d-inline-block bg-body-tertiary">
                        <p class="small text-secondary mb-2">Gambar saat ini:</p>
                        <img src="<?= esc(NewsArticleModel::publicImageUrl($currentImg), 'attr') ?>" alt="" class="rounded-3" style="max-width: 280px; max-height: 180px; object-fit: cover;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="author" class="form-label fw-semibold">Penulis</label>
                <input type="text" class="form-control rounded-3" id="author" name="author" maxlength="120"
                    value="<?= esc(old('author', (string) ($a['author'] ?? ''))) ?>">
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-semibold">Isi berita</label>
                <textarea class="form-control rounded-3 admin-richtext-source" id="content" name="content" rows="14"><?php
                    $body = old('content', (string) ($a['content'] ?? ''), false);
                    if ($body !== '' && ! is_html_string($body)) {
                        $body = plain_text_to_editor_html($body);
                    }
                    echo $body;
                ?></textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select class="form-select form-select-lg rounded-3" id="status" name="status" required>
                    <option value="draft" <?= $statusOld === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="publish" <?= $statusOld === 'publish' ? 'selected' : '' ?>>Terbit</option>
                </select>
                <div class="form-text">Draft tidak tampil di situs publik. Terbit akan menampilkan artikel di beranda dan halaman berita.</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-check2-circle me-1"></i>Simpan
                </button>
                <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('admin/konten/berita') ?>">Kembali</a>
                <?php if ($isEdit && (int) ($a['is_published'] ?? 0) === 1) : ?>
                    <a class="btn btn-outline-secondary rounded-3" href="<?= base_url('berita/' . (int) $a['id']) ?>"
                        target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di situs
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script>
(function () {
    const form = document.querySelector('form[data-berita-editor]');
    if (!form) return;
    const uploadUrl = '<?= base_url('admin/konten/upload-image') ?>';
    const deleteImageUrl = '<?= base_url('admin/konten/delete-image') ?>';

    tinymce.init({
        selector: '#content',
        height: 520,
        menubar: true,
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
            'pagebreak', 'nonbreaking', 'emoticons',
        ].join(' '),
        toolbar: [
            'undo redo | blocks | bold italic underline strikethrough subscript superscript | removeformat removefont',
            'fontfamily fontsize lineheight | forecolor backcolor | emoticons',
            'alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | hr',
            'table | link image media | charmap pagebreak nonbreaking',
            'fullscreen code preview | help',
        ].join(' | '),
        block_formats: 'Paragraf=p; Judul 2=h2; Judul 3=h3; Judul 4=h4; Judul 5=h5; Judul 6=h6',
        font_family_formats: 'Public Sans=Public Sans,system-ui,sans-serif;Arial=arial,helvetica,sans-serif;Georgia=georgia,serif;Times New Roman=times new roman,times,serif;Verdana=verdana,geneva,sans-serif;Courier New=courier new,monospace;',
        font_size_formats: '8pt 10pt 11pt 12pt 14pt 15pt 16pt 18pt 20pt 24pt 28pt 32pt 36pt',
        line_height_formats: '1 1.15 1.3 1.5 1.75 2 2.5 3',
        link_default_protocol: 'https',
        relative_urls: false,
        remove_script_host: false,
        image_title: true,
        image_description: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', uploadUrl);
            xhr.withCredentials = true;
            xhr.upload.onprogress = (event) => {
                if (event.lengthComputable) {
                    progress((event.loaded / event.total) * 100);
                }
            };
            xhr.onload = () => {
                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('Upload gagal. Coba lagi.');
                    return;
                }
                let json = null;
                try { json = JSON.parse(xhr.responseText); } catch (e) {
                    reject('Respons upload tidak valid.');
                    return;
                }
                if (!json || typeof json.location !== 'string') {
                    reject((json && json.error) ? json.error : 'Upload gagal.');
                    return;
                }
                resolve(json.location);
            };
            xhr.onerror = () => reject('Koneksi upload gagal.');
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }),
        media_live_embeds: true,
        color_cols: 10,
        color_map: [
            '000000','Hitam','1f2937','Slate 800','374151','Slate 700','6b7280','Slate 500',
            '9ca3af','Slate 400','d1d5db','Slate 300','e5e7eb','Slate 200','f3f4f6','Slate 100',
            'ffffff','Putih','ef4444','Merah','f97316','Oranye','f59e0b','Amber','eab308','Kuning',
            '84cc16','Lime','22c55e','Hijau','14b8a6','Teal','06b6d4','Cyan','0ea5e9','Sky',
            '3b82f6','Biru','6366f1','Indigo','8b5cf6','Ungu','a855f7','Violet','d946ef','Fuchsia',
            'ec4899','Pink','f43f5e','Rose','7c2d12','Coklat','064e3b','Hijau tua',
            '0c4a6e','Biru tua','312e81','Indigo tua',
        ],
        content_css: [
            'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap',
        ],
        content_style: 'body { font-family: "Public Sans", system-ui, sans-serif; font-size: 15px; line-height: 1.65; margin: 1rem; max-width: 52rem; }',
        extended_valid_elements: 'iframe[src|width|height|frameborder|allowfullscreen|title|loading|referrerpolicy|sandbox|class],img[src|alt|title|width|height|loading|class],span[style|class]',
        setup: function (editor) {
            editor.ui.registry.addButton('removefont', {
                tooltip: 'Hapus gaya font',
                text: 'Remove font style',
                onAction: function () {
                    editor.formatter.remove('fontname');
                    editor.formatter.remove('fontsize');
                    editor.formatter.remove('lineheight');
                    editor.execCommand('RemoveFormat');
                },
            });
            editor.on('change input undo redo', function () {
                editor.save();
            });
            let _prevEditorImages = [];
            const getEditorImages = () =>
                editor.dom.select('img')
                    .map(img => img.getAttribute('src') || '')
                    .filter(src => src.includes('/uploads/editor/'));
            editor.on('init', function () {
                _prevEditorImages = getEditorImages();
            });
            editor.on('change undo redo', function () {
                const current = getEditorImages();
                const removed = _prevEditorImages.filter(src => !current.includes(src));
                removed.forEach(src => {
                    fetch(deleteImageUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        credentials: 'same-origin',
                        body: JSON.stringify({ src }),
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.deleted) {
                            console.info('[Editor] File dihapus dari server:', data.filename);
                        }
                    })
                    .catch(() => { });
                });
                _prevEditorImages = current;
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
