<?php

namespace App\Models\API;

use CodeIgniter\Model;
use Exception;

class UserAuthenticationModel extends Model
{
  protected $table = 'user';
  protected $primaryKey = 'id_user';
  protected $allowedFields = ['username', 'password', 'level', 'nama'];

  function getUsername($username)
  {
    $builder = $this->table("user");
    $data  = $builder->getWhere(['username' => $username])->getRow();
    if (!$data) {
      throw new Exception("Data authentication not found");
    }
    return $data;
  }
}
