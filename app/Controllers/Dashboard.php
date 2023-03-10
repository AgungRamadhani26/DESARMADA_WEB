<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\LokasiModel;
use App\Models\PeminjamanModel;

use Dompdf\Dompdf;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class Dashboard extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $kendaraanModel;
    protected $lokasiModel;
    protected $peminjamanModel;
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->lokasiModel = new LokasiModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function daftar_mobil()
    {
        if (session()->get('level') == 1) {
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobil();
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotor();
        } else {
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobilby_id_user(session()->get('id_user'));
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotorby_id_user(session()->get('id_user'));
        }
        $data = [
            'mobil' => $this->kendaraanModel->getMobil(),
            'url' => '/dashboard/mobil',
            'jlh_mblTersedia' => $this->kendaraanModel->countKendaraanMobilTersedia(),
            'jlh_mtrTersedia' => $this->kendaraanModel->countKendaraanMotorTersedia(),
            'jlh_mblBLM_Kembali' => $jlh_mblBLM_Kembali,
            'jlh_mtrBLM_Kembali' => $jlh_mtrBLM_Kembali,
        ];
        return view('dashboard/mobil',  $data);
    }

    public function daftar_motor()
    {
        if (session()->get('level') == 1) {
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobil();
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotor();
        } else {
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobilby_id_user(session()->get('id_user'));
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotorby_id_user(session()->get('id_user'));
        }
        $data = [
            'sepedaMotor' => $this->kendaraanModel->getMotor(),
            'url' => '/dashboard/mobil',
            'jlh_mblTersedia' => $this->kendaraanModel->countKendaraanMobilTersedia(),
            'jlh_mtrTersedia' => $this->kendaraanModel->countKendaraanMotorTersedia(),
            'jlh_mblBLM_Kembali' => $jlh_mblBLM_Kembali,
            'jlh_mtrBLM_Kembali' => $jlh_mtrBLM_Kembali,
        ];
        return view('dashboard/motor',  $data);
    }

    public function mobil_keluar()
    {
        if (session()->get('level') == 1) {
            $mobil_dipinjam = $this->peminjamanModel->getAllPeminjaman_mobil();
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobil();
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotor();
        } else {
            $mobil_dipinjam = $this->peminjamanModel->getAllPeminjaman_mobilby_ID_user(session()->get('id_user'));
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobilby_id_user(session()->get('id_user'));
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotorby_id_user(session()->get('id_user'));
        }
        $data = [
            'url' => '/dashboard/mobil',
            'mobil_dipinjam' => $mobil_dipinjam,
            'jlh_mblTersedia' => $this->kendaraanModel->countKendaraanMobilTersedia(),
            'jlh_mtrTersedia' => $this->kendaraanModel->countKendaraanMotorTersedia(),
            'jlh_mblBLM_Kembali' => $jlh_mblBLM_Kembali,
            'jlh_mtrBLM_Kembali' => $jlh_mtrBLM_Kembali,
        ];
        return view('dashboard/mobil_keluar',  $data);
    }

    public function motor_keluar()
    {
        if (session()->get('level') == 1) {
            $motor_dipinjam = $this->peminjamanModel->getAllPeminjaman_motor();
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobil();
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotor();
        } else {
            $motor_dipinjam = $this->peminjamanModel->getAllPeminjaman_motorby_ID_user(session()->get('id_user'));
            $jlh_mblBLM_Kembali = $this->peminjamanModel->countPeminjamanMobilby_id_user(session()->get('id_user'));
            $jlh_mtrBLM_Kembali = $this->peminjamanModel->countPeminjamanMotorby_id_user(session()->get('id_user'));
        }
        $data = [
            'url' => '/dashboard/mobil',
            'motor_dipinjam' => $motor_dipinjam,
            'jlh_mblTersedia' => $this->kendaraanModel->countKendaraanMobilTersedia(),
            'jlh_mtrTersedia' => $this->kendaraanModel->countKendaraanMotorTersedia(),
            'jlh_mblBLM_Kembali' => $jlh_mblBLM_Kembali,
            'jlh_mtrBLM_Kembali' => $jlh_mtrBLM_Kembali,
        ];
        return view('dashboard/motor_keluar',  $data);
    }


    public function generateQR($nomor_polisi)
    {
        $kendaraan = $this->kendaraanModel->getKendaraanViaNopol($nomor_polisi);
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create($nomor_polisi)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(280)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        // Create generic logo
        $logo = Logo::create(FCPATH . '/assets/images/img_tampilan/LogoQR.png')->setResizeToWidth(80);
        // Create generic label
        $label = Label::create($kendaraan['jenis_kendaraan'] . '-' . $nomor_polisi)->setTextColor(new Color(0, 0, 0));
        $result = $writer->write($qrCode, $logo, $label);
        // Directly output the QR code, ambil data uri biar bisa di cetak ke pdf utk proses cetak
        $dataUri = $result->getDataUri();
        //$result->saveToFile(FCPATH . '/assets/QR-code/' . $nomor_polisi . '.png'); // ini kalo mau disimpan difolder, tapi kali ini gaperlu karena udah ada print qr-codenya

        $data = [
            'kendaraan' => $kendaraan,
            'url' => '/dashboard/mobil',
            'url_QR_Code' => $dataUri
        ];
        return view('dashboard/generateQR', $data);
    }


    public function printQR($nomor_polisi)
    {
        $kendaraan = $this->kendaraanModel->getKendaraanViaNopol($nomor_polisi);
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create($nomor_polisi)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(280)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        // Create generic logo
        $logo = Logo::create(FCPATH . '/assets/images/img_tampilan/LogoQR.png')->setResizeToWidth(80);
        // Create generic label
        $label = Label::create($kendaraan['jenis_kendaraan'] . '-' . $nomor_polisi)->setTextColor(new Color(0, 0, 0));
        $result = $writer->write($qrCode, $logo, $label);
        // Directly output the QR code, ambil data uri biar bisa di cetak ke pdf utk proses cetak
        $dataUri = $result->getDataUri();
        //$result->saveToFile(FCPATH . '/assets/QR-code/' . $nomor_polisi . '.png'); // ini kalo mau disimpan difolder, tapi kali ini gaperlu karena udah ada print qr-codenya

        $data = [
            'url' => '/dashboard/mobil',
            'url_QR_Code' => $dataUri
        ];

        //Ini untuk print qr-code ke pdf 
        $filename = $nomor_polisi;
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('dashboard/printQR_code_pdf', $data));
        // (optional) setup the paper size and orientation
        $customPaper = array(0, 0, 300, 300);
        $dompdf->setPaper($customPaper, 'landscape');
        // render html as PDF
        $dompdf->render();
        // output the generated pdf
        $dompdf->stream($filename);
    }
}
