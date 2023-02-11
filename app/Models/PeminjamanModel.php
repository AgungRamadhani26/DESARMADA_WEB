<?php

namespace App\Models;

use App\Controllers\Peminjaman;
use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman'; //artinya model ini menggunakan tabel peminjaman dari database
    protected $primaryKey = 'id_peminjaman'; //primary keynya
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

    //Fungsi buatan yang berguna untuk mendapatkan mobil-mobil yang sedang dipinjam
    public function getAllPeminjaman_mobil()
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT peminjaman.id_peminjaman AS id_peminjaman, kendaraan.tipe_kendaraan AS tipe_k_mobil, departemen.nama_departemen AS nama_dep_Mobil, 
            kendaraan.nomor_polisi AS nopol_mobil, peminjaman.tgl_peminjaman AS tgl_pinjam_mobil, peminjaman.jam_peminjaman AS jam_pinjam_mobil, 
            user.nama AS peminjam, peminjaman.keperluan AS keperluan FROM kendaraan, peminjaman, departemen, user
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan AND user.id_user = peminjaman.id_user AND departemen.id_departemen = kendaraan.id_departemen) 
            AND (peminjaman.tgl_kembali IS NULL) AND (kendaraan.jenis_kendaraan = 'mobil')
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getAllPeminjaman_mobilby_ID_user($id_user)
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT peminjaman.id_peminjaman AS id_peminjaman, kendaraan.tipe_kendaraan AS tipe_k_mobil, departemen.nama_departemen AS nama_dep_Mobil, 
            kendaraan.nomor_polisi AS nopol_mobil, peminjaman.tgl_peminjaman AS tgl_pinjam_mobil, peminjaman.jam_peminjaman AS jam_pinjam_mobil, 
            user.nama AS peminjam, peminjaman.keperluan AS keperluan FROM kendaraan, peminjaman, departemen, user
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan AND user.id_user = peminjaman.id_user AND departemen.id_departemen = kendaraan.id_departemen) 
            AND (peminjaman.tgl_kembali IS NULL) AND (kendaraan.jenis_kendaraan = 'mobil') AND (peminjaman.id_user = $id_user)
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    //Fungsi buatan yang berguna untuk mendapatkan motor-motor yang sedang dipinjam
    public function getAllPeminjaman_motor()
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT peminjaman.id_peminjaman AS id_peminjaman, kendaraan.tipe_kendaraan AS tipe_k_motor, departemen.nama_departemen AS nama_dep_Motor, 
            kendaraan.nomor_polisi AS nopol_motor, peminjaman.tgl_peminjaman AS tgl_pinjam_motor, peminjaman.jam_peminjaman AS jam_pinjam_motor, 
            user.nama AS peminjam, peminjaman.keperluan AS keperluan FROM kendaraan, peminjaman, departemen, user
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan AND user.id_user = peminjaman.id_user AND departemen.id_departemen = kendaraan.id_departemen)
            AND (peminjaman.tgl_kembali IS NULL) AND (kendaraan.jenis_kendaraan = 'motor')
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getAllPeminjaman_motorby_ID_user($id_user)
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT peminjaman.id_peminjaman AS id_peminjaman, kendaraan.tipe_kendaraan AS tipe_k_motor, departemen.nama_departemen AS nama_dep_Motor, 
            kendaraan.nomor_polisi AS nopol_motor, peminjaman.tgl_peminjaman AS tgl_pinjam_motor, peminjaman.jam_peminjaman AS jam_pinjam_motor, 
            user.nama AS peminjam, peminjaman.keperluan AS keperluan FROM kendaraan, peminjaman, departemen, user
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan AND user.id_user = peminjaman.id_user AND departemen.id_departemen = kendaraan.id_departemen)
            AND (peminjaman.tgl_kembali IS NULL) AND (kendaraan.jenis_kendaraan = 'motor') AND (peminjaman.id_user = $id_user)
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    //Fungsi buatan yang berguna untuk mendapatkan seluruh data peminjaman (history)
    public function getHistory()
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM kendaraan, peminjaman, user 
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan) AND (user.id_user = peminjaman.id_user) 
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getHistorybyID_User($id_user)
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM kendaraan, peminjaman, user 
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan) AND (user.id_user = peminjaman.id_user) AND (peminjaman.id_user = $id_user)
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getHistoryMobil()
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM kendaraan, peminjaman, user 
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan) AND (user.id_user = peminjaman.id_user) AND (kendaraan.jenis_kendaraan = 'mobil')
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getHistoryMobilbyID_USER($id_user)
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM kendaraan, peminjaman, user 
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan) AND (user.id_user = peminjaman.id_user) AND (kendaraan.jenis_kendaraan = 'mobil') AND (peminjaman.id_user = $id_user)
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getHistoryMotor()
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM kendaraan, peminjaman, user 
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan) AND (user.id_user = peminjaman.id_user) AND (kendaraan.jenis_kendaraan = 'motor')
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }

    public function getHistoryMotorbyID_USER($id_user)
    {
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM kendaraan, peminjaman, user 
            WHERE (kendaraan.id_kendaraan = peminjaman.id_kendaraan) AND (user.id_user = peminjaman.id_user) AND (kendaraan.jenis_kendaraan = 'motor') AND (peminjaman.id_user = $id_user)
            ORDER BY id_peminjaman DESC"
        );
        $results = $query->getResultArray();
        return $results;
    }
}
