<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduk extends Model
{
    protected $table = 'produk'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['kode_produk', 'nama_produk', 'harga', 'deskripsi', 'id_member'];  // Menambahkan 'deskripsi' dan 'id_member'
    protected $returnType = 'array'; // Mengembalikan data dalam bentuk array
}
