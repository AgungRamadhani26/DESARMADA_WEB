<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kendaraan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kendaraan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_departemen' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'jenis_kendaraan' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null'  => true,
            ],
            'nomor_polisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'  => true,
            ],
            'tipe_kendaraan' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null'  => true,
            ],
            'km' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null'  => true,
            ],
            'total_saldo_tol' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'  => true,
            ],
            'pinjam' => [
                'type'       => 'INT',
                'constraint' => '1',
                'null'  => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->addKey('id_kendaraan', true);
        $this->forge->addForeignKey('id_departemen', 'departemen', 'id_departemen');
        $this->forge->createTable('kendaraan');
    }

    public function down()
    {
        $this->forge->dropTable('kendaraan');
    }
}
