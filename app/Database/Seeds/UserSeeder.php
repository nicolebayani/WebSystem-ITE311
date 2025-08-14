<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role'          => 'admin',
                'name'          => 'System Admin',
                'email'         => 'admin123@gmail.com',
                'password_hash' => password_hash('akosiadmin', PASSWORD_DEFAULT),
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'role'          => 'instructor',
                'name'          => 'Professor Jamero',
                'email'         => 'jjamero@gmail.com',
                'password_hash' => password_hash('_jimjamero00', PASSWORD_DEFAULT),
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'role'          => 'student',
                'name'          => 'Nicole Bayani',
                'email'         => 'nicolebayani110@gmail.com',
                'password_hash' => password_hash('iluvyellow', PASSWORD_DEFAULT),
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
