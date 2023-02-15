<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\MainKendaraanModel;
use App\Controllers\BaseController;

class MainKendaraan extends BaseController
{
  use ResponseTrait;
  protected $model;
  public function index()
  {

    $model = new MainKendaraanModel();
    $data = $model->getKendaraan();
    return $this->respond($data, 200);
  }
}
