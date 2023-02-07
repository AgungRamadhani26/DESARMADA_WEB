<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

//Merupakan migrasi database tabel Peminjaman
class Peminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kendaraan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tgl_peminjaman' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'jam_peminjaman' => [
                'type'          => 'TIME',
                'null'          => true,
            ],
            'km_awal' => [
                'type'          => 'INT',
                'constraint'    => '11',
                'null'          => true,
            ],
            'saldo_tol_awal' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
                'null'  => true,
            ],
            'tgl_kembali' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'jam_kembali' => [
                'type'          => 'TIME',
                'null'          => true,
            ],
            'km_akhir' => [
                'type'          => 'INT',
                'constraint'    => '11',
                'null'          => true,
            ],
            'saldo_tol_akhir' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
                'null'          => true,
            ],
            'keperluan' => [
                'type'       => 'TEXT',
                'null'  => true,
            ],
            'driver' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'tujuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'hargabbm' => [
                'type'       => 'INT',
                'constraint' => '12',
                'null'  => true,
            ],
            'lampiran_tol' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'lampiran_bbm' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'  => true,
            ],
            'total_km' => [
                'type'          => 'INT',
                'constraint'    => '11',
                'null'          => true,
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
        $this->forge->addKey('id_peminjaman', true);
        $this->forge->addForeignKey('id_kendaraan', 'kendaraan', 'id_kendaraan');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}
