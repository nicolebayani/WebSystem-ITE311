<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubmissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'quiz_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'student_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'selected_choice' => ['type' => 'ENUM', 'constraint' => ['A','B','C','D']],
            'is_correct'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'submitted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('quiz_id');
        $this->forge->addKey('student_id');
        $this->forge->addForeignKey('quiz_id', 'quizzes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('submissions', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('submissions', true);
    }
}
