<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class OtentikasiAPI extends Model
{
  protected $table = 'user';
  protected $primaryKey = 'id_user';
  protected $allowedFields = ['username', 'password'];

  function get_username($username)
  {
    $builder = $this->table('user');
    $data = $builder->where('username', $username)->get()->getRowArray();
    if (!$data) {
      throw new Exception("Username tidak ditemukan!");
    }
    return $data;
  }
}
