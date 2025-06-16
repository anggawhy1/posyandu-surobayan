<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBaruBalitaModel extends Model
{
    protected $table = 'tb_data_baru_balita'; // tabel sementara
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik_anak',
        'nama_anak',
        'tgl_lahir',
        'jenis_kelamin',
        'berat_badan_lahir',
        'panjang_badan_lahir',
        'lingkar_kepala_lahir',
        'premature_mature',
        'no_kk',
        'nik_ibu',
        'nama_ibu',
        'nik_ayah',
        'nama_ayah',
        'created_at'
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
        $mainModel = new \App\Models\BalitaModel();

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
