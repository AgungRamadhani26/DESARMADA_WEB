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
                'nohp'       => '082370708349',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Bima Satria',
                'nohp'       => '082168351407',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Dafa Sinaga',
                'nohp'       => '081265163577',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'farhan Sormin',
                'nohp'       => '082295301704',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Nico Siahaan',
                'nohp'       => '081264475512',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Bobby Pratama',
                'nohp'       => '081261102194',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama'       => 'Randika Sagala',
                'nohp'       => '082273476690',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
        ];
        $this->db->table('driver')->insertBatch($data);
    }
}
