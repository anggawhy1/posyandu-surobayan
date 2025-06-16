<?php

namespace App\Models;

use CodeIgniter\Model;

class JumlahBalitaPerBulanModel extends Model
{
    protected $table = 'tb_jumlah_balita_per_bulan'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['bulan', 'jumlah_balita'];

    // Ambil semua data jumlah per bulan balita
    public function getJumlahBalitaPerBulan()
    {
        return $this->orderBy('bulan', 'ASC')->findAll();
    }
}
