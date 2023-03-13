<?php

namespace App\Models\API;

use CodeIgniter\Model;

class BulanModel extends Model
{
  protected $table = "bulan";
  protected $primaryKey = "id_bulan";
  protected $allowedFields = ["nama_bulan"];
}
