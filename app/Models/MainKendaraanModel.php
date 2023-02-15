<?php

namespace App\Models;

use CodeIgniter\Model;


class MainKendaraanModel extends Model
{

  public function getKendaraan()
  {
    return $this->db->table('kendaraan')
      ->join('departemen', 'departemen.id_departemen = kendaraan.id_departemen')
      ->select('kendaraan.id_kendaraan, departemen.nama_departemen,
       kendaraan.tipe_kendaraan, kendaraan.nomor_polisi, 
       kendaraan.jenis_kendaraan, kendaraan.km, kendaraan.gambar , kendaraan.pinjam')->get()->getResultArray();
  }
}
