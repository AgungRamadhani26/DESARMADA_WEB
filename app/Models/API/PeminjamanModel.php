<?php

namespace App\Models\API;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
  protected $table = "peminjaman";
  protected $primaryKey = "id_peminjaman";
  protected $allowedFields = [
    "id_kendaraan", "id_user",
    "tgl_peminjaman", "jam_peminjaman",
    "km_awal", "saldo_tol_awal", "tgl_kembali",
    "jam_kembali", "km_akhir", "saldo_tol_akhir",
    "keperluan", "driver", "tujuan", "hargabbm",
    "lampiran_tol", "lampiran_bbm", "total_km", "deleted_At"
  ];

  protected $validationRules = [
    "tgl_peminjaman" => "required",
    "jam_peminjaman" => "required",
    "km_awal" => "required",
    "tujuan" => "required",
    "keperluan" => "required",
    "driver" => "required",
  ];

  protected $validationMessages = [
    "tgl_peminjaman" => [
      "required" => "Tanggal peminjaman harus diisi!"
    ],
    "jam_peminjaman" => [
      "required" => "Jam peminjaman harus diisi!"
    ],
    "km_awal" => [
      "required" => "Km awal harus diisi!"
    ],
    "tujuan" => [
      "required" => "Tujuan harus diisi!"
    ],
    "keperluan" => [
      "required" => "Keperluan harus diisi!"
    ],
    "driver" => [
      "required" => "Driver harus diisi!"
    ],
  ];
}
