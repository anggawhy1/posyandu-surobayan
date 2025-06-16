<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipRemajaModel extends Model
{
    protected $table = 'tb_arsip_remajaputri2025_surobayan'; // tabel sementara
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'golongan_darah',
        'kadar_hb',
        'alamat',
        'nomor_telepon',
        'kategori_arsip',
        'created_at',
    ];

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function konfirmasi($id)
    {
        $data = $this->find($id);

        if (!$data) return false;

        // Hubungkan ke model utama untuk insert
        $mainModel = new \App\Models\ArsipRemajaModel();

        // Buang kolom yang tidak perlu jika tidak ada di tabel utama
        unset($data['id']);
        $data['updated_at'] = null;

        $inserted = $mainModel->insert($data);

        if ($inserted) {
            return $this->delete($id);
        }

        return false;
    }
}
