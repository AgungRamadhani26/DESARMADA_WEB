<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KendaraanModel;
use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

class Login extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $kendaraanModel;
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $secret = "6LfQ0D0kAAAAAL40cEXQhchOPGFJlk6-87lOXoEA";
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $response = json_decode($verify);
        $login = $this->request->getPost('login');
        if ($login) {
            $valid = true; //Flag variabel

            //Cek validasi username
            $username = $this->request->getPost('username');
            if ($username == '') {
                $error_username = "Username merupakan email, dan wajib diisi";
                $valid = false;
            } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $error_username = 'Format email tidak valid';
                $valid = false;
            }

            //Cek validasi password
            $password_asli = $this->request->getPost('password');
            if ($password_asli == '') {
                $error_password = "Password harus diisi";
                $valid = false;
            }

            if ($valid && $response->success) {
                $password = md5($password_asli);
                $array = ['username' => $username, 'password' => $password];
                $dataUser = $this->userModel->where($array)->first();
                if (is_null($dataUser)) {
                    $error = "Username atau password salah";
                } else {
                    $dataSesi = [
                        'id_user' => $dataUser['id_user'],
                        'id_driver' => $dataUser['id_driver'],
                        'username' => $dataUser['username'],
                        'level' => $dataUser['level'],
                        'nama' => $dataUser['nama']
                    ];
                    session()->set($dataSesi);
                    if (session()->get('level') == 1) { //admin
                        return redirect()->to('dashboard_admin/mobil');
                    } else if (session()->get('level') == 2) { //user
                        return redirect()->to('/dashboard_user/mobil');
                    }
                }
            }
        }
    }
}
