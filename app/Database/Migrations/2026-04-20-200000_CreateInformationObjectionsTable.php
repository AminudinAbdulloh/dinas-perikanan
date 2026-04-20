<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInformationObjectionsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'registration_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'identity_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'identity_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'objection_reason' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'comment'    => 'ditolak, tidak-ditanggapi, tidak-sesuai, dll.',
            ],
            'case_description' => [
                'type' => 'TEXT',
            ],
            'request_registration_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'No. registrasi permohonan asal',
            ],
            'attachment_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'attachment_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => 'diterima',
                'comment'    => 'diterima, diproses, selesai, ditolak',
            ],
            'admin_notes' => [
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
        $this->forge->addKey('registration_number', false, true);
        $this->forge->addKey('status');
        $this->forge->createTable('information_objections', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('information_objections', true);
    }
}
