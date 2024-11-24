<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MRegistrasi;

class RegistrasiController extends ResourceController
{
    // Method untuk melakukan registrasi pengguna baru
    public function registrasi()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[member.email]',
            'password' => 'required|min_length[8]',
            'role' => 'required|in_list[supplier,admin]', // Validasi role
        ]);

        // Validasi inputan
        if (!$validation->withRequest($this->request)->run()) {
            return $this->respond([
                'status' => 400,
                'error' => true,
                'message' => $validation->getErrors(),
            ], 400);
        }

        // Ambil data dari request
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role') ?? 'supplier', // default role "supplier"
        ];

        // Memanggil model dan menyimpan data
        $model = new MRegistrasi();
        if ($model->save($data)) {
            return $this->respond([
                'status' => 200,
                'error' => false,
                'message' => "Registrasi Berhasil",
            ], 200);
        } else {
            return $this->respond([
                'status' => 500,
                'error' => true,
                'message' => "Gagal menyimpan data",
            ], 500);
        }
    }

    // Method untuk menghapus registrasi berdasarkan ID
    public function hapusRegistrasi($id)
    {
        $model = new MRegistrasi();

        // Cek apakah data berhasil dihapus
        if ($model->delete($id)) {
            return $this->respond([
                'status' => 200,
                'error' => false,
                'message' => "Registrasi berhasil dihapus",
            ], 200);
        } else {
            return $this->respond([
                'status' => 400,
                'error' => true,
                'message' => "Gagal menghapus registrasi",
            ], 400);
        }
    }
}
