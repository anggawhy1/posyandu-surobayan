<?php

namespace App\Models;

use CodeIgniter\Model;

class JumlahRemajaPerBulanModel extends Model
{
    protected $table = 'tb_jumlah_remaja_per_bulan'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['bulan', 'jumlah_remaja'];

    // Ambil semua data jumlah per bulan balita
    public function getJumlahRemajaPerBulan()
    {
        return $this->orderBy('bulan', 'ASC')->findAll();
    }
}
