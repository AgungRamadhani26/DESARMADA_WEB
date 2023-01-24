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
    }


    //Fungsi daftar driver
    public function daftar_driver()
    {
        $data = [
            'driver' => $this->driverModel->getDriver()
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
                    'required' => '{field} harus diisi',
                    'alpha_space' => '{field} harus berupa huruf'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $nama = $this->request->getPost('nama');
            //proses memasukkan data ke database
            $data = [
                'nama' => $nama
            ];
            $this->driverModel->save($data);
            $hasil = [
                'sukses' => "Berhasil menambahkan data",
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


    //Fungsi edit_driver
    public function edit_driver($id_driver)
    {
        return json_encode($this->driverModel->find($id_driver));
    }
    //Fungsi update_driver untuk melanjutkan proses edit
    public function update_driver()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'alpha_space' => '{field} harus berupa huruf'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $id_driver = $this->request->getPost('id_driver');
            $nama = $this->request->getPost('nama');
            //proses memasukkan data ke database
            $data = [
                'id_driver' => $id_driver,
                'nama' => $nama
            ];
            $this->driverModel->save($data);
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


    //Fungsi delete_driver
    public function delete_driver($id_driver)
    {
        $db = \Config\Database::connect();
        $db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->driverModel->delete($id_driver);
        $db->query("SET FOREIGN_KEY_CHECKS=1");
        return redirect()->to('/driver/daftar_driver');
    }
}
