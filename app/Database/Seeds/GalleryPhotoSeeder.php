<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use App\Models\GalleryPhotoModel;
use CodeIgniter\Database\Seeder;

class GalleryPhotoSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->tableExists('gallery_photos') === false) {
            return;
        }

        if ((int) $this->db->table('gallery_photos')->countAll() > 0) {
            return;
        }

        $model = model(GalleryPhotoModel::class);

        $rows = [
            ['title' => 'Armada Perikanan Tradisional', 'image' => 'https://images.unsplash.com/photo-1660278988532-d55143363abb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Nelayan Papua Tengah', 'image' => 'https://images.unsplash.com/photo-1562656611-2b26567ccf19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwyfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Terumbu Karang Teluk Cenderawasih', 'image' => 'https://images.unsplash.com/photo-1724257154172-b7dcef926dea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxjb3JhbCUyMHJlZWYlMjB1bmRlcndhdGVyJTIwcGFwdWF8ZW58MXx8fHwxNzc1ODM3MDY2fDA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Pelabuhan Perikanan Nabire', 'image' => 'https://images.unsplash.com/photo-1601699006891-c27e05b161c9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw1fHxmaXNoaW5nJTIwYm9hdCUyMGhhcmJvcnxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Keanekaragaman Hayati Laut', 'image' => 'https://images.unsplash.com/photo-1724257496887-d5012cdc9400?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw1fHxjb3JhbCUyMHJlZWYlMjB1bmRlcndhdGVyJTIwcGFwdWF8ZW58MXx8fHwxNzc1ODM3MDY2fDA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Aktivitas Penangkapan Ikan', 'image' => 'https://images.unsplash.com/photo-1689505630546-bebf6e52dce2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Dermaga Perikanan', 'image' => 'https://images.unsplash.com/photo-1582965637751-2c8cc0c164ce?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwzfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080'],
            ['title' => 'Perjalanan Mencari Ikan', 'image' => 'https://images.unsplash.com/photo-1630546221335-bfbbe63f5e0a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw1fHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080'],
        ];

        foreach ($rows as $row) {
            $model->insert($row);
        }
    }
}
