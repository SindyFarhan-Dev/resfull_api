<?php

namespace App\Models;

use CodeIgniter\Model;

class MOrder extends Model
{
    protected $table = 'orders'; // Nama tabel di database
    protected $primaryKey = 'id_order'; // Primary key untuk tabel orders
    protected $allowedFields = [
        'id_member', 
        'total_harga', 
        'status', 
        'tanggal_pemesanan'
    ]; // Kolom-kolom yang dapat diisi atau diupdate
    protected $returnType = 'array'; // Mengembalikan data dalam bentuk array
    protected $useTimestamps = true; // Menggunakan timestamps jika ada kolom created_at dan updated_at di tabel

    // Fungsi untuk mengambil semua pesanan dari member
    public function getMemberOrders($id_member)
    {
        return $this->where('id_member', $id_member)->findAll(); // Mengambil semua pesanan berdasarkan id_member
    }

    // Fungsi untuk membuat pesanan baru
    public function createOrder($data)
    {
        return $this->insert($data); // Menyimpan pesanan baru
    }

    // Fungsi untuk memperbarui status pesanan
    public function updateOrderStatus($id_order, $status)
    {
        return $this->update($id_order, ['status' => $status]); // Mengupdate status pesanan berdasarkan id_order
    }

    // Fungsi untuk mendapatkan detail pesanan berdasarkan ID
    public function getOrderById($id_order)
    {
        return $this->find($id_order); // Mengambil pesanan berdasarkan id_order
    }
}
