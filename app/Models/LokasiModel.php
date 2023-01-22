<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'departemen'; //artinya model ini menggunakan tabel driver dari database
    protected $primaryKey = 'id_departemen';
    protected $useTimestamps = true; //menggunakan timestaps agar ketika input masuk ke database waktu yang tercatat adalah waltu saat itu, dan ketika melakukan edit waktu yang tercatat adalah waktu edit
    protected $useSoftDeletes = true; //menggunakan soft deletes milik CI4, caranya dengan menambahkan kolom pada tabel yang bernama deleted_at
    protected $allowedFields = ['nama_departemen']; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

    public function getLokasi($id_departemen = false)
    {
        if ($id_departemen == false) {
            return $this->findAll();
        }
        return $this->where(['id_departemen' => $id_departemen])->first();
    }
}
