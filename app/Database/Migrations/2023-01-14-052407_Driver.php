<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

//Merupakan migrasi database tabel Driver
class Driver extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_driver' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('id_driver', true);
        $this->forge->createTable('driver');
    }

    public function down()
    {
        $this->forge->dropTable('driver');
    }
}
