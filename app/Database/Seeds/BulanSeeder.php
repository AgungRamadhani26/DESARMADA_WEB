<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

//Merupakan seeder Bulan
class BulanSeeder extends Seeder
{
   public function run()
   {
      $data = [
         [
            'id_bulan'       => '01',
            'nama_bulan'       => 'Januari'
         ],
         [
            'id_bulan'       => '02',
            'nama_bulan'       => 'Februari'
         ],
         [
            'id_bulan'       => '03',
            'nama_bulan'       => 'Maret'
         ],
         [
            'id_bulan'       => '04',
            'nama_bulan'       => 'April'
         ],
         [
            'id_bulan'       => '05',
            'nama_bulan'       => 'Mei'
         ],
         [
            'id_bulan'       => '06',
            'nama_bulan'       => 'Juni'
         ],
         [
            'id_bulan'       => '07',
            'nama_bulan'       => 'Juli'
         ],
         [
            'id_bulan'       => '08',
            'nama_bulan'       => 'Agustus'
         ],
         [
            'id_bulan'       => '09',
            'nama_bulan'       => 'September'
         ],
         [
            'id_bulan'       => '10',
            'nama_bulan'       => 'Oktober'
         ],
         [
            'id_bulan'       => '11',
            'nama_bulan'       => 'November'
         ],
         [
            'id_bulan'       => '12',
            'nama_bulan'       => 'Desember'
         ],

      ];
      $this->db->table('bulan')->insertBatch($data);
   }
}
