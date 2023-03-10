<?php

namespace App\Controllers;

use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $lokasiModel;
    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
        helper(['swal_helper']);
    }



    //Fungsi daftar_lokasi
    public function daftar_lokasi()
    {
        $jumlahMotorMobil = $this->lokasiModel->getJumlahMobilMotor();
        $lokasiGR = array();
        $jumlahMobilGR = array();
        $jumlahMotorGR = array();
        foreach ($jumlahMotorMobil as $row) {
            $lokasiGR[] = $row['nama_dp'];
            $jumlahMobilGR[] = $row['jumlah_mobil'];
            $jumlahMotorGR[] = $row['jumlah_motor'];
        }
        $data = [
            'lokasi' => $this->lokasiModel->getLokasi(),
            'url' => '/lokasi/daftar_lokasi',
            'jlh_lokasi' => $this->lokasiModel->countLokasi(),
            'jumlahMobilMotor' => $this->lokasiModel->getJumlahMobilMotor(),
            'lokasiGR' => $lokasiGR,
            'jumlahMobilGR' => $jumlahMobilGR,
            'jumlahMotorGR' => $jumlahMotorGR
        ];
        return view('lokasi/daftar_lokasi', $data);
    }



    //Fungsi tambah_lokasi
    public function tambah_lokasi()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'namalokasi' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama lokasi harus diisi',
                    'alpha_space' => 'Nama lokasi harus berupa huruf'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $namalokasi1 = $this->request->getPost('namalokasi');
            $namalokasi = trim($namalokasi1);
            //proses memasukkan data ke database
            $data = [
                'nama_departemen' => $namalokasi
            ];
            $this->lokasiModel->save($data);
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



    //Fungsi edit_lokasi
    public function edit_lokasi($id_lokasi)
    {
        return json_encode($this->lokasiModel->find($id_lokasi));
    }
    //Fungsi update_lokasi untuk melanjutkan proses edit
    public function update_lokasi()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'namalokasi' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama lokasi harus diisi',
                    'alpha_space' => 'Nama lokasi harus berupa huruf'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $id_lokasi = $this->request->getPost('id_lokasi');
            $namalokasi1 = $this->request->getPost('namalokasi');
            $namalokasi = trim($namalokasi1);
            //proses memasukkan data ke database
            $data = [
                'id_departemen' => $id_lokasi,
                'nama_departemen' => $namalokasi
            ];
            $this->lokasiModel->save($data);
            $hasil = [
                'sukses' => "Berhasil mengedit data",
                'error' => true
            ];
        } else { //jika tidak valid
            $hasil = [
                'sukses' => false,
                'error' => $validasi->listErrors()
            ];
        }
        return json_encode($hasil);
    }



    //Fungsi delete_lokasi
    public function delete_lokasi($id_lokasi)
    {
        $this->lokasiModel->delete($id_lokasi);
        Set_notifikasi_swal('success', 'Sukses :)', 'Data lokasi berhasil dihapus');
        return redirect()->to('/lokasi/daftar_lokasi');
    }
}
