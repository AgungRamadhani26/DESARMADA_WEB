<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\LokasiModel;

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
}
