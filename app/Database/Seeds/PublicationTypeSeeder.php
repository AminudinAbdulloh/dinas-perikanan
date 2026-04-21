<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PublicationTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Perencanaan',
                'slug' => 'perencanaan',
                'sort_order' => 1,
            ],
            [
                'name' => 'Keuangan',
                'slug' => 'keuangan',
                'sort_order' => 2,
            ],
            [
                'name' => 'Pelaporan',
                'slug' => 'pelaporan',
                'sort_order' => 3,
            ],
        ];

        $this->db->table('publication_types')->insertBatch($data);
    }
}
