<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Agung Ramadhani',
            ],
            [
                'nama'       => 'Bima Satria',
            ],
            [
                'nama'       => 'Dafa Sinaga',
            ],
            [
                'nama'       => 'farhan Sormin',
            ],
            [
                'nama'       => 'Nico Siahaan',
            ],
            [
                'nama'       => 'Bobby Pratama',
            ],
            [
                'nama'       => 'Randika Sagala',
            ],
        ];
        $this->db->table('driver')->insertBatch($data);
    }
}
