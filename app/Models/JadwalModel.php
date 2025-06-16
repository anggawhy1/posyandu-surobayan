<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'tb_jadwal_posyandu'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['kegiatan', 'tanggal', 'waktu', 'lokasi'];

    // Ambil semua jadwal
    public function getJadwal()
    {
        return $this->orderBy('tanggal', 'ASC')->findAll();
    }

    // Simpan data jadwal baru
    public function tambahJadwal($data)
    {
        return $this->insert($data);
    }

    // Hapus jadwal berdasarkan ID
    public function hapusJadwal($id)
    {
        return $this->delete($id);
    }
}
