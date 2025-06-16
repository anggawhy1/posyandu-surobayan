<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiranModel extends Model
{
    protected $table = 'tb_kehadiran_bulanan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'bulan',
        'tahun',
        'kategori', // balita / remaja / lansia
        'nama',
        'nik',
        'hadir',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;

    // Ambil semua data kehadiran berdasarkan bulan & tahun tertentu
    public function getByBulanTahun($bulan, $tahun)
    {
        return $this->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->orderBy('kategori')
                    ->findAll();
    }

    // Ambil data per kategori
    public function getByKategori($kategori)
    {
        return $this->where('kategori', $kategori)
                    ->orderBy('nama', 'ASC')
                    ->findAll();
    }

    // Ambil data berdasarkan NIK dan bulan tertentu
    public function getHadir($nik, $bulan, $tahun, $kategori)
    {
        return $this->where([
                'nik' => $nik,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'kategori' => $kategori
            ])->first();
    }

    // Simpan atau update kehadiran
    public function saveHadir($data)
    {
        $existing = $this->getHadir($data['nik'], $data['bulan'], $data['tahun'], $data['kategori']);

        if ($existing) {
            return $this->update($existing['id'], [
                'hadir' => $data['hadir'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            return $this->insert($data);
        }
    }
}