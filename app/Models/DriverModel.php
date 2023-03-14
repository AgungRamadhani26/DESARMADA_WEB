<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
    protected $table = 'driver'; //artinya model ini menggunakan tabel driver dari database
    protected $primaryKey = 'id_driver'; //primary keynya
    protected $useTimestamps = true; //menggunakan timestaps agar ketika input masuk ke database waktu yang tercatat adalah waltu saat itu, dan ketika melakukan edit waktu yang tercatat adalah waktu edit
    protected $useSoftDeletes = true; //menggunakan soft deletes milik CI4, caranya dengan menambahkan kolom pada tabel yang bernama deleted_at
    protected $allowedFields = ['nama', 'nohp']; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

    //Fungsi buatan yang berguna untuk mendapatkan data driver
    public function getDriver($id_driver = false)
    {
        if ($id_driver == false) {
            return $this->findAll();
        }
        return $this->where(['id_driver' => $id_driver])->first();
    }

    //Hitung jumlah driver
    public function countDriver()
    {
        return $this->where(['deleted_at' => null])->countAllResults();
    }
}
