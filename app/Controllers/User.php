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
            'user' => $this->userModel->getUser()
        ];

        return view('user/daftar_user', $data);
    }


    //Fungsi tambah_driver
    public function tambah_user()
    {
        $validasi = \Config\Services::validation();
        //cek id_user untuk validasi username, karena username harus unik hal ini utk membedakan edit atau insert data baru juga
        if ($this->request->getPost('id_user') != null) { // kalau ada idnya berarti edit data sehingga validasinya hanya required dan valid email
            $userlama = $this->userModel->getUser($this->request->getPost('id_user'));
            if ($userlama['id_user'] == $this->request->getPost('id_user')) {
                $rule_username = 'required|valid_email';
            }
        }
        if ($this->request->getPost('id_user') == null) { // kalau tidak ada idnya berarti tambah data baru, sehingga validasinya required valid email dan is_unique
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
            $id_user = $this->request->getPost('id_user');
            $username = $this->request->getPost('username');
            $nama = $this->request->getPost('nama');
            $level = $this->request->getPost('level');
            $password = $this->request->getPost('password');
            $konfirpass = $this->request->getPost('konfirpass');
            //proses memasukkan data ke database
            //menambah driver terlebih dahulu karena jika menambah user maka otomatis akan menambah driver
            if ($password == $konfirpass) {
                $datadriver = [
                    'id_driver' => $id_user,
                    'nama' => $nama,
                ];
                $this->driverModel->save($datadriver);
                //menghubungkan ke database biar bisa melakukan query
                $db = \Config\Database::connect();
                //query mengambil id_driver dari tabel driver yang mana nama dari drivernya sama dengan nama user yang akan ditambahkan
                $query = $db->query("SELECT id_driver FROM driver WHERE nama = '$nama'");
                $result = $query->getResultArray();
                //karena result dalam bentuk array maka harus di loop lalo diambilah nilai nya.
                foreach ($result as $row) {
                    $driverid = $row['id_driver'];
                }
                //menambah user
                $datauser = [
                    'id_user' => $id_user,
                    'id_driver' => $driverid,
                    'username' => $username,
                    'nama' => $nama,
                    'level' => $level,
                    'password' => md5($password), //melakukan enskripsi password dengan md5
                ];
                $this->userModel->save($datauser);
                if ($id_user == '') { //jika data dari ajax id_drivernya kosong maka artinya menambah data baru
                    $hasil = [
                        'sukses' => "Berhasil menambahkan data",
                        'error' => false
                    ];
                } else {
                    $hasil = [ //jika data dari ajax id_drivernya tidak kosong maka artinya mengedit data
                        'sukses' => "Berhasil mengedit data",
                        'error' => false
                    ];
                }
            } else { //jika password tidak sama dengan konfirpass
                $hasil = [ //jika data dari ajax id_drivernya tidak kosong maka artinya mengedit data
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
}
