<?php

namespace App\Models;

use CodeIgniter\Model;


class HistoryLogModel extends Model
{

  public function getHistory()
  {
    return $this->db->table('kendaraan')
      ->join('departemen', 'departemen.id_departemen = kendaraan.id_departemen')
      ->join('peminjaman', 'peminjaman.id_kendaraan = kendaraan.id_kendaraan')
      ->select('peminjaman.id_user,peminjaman.id_kendaraan, departemen.nama_departemen, kendaraan.tipe_kendaraan, kendaraan.nomor_polisi, kendaraan.jenis_kendaraan, , peminjaman.tgl_peminjaman, peminjaman.jam_peminjaman, peminjaman.km_awal, peminjaman.saldo_tol_awal, peminjaman.tgl_kembali, peminjaman.jam_kembali, peminjaman.km_akhir, peminjaman.saldo_tol_akhir,peminjaman.keperluan, peminjaman.driver, peminjaman.tujuan, peminjaman.hargabbm,peminjaman.lampiran_tol, peminjaman.lampiran_bbm, peminjaman.total_km')->get()->getResultArray();
  }
}
