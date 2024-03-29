<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\API\PeminjamanModel;
use App\Controllers\BaseController;

class Peminjaman extends BaseController
{
  use ResponseTrait;
  protected $model;
  function __construct()
  {
    $this->model = new PeminjamanModel();
  }
  public function index()
  {
    $data = $this->model->orderBy('id_peminjaman', 'ASC')->findAll();
    return $this->respond($data, 200);
  }
  public function show($id = null)
  {
    $data = $this->model->getWhere(['id_peminjaman' => $id])->getRow();
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
          "Data" => $data
        ]
      ];
      return $this->respond($response);
    }
    $this->model->save($data);
    $response = [
      "status" => 200,
      "error" => null,
      "messages" => [
        "success" => "Data berhasil ditambahkan",
        "Data" => $data
      ]
    ];
    return $this->respond($response);
  }
  public function update($id = null)
  {
    $data = $this->request->getRawInput();
    $data['id_peminjaman'] = $id;

    $isExist = $this->model->getWhere(['id_peminjaman' => $id])->getRow();
    if (!$isExist) {
      return $this->failNotFound("Data tidak ditemukan untuk id $id");
    }
    //if request has file
    if ($this->request->getFile('lampiran_bbm')) {
      $lampiran_bbm = $this->request->getFile('lampiran_bbm');
      $lampiran_bbm->move('assets/img_lampiran_bbm');
      $lampiran_bbm_name = $lampiran_bbm->getName();
      $data['lampiran_bbm'] = $lampiran_bbm_name;
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

  public function delete($id = null)
  {
    $isExist = $this->model->getWhere(['id_peminjaman' => $id])->getRow();
    if (!$isExist) {
      return $this->failNotFound("Data tidak ditemukan untuk id $id");
    }
    if (!$this->model->delete($id)) {
      return $this->fail($this->model->errors());
    }

    $respond = [
      "status" => 200,
      "error" => null,
      "messages" => [
        "success" => "Data berhasil dengan id = $id di hapus"
      ]
    ];
    return $this->respond($respond);
  }
}
