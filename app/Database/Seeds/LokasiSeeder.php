<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

use CodeIgniter\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_departemen'       => 'Semarang',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_departemen'       => 'Makassar',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_departemen'       => 'Yogyakarta',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_departemen'       => 'Tegal',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
        ];
        $this->db->table('departemen')->insertBatch($data);
    }
}
