<?php

namespace App\Models;

use CodeIgniter\Model;

class BulanModel extends Model
{
   protected $table = 'bulan'; //artinya model ini menggunakan tabel driver dari database
   protected $primaryKey = 'id_bulan'; //primary keynya
   protected $allowedFields = ['nama_bulan']; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

   //Fungsi buatan yang berguna untuk mendapatkan data driver
   public function getBulan($id_bulan = false)
   {
      if ($id_bulan == false) {
         return $this->findAll();
      }
      return $this->where(['id_bulan' => $id_bulan])->first();
   }
}
