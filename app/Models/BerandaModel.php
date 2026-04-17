<?php

namespace App\Models;

/**
 * BerandaModel
 *
 * Menyediakan data statis untuk halaman beranda.
 * Nantinya dapat diganti dengan query database.
 */
class BerandaModel
{
    /**
     * Data menu navigasi utama untuk navbar public.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getPublicNavigationMenu(): array
    {
        return [
            [
                'nama' => 'Beranda',
                'link' => base_url('/'),
                'aktif' => 'home',
            ],
            [
                'nama' => 'Profil',
                'link' => '#',
                'aktif' => 'profil',
                'submenu' => [
                    ['nama' => 'Sejarah', 'link' => base_url('profil/sejarah')],
                    ['nama' => 'Visi dan Misi', 'link' => base_url('profil/visi-misi')],
                    ['nama' => 'Tugas Pokok dan Fungsi', 'link' => base_url('profil/tupoksi')],
                    ['nama' => 'Struktur Organisasi', 'link' => base_url('profil/struktur')],
                    ['nama' => 'Profil Pejabat Struktural', 'link' => base_url('profil/pejabat')],
                    ['nama' => 'Daftar Pegawai', 'link' => base_url('profil/pegawai')],
                    ['nama' => 'Alamat dan Kontak', 'link' => base_url('profil/kontak')],
                ],
            ],
            [
                'nama' => 'Program',
                'link' => '#',
                'aktif' => 'program',
                'submenu' => [
                    ['nama' => 'Rencana Strategis', 'link' => base_url('program/renstra')],
                    ['nama' => 'Rencana Kerja', 'link' => base_url('program/renja')],
                    ['nama' => 'Laporan Kinerja', 'link' => base_url('program/lakip')],
                    ['nama' => 'Perjanjian Kinerja', 'link' => base_url('program/pk')],
                ],
            ],
            [
                'nama' => 'Data & Informasi',
                'link' => '#',
                'aktif' => 'informasi',
                'submenu' => [
                    [
                        'nama' => 'Layanan Publik',
                        'link' => '#',
                        'submenu' => [
                            ['nama' => 'Alur Permohonan', 'link' => base_url('informasi/alur-permohonan')],
                            ['nama' => 'Form Permohonan', 'link' => base_url('informasi/form-permohonan')],
                            ['nama' => 'Form Keberatan', 'link' => base_url('informasi/form-keberatan')],
                            ['nama' => 'Daftar Informasi Publik', 'link' => base_url('informasi/daftar-informasi')],
                            ['nama' => 'Informasi Dikecualikan', 'link' => base_url('informasi/informasi-dikecualikan')],
                            ['nama' => 'Informasi Berkala', 'link' => base_url('informasi/informasi-berkala')],
                        ],
                    ],
                    ['nama' => 'Berita', 'link' => base_url('berita')],
                ],
            ],
            [
                'nama' => 'Galeri',
                'link' => '#',
                'aktif' => 'galeri',
                'submenu' => [
                    ['nama' => 'Foto', 'link' => base_url('galeri/foto')],
                    ['nama' => 'Video', 'link' => base_url('galeri/video')],
                ],
            ],
            [
                'nama' => 'Menu Lainnya',
                'link' => '#',
                'aktif' => 'lainnya',
                'submenu' => [
                    ['nama' => 'FAQ', 'link' => base_url('faq')],
                    ['nama' => 'Kebijakan Privasi', 'link' => base_url('kebijakan-privasi')],
                ],
            ],
        ];
    }

    /**
     * Data konten footer halaman public.
     *
     * @return array<string, mixed>
     */
    public function getPublicFooterData(): array
    {
        return [
            'agency' => [
                'icon' => 'bi-building',
                'name' => 'Dinas Kelautan dan Perikanan - Daerah Istimewa Yogyakarta',
                'contacts' => [
                    ['icon' => 'bi-geo-alt', 'text' => 'Sanoba, Distrik Nabire, Kabupaten Nabire, Papua Tengah 98816'],
                    ['icon' => 'bi-envelope', 'text' => 'dislautkan@papua.go.id'],
                    ['icon' => 'bi-telephone', 'text' => '(0123) 456789'],
                ],
            ],
            'informationLinks' => [
                ['label' => 'Berita Terbaru', 'url' => '#'],
                ['label' => 'Galeri Foto', 'url' => '#'],
                ['label' => 'Galeri Video', 'url' => '#'],
                ['label' => 'Pemberitahuan Privasi', 'url' => '#'],
            ],
            'socialLinks' => [
                ['icon' => 'bi-instagram', 'label' => 'Instagram', 'url' => '#'],
                ['icon' => 'bi-youtube', 'label' => 'YouTube', 'url' => '#'],
            ],
            'stats' => [
                ['icon' => 'bi-people', 'label' => 'Pengunjung Hari Ini', 'value' => '6', 'colorClass' => 'stat-color-blue'],
                ['icon' => 'bi-file-earmark-text', 'label' => 'Views Hari Ini', 'value' => '24', 'colorClass' => 'stat-color-green'],
                ['icon' => 'bi-people-fill', 'label' => 'Pengunjung 7 Hari', 'value' => '121', 'colorClass' => 'stat-color-amber'],
                ['icon' => 'bi-bar-chart-line', 'label' => 'Total Pengunjung', 'value' => '4.350', 'colorClass' => 'stat-color-purple'],
                ['icon' => 'bi-eye', 'label' => 'Total Views', 'value' => '35.232', 'colorClass' => 'stat-color-indigo'],
                ['icon' => 'bi-clock', 'label' => 'Terakhir Diperbarui', 'value' => '16 Apr 2026', 'colorClass' => 'stat-color-teal', 'small' => true],
            ],
            'copyright' => '2026 Dislautkan D.I. Yogyakarta. All rights reserved.',
        ];
    }

    /**
     * Daftar layanan utama yang ditampilkan di beranda.
     *
     * @return array<int, array<string, string>>
     */
    public function getServices(): array
    {
        return [
            [
                'icon' => 'bi-clipboard-check',
                'title' => 'Alur Permohonan Informasi Publik',
                'description' => 'Panduan dan prosedur pengajuan permohonan informasi publik',
                'link' => 'informasi/alur-permohonan',
            ],
            [
                'icon' => 'bi-file-earmark-text',
                'title' => 'Form Permohonan Informasi',
                'description' => 'Formulir pengajuan permohonan informasi publik secara online',
                'link' => 'informasi/form-permohonan',
            ],
            [
                'icon' => 'bi-shield-exclamation',
                'title' => 'Form Keberatan Informasi',
                'description' => 'Formulir pengajuan keberatan atas permohonan informasi',
                'link' => 'informasi/form-keberatan',
            ],
            [
                'icon' => 'bi-folder2-open',
                'title' => 'Daftar Informasi Publik',
                'description' => 'Katalog dan daftar informasi publik yang tersedia',
                'link' => 'informasi/daftar-informasi',
            ],
            [
                'icon' => 'bi-lock',
                'title' => 'Daftar Informasi Dikecualikan',
                'description' => 'Informasi publik yang dikecualikan dari layanan informasi',
                'link' => 'informasi/informasi-dikecualikan',
            ],
            [
                'icon' => 'bi-clock-history',
                'title' => 'Informasi Setiap Saat',
                'description' => 'Informasi publik yang dapat diakses setiap saat',
                'link' => 'informasi/informasi-setiap-saat',
            ],
            [
                'icon' => 'bi-calendar-event',
                'title' => 'Informasi Berkala',
                'description' => 'Informasi publik yang disediakan secara berkala',
                'link' => 'informasi/informasi-berkala',
            ],
            [
                'icon' => 'bi-bar-chart-line',
                'title' => 'Laporan Layanan Informasi',
                'description' => 'Laporan dan statistik layanan informasi publik',
                'link' => 'informasi/laporan-layanan',
            ],
        ];
    }

    /**
     * Daftar berita terkini untuk ditampilkan di beranda.
     *
     * @return array<int, array<string, int|string>>
     */
    public function getNewsList(): array
    {
        return [
            [
                'id' => 1,
                'date' => '5 April 2026',
                'title' => 'Penyerahan Bantuan Alat Tangkap kepada 200 Nelayan',
                'excerpt' => 'Gubernur Papua Tengah menyerahkan bantuan alat tangkap modern kepada nelayan di Kabupaten Nabire',
                'image' => 'https://images.unsplash.com/photo-1660278988532-d55143363abb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
            ],
            [
                'id' => 2,
                'date' => '28 Maret 2026',
                'title' => 'Pelatihan Budidaya Ikan Nila untuk Kelompok Tani',
                'excerpt' => 'Dinas menggelar pelatihan budidaya ikan nila sistem bioflok untuk 50 kelompok pembudidaya',
                'image' => 'https://images.unsplash.com/photo-1562656611-2b26567ccf19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwyfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
            ],
            [
                'id' => 3,
                'date' => '15 Maret 2026',
                'title' => 'Monitoring Kesehatan Terumbu Karang di Teluk Cenderawasih',
                'excerpt' => 'Tim survei melakukan monitoring kondisi ekosistem terumbu karang di kawasan konservasi',
                'image' => 'https://images.unsplash.com/photo-1724257154172-b7dcef926dea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxjb3JhbCUyMHJlZWYlMjB1bmRlcndhdGVyJTIwcGFwdWF8ZW58MXx8fHwxNzc1ODM3MDY2fDA&ixlib=rb-4.1.0&q=80&w=1080',
            ],
        ];
    }

    /**
     * Daftar foto galeri untuk ditampilkan di beranda.
     *
     * @return array<int, array<string, int|string>>
     */
    public function getGalleryPhotos(): array
    {
        return [
            [
                'id' => 1,
                'image' => 'https://images.unsplash.com/photo-1660278988532-d55143363abb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Armada Perikanan Tradisional',
                'category' => 'Perikanan Tangkap',
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1562656611-2b26567ccf19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwyfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Nelayan Papua Tengah',
                'category' => 'Profil Nelayan',
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1724257154172-b7dcef926dea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxjb3JhbCUyMHJlZWYlMjB1bmRlcndhdGVyJTIwcGFwdWF8ZW58MXx8fHwxNzc1ODM3MDY2fDA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Terumbu Karang Teluk Cenderawasih',
                'category' => 'Konservasi',
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1601699006891-c27e05b161c9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw1fHxmaXNoaW5nJTIwYm9hdCUyMGhhcmJvcnxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Pelabuhan Perikanan Nabire',
                'category' => 'Infrastruktur',
            ],
            [
                'id' => 5,
                'image' => 'https://images.unsplash.com/photo-1724257496887-d5012cdc9400?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw1fHxjb3JhbCUyMHJlZWYlMjB1bmRlcndhdGVyJTIwcGFwdWF8ZW58MXx8fHwxNzc1ODM3MDY2fDA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Keanekaragaman Hayati Laut',
                'category' => 'Konservasi',
            ],
            [
                'id' => 6,
                'image' => 'https://images.unsplash.com/photo-1689505630546-bebf6e52dce2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Aktivitas Penangkapan Ikan',
                'category' => 'Perikanan Tangkap',
            ],
            [
                'id' => 7,
                'image' => 'https://images.unsplash.com/photo-1582965637751-2c8cc0c164ce?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwzfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Dermaga Perikanan',
                'category' => 'Infrastruktur',
            ],
            [
                'id' => 8,
                'image' => 'https://images.unsplash.com/photo-1630546221335-bfbbe63f5e0a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw1fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'title' => 'Perjalanan Mencari Ikan',
                'category' => 'Perikanan Tangkap',
            ],
        ];
    }

    /**
     * Daftar video terbaru untuk ditampilkan di beranda.
     *
     * @return array<int, array<string, int|string>>
     */
    public function getLatestVideos(): array
    {
        return [
            [
                'id' => 1,
                'youtube_id' => 'N4lNE4MBJG8',
                'youtube_url' => 'https://youtu.be/N4lNE4MBJG8?si=iJgIJ2zXTzmsrp52',
                'title' => 'Profil Nelayan Papua Tengah',
                'duration' => '5:32',
                'date' => '2 April 2026',
            ],
            [
                'id' => 2,
                'youtube_id' => 'B2pCPefPba4',
                'youtube_url' => 'https://youtu.be/B2pCPefPba4?si=VG4HgLFILNfCqzF4',
                'title' => 'Konservasi Terumbu Karang Teluk Cenderawasih',
                'duration' => '8:15',
                'date' => '25 Maret 2026',
            ],
            [
                'id' => 3,
                'youtube_id' => 'eQwIKZhxdzc',
                'youtube_url' => 'https://youtu.be/eQwIKZhxdzc?si=tDVQ6nNY13VfxBku',
                'title' => 'Penyerahan Bantuan Kapal Perikanan',
                'duration' => '4:20',
                'date' => '18 Maret 2026',
            ],
            [
                'id' => 4,
                'youtube_id' => 'l4i_zI69klU',
                'youtube_url' => 'https://youtu.be/l4i_zI69klU?si=6glMP5KJb75Lv-5w',
                'title' => 'Pelatihan Budidaya Ikan Modern',
                'duration' => '6:45',
                'date' => '10 Maret 2026',
            ],
            [
                'id' => 5,
                'youtube_id' => 'dndRLICiZbU',
                'youtube_url' => 'https://youtu.be/dndRLICiZbU?si=zrJSKTjBh7lhCOAX',
                'title' => 'Pembangunan Pelabuhan Perikanan Baru',
                'duration' => '3:55',
                'date' => '5 Maret 2026',
            ],
            [
                'id' => 6,
                'youtube_id' => 'PlZaWP064KA',
                'youtube_url' => 'https://youtu.be/PlZaWP064KA?si=1n7rU7_4F_JAv7l0',
                'title' => 'Eksplorasi Kekayaan Laut Papua Tengah',
                'duration' => '7:10',
                'date' => '1 Maret 2026',
            ],
        ];
    }
}