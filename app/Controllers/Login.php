<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

class Login extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $kendaraanModel;
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index()
    {
        $data = [
            'url' => '/dashboard_admin/mobil',
            'mobil' => $this->kendaraanModel->getMobil(),
        ];
        return view('dashboard_admin/mobil',  $data);
    }
}
