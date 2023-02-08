<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

//Merupakan seeder Driver
class DriverSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Agung Ramadhani',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Bima Satria',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Dafa Sinaga',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'farhan Sormin',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Nico Siahaan',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Bobby Pratama',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Randika Sagala',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
        ];
        $this->db->table('driver')->insertBatch($data);
    }
}
