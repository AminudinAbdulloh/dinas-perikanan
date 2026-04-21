<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontakTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_dinas' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'socials' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('kontak', true);

        // Insert initial data
        $this->db->table('kontak')->insert([
            'nama_dinas' => 'Dinas Kelautan dan Perikanan - Papua Tengah',
            'alamat'     => 'Sanoba, Distrik Nabire, Kabupaten Nabire, Papua Tengah 98816',
            'email'      => 'dislautkan@papua.go.id',
            'telepon'    => '(0123) 456789',
            'socials'    => json_encode([
                ['label' => 'Instagram', 'url' => 'https://instagram.com/'],
                ['label' => 'YouTube', 'url' => 'https://youtube.com/'],
            ]),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('kontak', true);
    }
}
