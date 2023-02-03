<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan'; //artinya model ini menggunakan tabel kendaraan dari database
    protected $primaryKey = 'id_kendaraan'; //primary keynya
    protected $useTimestamps = true; //menggunakan timestaps agar ketika input masuk ke database waktu yang tercatat adalah waltu saat itu, dan ketika melakukan edit waktu yang tercatat adalah waktu edit
    protected $useSoftDeletes = true; //menggunakan soft deletes milik CI4, caranya dengan menambahkan kolom pada tabel yang bernama deleted_at
    protected $allowedFields = ['id_departemen', 'jenis_kendaraan', 'nomor_polisi', 'tipe_kendaraan', 'km', 'total_saldo_tol', 'pinjam', 'gambar']; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

    //Fungsi buatan yang berguna untuk mendapatkan data kendaraan
    public function getKendaraan($id_kendaraan = false)
    {
        if ($id_kendaraan == false) {
            return $this->findAll();
        }
        return $this->where(['id_kendaraan' => $id_kendaraan])->first();
    }

    //Fungsi buatan untuk mendapatkan kendaraan berdasarkan nomor_polisi
    public function getKendaraanViaNopol($nomor_polisi)
    {
        return $this->where(['nomor_polisi' => $nomor_polisi])->first();
    }

    public function getMobil()
    {
        return $this->where(['jenis_kendaraan' => 'mobil'])->findAll();
    }

    public function getMotor()
    {
        return $this->where(['jenis_kendaraan' => 'motor'])->findAll();
    }
}
