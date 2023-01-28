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
            'lokasi' => $this->lokasiModel->getLokasi(),
            'url' => '/kendaraan/daftar_kendaraan'
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
                'rules' => 'required|is_unique[kendaraan.nomor_polisi]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => 'nomor polisi tidak boleh sama'
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
                'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,1024]',
                'errors' => [
                    'uploaded' => 'Gambar belum dimasukkan',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $jeniskendaraan = $this->request->getPost('jeniskendaraan');
            $tipekendaraan = $this->request->getPost('tipekendaraan');
            $nopol = $this->request->getPost('nopol');
            $lokasi = $this->request->getPost('lokasi');
            $kmawal = $this->request->getPost('kmawal');
            $gambar = $this->request->getFile('gambar');
            $namaGambar = $gambar->getRandomName();
            //pindahkan file ke folder assets/img_kendaraan, nama file adalah hasil generate nama gambar random
            $gambar->move('assets/img_kendaraan', $namaGambar);
            //proses memasukkan data ke database
            $data = [
                'jenis_kendaraan' => $jeniskendaraan,
                'tipe_kendaraan' => $tipekendaraan,
                'nomor_polisi' => $nopol,
                'id_departemen' => $lokasi,
                'km' => $kmawal,
                'total_saldo_tol' => '0', //setiap kendaraan baru saldo tolnya diset '0' karena belum mengeluarkan saldo tol, ingat tipe data disini adalah varchar
                'pinjam' => 0, //setiap kendaraan baru diset pinjam=0 artinya status kendaraan tersedia
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



    //Fungsi edit_kendaraan
    public function edit_kendaraan($id_kendaraan)
    {
        return json_encode($this->kendaraanModel->find($id_kendaraan));
    }
    //Fungsi update_kendaraan
    public function update_kendaraan()
    {
        $validasi = \Config\Services::validation();
        // cek nomor polisi, karena nomor polisi harus unik
        $kendaraanLama = $this->kendaraanModel->getKendaraan($this->request->getPost('id_kendaraan')); //dari input yang bertipe hidden
        if ($kendaraanLama['nomor_polisi'] == $this->request->getPost('nopol')) {
            $rule_nopol = 'required';
        } else {
            $rule_nopol = 'required|is_unique[kendaraan.nomor_polisi]';
        }
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
                'rules' => $rule_nopol,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => 'nomor polisi tidak boleh sama'
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
                'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,1024]',
                'errors' => [
                    'uploaded' => 'Gambar belum diupload',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar'
                ]
            ]
        ];
        $aturan_tanpa_gambar = [
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
                'rules' => $rule_nopol,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => 'nomor polisi tidak boleh sama'
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
            ]
        ];
        if ($this->request->getFile('gambar')) {
            $validasi->setRules($aturan);
        } else {
            $validasi->setRules($aturan_tanpa_gambar);
        }
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //mengambil dari data ajax
            $id_kendaraan = $this->request->getPost('id_kendaraan');
            $gambarlama = $this->request->getPost('gambarlama');
            $jeniskendaraan = $this->request->getPost('jeniskendaraan');
            $tipekendaraan = $this->request->getPost('tipekendaraan');
            $nopol = $this->request->getPost('nopol');
            $lokasi = $this->request->getPost('lokasi');
            $kmawal = $this->request->getPost('kmawal');
            $gambar = $this->request->getFile('gambar');
            if ($gambar == null) {
                $namaGambar = $gambarlama;
            } else {
                $namaGambar = $gambar->getRandomName();
                //pindahkan file ke folder assets/img_kendaraan, nama file adalah hasil generate nama gambar random
                $gambar->move('assets/img_kendaraan', $namaGambar);
                //hapus file yang lama
                unlink('assets/img_kendaraan/' . $this->request->getPost('gambarlama'));
            }
            //proses memasukkan data ke database
            $data = [
                'id_kendaraan' => $id_kendaraan,
                'jenis_kendaraan' => $jeniskendaraan,
                'tipe_kendaraan' => $tipekendaraan,
                'nomor_polisi' => $nopol,
                'id_departemen' => $lokasi,
                'km' => $kmawal,
                'gambar' => $namaGambar
            ];
            $this->kendaraanModel->save($data);
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



    //Fungsi delete_kendaraan
    public function delete_kendaraan($id_kendaraan)
    {
        $kendaraan = $this->kendaraanModel->find($id_kendaraan);
        unlink('assets/img_kendaraan/' . $kendaraan['gambar']);
        $this->kendaraanModel->delete($id_kendaraan);
        return redirect()->to('/kendaraan/daftar_kendaraan');
    }
}
