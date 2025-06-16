<?php

namespace App\Models;

use CodeIgniter\Model;

class DataIbuHamilModel extends Model
{
    protected $table = 'tb_data_baru_ibu_hamil';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik',
        'nama_ibu_hamil',
        'nik_suami',
        'nama_suami',
        'pekerjaan_ibu_hamil',
        'pekerjaan_suami',
        'tgl_mulai_hamil',
        'tgl_perkiraan_lahir',
        'usia_kehamilan',
        'golDarah_ibu_hamil',
        'golDarah_suami',
        'kadar_hb',
        'bb_sebelum_hamil',
        'no_telepon',
        'alamat'
    ];
}
