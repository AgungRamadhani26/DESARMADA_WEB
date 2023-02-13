<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\KendaraanModel;
use App\Models\UserModel;
use App\Models\DriverModel;

use Dompdf\Dompdf;

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
        helper(['options_helper']);
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
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
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
            $kendaraan = $this->kendaraanModel->find($id_kendaraan);
            $data_pinjam = [
                'id_kendaraan' => $id_kendaraan,
                'id_user' => session()->get('id_user'),
                'tgl_peminjaman' => $tgl_pinjam2,
                'jam_peminjaman' => $jam_pinjam2,
                'km_awal' => $km,
                'saldo_tol_awal' => $kendaraan['total_saldo_tol'],
                'keperluan' => $keperluan,
                'driver' =>  $driver_peminjaman,
                'tujuan' => $tujuan
            ];
            $data_kendaraan = [
                'id_kendaraan' => $id_kendaraan,
                'pinjam' => 1
            ];
            if ($tgl_pinjam2 == date('Y-m-d')) {
                if ($jam_pinjam2 >= date('H:i')) { //DETIK DIABAIKAN SAJA
                    $this->peminjamanModel->save($data_pinjam);
                    $this->kendaraanModel->save($data_kendaraan);
                    Set_notifikasi_swal('success', 'Sukses :)', 'Peminjaman kendaraan berhasil');
                    if ($kendaraan['jenis_kendaraan'] == 'mobil') {
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
                if ($kendaraan['jenis_kendaraan'] == 'mobil') {
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

    public function kembalikan_kendaraan($id_peminjaman)
    {
        $peminjaman = $this->peminjamanModel->find($id_peminjaman);
        $kendaraan = $this->kendaraanModel->find($peminjaman['id_kendaraan']);
        $data = [
            'url' => '/dashboard/mobil',
            'kendaraan' => $kendaraan,
            'peminjaman' => $peminjaman
        ];
        return view('peminjaman/kembalikan_kendaraan', $data);
    }

    public function add_pengembalian($id_peminjaman)
    {
        // Validasi input
        $validasi = \Config\Services::validation();
        if ($this->request->getPost('isi_tol') != 0) {
            $rule_lampiran_isi_tol  = 'uploaded[lampiran_isi_tol]|max_size[lampiran_isi_tol,1024]|is_image[lampiran_isi_tol]|mime_in[lampiran_isi_tol,image/jpg,image/jpeg,image/png]';
        } else {
            $rule_lampiran_isi_tol  = 'is_image[lampiran_isi_tol]';
        }
        if ($this->request->getPost('isi_bbm') != 0) {
            $rule_lampiran_isi_bbm  = 'uploaded[lampiran_isi_bbm]|max_size[lampiran_isi_bbm,1024]|is_image[lampiran_isi_bbm]|mime_in[lampiran_isi_bbm,image/jpg,image/jpeg,image/png]';
        } else {
            $rule_lampiran_isi_bbm  = 'is_image[lampiran_isi_bbm]';
        }
        $aturan = [
            'tgl_kembali' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal kembali harus diisi',
                ]
            ],
            'jam_kembali' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam kembali harus diisi',
                ]
            ],
            'km_akhir' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Km akhir harus diisi',
                    'integer' => 'km akhir harus berupa bilangan bulat'
                ]
            ],
            'lampiran_isi_tol' => [
                'rules' => $rule_lampiran_isi_tol,
                'errors' => [
                    'uploaded' => 'Tolong kirimkan lampiran',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'lampiran_isi_bbm' => [
                'rules' => $rule_lampiran_isi_bbm,
                'errors' => [
                    'uploaded' => 'Tolong kirimkan lampiran',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ]
        ];
        $validasi->setRules($aturan);
        //Untuk mengambil data dari model peminjaman yang berguna untuk validasi
        $peminjaman = $this->peminjamanModel->find($id_peminjaman);
        $kendaraan = $this->kendaraanModel->find($peminjaman['id_kendaraan']);
        $isi_tol = $this->request->getPost('isi_tol');
        $isi_bbm = $this->request->getPost('isi_bbm');
        //Menghapus tanda titik dari inputan karena make autonumeric
        $isi_tol1 = str_replace('.', '', $isi_tol);
        $isi_bbm1 = str_replace('.', '', $isi_bbm);
        if ($validasi->withRequest($this->request)->run()) {
            $tgl_kembali = $this->request->getPost('tgl_kembali');
            $jam_kembali = $this->request->getPost('jam_kembali');
            $km_akhir = $this->request->getPost('km_akhir');
            $lampiran_isi_tol = $this->request->getFile('lampiran_isi_tol');
            $lampiran_isi_bbm = $this->request->getFile('lampiran_isi_bbm');
            //mengubah format tgl_pinjam
            $tgl_kembali1 = strtotime($tgl_kembali);
            $tgl_kembali2 = date('Y-m-d', $tgl_kembali1);
            //mengubah format jam_pinjam
            $jam_kembali1 = strtotime($jam_kembali);
            $jam_kembali2 = date('H:i:s', $jam_kembali1);
            //ngecek apakah ada file yang di upload
            if ($lampiran_isi_tol->getError() != 4) { //error 4 artinya request filenya tidak ada
                //generate nama gambar random
                $namaLampiran_isi_tol = $lampiran_isi_tol->getRandomName();
                //pindahkan file gambar ke folder yang sudah dibuat di folder public
                $lampiran_isi_tol->move('assets/img_lampiran_tol', $namaLampiran_isi_tol);
            } else {
                $namaLampiran_isi_tol = NULL;
            }
            if ($lampiran_isi_bbm->getError() != 4) { //error 4 artinya request filenya tidak ada
                //generate nama gambar random
                $namaLampiran_isi_bbm = $lampiran_isi_bbm->getRandomName();
                //pindahkan file gambar ke folder yang sudah dibuat di folder public
                $lampiran_isi_bbm->move('assets/img_lampiran_bbm', $namaLampiran_isi_bbm);
            } else {
                $namaLampiran_isi_bbm = NULL;
            }
            //Memeriksa km akhir, kalau lebih kecil dari km awal maka mengirim pesan error
            if ($km_akhir < $peminjaman['km_awal']) {
                Set_notifikasi_swal('error', 'Maaf', 'Km akhir tidak mungkin lebih kecil dari km awal');
                return redirect()->to('/peminjaman/kembalikan_kendaraan/' . $id_peminjaman)->withInput();
            }
            //Untuk mengumpulkan data inputan yang nanti akan dimasukkan ke database jika validasi lolos semua
            $total_km = $km_akhir - $peminjaman['km_awal'];
            $saldo_tol_akhir = $peminjaman['saldo_tol_awal'] + $isi_tol1;
            $data_pinjam = [
                'id_peminjaman' => $id_peminjaman,
                'tgl_kembali' => $tgl_kembali2,
                'jam_kembali' => $jam_kembali2,
                'km_akhir' => $km_akhir,
                'total_km' => $total_km,
                'saldo_tol_akhir' => $saldo_tol_akhir,
                'hargabbm' => $isi_bbm1,
                'lampiran_tol' => $namaLampiran_isi_tol,
                'lampiran_bbm' => $namaLampiran_isi_bbm
            ];
            $data_kendaraan = [
                'id_kendaraan' => $peminjaman['id_kendaraan'],
                'pinjam' => 0,
                'km' => $km_akhir,
                'total_saldo_tol' => $saldo_tol_akhir
            ];
            if ($tgl_kembali2 == $peminjaman['tgl_peminjaman']) {
                if ($jam_kembali2 >= date('H:i')) { //DETIK DIABAIKAN SAJA
                    $this->peminjamanModel->save($data_pinjam);
                    $this->kendaraanModel->save($data_kendaraan);
                    Set_notifikasi_swal('success', 'Sukses :)', 'Pengembalian kendaraan berhasil');
                    if ($kendaraan['jenis_kendaraan'] == 'mobil') {
                        return redirect()->to('/dashboard/mobil_keluar');
                    } else {
                        return redirect()->to('/dashboard/motor_keluar');
                    }
                } else {
                    Set_notifikasi_swal('error', 'Maaf', 'Pilih jam pengembalian minimal jam saat ini');
                    return redirect()->to('/peminjaman/kembalikan_kendaraan/' . $id_peminjaman)->withInput();
                }
            } elseif ($tgl_kembali2 > $peminjaman['tgl_peminjaman']) {
                $this->peminjamanModel->save($data_pinjam);
                $this->kendaraanModel->save($data_kendaraan);
                Set_notifikasi_swal('success', 'Sukses :)', 'Pengembalian kendaraan berhasil');
                if ($kendaraan['jenis_kendaraan'] == 'mobil') {
                    return redirect()->to('/dashboard/mobil_keluar');
                } else {
                    return redirect()->to('/dashboard/motor_keluar');
                }
            } else {
                Set_notifikasi_swal('error', 'Maaf', 'Pilih tanggal pengembalian harus lebih dari tanggal peminjaman');
                return redirect()->to('/peminjaman/kembalikan_kendaraan/' . $id_peminjaman)->withInput();
            }
        } else {
            session()->setFlashdata('err_tgl_kembali', $validasi->getError('tgl_kembali'));
            session()->setFlashdata('err_jam_kembali', $validasi->getError('jam_kembali'));
            session()->setFlashdata('err_km_akhir', $validasi->getError('km_akhir'));
            session()->setFlashdata('err_isi_tol', $validasi->getError('isi_tol'));
            session()->setFlashdata('err_lampiran_isi_tol', $validasi->getError('lampiran_isi_tol'));
            session()->setFlashdata('err_isi_bbm', $validasi->getError('isi_bbm'));
            session()->setFlashdata('err_lampiran_isi_bbm', $validasi->getError('lampiran_isi_bbm'));
            session()->setFlashdata('isi_tol', $isi_tol1);
            session()->setFlashdata('isi_bbm', $isi_bbm1);
            return redirect()->to('/peminjaman/kembalikan_kendaraan/' . $id_peminjaman)->withInput();
        }
    }

    public function delete_peminjaman($id_peminjaman)
    {
        $peminjaman = $this->peminjamanModel->find($id_peminjaman);
        if (($peminjaman['tgl_kembali'] == NULL) || $peminjaman['jam_kembali'] == NULL) {
            Set_notifikasi_swal('info', 'oopss!!!', 'Peminjaman tidak dapat dihapus jika kendaraan belum dikembalikan');
        } else {
            $this->peminjamanModel->delete($id_peminjaman);
            Set_notifikasi_swal('success', 'Sukses :)', 'Data Peminjaman berhasil dihapus');
        }
        return redirect()->to('peminjaman/history_peminjaman');
    }

    public function delete_peminjamanMobil($id_peminjaman)
    {
        $peminjaman = $this->peminjamanModel->find($id_peminjaman);
        if (($peminjaman['tgl_kembali'] == NULL) || $peminjaman['jam_kembali'] == NULL) {
            Set_notifikasi_swal('info', 'oopss!!!', 'Peminjaman tidak dapat dihapus jika kendaraan belum dikembalikan');
        } else {
            $this->peminjamanModel->delete($id_peminjaman);
            Set_notifikasi_swal('success', 'Sukses :)', 'Data Peminjaman berhasil dihapus');
        }
        return redirect()->to('peminjaman/history_peminjaman_mobil');
    }

    public function delete_peminjamanMotor($id_peminjaman)
    {
        $peminjaman = $this->peminjamanModel->find($id_peminjaman);
        if (($peminjaman['tgl_kembali'] == NULL) || $peminjaman['jam_kembali'] == NULL) {
            Set_notifikasi_swal('info', 'oopss!!!', 'Peminjaman tidak dapat dihapus jika kendaraan belum dikembalikan');
        } else {
            $this->peminjamanModel->delete($id_peminjaman);
            Set_notifikasi_swal('success', 'Sukses :)', 'Data Peminjaman berhasil dihapus');
        }
        return redirect()->to('peminjaman/history_peminjaman_motor');
    }

    public function history_peminjaman()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistory();
        } else {
            $history = $this->peminjamanModel->getHistorybyID_User(session()->get('id_user'));
        }
        $data = [
            'history' => $history,
            'url' => '/peminjaman/history_peminjaman'
        ];
        return view('peminjaman/history_peminjaman', $data);
    }

    public function history_peminjaman_mobil()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistoryMobil();
        } else {
            $history = $this->peminjamanModel->getHistoryMobilbyID_USER(session()->get('id_user'));
        }
        $data = [
            'history' => $history,
            'url' => '/peminjaman/history_peminjaman'
        ];
        return view('peminjaman/history_peminjaman_mobil', $data);
    }

    public function history_peminjaman_motor()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistoryMotor();
        } else {
            $history = $this->peminjamanModel->getHistoryMotorbyID_USER(session()->get('id_user'));
        }
        $data = [
            'history' => $history,
            'url' => '/peminjaman/history_peminjaman'
        ];
        return view('peminjaman/history_peminjaman_motor', $data);
    }

    public function eksport_all_exc()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistory();
            $fileName = 'Daftar_History_All.xlsx';
        } else {
            $history = $this->peminjamanModel->getHistorybyID_User(session()->get('id_user'));
            $nama = session()->get('nama');
            $fileName = 'Daftar_History_All_' . $nama . '.xlsx';
        }
        export_history($history, $fileName);
    }

    public function eksport_all_pdf()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistory();
            $filename = 'Daftar_History_All';
        } else {
            $history = $this->peminjamanModel->getHistorybyID_User(session()->get('id_user'));
            $nama = session()->get('nama');
            $filename = 'Daftar_History_All_' . $nama;
        }
        $data = [
            'history' => $history,
        ];
        $view = 'peminjaman/print_pdf_history/history_peminjaman';
        export_history_pdf($view, $data, $filename);
    }

    public function eksport_mobil_exc()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistoryMobil();
            $fileName = 'Daftar_History_Mobil.xlsx';
        } else {
            $history = $this->peminjamanModel->getHistoryMobilbyID_USER(session()->get('id_user'));
            $nama = session()->get('nama');
            $fileName = 'Daftar_History_Mobil_' . $nama . '.xlsx';
        }
        export_history($history, $fileName);
    }

    public function eksport_mobil_pdf()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistoryMobil();
            $filename = 'Daftar_History_Mobil';
        } else {
            $history = $this->peminjamanModel->getHistoryMobilbyID_USER(session()->get('id_user'));
            $nama = session()->get('nama');
            $filename = 'Daftar_History_Mobil_' . $nama;
        }
        $data = [
            'history' => $history,
        ];
        $view = 'peminjaman/print_pdf_history/history_peminjaman_mobil';
        export_history_pdf($view, $data, $filename);
    }

    public function eksport_motor_exc()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistoryMotor();
            $fileName = 'Daftar_History_Motor.xlsx';
        } else {
            $history = $this->peminjamanModel->getHistoryMotorbyID_USER(session()->get('id_user'));
            $nama = session()->get('nama');
            $fileName = 'Daftar_History_Motor_' . $nama . '.xlsx';
        }
        export_history($history, $fileName);
    }

    public function eksport_motor_pdf()
    {
        if (session()->get('level') == 1) {
            $history = $this->peminjamanModel->getHistoryMotor();
            $filename = 'Daftar_History_Motor';
        } else {
            $history = $this->peminjamanModel->getHistoryMotorbyID_USER(session()->get('id_user'));
            $nama = session()->get('nama');
            $filename = 'Daftar_History_Motor_' . $nama;
        }
        $data = [
            'history' => $history,
        ];
        $view = 'peminjaman/print_pdf_history/history_peminjaman_motor';
        export_history_pdf($view, $data, $filename);
    }
}
