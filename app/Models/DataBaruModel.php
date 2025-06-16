<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBaruBalitaModel extends Model
{
    protected $table = 'tb_data_baru_balita';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik_anak', 'nama_anak', 'tgl_lahir', 'jenis_kelamin', 'berat_badan_lahir',
        'panjang_badan_lahir', 'lingkar_kepala_lahir', 'premature_mature',
        'no_kk', 'nik_ibu', 'nama_ibu', 'nik_ayah', 'nama_ayah', 'created_at'
    ];
    protected $useTimestamps = true;
}

class DataBaruRemajaPutriModel extends Model
{
    protected $table = 'tb_data_baru_remaja_putri';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik', 'nama', 'tgl_lahir', 'jenis_kelamin', 'sekolah', 'alamat', 'created_at'
    ];
    protected $useTimestamps = true;
}

class DataBaruIbuHamilModel extends Model
{
    protected $table = 'tb_data_baru_ibu_hamil';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik', 'nama', 'umur', 'hamil_ke', 'alamat', 'created_at'
    ];
    protected $useTimestamps = true;
}
