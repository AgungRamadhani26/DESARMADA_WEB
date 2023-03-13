<?php

namespace App\Models\API;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
  protected $table = "departemen";
  protected $primaryKey = "id_departemen";
  protected $allowedFields = ["nama_departemen"];
}
