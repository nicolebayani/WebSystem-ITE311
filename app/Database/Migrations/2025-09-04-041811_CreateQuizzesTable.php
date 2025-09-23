<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'lesson_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'question'  => ['type' => 'TEXT'],
            'choice_a'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'choice_b'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'choice_c'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'choice_d'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'correct_choice' => ['type' => 'ENUM', 'constraint' => ['A','B','C','D']],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('lesson_id');
        $this->forge->addForeignKey('lesson_id', 'lessons', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('quizzes', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('quizzes', true);
    }
}
