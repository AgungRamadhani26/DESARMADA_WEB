<?php

namespace App\Models\API;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = "user";
  protected $primaryKey = "id_user";
  protected $foreignKey = "id_driver";
  protected $allowedFields = ["nama", "username", "password", "role"];
}
