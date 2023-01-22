<?php

namespace App\Controllers;

use App\Models\KendaraanModel;

class Kendaraan extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $kendaraanModel;
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
    }

    //method index
    public function daftar_kendaraan()
    {
        $data = [
            'kendaraan' => $this->kendaraanModel->getKendaraan()
        ];

        return view('kendaraan/daftar_kendaraan', $data);
    }
}
