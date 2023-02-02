<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DriverModel;

class User extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $userModel;
    protected $driverModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->driverModel = new DriverModel();
    }



    //Fungsi daftar_user
    public function daftar_user()
    {
        $data = [
            'user' => $this->userModel->getUser(),
            'driver' => $this->driverModel->getDriver(),
            'url' => '/user/daftar_user'
        ];
        return view('user/daftar_user', $data);
    }



    //Fungsi tambah_user
    public function tambah_user()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'username' => [
                'rules' => 'required|valid_email|is_unique[user.username]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'format {field} adalah email',
                    'is_unique' => '{field} sudah terdaftar coba pakai yang lain'
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'alpha_space' => '{field} harus berupa huruf'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus dipilih'
                ]
            ],
            'driver' => [
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
            'konfirpass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $username = $this->request->getPost('username');
            $nama = $this->request->getPost('nama');
            $level = $this->request->getPost('level');
            $driver = $this->request->getPost('driver');
            $password = $this->request->getPost('password');
            $konfirpass = $this->request->getPost('konfirpass');
            //proses memasukkan data ke database
            if ($password == $konfirpass) {
                //menambah user
                $datauser = [
                    'username' => $username,
                    'nama' => $nama,
                    'level' => $level,
                    'id_driver' => $driver,
                    'password' => md5($password) //melakukan enskripsi password dengan md5
                ];
                $this->userModel->save($datauser);
                $hasil = [
                    'sukses' => "Berhasil menambah data",
                    'error' => false
                ];
            } else { //jika password tidak sama dengan konfirpass
                $hasil = [
                    'sukses' => false,
                    'error' => "Password harus sama dengan konfirmasi password"
                ];
            }
        } else { //jika tidak valid
            $hasil = [
                'sukses' => false,
                'error' => $validasi->listErrors()
            ];
        }
        return json_encode($hasil);
    }



    //Fungsi edit_user
    public function edit_user($id_user)
    {
        return json_encode($this->userModel->find($id_user));
    }
    //Fungsi update_user
    public function update_user()
    {
        $validasi = \Config\Services::validation();
        // cek username, karena username harus unik
        $userLama = $this->userModel->getUser($this->request->getPost('id_user')); //dari input yang bertipe hidden
        if ($userLama['username'] == $this->request->getPost('username')) {
            $rule_username = 'required|valid_email';
        } else {
            $rule_username = 'required|valid_email|is_unique[user.username]';
        }
        $aturan = [
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'format {field} adalah email',
                    'is_unique' => '{field} sudah terdaftar coba pakai yang lain'
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'alpha_space' => '{field} harus berupa huruf'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus dipilih'
                ]
            ],
            'driver' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $id_user = $this->request->getPost('id_user');
            $username = $this->request->getPost('username');
            $nama = $this->request->getPost('nama');
            $level = $this->request->getPost('level');
            $driver = $this->request->getPost('driver');
            //proses memasukkan data ke database
            $datauser = [
                'id_user' => $id_user,
                'username' => $username,
                'nama' => $nama,
                'level' => $level,
                'id_driver' => $driver,
            ];
            $this->userModel->save($datauser);
            $hasil = [
                'sukses' => "Berhasil mengedit data",
                'error' => false
            ];
        } else { //jika tidak valid
            $hasil = [
                'sukses' => false,
                'error' => $validasi->listErrors()
            ];
        }
        return json_encode($hasil);
    }



    //Fungsi delete_user
    public function delete_user($id_user)
    {
        $this->userModel->delete($id_user);
        return redirect()->to('/user/daftar_user');
    }
}
