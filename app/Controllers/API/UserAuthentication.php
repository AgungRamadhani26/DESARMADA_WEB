<?php

namespace App\Controllers\API;

use App\Models\UserAuthenticationModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class UserAuthentication extends BaseController
{
  use ResponseTrait;
  public function index()
  {
    $validation = \Config\Services::validation();
    $aturan = [
      "username" => [
        'rules' => 'required',
        'error' => [
          'required' => 'Silahkan masukkan username anda',
        ]
      ],
      "password" => [
        'rules' => 'required',
        'error' => [
          'required' => 'Silahkan masukkan password anda'
        ]
      ]
    ];
    $validation->setRules($aturan);
    if (!$validation->withRequest($this->request)->run()) {
      return $this->fail($validation->getErrors());
    }

    $model = new UserAuthenticationModel();

    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $data = $model->getUsername($username);
    if ($data->password != md5($password)) {
      return $this->fail('Password anda salah');
    }

    helper('jwt');
    $response = [
      'message' => 'Autentikasi / login berhasil',
      'data' => $data,
      'access_token' => createJWT($username)
    ];
    return $this->respond($response);
  }
}
