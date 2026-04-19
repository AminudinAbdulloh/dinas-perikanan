<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsArticlesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'published_at' => [
                'type' => 'DATE',
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'excerpt' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
            ],
            'views' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 0,
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
            'content' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
            'is_published' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 1,
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
        $this->forge->addKey('published_at');
        $this->forge->addKey('is_published');
        $this->forge->createTable('news_articles');
    }

    public function down(): void
    {
        $this->forge->dropTable('news_articles');
    }
}
