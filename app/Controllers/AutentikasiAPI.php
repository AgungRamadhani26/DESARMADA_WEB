<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\OtentikasiAPI;
use App\Controllers\BaseController;

class AutentikasiAPI extends BaseController
{
  use ResponseTrait;
  public function index()
  {
    $validation = \Config\Services::validation();
    $aturan = [
      'username' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Username harus diisi!'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password harus diisi!'
        ]
      ]
    ];
    $validation->setRules($aturan);
    if (!$validation->withRequest($this->request)->run()) {
      return $this->fail($validation->getErrors());
    }

    $model = new OtentikasiAPI();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $data = $model->get_username($username);
    if ($data['password'] != md5($password)) {
      return $this->fail('Password salah!');
    }

    helper('jwt');
    $response = [
      'status' => 200,
      'error' => null,
      'access_token' => createJWT(['username' => $username])
    ];
    return $this->respond($response);
  }
}
