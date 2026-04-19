<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropDurationFromGalleryVideos extends Migration
{
    public function up(): void
    {
        if ($this->db->tableExists('gallery_videos') && $this->db->fieldExists('duration', 'gallery_videos')) {
            $this->forge->dropColumn('gallery_videos', 'duration');
        }
    }

    public function down(): void
    {
        if ($this->db->tableExists('gallery_videos') && ! $this->db->fieldExists('duration', 'gallery_videos')) {
            $this->forge->addColumn('gallery_videos', [
                'duration' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 16,
                    'null'       => true,
                    'after'      => 'youtube_url',
                ],
            ]);
        }
    }
}
