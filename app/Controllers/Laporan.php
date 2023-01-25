<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function laporan_penggunaan()
    {
        $data = [
            'url' => '/laporan/laporan_penggunaan'
        ];
        return view('laporan/laporan_penggunaan',  $data);
    }
}
