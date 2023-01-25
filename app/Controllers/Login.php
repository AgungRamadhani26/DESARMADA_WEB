<?php

namespace App\Controllers;

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
