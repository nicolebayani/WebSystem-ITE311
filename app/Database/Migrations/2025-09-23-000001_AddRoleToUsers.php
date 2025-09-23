<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUsers extends Migration
{
    public function up()
    {
        // Add role column if it does not exist
        if (!$this->db->fieldExists('role', 'users')) {
            $fields = [
                'role' => [
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                    'null' => false,
                    'default' => 'student',
                ],
            ];

            $this->forge->addColumn('users', $fields);
        }

        // Normalize any existing role values to lowercase common set
        $this->db->query("UPDATE users SET role = LOWER(role) WHERE role IS NOT NULL");
        // Set default 'student' where role is empty or null
        $this->db->query("UPDATE users SET role = 'student' WHERE role IS NULL OR role = ''");
    }

    public function down()
    {
        // Drop role column if exists
        if ($this->db->fieldExists('role', 'users')) {
            $this->forge->dropColumn('users', 'role');
        }
    }
}


