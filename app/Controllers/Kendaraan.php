<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\LokasiModel;

class Kendaraan extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $kendaraanModel;
    protected $lokasiModel;
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->lokasiModel = new LokasiModel();
    }

    //Fungsi daftar_kendaraan
    public function daftar_kendaraan()
    {
        $data = [
            'kendaraan' => $this->kendaraanModel->getKendaraan(),
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        return view('kendaraan/daftar_kendaraan', $data);
    }

    //Fungsi tambah_kendaraan
    public function tambah_kendaraan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'jeniskendaraan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus dipilih'
                ]
            ],
            'tipekendaraan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nopol' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus dipilih'
                ]
            ],
            'kmawal' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'integer' => '{field} harus berupa angka'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]', //uploaded digunakan utk upload file lihat dokumentasi ci4, cuman pada kali ini rule uploaded[sampul] dihapus karena boleh untuk tidak upload file
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $jeniskendaraan = $this->request->getPost('jeniskendaraan');
            $tipekendaraan = $this->request->getPost('tipekendaraan');
            $nopol = $this->request->getPost('nopol');
            $lokasi = $this->request->getPost('lokasi');
            $kmawal = $this->request->getPost('kmawal');
            $gambar = $this->request->getFile('gambar');
            // Apakah ada gambar yang diupload, jika tidak maka sampul menggunakan gambar default
            if ($gambar->getError() == 4) { //error 4 artinya request filenya tidak ada
                $namaGambar = 'kendaraanDefault.png';
            } else {
                //generate nama sampul random
                $namaGambar = $gambar->getRandomName();
                //pindahkan file ke folder img, nama file adalah hasil generate nama sampul random
                $gambar->move('assets/img_kendaraan', $namaGambar);
            }
            //proses memasukkan data ke database
            $data = [
                'jenis_kendaraan' => $jeniskendaraan,
                'tipe_kendaraan' => $tipekendaraan,
                'nomor_polisi' => $nopol,
                'id_departemen' => $lokasi,
                'km' => $kmawal,
                'gambar' => $namaGambar
            ];
            $this->kendaraanModel->save($data);
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
}
