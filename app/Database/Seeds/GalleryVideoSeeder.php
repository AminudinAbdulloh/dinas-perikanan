<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use App\Models\GalleryVideoModel;
use CodeIgniter\Database\Seeder;

class GalleryVideoSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->tableExists('gallery_videos') === false) {
            return;
        }

        if ((int) $this->db->table('gallery_videos')->countAll() > 0) {
            return;
        }

        $model = model(GalleryVideoModel::class);

        $rows = [
            [
                'title' => 'Profil Nelayan Papua Tengah',
                'youtube_id' => 'N4lNE4MBJG8',
                'youtube_url' => 'https://youtu.be/N4lNE4MBJG8?si=iJgIJ2zXTzmsrp52',
                // removed: 'duration' => '5:32',
            ],
            [
                'title' => 'Konservasi Terumbu Karang Teluk Cenderawasih',
                'youtube_id' => 'B2pCPefPba4',
                'youtube_url' => 'https://youtu.be/B2pCPefPba4?si=VG4HgLFILNfCqzF4',
                // removed: 'duration' => '8:15',
            ],
            [
                'title' => 'Penyerahan Bantuan Kapal Perikanan',
                'youtube_id' => 'eQwIKZhxdzc',
                'youtube_url' => 'https://youtu.be/eQwIKZhxdzc?si=tDVQ6nNY13VfxBku',
                // removed: 'duration' => '4:20',
            ],
            [
                'title' => 'Pelatihan Budidaya Ikan Modern',
                'youtube_id' => 'l4i_zI69klU',
                'youtube_url' => 'https://youtu.be/l4i_zI69klU?si=6glMP5KJb75Lv-5w',
                // removed: 'duration' => '6:45',
            ],
            [
                'title' => 'Pembangunan Pelabuhan Perikanan Baru',
                'youtube_id' => 'dndRLICiZbU',
                'youtube_url' => 'https://youtu.be/dndRLICiZbU?si=zrJSKTjBh7lhCOAX',
                // removed: 'duration' => '3:55',
            ],
            [
                'title' => 'Eksplorasi Kekayaan Laut Papua Tengah',
                'youtube_id' => 'PlZaWP064KA',
                'youtube_url' => 'https://youtu.be/PlZaWP064KA?si=1n7rU7_4F_JAv7l0',
                // removed: 'duration' => '7:10',
            ],
        ];

        foreach ($rows as $row) {
            $model->insert($row);
        }
    }
}
