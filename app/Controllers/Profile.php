<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function lihat_profile()
    {
        $data = [
            'url' => '/profile/lihat_profile'
        ];
        return view('profile/lihat_profile',  $data);
    }
}
