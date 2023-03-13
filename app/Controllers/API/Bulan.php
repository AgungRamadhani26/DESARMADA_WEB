<?php

namespace App\Controllers;

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\BulanModel;
use App\Controllers\BaseController;

class Bulan extends BaseController
{
  use ResponseTrait;
  protected $model;
  function __construct()
  {
    $this->model = new BulanModel();
  }
  public function index()
  {
    $data = $this->model->orderBy('id_bulan', 'ASC')->findAll();
    return $this->respond($data, 200);
  }
  public function show($id = null)
  {
    $data = $this->model->getWhere(['id_bulan' => $id])->getRow();
    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound('Data tidak ditemukan');
    }
  }
}
