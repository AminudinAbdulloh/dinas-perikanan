<?php

namespace App\Controllers;

class Beranda extends BaseController
{
    public function index(): string
    {
        $data['menu_navigasi'] = [
            [
                'nama' => 'Beranda',
                'link' => base_url('/'),
                'aktif' => 'home'
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
                ]
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
                ]
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
                        ]
                    ],
                    ['nama' => 'Berita', 'link' => base_url('berita')],
                ]
            ],
            [
                'nama' => 'Galeri',
                'link' => '#',
                'aktif' => 'galeri',
                'submenu' => [
                    ['nama' => 'Foto', 'link' => base_url('galeri/foto')],
                    ['nama' => 'Video', 'link' => base_url('galeri/video')],
                ]
            ],
            [
                'nama' => 'Menu Lainnya',
                'link' => '#',
                'aktif' => 'lainnya',
                'submenu' => [
                    ['nama' => 'FAQ', 'link' => base_url('faq')],
                    ['nama' => 'Kebijakan Privasi', 'link' => base_url('kebijakan-privasi')],
                ]
            ],
        ];

        $data['services'] = [
            [
                'icon' => 'bi-clipboard-check',
                'title' => 'Alur Permohonan Informasi Publik',
                'description' => 'Panduan dan prosedur pengajuan permohonan informasi publik',
                'link' => 'informasi/alur-permohonan'
            ],
            [
                'icon' => 'bi-file-earmark-text',
                'title' => 'Form Permohonan Informasi',
                'description' => 'Formulir pengajuan permohonan informasi publik secara online',
                'link' => 'informasi/form-permohonan'
            ],
            [
                'icon' => 'bi-shield-exclamation',
                'title' => 'Form Keberatan Informasi',
                'description' => 'Formulir pengajuan keberatan atas permohonan informasi',
                'link' => 'informasi/form-keberatan'
            ],
            [
                'icon' => 'bi-folder2-open',
                'title' => 'Daftar Informasi Publik',
                'description' => 'Katalog dan daftar informasi publik yang tersedia',
                'link' => 'informasi/daftar-informasi'
            ],
            [
                'icon' => 'bi-lock',
                'title' => 'Daftar Informasi Dikecualikan',
                'description' => 'Informasi publik yang dikecualikan dari layanan informasi',
                'link' => 'informasi/informasi-dikecualikan'
            ],
            [
                'icon' => 'bi-clock-history',
                'title' => 'Informasi Setiap Saat',
                'description' => 'Informasi publik yang dapat diakses setiap saat',
                'link' => 'informasi/informasi-setiap-saat'
            ],
            [
                'icon' => 'bi-calendar-event',
                'title' => 'Informasi Berkala',
                'description' => 'Informasi publik yang disediakan secara berkala',
                'link' => 'informasi/informasi-berkala'
            ],
            [
                'icon' => 'bi-bar-chart-line',
                'title' => 'Laporan Layanan Informasi',
                'description' => 'Laporan dan statistik layanan informasi publik',
                'link' => 'informasi/laporan-layanan'
            ],
        ];

        $data['newsList'] = [
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

        return view('public/index', $data);
    }
}
