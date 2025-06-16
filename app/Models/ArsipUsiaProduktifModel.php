<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipUsiaProduktifModel extends Model
{
    protected $table = 'tb_arsip_usia_produktif'; // tabel sementara
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik',
        'nama',
        'alamat',
        'usia',
        'jenis_kelamin',
        'kategori',
        'tanggal_arsip'
        
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
        $mainModel = new \App\Models\UsiaProduktifModel();

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
