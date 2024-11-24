<?php

namespace App\Models;

use CodeIgniter\Model;

class MRegistrasi extends Model
{
    protected $table = 'member'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id'; // Pastikan primary key sesuai dengan tabel
    
    // Menambahkan kolom 'role' pada allowedFields
    protected $allowedFields = ['nama', 'email', 'password', 'role']; // Sekarang dapat menerima 'role'
    
    protected $returnType = 'array'; // Menentukan tipe pengembalian data
    
    // Anda bisa menambahkan aturan validasi di sini jika diperlukan
}
