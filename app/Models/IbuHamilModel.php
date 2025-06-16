<?php

namespace App\Models;

use CodeIgniter\Model;

class IbuHamilModel extends Model
{
    protected $table = 'tb_data_ibuhamil_surobayan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nik', 'nama_ibu_hamil', 'nik_suami', 'nama_suami', 'pekerjaan_ibu_hamil',
        'pekerjaan_suami', 'tgl_mulai_hamil', 'tgl_perkiraan_lahir', 'usia_kehamilan',
        'golDarah_ibu_hamil', 'golDarah_suami', 'kadar_hb', 'bb_sebelum_hamil',
        'no_telepon', 'alamat'
    ];

    public function arsipkanIbuHamil($id, $kategori)
    {
        $db = \Config\Database::connect();

        // Ambil data ibu hamil yang akan diarsipkan
        $ibuHamil = $this->find($id);

        if (!$ibuHamil) {
            return false; // Jika data tidak ditemukan
        }

        // Masukkan ke tabel arsip
        $db->table('tb_arsip_ibuhamil')->insert([
            'nik' => $ibuHamil['nik'],
            'nama_ibu_hamil' => $ibuHamil['nama_ibu_hamil'],
            'nik_suami' => $ibuHamil['nik_suami'],
            'nama_suami' => $ibuHamil['nama_suami'],
            'pekerjaan_ibu_hamil' => $ibuHamil['pekerjaan_ibu_hamil'],
            'pekerjaan_suami' => $ibuHamil['pekerjaan_suami'],
            'tgl_mulai_hamil' => $ibuHamil['tgl_mulai_hamil'],
            'tgl_perkiraan_lahir' => $ibuHamil['tgl_perkiraan_lahir'],
            'usia_kehamilan' => $ibuHamil['usia_kehamilan'],
            'golDarah_ibu_hamil' => $ibuHamil['golDarah_ibu_hamil'],
            'golDarah_suami' => $ibuHamil['golDarah_suami'],
            'kadar_hb' => $ibuHamil['kadar_hb'],
            'bb_sebelum_hamil' => $ibuHamil['bb_sebelum_hamil'],
            'no_telepon' => $ibuHamil['no_telepon'],
            'alamat' => $ibuHamil['alamat'],
            'kategori_arsip' => $kategori,
            'tgl_arsip' => date('Y-m-d H:i:s')
        ]);

        // Hapus dari tabel utama
        return $this->delete($id);
    }


    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }
    
}
