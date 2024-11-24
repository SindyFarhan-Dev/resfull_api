<?php

namespace App\Controllers;

use App\Models\MLogin;
use App\Models\MMember;
use CodeIgniter\RESTful\ResourceController;

class LoginController extends ResourceController
{
    public function login()
    {
        // Ambil data email dan password dari request
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Validasi input email dan password
        if (empty($email) || empty($password)) {
            return $this->failValidationErrors('Email dan password wajib diisi');
        }

        // Cari member berdasarkan email
        $model = new MMember();
        $member = $model->where('email', $email)->first();

        if (!$member) {
            return $this->failNotFound('Email tidak ditemukan');
        }

        // Verifikasi password
        if (!password_verify($password, $member['password'])) {
            return $this->failUnauthorized('Password tidak valid');
        }

        // Generate auth_key
        $auth_key = $this->RandomString();

        // Simpan login record di MLogin
        $login = new MLogin();
        $loginData = [
            'member_id' => $member['id'],
            'auth_key' => $auth_key
        ];

        if (!$login->save($loginData)) {
            return $this->failServerError('Terjadi kesalahan saat menyimpan session login');
        }

        // Data response
        $data = [
            'token' => $auth_key,
            'user' => [
                'id' => $member['id'],
                'email' => $member['email'],
                'role' => $member['role'],  // Menambahkan role
            ]
        ];

        return $this->respond([
            'code' => 200,
            'status' => true,
            'data' => $data
        ]);
    }

    private function RandomString($length = 100)
    {
        $karakter = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $panjang_karakter = strlen($karakter);
        $str = '';

        // Generate random string
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }
}
