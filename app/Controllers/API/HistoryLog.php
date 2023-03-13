<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use App\Models\API\HistoryLogModel;
use App\Controllers\BaseController;

class HistoryLog extends BaseController
{
  use ResponseTrait;
  protected $model;
  public function index()
  {

    $model = new HistoryLogModel();
    $data = $model->getHistory();
    return $this->respond($data, 200);
  }
}
