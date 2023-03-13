<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\MainKendaraanModel;
use App\Controllers\BaseController;

class MainKendaraan extends BaseController
{
  // use ResponseTrait;
  // protected $model;
  // function __construct()
  // {
  //   $this->model = new MainKendaraanModel();
  // }
  // public function index()
  // {
  //   $data = $this->model->orderBy('id_kendaraan', 'ASC')->findAll();
  //   // $data = $this->model->getSiswa();
  //   return $this->respond($data, 200);
  // }
  // public function show($id = null)
  // {
  //   $data = $this->model->getWhere(['id_kendaraan' => $id])->getRow();
  //   // $data = $this->model->getSiswa($id);
  //   if ($data) {
  //     return $this->respond($data, 200);
  //   } else {
  //     return $this->failNotFound('Data tidak ditemukan');
  //   }
  // }
  use ResponseTrait;
  protected $model;
  public function index()
  {

    $model = new MainKendaraanModel();
    $data = $model->getKendaraan();
    return $this->respond($data, 200);
  }
}
