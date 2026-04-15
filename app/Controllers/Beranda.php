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
                    ['nama' => 'Alur Permohonan', 'link' => base_url('informasi/alur-permohonan')],
                    ['nama' => 'Form Permohonan', 'link' => base_url('informasi/form-permohonan')],
                    ['nama' => 'Form Keberatan', 'link' => base_url('informasi/form-keberatan')],
                    ['nama' => 'Daftar Informasi Publik', 'link' => base_url('informasi/daftar-informasi')],
                    ['nama' => 'Informasi Dikecualikan', 'link' => base_url('informasi/informasi-dikecualikan')],
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
        ];

        return view('public/index', $data);
    }
}
