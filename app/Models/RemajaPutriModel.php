<?php

namespace App\Models;

use CodeIgniter\Model;

class RemajaPutriModel extends Model
{
    protected $table = 'tb_data_remajaputri2025_surobayan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap', 'nik', 'tanggal_lahir', 'golongan_darah', 
        'kadar_hb', 'alamat', 'nomor_telepon', 'created_at'
    ];

    public function search($keyword, $rt = null)
{
    $builder = $this;

    $builder->groupStart()
            ->like('nama_lengkap', $keyword)
            ->orLike('nik', $keyword)
            ->groupEnd();

    if ($rt) {
        $builder->where('alamat', $rt);
    }

    return $builder; // Penting: return builder, bukan hasil get()
}


public function arsipkan($id, $kategori)
{
    $data = $this->find($id);
    if (!$data) return false;

    unset($data['id']); // biar auto-increment
    $data['kategori_arsip'] = $kategori;

    $inserted = $this->db->table('tb_arsip_remajaputri2025_surobayan')->insert($data);

    if ($inserted) {
        return $this->delete($id); // hapus dari tabel utama
    }

    return false;
}

// 🔹 Update data berdasarkan ID
public function updateData($id, $data)
{
    return $this->update($id, $data);
}



}
