<?php

namespace App\Controllers;

use App\Models\DriverModel;

class Driver extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $driverModel;
    public function __construct()
    {
        $this->driverModel = new DriverModel();
        helper(['swal_helper']);
    }



    //Fungsi daftar driver
    public function daftar_driver()
    {
        $data = [
            'driver' => $this->driverModel->getDriver(),
            'url' => '/driver/daftar_driver',
            'jlh_driver' => $this->driverModel->countDriver()
        ];
        return view('driver/daftar_driver', $data);
    }



    //Fungsi tambah_driver
    public function tambah_driver()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'alpha_space' => 'Nama harus berupa huruf'
                ]
            ],
            'nohp' => [
                'rules' => 'required|numeric|is_unique[driver.nohp]|max_length[13]|min_length[10]',
                'errors' => [
                    'required' => 'No Handphone harus diisi',
                    'numeric' => 'No Handphone harus berupa angka dan tidak boleh mengandung spasi',
                    'is_unique' => 'No Handphone sudah terdaftar, coba pakai yang lain',
                    'max_length' => 'No Handphone maksimal 13 digit',
                    'min_length' => 'No Handphone minimal 10 digit'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $nama1 = $this->request->getPost('nama');
            $nama = trim($nama1);
            $nohp1 = $this->request->getPost('nohp');
            $nohp = trim($nohp1);
            //proses memasukkan data ke database
            $data = [
                'nama' => $nama,
                'nohp' => $nohp
            ];
            $this->driverModel->save($data);
            //output ke layar
            $hasil = [
                'sukses' => "Berhasil menambahkan data",
                'error' => false
            ];
        } else { //jika tidak valid
            //output ke layar
            $hasil = [
                'sukses' => false,
                'error' => $validasi->listErrors()
            ];
        }
        //mengirimkan output $hasil ke ajax
        return json_encode($hasil);
    }



    //Fungsi edit_driver
    public function edit_driver($id_driver)
    {
        //mengirimkan output $hasil ke ajax
        return json_encode($this->driverModel->find($id_driver));
    }
    //Fungsi update_driver untuk melanjutkan proses edit
    public function update_driver()
    {
        $validasi = \Config\Services::validation();
        // cek no handphone, karena no handphone harus unik
        $driverLama = $this->driverModel->getDriver($this->request->getPost('id_driver')); //dari input yang bertipe hidden
        if ($driverLama['nohp'] == $this->request->getPost('nohp')) {
            $rule_nohp = 'required|numeric|max_length[13]|min_length[10]';
        } else {
            $rule_nohp = 'required|numeric|is_unique[driver.nohp]|max_length[13]|min_length[10]';
        }
        $aturan = [
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'alpha_space' => 'Nama harus berupa huruf'
                ]
            ],
            'nohp' => [
                'rules' => $rule_nohp,
                'errors' => [
                    'required' => 'No Handphone harus diisi',
                    'numeric' => 'No Handphone harus berupa angka dan tidak boleh mengandung spasi',
                    'is_unique' => 'No Handphone sudah terdaftar, coba pakai yang lain',
                    'max_length' => 'No Handphone maksimal 13 digit',
                    'min_length' => 'No Handphone minimal 10 digit'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $id_driver = $this->request->getPost('id_driver');
            $nama1 = $this->request->getPost('nama');
            $nama = trim($nama1);
            $nohp1 = $this->request->getPost('nohp');
            $nohp = trim($nohp1);
            //proses memasukkan data ke database
            $data = [
                'id_driver' => $id_driver,
                'nama' => $nama,
                'nohp' => $nohp
            ];
            $this->driverModel->save($data);
            //output ke layar
            $hasil = [
                'sukses' => "Berhasil mengedit data",
                'error' => false
            ];
        } else { //jika tidak valid
            //output ke layar
            $hasil = [
                'sukses' => false,
                'error' => $validasi->listErrors()
            ];
        }
        //mengirimkan output $hasil ke ajax
        return json_encode($hasil);
    }



    //Fungsi delete_driver
    public function delete_driver($id_driver)
    {
        $this->driverModel->delete($id_driver);
        Set_notifikasi_swal('success', 'Sukses :)', 'Data driver berhasil dihapus');
        return redirect()->to('/driver/daftar_driver');
    }
}
