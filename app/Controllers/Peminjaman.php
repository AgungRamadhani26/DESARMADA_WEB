<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time
use App\Models\PeminjamanModel;
use App\Models\KendaraanModel;
use App\Models\UserModel;
use App\Models\DriverModel;

class Peminjaman extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $peminjamanModel;
    protected $kendaraanModel;
    protected $userModel;
    protected $driverModel;
    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->userModel = new UserModel();
        $this->driverModel = new DriverModel();
        helper(['swal_helper']); //load helper yang udah dibuat
    }

    public function pinjam_kendaraan($id_kendaraan)
    {
        $data = [
            'url' => '/dashboard/mobil',
            'kendaraan' => $this->kendaraanModel->getKendaraan($id_kendaraan),
            'driverr' => $this->driverModel->getDriver()
        ];
        return view('peminjaman/pinjam_kendaraan', $data);
    }

    public function add_pinjam($id_kendaraan)
    {
        // Validasi input
        $validasi = \Config\Services::validation();
        $aturan = [
            'tgl_pinjam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal pinjam harus diisi',
                ]
            ],
            'jam_pinjam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam pinjam harus diisi',
                ]
            ],
            'keperluan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keperluan harus diisi',
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan harus diisi',
                ]
            ]
        ];
        $validasi->setRules($aturan);
        $km = $this->request->getPost('km');
        $tgl_pinjam = $this->request->getPost('tgl_pinjam');
        $jam_pinjam = $this->request->getPost('jam_pinjam');
        $keperluan = $this->request->getPost('keperluan');
        $driver = $this->request->getPost('driver');
        $tujuan = $this->request->getPost('tujuan');
        //mengubah format tgl_pinjam
        $tgl_pinjam1 = strtotime($tgl_pinjam);
        $tgl_pinjam2 = date('Y-m-d', $tgl_pinjam1);
        //mengubah format jam_pinjam
        $jam_pinjam1 = strtotime($jam_pinjam);
        $jam_pinjam2 = date('H:i:s', $jam_pinjam1);
        //Pengecekan apakah memilih driver, jika tidak maka secara default driver adalah si peminjam
        if ($driver) {
            $driver_peminjaman = $driver;
        } else {
            $driverr = $this->driverModel->getDriver(session()->get('id_driver'));
            $driver_peminjaman = $driverr['nama'];
        }
        $jenis_kendaraan = $this->kendaraanModel->select('jenis_kendaraan')->where('id_kendaraan', $id_kendaraan);
        $data_pinjam = [
            'id_kendaraan' => $id_kendaraan,
            'id_user' => session()->get('id_user'),
            'tgl_peminjaman' => $tgl_pinjam2,
            'jam_peminjaman' => $jam_pinjam2,
            'km_awal' => $km,
            'keperluan' => $keperluan,
            'driver' =>  $driver_peminjaman,
            'tujuan' => $tujuan
        ];
        $data_kendaraan = [
            'id_kendaraan' => $id_kendaraan,
            'pinjam' => 1
        ];
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            if ($tgl_pinjam2 == date('Y-m-d')) {
                if ($jam_pinjam2 >= date('H:i')) { //DETIK DIABAIKAN SAJA
                    $this->peminjamanModel->save($data_pinjam);
                    $this->kendaraanModel->save($data_kendaraan);
                    Set_notifikasi_swal('success', 'Sukses :)', 'Peminjaman kendaraan berhasil');
                    if ($jenis_kendaraan == 'mobil') {
                        return redirect()->to('/dashboard/mobil_keluar');
                    } else {
                        return redirect()->to('/dashboard/motor_keluar');
                    }
                } else {
                    Set_notifikasi_swal('error', 'Maaf', 'Pilih jam peminjaman minimal jam saat ini');
                    return redirect()->to('/peminjaman/pinjam_kendaraan/' . $id_kendaraan)->withInput();
                }
            } elseif ($tgl_pinjam2 > date('Y-m-d')) {
                $this->peminjamanModel->save($data_pinjam);
                $this->kendaraanModel->save($data_kendaraan);
                Set_notifikasi_swal('success', 'Sukses :)', 'Peminjaman kendaraan berhasil');
                if ($jenis_kendaraan == 'mobil') {
                    return redirect()->to('/dashboard/mobil_keluar');
                } else {
                    return redirect()->to('/dashboard/motor_keluar');
                }
            } else {
                Set_notifikasi_swal('error', 'Maaf', 'Pilih tanggal peminjaman minimal hari ini');
                return redirect()->to('/peminjaman/pinjam_kendaraan/' . $id_kendaraan)->withInput();
            }
        } else {
            session()->setFlashdata('tgl_pinjam_kosong', $validasi->getError('tgl_pinjam'));
            session()->setFlashdata('jam_pinjam_kosong', $validasi->getError('jam_pinjam'));
            session()->setFlashdata('keperluan_kosong', $validasi->getError('keperluan'));
            session()->setFlashdata('tujuan_kosong', $validasi->getError('tujuan'));
            return redirect()->to('/peminjaman/pinjam_kendaraan/' . $id_kendaraan)->withInput();
        }
    }

    //method index
    public function history_Peminjaman()
    {
        $data = [
            'history' => $this->peminjamanModel->getHistory(),
            'url' => '/peminjaman/history_peminjaman'
        ];
        return view('peminjaman/history_peminjaman', $data);
    }
}
