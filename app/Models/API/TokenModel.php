<?php

namespace App\Models\API;

use CodeIgniter\Model;

class TokenModel extends  Model
{
  protected $table = 'token';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'token'];

  function getToken($id)
  {
    $builder = $this->table("token");
    $data  = $builder->getWhere(['id' => $id])->getRowArray();
    return $data['token'];
  }
}
