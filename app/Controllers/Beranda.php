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

        return view('public/index', $data);
    }
}
