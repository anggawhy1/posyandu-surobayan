<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipLansiaModel extends Model
{
    protected $table = 'tb_arsip_lansia_surobayan'; // Pastikan ini tabel yang benar
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik', 
        'nama', 
        'alamat', 
        'usia', 
        'jenis_kelamin', 
        'kategori', // Pastikan menambahkan kolom kategori_arsip jika ada di tabel
        'created_at',
    ];

    // Fungsi untuk mengambil semua data arsip
    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    // Fungsi konfirmasi untuk memindahkan data arsip ke tabel utama
    public function konfirmasi($id)
    {
        $data = $this->find($id);

        if (!$data) return false;

        // Hubungkan ke model utama untuk insert
        $mainModel = new \App\Models\ArsiplansiaModel();

        // Menghapus kolom id yang tidak diperlukan dan memastikan data yang valid untuk dimasukkan
        unset($data['id']);
        $data['updated_at'] = null;

        $inserted = $mainModel->insert($data);

        if ($inserted) {
            return $this->delete($id); // Menghapus data dari tabel arsip setelah dipindahkan
        }

        return false;
    }
}


