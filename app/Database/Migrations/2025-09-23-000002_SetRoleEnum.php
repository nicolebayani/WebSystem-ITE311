<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetRoleEnum extends Migration
{
    public function up()
    {
        // Normalize existing values
        $this->db->query("UPDATE users SET role = LOWER(role) WHERE role IS NOT NULL");
        // Set default 'student' where role is null/empty or invalid
        $this->db->query("UPDATE users SET role = 'student' WHERE role IS NULL OR role = '' OR role NOT IN ('admin','teacher','student')");

        // Convert to ENUM (MySQL) with allowed roles
        $dbDriver = $this->db->DBDriver ?? '';
        if (strtolower($dbDriver) === 'mysqli') {
            $fields = [
                'role' => [
                    'name'       => 'role',
                    'type'       => 'ENUM',
                    'constraint' => ['admin', 'teacher', 'student'],
                    'default'    => 'student',
                    'null'       => false,
                ],
            ];
            $this->forge->modifyColumn('users', $fields);
        } else {
            // For non-MySQL drivers keep VARCHAR but ensure defaults
            $fields = [
                'role' => [
                    'name'       => 'role',
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'student',
                    'null'       => false,
                ],
            ];
            $this->forge->modifyColumn('users', $fields);
        }
    }

    public function down()
    {
        // Revert to VARCHAR if previously changed
        $fields = [
            'role' => [
                'name'       => 'role',
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'student',
                'null'       => false,
            ],
        ];
        $this->forge->modifyColumn('users', $fields);
    }
}


