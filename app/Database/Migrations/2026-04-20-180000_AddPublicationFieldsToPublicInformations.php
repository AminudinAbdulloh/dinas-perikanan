<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPublicationFieldsToPublicInformations extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('public_informations', [
            'publication_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'category',
                'comment'    => 'perencanaan, keuangan, pelaporan (null for dikecualikan)',
            ],
            'publication_category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'publication_type',
                'comment'    => 'FK to publication_categories',
            ],
        ]);

        $this->forge->addKey('publication_category_id', false, false, 'idx_pub_cat_id');
    }

    public function down(): void
    {
        $this->forge->dropColumn('public_informations', ['publication_type', 'publication_category_id']);
    }
}
