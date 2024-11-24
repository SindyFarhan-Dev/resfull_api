<?php

namespace App\Controllers;

use App\Models\MOrder;

class OrderController extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new MOrder();
    }

    // Fungsi untuk menampilkan daftar pesanan
    public function index()
    {
        $data['orders'] = $this->orderModel->findAll(); // Mengambil semua pesanan
        return view('orders/index', $data); // Mengirim data ke view
    }

    // Fungsi untuk membuat pesanan baru
    public function create()
    {
        // Misalnya, data pesanan datang dari form
        $data = [
            'id_member' => $this->request->getPost('id_member'),
            'total_harga' => $this->request->getPost('total_harga'),
            'status' => 'menunggu konfirmasi', // Status awal pesanan
            'tanggal_pemesanan' => date('Y-m-d H:i:s'), // Waktu pemesanan
        ];

        if ($this->orderModel->createOrder($data)) {
            return redirect()->to('/orders')->with('message', 'Pesanan berhasil dibuat!');
        } else {
            return redirect()->to('/orders/create')->with('error', 'Gagal membuat pesanan!');
        }
    }

    // Fungsi untuk memperbarui status pesanan
    public function updateStatus($id_order)
    {
        $newStatus = $this->request->getPost('status'); // Status baru yang dipilih

        if ($this->orderModel->updateOrderStatus($id_order, $newStatus)) {
            return redirect()->to('/orders')->with('message', 'Status pesanan berhasil diperbarui!');
        } else {
            return redirect()->to('/orders')->with('error', 'Gagal memperbarui status pesanan!');
        }
    }

    // Fungsi untuk menampilkan detail pesanan berdasarkan ID
    public function show($id_order)
    {
        $data['order'] = $this->orderModel->find($id_order); // Mengambil data pesanan berdasarkan ID
        return view('orders/show', $data); // Mengirim data ke view
    }
}
