<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBalitaModel extends Model
{
    protected $table = 'tb_data_baru_balita';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik_anak', 'nama_anak', 'tgl_lahir', 'jenis_kelamin', 
        'berat_badan_lahir', 'panjang_badan_lahir', 'lingkar_kepala_lahir', 
        'premature_mature', 'no_kk', 'nik_ibu', 'nama_ibu', 'nik_ayah', 'nama_ayah'
    ];

    
}
