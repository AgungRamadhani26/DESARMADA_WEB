<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $peminjamanModel;
    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
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
