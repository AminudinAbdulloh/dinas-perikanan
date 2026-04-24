<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PublicInformationSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        $this->db->table('public_informations')->truncate();
        $this->db->table('publication_categories')->truncate();

        // ──────────────────────────────────────────────────────────────
        // 1. Publication Categories (Sub-Kategori Publikasi)
        // ──────────────────────────────────────────────────────────────
        $categories = [
            // Perencanaan
            ['name' => 'Renstra',                        'slug' => 'renstra',                        'publication_type' => 'perencanaan', 'sort_order' => 1],
            ['name' => 'Renja',                          'slug' => 'renja',                          'publication_type' => 'perencanaan', 'sort_order' => 2],
            ['name' => 'Perjanjian Kinerja',             'slug' => 'perjanjian-kinerja',             'publication_type' => 'perencanaan', 'sort_order' => 3],
            ['name' => 'Strategi',                       'slug' => 'strategi',                       'publication_type' => 'perencanaan', 'sort_order' => 4],

            // Keuangan
            ['name' => 'Laporan Keuangan',               'slug' => 'laporan-keuangan',               'publication_type' => 'keuangan', 'sort_order' => 1],
            ['name' => 'Aset dan Inventaris',            'slug' => 'aset-dan-inventaris',            'publication_type' => 'keuangan', 'sort_order' => 2],
            ['name' => 'LHKPN',                          'slug' => 'lhkpn',                          'publication_type' => 'keuangan', 'sort_order' => 3],

            // Pelaporan
            ['name' => 'Laporan Kinerja',                'slug' => 'laporan-kinerja',                'publication_type' => 'pelaporan', 'sort_order' => 1],
            ['name' => 'Laporan SKM',                    'slug' => 'laporan-skm',                    'publication_type' => 'pelaporan', 'sort_order' => 2],
            ['name' => 'Laporan Forum Konsultasi Publik','slug' => 'laporan-forum-konsultasi-publik','publication_type' => 'pelaporan', 'sort_order' => 3],
            ['name' => 'Laporan Implementasi Reformasi Birokrasi','slug' => 'laporan-implementasi-reformasi-birokrasi','publication_type' => 'pelaporan', 'sort_order' => 4],
            ['name' => 'Laporan PPID Pelaksana',         'slug' => 'laporan-ppid-pelaksana',         'publication_type' => 'pelaporan', 'sort_order' => 5],
            ['name' => 'Laporan Capaian Program dan Kegiatan','slug' => 'laporan-capaian-program-dan-kegiatan','publication_type' => 'pelaporan', 'sort_order' => 6],
        ];

        $catIdMap = [];
        foreach ($categories as $cat) {
            $cat['created_at'] = date('Y-m-d H:i:s');
            $cat['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('publication_categories')->insert($cat);
            $catIdMap[$cat['slug']] = $this->db->insertID();
        }

        // ──────────────────────────────────────────────────────────────
        // 2. Public Informations (documents linked to sub-categories)
        // ──────────────────────────────────────────────────────────────
        $data = [
            // ── Informasi Berkala ──

            // Renstra
            [
                'category'                => 'berkala',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['renstra'],
                'title'                   => 'Rencana Strategis (Renstra) 2021-2026',
                'description'             => 'Dokumen perencanaan pembangunan jangka menengah sektor kelautan dan perikanan.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap 5 tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'berkala',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['renstra'],
                'title'                   => 'Renstra 2016-2021',
                'description'             => 'Rencana strategis periode sebelumnya.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap 5 tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2021,
            ],

            // Renja
            [
                'category'                => 'berkala',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['renja'],
                'title'                   => 'Rencana Kerja (Renja) Tahun 2025',
                'description'             => 'Program kerja tahunan sebagai turunan dari Renstra dan prioritas daerah.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2025,
            ],
            [
                'category'                => 'berkala',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['renja'],
                'title'                   => 'Rencana Kerja (Renja) Tahun 2024',
                'description'             => 'Renja tahun anggaran 2024.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],

            // Perjanjian Kinerja
            [
                'category'                => 'berkala',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['perjanjian-kinerja'],
                'title'                   => 'Perjanjian Kinerja Tahun 2025',
                'description'             => 'Komitmen target kinerja antara pimpinan unit kerja dan kepala dinas.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2025,
            ],

            // Laporan Keuangan
            [
                'category'                => 'berkala',
                'publication_type'        => 'keuangan',
                'publication_category_id' => $catIdMap['laporan-keuangan'],
                'title'                   => 'Laporan Keuangan Semester I 2025',
                'description'             => 'Laporan realisasi keuangan dinas semester pertama.',
                'responsible_party'       => 'Sub Bag Keuangan',
                'time_period'             => 'Setiap 6 bulan',
                'information_format'      => 'Softfile',
                'year'                    => 2025,
            ],
            [
                'category'                => 'berkala',
                'publication_type'        => 'keuangan',
                'publication_category_id' => $catIdMap['laporan-keuangan'],
                'title'                   => 'Laporan Keuangan Tahun 2024',
                'description'             => 'Laporan realisasi keuangan dinas tahun 2024.',
                'responsible_party'       => 'Sub Bag Keuangan',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Cetak/Softfile',
                'year'                    => 2024,
            ],

            // Laporan Kinerja
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-kinerja'],
                'title'                   => 'Laporan Kinerja Tahun 2024',
                'description'             => 'Laporan Kinerja DKP 2024.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Cetak/Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-kinerja'],
                'title'                   => 'LKj DKP 2023',
                'description'             => 'LKj DKP 2023.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2023,
            ],
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-kinerja'],
                'title'                   => 'Laporan Kinerja Tahun 2022',
                'description'             => 'Laporan Kinerja Tahun 2022.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2022,
            ],
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-kinerja'],
                'title'                   => 'Laporan Kinerja Tahun 2021',
                'description'             => 'Laporan Kinerja Tahun 2021.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2021,
            ],

            // Laporan SKM
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-skm'],
                'title'                   => 'Laporan SKM Tahun 2024',
                'description'             => 'Survei Kepuasan Masyarakat tahun 2024.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],

            // Laporan PPID Pelaksana
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-ppid-pelaksana'],
                'title'                   => 'Laporan PPID Pelaksana 2024',
                'description'             => 'Laporan PPID Pelaksana tahun 2024.',
                'responsible_party'       => 'PPID Pelaksana',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],

            // Laporan Capaian Program
            [
                'category'                => 'berkala',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-capaian-program-dan-kegiatan'],
                'title'                   => 'Laporan Capaian Program dan Kegiatan 2024',
                'description'             => 'Capaian program dan kegiatan dinas tahun 2024.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap tahun',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],

            // ── Informasi Serta Merta ──
            [
                'category'                => 'serta-merta',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-kinerja'],
                'title'                   => 'Peringatan Dini Cuaca Buruk untuk Nelayan',
                'description'             => 'Informasi peringatan dini kondisi cuaca ekstrem yang berdampak pada keselamatan nelayan.',
                'responsible_party'       => 'Bidang Perikanan Tangkap',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Digital',
                'year'                    => 2024,
            ],
            [
                'category'                => 'serta-merta',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-skm'],
                'title'                   => 'Larangan Penggunaan Alat Tangkap Terlarang',
                'description'             => 'Informasi mengenai jenis alat tangkap yang dilarang penggunaannya sesuai regulasi.',
                'responsible_party'       => 'Bidang Pengawasan',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Cetak/Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'serta-merta',
                'publication_type'        => 'pelaporan',
                'publication_category_id' => $catIdMap['laporan-ppid-pelaksana'],
                'title'                   => 'Informasi Bencana Alam Pesisir',
                'description'             => 'Informasi tanggap darurat terkait bencana alam yang berdampak pada wilayah pesisir.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Digital',
                'year'                    => 2024,
            ],

            // ── Informasi Setiap Saat ──
            [
                'category'                => 'setiap-saat',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['renstra'],
                'title'                   => 'Daftar Peraturan Perundang-undangan Bidang Kelautan dan Perikanan',
                'description'             => 'Kumpulan regulasi dan peraturan yang berlaku di sektor kelautan dan perikanan.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'setiap-saat',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['strategi'],
                'title'                   => 'Prosedur Perizinan Usaha Perikanan',
                'description'             => 'Tahapan dan persyaratan pengajuan izin usaha perikanan tangkap dan budidaya.',
                'responsible_party'       => 'Bidang Perikanan Tangkap',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Cetak/Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'setiap-saat',
                'publication_type'        => 'perencanaan',
                'publication_category_id' => $catIdMap['strategi'],
                'title'                   => 'Data Statistik Perikanan Papua Tengah',
                'description'             => 'Data produksi perikanan, jumlah nelayan, dan data sektor kelautan lainnya.',
                'responsible_party'       => 'Sub Bag Perencanaan',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'setiap-saat',
                'publication_type'        => 'keuangan',
                'publication_category_id' => $catIdMap['aset-dan-inventaris'],
                'title'                   => 'Informasi Tarif/Biaya Pelayanan Publik',
                'description'             => 'Daftar tarif pelayanan publik yang dikelola oleh dinas.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Cetak/Softfile',
                'year'                    => 2024,
            ],

            // ── Informasi yang Dikecualikan (no publication type) ──
            [
                'category'                => 'dikecualikan',
                'publication_type'        => null,
                'publication_category_id' => null,
                'title'                   => 'Dokumen Pengadaan Barang/Jasa yang Masih Dalam Proses',
                'description'             => 'Informasi pengadaan barang dan jasa yang belum selesai prosesnya.',
                'responsible_party'       => 'PPK',
                'time_period'             => 'Selama proses',
                'information_format'      => 'Cetak/Softfile',
                'year'                    => 2024,
            ],
            [
                'category'                => 'dikecualikan',
                'publication_type'        => null,
                'publication_category_id' => null,
                'title'                   => 'Hasil Audit Internal yang Belum Dipublikasikan',
                'description'             => 'Laporan audit internal yang masih dalam proses review dan belum final.',
                'responsible_party'       => 'Inspektorat',
                'time_period'             => 'Selama proses',
                'information_format'      => 'Cetak',
                'year'                    => 2024,
            ],
            [
                'category'                => 'dikecualikan',
                'publication_type'        => null,
                'publication_category_id' => null,
                'title'                   => 'Memorandum/Nota Dinas Internal',
                'description'             => 'Komunikasi internal antar unit kerja yang bersifat rahasia.',
                'responsible_party'       => 'Sekretariat',
                'time_period'             => 'Setiap saat',
                'information_format'      => 'Cetak',
                'year'                    => 2024,
            ],
        ];

        foreach ($data as $row) {
            $row['is_published'] = 1;
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('public_informations')->insert($row);
        }
    }
}
