<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
    protected $table = 'driver'; //artinya model ini menggunakan tabel driver dari database
    protected $primaryKey = 'id_driver'; //primary keynya
    protected $allowedFields = ['nama']; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

    //Fungsi buatan yang berguna untuk mendapatkan data driver
    public function getDriver($id_driver = false)
    {
        if ($id_driver == false) {
            return $this->findAll();
        }
        return $this->where(['id_driver' => $id_driver])->first();
    }
}
