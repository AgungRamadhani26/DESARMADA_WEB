<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

use CodeIgniter\Database\Seeder;

//Merupakan seeder User
class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_driver'  => 1,
                'username'   => 'agungramadhani2611@gmail.com',
                'password'   => md5('123456'),
                'level'      => 1,
                'nama'       => 'Agung Ramadhani',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_driver'  => 2,
                'username'   => 'bima@gmail.com',
                'password'   => md5('123456'),
                'level'      => 2,
                'nama'       => 'Bima Satria',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_driver'  => 3,
                'username'   => 'dafa@gmail.com',
                'password'   => md5('123456'),
                'level'      => 2,
                'nama'       => 'Dafa Sinaga',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_driver'  => 4,
                'username'   => 'farhan@gmail.com',
                'password'   => md5('123456'),
                'level'      => 2,
                'nama'       => 'farhan Sormin',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_driver'  => 5,
                'username'   => 'nico@gmail.com',
                'password'   => md5('123456'),
                'level'      => 2,
                'nama'       => 'Nico Siahaan',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_driver'  => 6,
                'username'   => 'bobby@gmail.com',
                'password'   => md5('123456'),
                'level'      => 2,
                'nama'       => 'Bobby Pratama',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'id_driver'  => 7,
                'username'   => 'randika@gmail.com',
                'password'   => md5('123456'),
                'level'      => 2,
                'nama'       => 'Randika Sagala',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
        ];
        $this->db->table('user')->insertBatch($data);
    }
}
