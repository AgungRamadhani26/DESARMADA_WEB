<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

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
        ]);
        $this->forge->addKey('id_driver', true);
        $this->forge->createTable('driver');
    }

    public function down()
    {
        $this->forge->dropTable('driver');
    }
}
