<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Controllers\BaseController;

class User extends BaseController
{
  use ResponseTrait;
  protected $model;
  function __construct()
  {
    $this->model = new UserModel();
  }
  public function index()
  {
    $data = $this->model->orderBy('id_user', 'ASC')->findAll();
    return $this->respond($data, 200);
  }
  public function show($id = null)
  {
    $data = $this->model->getWhere(['id_user' => $id])->getRow();
    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound('Data tidak ditemukan');
    }
  }
  public function update($id = null)
  {
    $data = $this->request->getRawInput();
    $data['id_user'] = $id;

    $isExist = $this->model->getWhere(['id_user' => $id])->getRow();
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
