/**
 * Beranda (Homepage) Scripts
 *
 * 1. Hero Carousel — animasi konten slide via class .do-anim (no double-fire)
 * 2. Video Player Modal
 */
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       1. HERO CAROUSEL
       ============================================================ */
    (function () {
        var carouselEl = document.getElementById('heroCarousel');
        if (!carouselEl) return;

        /**
         * Trigger animasi fadeInUp pada .hero-anim-el di slide yang aktif.
         * Animasi HANYA dikontrol lewat class .do-anim — tidak ada CSS auto-play
         * di .hero-anim-el, sehingga tidak ada double-animation.
         */
        function playSlideAnim() {
            // Hapus do-anim dari semua element dulu
            carouselEl.querySelectorAll('.hero-anim-el').forEach(function (el) {
                el.classList.remove('do-anim');
            });

            var activeItem = carouselEl.querySelector('.carousel-item.active');
            if (!activeItem) return;

            var animEl = activeItem.querySelector('.hero-anim-el');
            if (!animEl) return;

            // Force reflow agar animasi restart dari awal
            void animEl.offsetWidth;
            animEl.classList.add('do-anim');
        }

        // Animasi slide pertama saat halaman dimuat
        playSlideAnim();

        // Animasi ulang setiap kali slide selesai berganti
        carouselEl.addEventListener('slid.bs.carousel', function () {
            playSlideAnim();
        });
    })();


    /* ============================================================
       2. VIDEO PLAYER MODAL
       ============================================================ */
    (function () {
        var videoModalEl = document.getElementById('videoPlayerModal');
        var playerFrame  = document.getElementById('youtubePlayerFrame');
        var modalTitle   = document.getElementById('videoPlayerModalLabel');
        var triggers     = document.querySelectorAll('.js-video-trigger');

        if (!videoModalEl || !playerFrame || !modalTitle || !triggers.length) return;

        if (typeof bootstrap === 'undefined') {
            console.warn('Bootstrap JS belum dimuat. Video modal tidak akan berfungsi.');
            return;
        }

        var videoModal = new bootstrap.Modal(videoModalEl);

        function buildEmbedUrl(id) {
            return 'https://www.youtube.com/embed/' + encodeURIComponent(id) + '?autoplay=1&rel=0';
        }

        function onTriggerClick(e) {
            e.preventDefault();
            var youtubeId = this.dataset.youtubeId;
            if (!youtubeId) return;
            modalTitle.textContent = this.dataset.videoTitle || 'Video';
            playerFrame.src = buildEmbedUrl(youtubeId);
            videoModal.show();
        }

        function onModalHidden() {
            playerFrame.src = '';
            modalTitle.textContent = 'Video';
        }

        triggers.forEach(function (t) { t.addEventListener('click', onTriggerClick); });
        videoModalEl.addEventListener('hidden.bs.modal', onModalHidden);
    })();

});