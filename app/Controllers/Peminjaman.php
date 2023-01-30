<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\KendaraanModel;

class Peminjaman extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $peminjamanModel;
    protected $kendaraanModel;
    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->kendaraanModel = new KendaraanModel();
    }

    public function pinjam_kendaraan($id_kendaraan)
    {
        $data = [
            'url' => '/dashboard_admin/mobil',
            'validation' => \Config\Services::validation(), //menangkap validasi
            'kendaraan' => $this->kendaraanModel->getKendaraan($id_kendaraan)
        ];

        return view('peminjaman/pinjam_kendaraan', $data);
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
