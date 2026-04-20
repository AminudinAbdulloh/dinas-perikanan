<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInformationRequestsTable extends Migration
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
            'applicant_category' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'comment'    => 'Perorangan or Lembaga',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'occupation' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'identity_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'comment'    => 'KTP, SIM, Paspor, etc.',
            ],
            'identity_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'information_detail' => [
                'type' => 'TEXT',
            ],
            'information_purpose' => [
                'type' => 'TEXT',
            ],
            'obtain_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'comment'    => 'membaca or salinan',
            ],
            'copy_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'comment'    => 'langsung, kurir, pos, faksimili, email',
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
        $this->forge->addKey('email');
        $this->forge->addKey('identity_number');
        $this->forge->createTable('information_requests', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('information_requests', true);
    }
}
