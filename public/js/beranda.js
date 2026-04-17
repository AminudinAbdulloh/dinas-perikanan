/**
 * Beranda (Homepage) - Video Player Modal
 *
 * Menangani klik pada kartu video untuk membuka YouTube di dalam modal Bootstrap.
 */
document.addEventListener('DOMContentLoaded', function () {
    const videoModalEl = document.getElementById('videoPlayerModal');
    const playerFrame = document.getElementById('youtubePlayerFrame');
    const modalTitle = document.getElementById('videoPlayerModalLabel');
    const triggers = document.querySelectorAll('.js-video-trigger');

    if (!videoModalEl || !playerFrame || !modalTitle || !triggers.length) {
        return;
    }

    if (typeof bootstrap === 'undefined') {
        console.warn('Bootstrap JS belum dimuat. Video modal tidak akan berfungsi.');
        return;
    }

    const videoModal = new bootstrap.Modal(videoModalEl);

    /**
     * Membangun URL embed YouTube dengan parameter autoplay.
     *
     * @param {string} youtubeId
     * @returns {string}
     */
    function buildEmbedUrl(youtubeId) {
        return 'https://www.youtube.com/embed/' + encodeURIComponent(youtubeId) + '?autoplay=1&rel=0';
    }

    /**
     * Membuka modal dan memuat video yang dipilih.
     *
     * @param {Event} event
     */
    function onVideoTriggerClick(event) {
        event.preventDefault();

        const youtubeId = this.dataset.youtubeId;
        const videoTitle = this.dataset.videoTitle || 'Video';

        if (!youtubeId) {
            return;
        }

        modalTitle.textContent = videoTitle;
        playerFrame.src = buildEmbedUrl(youtubeId);

        videoModal.show();
    }

    /**
     * Menghentikan video dan mereset modal saat ditutup.
     */
    function onModalHidden() {
        playerFrame.src = '';
        modalTitle.textContent = 'Video';
    }

    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', onVideoTriggerClick);
    });

    videoModalEl.addEventListener('hidden.bs.modal', onModalHidden);
});