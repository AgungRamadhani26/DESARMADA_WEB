<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\DepartemenModel;
use App\Controllers\BaseController;

class Departemen extends BaseController
{
  use ResponseTrait;
  protected $model;
  function __construct()
  {
    $this->model = new DepartemenModel();
  }
  public function index()
  {
    $data = $this->model->orderBy('id_departemen', 'ASC')->findAll();
    return $this->respond($data, 200);
  }
  public function show($id = null)
  {
    $data = $this->model->getWhere(['id_departemen' => $id])->getRow();
    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound('Data tidak ditemukan');
    }
  }
}
