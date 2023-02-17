<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\BulanModel;
use App\Models\PeminjamanModel;
use CodeIgniter\HTTP\Request;

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
        $bulanG = $db->query(
            "SELECT nama_bulan FROM bulan WHERE id_bulan BETWEEN '01' AND '12'"
        );
        $bulanGrafik = $bulanG->getResultArray();
        $bulanGR = array();
        foreach ($bulanGrafik as $row) {
            $bulanGR[] = $row['nama_bulan'];
        }

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
        $nopolGR = array();
        $kmGR = array();
        foreach ($Laporan as $row) {
            $nopolGR[] = $row['nopol'];
            $kmGR[] = $row['total'];
        }

        $data = [
            'url' => '/laporan/laporan_penggunaan',
            'bulanTabel' => $bulanTabel,
            'kendaraanTabel' => $kendaraanTabel,
            'laporan' => $Laporan,
            'bulanGrafik' => $bulanGR,
            'nopolGR' => $nopolGR,
            'kmGR' => $kmGR
        ];
        return view('laporan/laporan_penggunaan',  $data);
    }

    public function cari_laporan()
    {
        $bulan_awal = $this->request->getGet('bulan_awal');
        $bulan_akhir = $this->request->getGet('bulan_akhir');
        $tahun = $this->request->getGet('tahun');
        $db = \Config\Database::connect();
        $bulanT = $db->query(
            "SELECT * FROM bulan WHERE id_bulan BETWEEN $bulan_awal AND $bulan_akhir"
        );
        $bulanTabel = $bulanT->getResultArray();
        $bulanG = $db->query(
            "SELECT nama_bulan FROM bulan WHERE id_bulan BETWEEN $bulan_awal AND $bulan_akhir"
        );
        $bulanGrafik = $bulanG->getResultArray();
        $bulanGR = array();
        foreach ($bulanGrafik as $row) {
            $bulanGR[] = $row['nama_bulan'];
        }
        $kendaraanT = $db->query(
            "SELECT tipe_kendaraan, nomor_polisi FROM kendaraan"
        );
        $kendaraanTabel = $kendaraanT->getResultArray();
        $laporan = $this->peminjamanModel->getLaporanKM($tahun);
        $nopolGR = array();
        $kmGR = array();
        foreach ($laporan as $row) {
            $nopolGR[] = $row['nopol'];
            $kmGR[] = $row['total'];
        }
        $data = [
            'url' => '/laporan/laporan_penggunaan',
            'bulanTabel' => $bulanTabel,
            'kendaraanTabel' => $kendaraanTabel,
            'laporan' => $laporan,
            'bulanGrafik' => $bulanGR,
            'nopolGR' => $nopolGR,
            'kmGR' => $kmGR
        ];
        session()->setFlashdata('bulan_awal', $bulan_awal);
        session()->setFlashdata('bulan_akhir', $bulan_akhir);
        session()->setFlashdata('tahun', $tahun);
        return view('laporan/laporan_penggunaan', $data);
    }
}
