<?php
namespace App\Models;

use CodeIgniter\Model;

class MMember extends Model
{
    protected $table = 'member';  // Nama tabel di database
    protected $primaryKey = 'id'; // Pastikan primary key sesuai dengan tabel
    protected $allowedFields = ['nama', 'email', 'password', 'role']; // Kolom yang bisa dimodifikasi
    protected $returnType = 'array';  // Mengembalikan data dalam bentuk array
    protected $useTimestamps = true;  // Menggunakan timestamp jika ada kolom created_at/updated_at

    // Menambahkan aturan validasi untuk input data
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email|is_unique[member.email]',
        'password' => 'required|min_length[8]',
        'role' => 'required|in_list[admin,supplier]',  // Menambahkan validasi role
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama harus diisi.',
            'min_length' => 'Nama minimal 3 karakter.',
            'max_length' => 'Nama maksimal 50 karakter.',
        ],
        'email' => [
            'required' => 'Email harus diisi.',
            'valid_email' => 'Email yang dimasukkan tidak valid.',
            'is_unique' => 'Email sudah terdaftar.',
        ],
        'password' => [
            'required' => 'Password harus diisi.',
            'min_length' => 'Password minimal 8 karakter.',
        ],
        'role' => [
            'required' => 'Role harus dipilih.',
            'in_list' => 'Role yang dipilih tidak valid.',
        ],
    ];

    // Fungsi untuk mendapatkan role berdasarkan ID member
    public function getRoleById($id)
    {
        return $this->where('id', $id)->first();  // Mengambil data berdasarkan id
    }

    // Fungsi untuk melakukan pengecekan apakah email sudah ada
    public function emailExists($email)
    {
        return $this->where('email', $email)->first();  // Mengambil member berdasarkan email
    }
}
