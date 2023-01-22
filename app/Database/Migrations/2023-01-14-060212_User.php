<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_driver' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'level' => [
                'type'       => 'INT',
                'constraint' => '1',
                'null'  => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'created_at' => [
                'type'  => 'DATETIME',
                'null'  => true,
            ],
            'updated_at' => [
                'type'  => 'DATETIME',
                'null'  => true,
            ],
            'deleted_at' => [
                'type'  => 'DATETIME',
                'null'  => true,
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('id_driver', 'driver', 'id_driver');
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
