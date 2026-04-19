<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterNewsArticlesSimplifyColumns extends Migration
{
    public function up(): void
    {
        $this->forge->dropColumn('news_articles', ['published_at', 'read_time', 'tags']);
    }

    public function down(): void
    {
        $forge = $this->forge;
        $forge->addColumn('news_articles', [
            'published_at' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'read_time' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'default'    => '5 min',
            ],
            'tags' => [
                'type' => 'JSON',
                'null' => true,
            ],
        ]);
    }
}
