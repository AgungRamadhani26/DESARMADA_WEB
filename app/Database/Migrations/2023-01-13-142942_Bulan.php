<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bulan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bulan' => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
            ],
            'nama_bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
        ]);
        $this->forge->addKey('id_bulan', true);
        $this->forge->createTable('bulan');
    }

    public function down()
    {
        $this->forge->dropTable('bulan');
    }
}
