<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function lihat_profile()
    {
        $data = [
            'url' => '/profile/lihat_profile'
        ];
        return view('profile/lihat_profile',  $data);
    }

    public function update_profile()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'username' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'format {field} adalah email',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'passwordBaru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Baru harus diisi'
                ]
            ],
            'konfirPassBaru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Konfirmasi password baru belum diisi'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        $profileLama = $this->userModel->getUser(session()->get('id_user'));
        $username = $this->request->getPost('username');
        $nama = $this->request->getPost('nama');
        $password = $this->request->getPost('password');
        $passwordBaru = $this->request->getPost('passwordBaru');
        $konfirPassBaru = $this->request->getPost('konfirPassBaru');
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //enskripsi password untuk pengecekan ke database, apakah password yang diisi sama dengan password di database
            $passwordMD5 = md5($password);
            if ($passwordMD5 == $profileLama['password']) {
                if ($passwordBaru == $konfirPassBaru) {
                    //proses memasukkan data ke database
                    $datauser = [
                        'id_user' => session()->get('id_user'),
                        'username' => $username,
                        'nama' => $nama,
                        'password' => md5($passwordBaru)
                    ];
                    $this->userModel->save($datauser);
                    session()->setFlashdata('berhasilupdate', 'Profile berhasil dupdate');
                } else {
                    session()->setFlashdata('errUpdateProfile', 'Password Baru tidak sama dengan konfirmasi password baru');
                    session()->setFlashdata('password', $password);
                    session()->setFlashdata('passwordBaru', $passwordBaru);
                    session()->setFlashdata('konfirPassBaru', $konfirPassBaru);
                }
            } else {
                session()->setFlashdata('errUpdateProfile', 'Password saat ini tidak valid');
                session()->setFlashdata('password', $password);
                session()->setFlashdata('passwordBaru', $passwordBaru);
                session()->setFlashdata('konfirPassBaru', $konfirPassBaru);
            }
        } else { //jika tidak valid
            session()->setFlashdata('passkosong', $validasi->getError('password'));
            session()->setFlashdata('passbaru_kosong', $validasi->getError('passwordBaru'));
            session()->setFlashdata('konfirpass_barukosong', $validasi->getError('konfirPassBaru'));
            session()->setFlashdata('password', $password);
            session()->setFlashdata('passwordBaru', $passwordBaru);
            session()->setFlashdata('konfirPassBaru', $konfirPassBaru);
        }
        return redirect()->to('/profile/lihat_profile');
    }
}
