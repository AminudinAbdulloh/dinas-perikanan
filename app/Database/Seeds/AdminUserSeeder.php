<?php

namespace App\Database\Seeds;

use App\Models\AdminUserModel;
use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $model = new AdminUserModel();

        if ($model->where('email', 'admin@dinas.go.id')->first() !== null) {
            return;
        }

        $model->insert([
            'email'          => 'admin@dinas.go.id',
            'password_hash'  => password_hash('admin123', PASSWORD_DEFAULT),
            'name'           => 'Administrator',
            'is_active'      => 1,
        ]);
    }
}
