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

    //Fungsi untuk mendapatkan kendaraan khusus peminjaman
    public function getKendaraanPeminjaman($id_kendaraan)
    {
        return $this->where(['id_kendaraan' => $id_kendaraan, 'pinjam' => 0])->first();
    }

    //Fungsi buatan untuk mendapatkan kendaraan berdasarkan nomor_polisi
    public function getKendaraanViaNopol($nomor_polisi)
    {
        return $this->where(['nomor_polisi' => $nomor_polisi])->first();
    }

    //Untuk mendapatkan kendaraan mobil
    public function getMobil()
    {
        return $this->where(['jenis_kendaraan' => 'mobil'])->findAll();
    }

    //Untuk mendapatkan kendaraan motor
    public function getMotor()
    {
        return $this->where(['jenis_kendaraan' => 'motor'])->findAll();
    }

    //Hitung jumlah kendaraan
    public function countKendaraan()
    {
        return $this->where(['deleted_at' => null])->countAllResults();
    }

    //Hitung jumlah kendaraan tersedia
    public function countKendaraanTersedia()
    {
        return $this->where(['deleted_at' => null, 'pinjam' => 0])->countAllResults();
    }

    //Hitung jumlah kendaraan tidak tersedia
    public function countKendaraanTidakTersedia()
    {
        return $this->where(['deleted_at' => null, 'pinjam' => 1])->countAllResults();
    }

    //Hitung jumlah kendaraan servis
    public function countKendaraanServis()
    {
        return $this->where(['deleted_at' => null, 'pinjam' => 2])->countAllResults();
    }

    //Hitung jumlah kendaraan mobil tersedia
    public function countKendaraanMobilTersedia()
    {
        return $this->where(['deleted_at' => null, 'pinjam' => 0, 'jenis_kendaraan' => 'mobil'])->countAllResults();
    }

    //Hitung jumlah kendaraan motor tersedia
    public function countKendaraanMotorTersedia()
    {
        return $this->where(['deleted_at' => null, 'pinjam' => 0, 'jenis_kendaraan' => 'motor'])->countAllResults();
    }
}
