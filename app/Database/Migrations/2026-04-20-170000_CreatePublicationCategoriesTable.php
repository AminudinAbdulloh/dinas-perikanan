<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePublicationCategoriesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'publication_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'comment'    => 'perencanaan, keuangan, pelaporan',
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('publication_type');
        $this->forge->createTable('publication_categories', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('publication_categories', true);
    }
}
