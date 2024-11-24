<?php

namespace App\Models;

use CodeIgniter\Model;

class MLogin extends Model
{
    protected $table = 'member_token'; // Tabel untuk menyimpan token
    protected $primaryKey = 'id'; // Primary key pada tabel member_token
    protected $allowedFields = ['member_id', 'auth_key']; // Kolom yang bisa diubah (member_id dan auth_key)
    
    // Jika Anda ingin relasi dengan tabel member, Anda bisa menambahkan relasi (optional)
    // Misalnya jika ingin mengambil data role dari tabel member saat login, Anda bisa menggunakan 'with' atau join.
    
    // Menambahkan function untuk mendapatkan data member (role) berdasarkan member_id
    public function getMemberWithRole($member_id)
    {
        return $this->db->table('member')
            ->select('member.id, member.email, member.role') // Ambil data email dan role
            ->join('member_token', 'member_token.member_id = member.id')
            ->where('member_token.member_id', $member_id)
            ->get()->getRowArray();
    }
}
