<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\KendaraanModel;
use App\Controllers\BaseController;

class Kendaraan extends BaseController
{
  use ResponseTrait;
  protected $model;
  function __construct()
  {
    $this->model = new KendaraanModel();
  }
  public function index()
  {
    $data = $this->model->orderBy('id_kendaraan', 'ASC')->findAll();
    return $this->respond($data, 200);
  }
  public function show($id = null)
  {
    $data = $this->model->getWhere(['id_kendaraan' => $id])->getRow();
    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound('Data tidak ditemukan');
    }
  }
  public function create()
  {

    $data = $this->request->getPost();
    if (!$this->validate($this->model->validationRules, $this->model->validationMessages)) {
      $response = [
        "status" => 500,
        "error" => $this->validator->getErrors(),
        "messages" => [
          "error" => "Data gagal ditambahkan",
          "data" => $data
        ]
      ];
      return $this->respond($response);
    }
    $this->model->save($data);
    $response = [
      "status" => 200,
      "error" => null,
      "messages" => [
        "success" => "Data berhasil ditambahkan"
      ]
    ];
    return $this->respond($response);
  }
  public function update($id = null)
  {
    $data = $this->request->getRawInput();
    $data['id_kendaraan'] = $id;

    $isExist = $this->model->getWhere(['id_kendaraan' => $id])->getRow();
    if (!$isExist) {
      return $this->failNotFound("Data tidak ditemukan untuk id $id");
    }
    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $respond = [
      "status" => 200,
      "error" => null,
      "messages" => [
        "success" => "Data berhasil dengan id = $id di update"
      ]
    ];
    return $this->respond($respond);
  }
}
