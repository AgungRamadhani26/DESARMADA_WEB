<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\BulanModel;
use App\Models\PeminjamanModel;

class Laporan extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $kendaraanModel;
    protected $bulanModel;
    protected $peminjamanModel;
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->bulanModel = new BulanModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function laporan_penggunaan()
    {
        $data = [
            'url' => '/laporan/laporan_penggunaan',
            'bulan' => $this->bulanModel->getBulan()
        ];
        return view('laporan/laporan_penggunaan',  $data);
    }

    public function cari_laporan()
    {
        $bulan_awal = $this->request->getPost('bulan_awal');
        $bulan_akhir = $this->request->getPost('bulan_akhir');
        $tahun = $this->request->getPost('tahun');
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT"
        );
        $results = $query->getResultArray();
        return $results;

        $data = [
            'url' => '/laporan/laporan_penggunaan',
            'bulan' => $this->bulanModel->getBulan()
        ];
        return view('laporan/laporan_penggunaan', $data);
    }
}
