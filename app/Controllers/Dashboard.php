<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\LokasiModel;

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
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->lokasiModel = new LokasiModel();
    }

    public function daftar_mobil()
    {
        $data = [
            'mobil' => $this->kendaraanModel->getMobil(),
            'url' => '/dashboard/mobil'
        ];
        return view('dashboard/mobil',  $data);
    }

    public function daftar_motor()
    {
        $data = [
            'sepedaMotor' => $this->kendaraanModel->getMotor(),
            'url' => '/dashboard/mobil'
        ];
        return view('dashboard/motor',  $data);
    }

    public function mobil_keluar()
    {
        $data = [
            'url' => '/dashboard/mobil'
        ];
        return view('dashboard/mobil_keluar',  $data);
    }

    public function motor_keluar()
    {
        $data = [
            'url' => '/dashboard/mobil'
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
