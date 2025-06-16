<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBaruRemajaModel extends Model
{
    protected $table = 'tb_data_baru_remaja_putri'; // tabel sementara
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'golongan_darah',
        'kadar_hb',
        'alamat',
        'nomor_telepon',
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
        $mainModel = new \App\Models\RemajaPutriModel();

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
