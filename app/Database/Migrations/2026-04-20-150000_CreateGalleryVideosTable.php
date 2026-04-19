<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleryVideosTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'youtube_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'youtube_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
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
        $this->forge->addKey('created_at');
        $this->forge->createTable('gallery_videos');
    }

    public function down(): void
    {
        $this->forge->dropTable('gallery_videos');
    }
}
