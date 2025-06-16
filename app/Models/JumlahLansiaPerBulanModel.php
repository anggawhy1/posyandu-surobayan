<?php

namespace App\Models;

use CodeIgniter\Model;

class JumlahLansiaPerBulanModel extends Model
{
    protected $table = 'tb_jumlah_lansia_per_bulan'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['bulan', 'jumlah_lansia'];

    // Ambil semua data jumlah per bulan balita
    public function getJumlahLansiaPerBulan()
    {
        return $this->orderBy('bulan', 'ASC')->findAll();
    }
}
