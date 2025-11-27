<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEnrollmentDateAndStatus extends Migration
{
    public function up()
    {
        // Add columns to enrollments table if they do not already exist
        $forge = \Config\Database::forge();

        // Use field definitions that match expected types
        $fields = [
            'enrollment_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => false,
                'default' => 'enrolled',
            ],
        ];

        $db = \Config\Database::connect();

        // Check table exists
        if ($db->tableExists('enrollments')) {
            // Only add columns that don't already exist
            $fieldsToAdd = [];
            $columns = $db->getFieldData('enrollments');
            $existing = array_map(function($c) { return $c->name; }, $columns);

            foreach ($fields as $name => $spec) {
                if (!in_array($name, $existing)) {
                    $fieldsToAdd[$name] = $spec;
                }
            }

            if (!empty($fieldsToAdd)) {
                $forge->addColumn('enrollments', $fieldsToAdd);
            }
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        if ($db->tableExists('enrollments')) {
            $forge = \Config\Database::forge();
            // Only drop columns if they exist
            $columns = $db->getFieldData('enrollments');
            $existing = array_map(function($c) { return $c->name; }, $columns);

            $colsToDrop = [];
            foreach (['enrollment_date', 'status'] as $c) {
                if (in_array($c, $existing)) {
                    $colsToDrop[] = $c;
                }
            }

            if (!empty($colsToDrop)) {
                $forge->dropColumn('enrollments', $colsToDrop);
            }
        }
    }
}
