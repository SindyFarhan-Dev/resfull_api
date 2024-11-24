<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MProduk;
use App\Models\MMember;

class ProdukController extends ResourceController
{
    /**
     * Menambah produk baru
     */
    public function create()
    {
        $data = [
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_member' => $this->request->getVar('id_member') // Menambahkan id_member
        ];

        // Validasi data sebelum insert
        if (!$this->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'id_member' => 'required|numeric' // Validasi untuk id_member
        ])) {
            return $this->responseHasil(400, false, 'Data tidak valid');
        }

        $model = new MProduk();

        try {
            if ($model->insert($data)) {
                $insertedID = $model->getInsertID();
                $produk = $model->find($insertedID);
                return $this->responseHasil(201, true, $produk);
            }
        } catch (\Exception $e) {
            return $this->responseHasil(500, false, 'Error: ' . $e->getMessage());
        }

        return $this->responseHasil(500, false, 'Gagal menyimpan produk.');
    }

    /**
     * Menampilkan semua produk
     */
    public function list()
    {
        $model = new MProduk();
        $produk = $model->findAll();

        if (empty($produk)) {
            return $this->responseHasil(404, false, 'Tidak ada produk yang ditemukan');
        }

        return $this->responseHasil(200, true, $produk);
    }

    /**
     * Menampilkan detail produk berdasarkan ID
     */
    public function detail($id)
    {
        $model = new MProduk();
        $produk = $model->find($id);

        if (!$produk) {
            return $this->responseHasil(404, false, 'Produk tidak ditemukan');
        }

        return $this->responseHasil(200, true, $produk);
    }

    /**
     * Mengubah data produk
     */
    public function ubah($id)
    {
        $data = [
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_member' => $this->request->getVar('id_member') // Menambahkan id_member
        ];

        // Validasi data sebelum update
        if (!$this->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'id_member' => 'required|numeric' // Validasi untuk id_member
        ])) {
            return $this->responseHasil(400, false, 'Data tidak valid');
        }

        $model = new MProduk();

        try {
            if ($model->update($id, $data)) {
                $produk = $model->find($id);
                if ($produk) {
                    return $this->responseHasil(200, true, $produk);
                }
            }
        } catch (\Exception $e) {
            return $this->responseHasil(500, false, 'Error: ' . $e->getMessage());
        }

        return $this->responseHasil(500, false, 'Gagal mengubah data produk.');
    }

    /**
     * Menghapus produk berdasarkan ID
     */
    public function hapus($id)
    {
        $model = new MProduk();

        if (!$model->find($id)) {
            return $this->responseHasil(404, false, 'Produk tidak ditemukan');
        }

        try {
            if ($model->delete($id)) {
                return $this->responseHasil(200, true, 'Produk berhasil dihapus');
            }
        } catch (\Exception $e) {
            return $this->responseHasil(500, false, 'Error: ' . $e->getMessage());
        }

        return $this->responseHasil(500, false, 'Gagal menghapus produk.');
    }

    /**
     * Method untuk mengirimkan respons API
     */
    private function responseHasil($status, $success, $data)
    {
        if (!$success && is_string($data)) {
            $response = [
                'status' => $status,
                'success' => $success,
                'message' => $data,
                'data' => null
            ];
        } else {
            $response = [
                'status' => $status,
                'success' => $success,
                'data' => $data
            ];
        }

        return $this->respond($response, $status);
    }
}
