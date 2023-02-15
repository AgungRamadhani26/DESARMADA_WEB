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
        $db = \Config\Database::connect();
        $bulanT = $db->query(
            "SELECT * FROM bulan WHERE id_bulan BETWEEN '01' AND '12'"
        );
        $bulanTabel = $bulanT->getResultArray();
        $kendaraanT = $db->query(
            "SELECT tipe_kendaraan, nomor_polisi FROM kendaraan"
        );
        $kendaraanTabel = $kendaraanT->getResultArray();
        $LaporanKM = $db->query(
            "SELECT kendaraan.nomor_polisi as nopol, SUM(peminjaman.total_km) AS total, 
            MONTH(peminjaman.tgl_kembali)AS month, YEAR(peminjaman.tgl_kembali) AS year FROM kendaraan LEFT JOIN peminjaman 
            ON kendaraan.id_kendaraan = peminjaman.id_kendaraan AND YEAR(peminjaman.tgl_kembali) = '2023'
            GROUP BY kendaraan.nomor_polisi, month, year ORDER BY kendaraan.id_kendaraan"
        );
        $Laporan = $LaporanKM->getResultArray();
        $data = [
            'url' => '/laporan/laporan_penggunaan',
            'bulanTabel' => $bulanTabel,
            'kendaraanTabel' => $kendaraanTabel,
            'laporan' => $Laporan
        ];
        return view('laporan/laporan_penggunaan',  $data);
    }

    public function cari_laporan()
    {
        $bulan_awal = $this->request->getPost('bulan_awal');
        $bulan_akhir = $this->request->getPost('bulan_akhir');
        $tahun = $this->request->getPost('tahun');
        $db = \Config\Database::connect();
        $bulanT = $db->query(
            "SELECT * FROM bulan WHERE id_bulan BETWEEN $bulan_awal AND $bulan_akhir"
        );
        $bulanTabel = $bulanT->getResultArray();
        $kendaraanT = $db->query(
            "SELECT tipe_kendaraan, nomor_polisi FROM kendaraan"
        );
        $kendaraanTabel = $kendaraanT->getResultArray();
        $laporanKM = $db->query(
            "SELECT kendaraan.nomor_polisi as nopol, SUM(peminjaman.total_km) AS total, 
            MONTH(peminjaman.tgl_kembali)AS month, YEAR(peminjaman.tgl_kembali) AS year FROM kendaraan LEFT JOIN peminjaman 
            ON kendaraan.id_kendaraan = peminjaman.id_kendaraan AND YEAR(peminjaman.tgl_kembali) = $tahun
            GROUP BY kendaraan.nomor_polisi, month, year ORDER BY kendaraan.id_kendaraan"
        );
        $laporan = $laporanKM->getResultArray();
        $data = [
            'url' => '/laporan/laporan_penggunaan',
            'bulanTabel' => $bulanTabel,
            'kendaraanTabel' => $kendaraanTabel,
            'laporan' => $laporan
        ];
        return view('laporan/laporan_penggunaan', $data);
    }
}
