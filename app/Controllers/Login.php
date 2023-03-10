<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    //Method untuk menampilkan halaman login
    public function index()
    {
        return view('login');
    }


    //Method untuk melakukan login
    public function login()
    {
        $secret = "6LfQ0D0kAAAAAL40cEXQhchOPGFJlk6-87lOXoEA";
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $response = json_decode($verify);
        $login = $this->request->getPost('login');
        $error_username = null;
        $error_password = null;
        $error_captcha = null;
        //jika menekan tombol login
        if ($login) {
            $valid = true; //Flag variabel validasi
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
            //Cek validasi captcha
            if (!$response->success) {
                $error_captcha = "Anda belum mengklik captcha";
                $valid = false;
            }
            //jika validasi benar
            if ($valid == true) {
                $password = md5($password_asli);
                $array = ['username' => $username, 'password' => $password];
                $dataUser = $this->userModel->where($array)->first();
                if (is_null($dataUser)) {
                    $error = "Username atau password salah";
                    session()->setFlashdata('error', $error);
                    session()->setFlashdata('username', $username);
                    session()->setFlashdata('password', $password_asli);
                    return redirect()->to('/');
                } else {
                    $dataSesi = [
                        'id_user' => $dataUser['id_user'],
                        'id_driver' => $dataUser['id_driver'],
                        'username' => $dataUser['username'],
                        'level' => $dataUser['level'],
                        'nama' => $dataUser['nama']
                    ];
                    session()->set($dataSesi);
                    return redirect()->to('dashboard/mobil');
                }
            } else {
                session()->setFlashdata('error_captcha', $error_captcha);
                session()->setFlashdata('username', $username);
                session()->setFlashdata('password', $password_asli);
                session()->setFlashdata('error_username', $error_username);
                session()->setFlashdata('error_password', $error_password);
                return redirect()->to('/');
            }
        }
    }


    //Method untuk melakukan logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
