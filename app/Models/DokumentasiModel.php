<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumentasiModel extends Model
{
    protected $table = 'tb_dokumentasi_posyandu'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_dokumentasi', 'gambar', 'created_at'];

    // Ambil semua dokumentasi dengan pagination (6 per halaman)
    public function getDokumentasi($limit, $offset)
    {
        return $this->orderBy('created_at', 'DESC')->findAll($limit, $offset);
    }

    // Simpan dokumentasi baru
    public function tambahDokumentasi($data)
    {
        return $this->insert($data);
    }

    // Hapus dokumentasi berdasarkan ID
    public function hapusDokumentasi($id)
    {
        return $this->delete($id);
    }

    // Hitung total data untuk pagination
    public function countDokumentasi()
    {
        return $this->countAll();
    }
}
