<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

class Dashboard extends BaseController
{
    public function daftar_mobil()
    {
        $data = [
            'url' => '/dashboard_admin/mobil'
        ];
        return view('dashboard_admin/mobil',  $data);
    }

    public function daftar_motor()
    {
        $data = [
            'url' => '/dashboard_admin/mobil'
        ];
        return view('dashboard_admin/motor',  $data);
    }
}
