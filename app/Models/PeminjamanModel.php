<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman'; //artinya model ini menggunakan tabel peminjaman dari database
    protected $useTimestamps = true; //menggunakan timestaps agar ketika input masuk ke database waktu yang tercatat adalah waltu saat itu, dan ketika melakukan edit waktu yang tercatat adalah waktu edit
    protected $useSoftDeletes = true; //menggunakan soft deletes milik CI4, caranya dengan menambahkan kolom pada tabel yang bernama deleted_at
    protected $allowedFields = [
        'id_kendaraan', 'id_user', 'tgl_peminjaman',
        'jam_peminjaman', 'km_awal', 'saldo_tol_awal',
        'tgl_kembali', 'jam_kembali', 'km_akhir',
        'saldo_tol_akhir', 'keperluan', 'driver',
        'tujuan', 'hargabbm', 'lampiran_tol', 'lampiran_bbm',
        'total_km'
    ]; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

    public function getHistory($id_peminjaman = false)
    {
        if ($id_peminjaman == false) {
            return $this->findAll();
        }
        return $this->where(['id_peminjaman' => $id_peminjaman])->first();
    }
}
