<?php

namespace App\Models\API;

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



  // $this->db->select('*');
  // $this->db->from('table1');
  // $this->db->join('table2', 'table1.id = table2.id', 'left');
  // $this->db->join('table3', 'table2.id = table3.id', 'left');
  // $result = $this->db->get();
  // return $result->result_array();


}

    // return $this->db->table('kendaraan')
    //   ->join('departemen', 'departemen.id_departemen = kendaraan.id_departemen')
    //   ->get()->getResultArray();