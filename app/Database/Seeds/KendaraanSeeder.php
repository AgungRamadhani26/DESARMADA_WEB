<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

use CodeIgniter\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_departemen'  => 1,
                'jenis_kendaraan'   => 'Motor',
                'nomor_polisi'   => 'T123',
                'tipe_kendaraan'      => 'Supra',
                'km'       => 13,
                'total_saldo_tol' => '100000',
                'pinjam' => 0,
                'gambar' => 'Supra.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_departemen'  => 2,
                'jenis_kendaraan'   => 'Mobil',
                'nomor_polisi'   => 'T124',
                'tipe_kendaraan'      => 'Kijang',
                'km'       => 10,
                'total_saldo_tol' => '200000',
                'pinjam' => 1,
                'gambar' => 'Kijang.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_departemen'  => 3,
                'jenis_kendaraan'   => 'Mobil',
                'nomor_polisi'   => 'T125',
                'tipe_kendaraan'      => 'Land Cruiser',
                'km'       => 10,
                'total_saldo_tol' => '200000',
                'pinjam' => 2,
                'gambar' => 'Kijang.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
        ];
        $this->db->table('kendaraan')->insertBatch($data);
    }
}
