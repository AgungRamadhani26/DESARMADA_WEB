<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'departemen'; //artinya model ini menggunakan tabel departemen dari database
    protected $primaryKey = 'id_departemen'; //primary keynya
    protected $useTimestamps = true; //menggunakan timestaps agar ketika input masuk ke database waktu yang tercatat adalah waltu saat itu, dan ketika melakukan edit waktu yang tercatat adalah waktu edit
    protected $useSoftDeletes = true; //menggunakan soft deletes milik CI4, caranya dengan menambahkan kolom pada tabel yang bernama deleted_at
    protected $allowedFields = ['nama_departemen']; //berguna untuk mengijinkan kolom mana saja yg dapat kita isi secara manual melalui aplikasi yang kita buat

    //Fungsi buatan yang berguna untuk mendapatkan data departemen
    public function getLokasi($id_departemen = false)
    {
        if ($id_departemen == false) {
            return $this->findAll();
        }
        return $this->where(['id_departemen' => $id_departemen])->first();
    }

    //Hitung jumlah masing masing kendaraan berjenis mobil dan motor disetiap departemen
    public function getJumlahMobilMotor()
    {
        $db = \Config\Database::connect();
        $jlhMobilMotor = $db->query(
            "SELECT departemen.id_departemen as id_dp, departemen.nama_departemen as nama_dp, 
            COUNT(CASE WHEN kendaraan.jenis_kendaraan = 'mobil' THEN 1 ELSE NULL END) as jumlah_mobil, 
            COUNT(CASE WHEN kendaraan.jenis_kendaraan = 'motor' THEN 1 ELSE NULL END) as jumlah_motor 
            FROM departemen LEFT JOIN kendaraan ON departemen.id_departemen = kendaraan.id_departemen 
            AND kendaraan.deleted_at IS NULL WHERE departemen.deleted_at IS NULL 
            GROUP BY departemen.id_departemen ORDER BY departemen.id_departemen ASC;
        "
        );
        $jlhMobildanMotor = $jlhMobilMotor->getResultArray();
        return $jlhMobildanMotor;
    }

    //Hitung jumlah lokasi
    public function countLokasi()
    {
        return $this->where(['deleted_at' => null])->countAllResults();
    }
}
