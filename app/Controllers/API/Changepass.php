<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Changepass extends BaseController
{
  use ResponseTrait;
  public function index()
  {
    $db = \Config\Database::connect();
    $username = $this->request->getPost('username');

    $select = $db->query("SELECT * FROM user WHERE username = '$username'");
    $count = $select->getNumRows();

    $newpass = md5('123456');

    if ($count == 1) {
      $update = $db->query("UPDATE user SET password = '$newpass' WHERE username = '$username'");
      if ($update) {
        return $this->respond([
          'status' => 200,
          'message' => 'Password berhasil direset'
        ], 200);
      } else {
        return $this->respond([
          'status' => 400,
          'message' => 'Password gagal direset'
        ], 400);
      }
    }
  }
}
