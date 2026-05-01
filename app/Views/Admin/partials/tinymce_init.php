<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '<?= $selector ?? "#editor" ?>',
        height: <?= $height ?? 500 ?>,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | link image media table | help',
        content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:16px; line-height: 1.6; }',
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_url: '<?= base_url("admin/konten/upload-image") ?>',
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = function() {
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }
    });

    // Helper function to handle form submission with TinyMCE
    function syncTinyMCE() {
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }
    }
</script>
