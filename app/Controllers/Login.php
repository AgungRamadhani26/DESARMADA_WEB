<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time; //biar bisa gunain fungsi time

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'url' => 'dashboardadmin'
        ];
        return view('DashboardAdmin',  $data);
    }
}
