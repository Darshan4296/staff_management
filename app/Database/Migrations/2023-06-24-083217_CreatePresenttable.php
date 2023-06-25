<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePresenttable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 10,
            ],
            'clock_in' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'clock_out' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('presents');
    }

    public function down()
    {
        $this->forge->dropTable('presents');
    }
}
