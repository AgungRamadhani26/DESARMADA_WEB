<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    //Konstruktor agar semua method dapat menggunakan model
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['swal_helper']); //load helper yang udah dibuat
    }

    public function lihat_profile()
    {
        $data = [
            'url' => 'profile'
        ];
        return view('profile/lihat_profile',  $data);
    }

    public function update_profile()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'username' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'format {field} adalah email',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Password tidak boleh kurang dari 6 karakter'
                ]
            ],
            'passwordBaru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password Baru harus diisi',
                    'min_length' => 'Password Baru tidak boleh kurang dari 6 karakter'
                ]
            ],
            'konfirPassBaru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Konfirmasi password baru belum diisi',
                    'min_length' => 'Konfirmasi Password tidak boleh kurang dari 6 karakter'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        $profileLama = $this->userModel->getUser(session()->get('id_user'));
        $username = $this->request->getPost('username');
        $nama = $this->request->getPost('nama');
        $password = $this->request->getPost('password');
        $passwordBaru = $this->request->getPost('passwordBaru');
        $konfirPassBaru = $this->request->getPost('konfirPassBaru');
        //jika valid
        if ($validasi->withRequest($this->request)->run()) {
            //enskripsi password untuk pengecekan ke database, apakah password yang diisi sama dengan password di database
            $passwordMD5 = md5($password);
            if ($passwordMD5 == $profileLama['password']) {
                if ($passwordBaru == $konfirPassBaru) {
                    //proses memasukkan data ke database
                    $datauser = [
                        'id_user' => session()->get('id_user'),
                        'username' => $username,
                        'nama' => $nama,
                        'password' => md5($passwordBaru)
                    ];
                    $this->userModel->save($datauser);
                    Set_notifikasi_swal('success', 'Sukses :)', 'Profile berhasil diupdate'); //kirim notifikasi sweet alert make fungsi dari helper yang udah dibuat
                } else {
                    Set_notifikasi_swal('error', 'Maaf', 'Password baru tidak cocok dengan konfirmasi password baru');
                    session()->setFlashdata('password', $password);
                    session()->setFlashdata('passwordBaru', $passwordBaru);
                    session()->setFlashdata('konfirPassBaru', $konfirPassBaru);
                }
            } else {
                Set_notifikasi_swal('error', 'Maaf', 'Password saat ini salah');
                session()->setFlashdata('password', $password);
                session()->setFlashdata('passwordBaru', $passwordBaru);
                session()->setFlashdata('konfirPassBaru', $konfirPassBaru);
            }
        } else { //jika tidak valid
            session()->setFlashdata('passkosong', $validasi->getError('password'));
            session()->setFlashdata('passbaru_kosong', $validasi->getError('passwordBaru'));
            session()->setFlashdata('konfirpass_barukosong', $validasi->getError('konfirPassBaru'));
            session()->setFlashdata('password', $password);
            session()->setFlashdata('passwordBaru', $passwordBaru);
            session()->setFlashdata('konfirPassBaru', $konfirPassBaru);
        }
        return redirect()->to('/profile/lihat_profile');
    }


    public function lupa_password()
    {
        return view('/profile/lupa_password');
    }

    public function cek_email()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'username' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'format {field} adalah email',
                ]
            ]
        ];
        $validasi->setRules($aturan);
        if (!$validasi->withRequest($this->request)->run()) {
            session()->setFlashdata('err_username', $validasi->getError('username'));
            return redirect()->to('/lupa_password')->withInput();
        } else {
            $username = $this->request->getPost('username');
            $user = $this->userModel->where(['username' => $username])->first();
            if (is_null($user)) {
                session()->setFlashdata('err_username', 'Email tidak terdaftar');
                return redirect()->to('/lupa_password')->withInput();
            } else {
                $email = service('email');
                $email->setTo($username);
                $email->setFrom('agungramadhani2409@gmail.com', 'DESARMADA Reset Password');
                $email->setSubject('Reset Password');
                $email->setMessage(' Klik link ini untuk reset password anda : <a href="http://localhost:8080/lupa_password/reset_password/' . md5($user['id_user']) . '">Reset Password</a>
                <br><b>Noted:</b> Jika anda tidak merasa melakukan reset password, abaikan email ini !.');
                if ($email->send()) {
                    session()->setFlashdata('berhasil_kirim_email', 'Email berhasil dikirim, silahkan cek email anda. jika anda tidak menemukannya coba cek di spam');
                    return redirect()->to('/lupa_password');
                } else {
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }
            }
        }
    }

    public function reset_password($md5_id_user)
    {
        $user = $this->userModel->where(['md5(id_user)' => $md5_id_user])->first();
        $datauser = [
            'user' => $user
        ];
        return view('/profile/reset_password', $datauser);
    }

    public function save_reset_password($id_user)
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'password_Baru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                    'min_length' => 'Password tidak boleh kurang dari 6 karakter'
                ]
            ],
            'Konfir_passwordBaru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Anda belum mengkonfirmasi password baru',
                    'min_length' => 'Password Baru tidak boleh kurang dari 6 karakter'
                ]
            ]
        ];
        $validasi->setRules($aturan);
        $password_Baru = $this->request->getPost('password_Baru');
        $Konfir_passwordBaru = $this->request->getPost('Konfir_passwordBaru');
        if ($validasi->withRequest($this->request)->run()) {
            if ($password_Baru == $Konfir_passwordBaru) {
                $datauser = [
                    'id_user' => $id_user,
                    'password' => md5($password_Baru)
                ];
                $this->userModel->save($datauser);
                session()->setFlashdata('success_pass_Konf', 'Password berhasil diubah, silahkan login kembali');
                return redirect()->to('/lupa_password/reset_password/' . md5($id_user));
            } else {
                session()->setFlashdata('err_pass_Konf', 'Password baru tidak cocok dengan konfirmasi password baru');
                return redirect()->to('/lupa_password/reset_password/' . md5($id_user))->withInput();
            }
        } else {
            session()->setFlashdata('err_passwordBaru', $validasi->getError('password_Baru'));
            session()->setFlashdata('err_konfirPassBaru', $validasi->getError('Konfir_passwordBaru'));
            return redirect()->to('/lupa_password/reset_password/' . md5($id_user))->withInput();
        }
    }
}
