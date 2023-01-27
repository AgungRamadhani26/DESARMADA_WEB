<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

use CodeIgniter\Database\Seeder;

//Merupakan seeder Kendaraan
class KendaraanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_departemen'  => 1,
                'jenis_kendaraan'   => 'motor',
                'nomor_polisi'   => 'BS123RE',
                'tipe_kendaraan'      => 'Beat Merah',
                'km'       => 13,
                'total_saldo_tol' => '100000',
                'pinjam' => 0,
                'gambar' => 'BeatMerah.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_departemen'  => 2,
                'jenis_kendaraan'   => 'mobil',
                'nomor_polisi'   => 'BK123AB',
                'tipe_kendaraan'      => 'Avanza Hitam',
                'km'       => 10,
                'total_saldo_tol' => '200000',
                'pinjam' => 1,
                'gambar' => 'AvanzaHitam.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_departemen'  => 3,
                'jenis_kendaraan'   => 'mobil',
                'nomor_polisi'   => 'BW132AZ',
                'tipe_kendaraan'      => 'Brio Putih',
                'km'       => 10,
                'total_saldo_tol' => '200000',
                'pinjam' => 2,
                'gambar' => 'BrioPutih.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
        ];
        $this->db->table('kendaraan')->insertBatch($data);
    }
}
