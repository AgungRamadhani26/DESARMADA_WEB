<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use CodeIgniter\API\ResponseTrait;

class uploadImage extends BaseController
{
  use ResponseTrait;
  protected $model;
  public function __construct()
  {
    $this->model = new PeminjamanModel();
    helper(['form', 'url']);
  }
  public function index()
  {
    $id = $this->request->getVar('id');
    $data = $this->request->getRawInput();
    $data['id_peminjaman'] = $id;

    $isExist = $this->model->getWhere(['id_peminjaman' => $id])->getRow();
    if (!$isExist) {
      return $this->failNotFound("Data tidak ditemukan untuk id $id");
    }

    $image = null;
    $imageBBM = $this->request->getFile('lampiran_bbm');
    if ($imageBBM != null && $imageBBM->getError() == 0) {
        $ext = $imageBBM->getClientExtension();
        $file_name = "img-" . mt_rand(111111111, 999999999) . "." . $ext;
        $imageBBM->move('assets/lampiran_bbm', $file_name);
        $image = $file_name;
    }

    $imageTol = $this->request->getFile('lampiran_tol');
    if ($imageTol != null && $imageTol->getError() == 0) {
        $ext = $imageTol->getClientExtension();
        $file_name = "img-" . mt_rand(111111111, 999999999) . "." . $ext;
        $imageTol->move('assets/lampiran_tol', $file_name);
        $image = $file_name;
    }
    
    if ($image == null) {
      return $this->respond([
        'message' => 'Image gagal diupload',
      ], 400);
    }

    if ($imageBBM != null) $data['lampiran_bbm'] = $image;
    if ($imageTol != null) $data['lampiran_tol'] = $image;

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    return $this->respond([
      'message' => 'Image berhasil diupload',
      'image_name' => $image
    ], 200);
  }
}
