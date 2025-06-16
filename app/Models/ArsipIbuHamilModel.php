<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipIbuHamilModel extends Model
{
    protected $table = 'tb_arsip_ibuhamil'; // tabel sementara
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik',
        'nama_ibu_hamil',
        'nik_suami',
        'nama_suami',
        'pekerjaan_ibu_hamil',
        'pekerjaan_suami',
        'tgl_mulai_hamil',
        'tgl_perkiraan_lahir',
        'usia_kehamilan',
        'golDarah_ibu_hamil',
        'golDarah_suami',
        'kadar_hb',
        'bb_sebelum_hamil',
        'no_telepon',
        'alamat',
        'tgl_arsip'
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
        $mainModel = new \App\Models\IbuHamilModel();

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
