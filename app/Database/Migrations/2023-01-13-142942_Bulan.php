<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

//Merupakan migrasi database tabel Bulan
class Bulan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bulan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 2,
            ],
            'nama_bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
