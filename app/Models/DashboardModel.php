<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // Fungsi lama (tetap ada)
    public function getBalita()
    {
        $query = $this->db->query("SELECT * FROM tb_data_balita2025_surobayan LIMIT 5");
        return $query->getResultArray(); 
    }

    public function getRemajaPutri()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM tb_data_remajaputri2025_surobayan");
        $data = $query->getRowArray();
        return ['total' => $data['total'], 'perempuan' => $data['total'], 'laki' => 0];
    }

    public function getIbuHamil()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM tb_data_ibuhamil_surobayan");
        $data = $query->getRowArray();
        return ['total' => $data['total'], 'perempuan' => $data['total'], 'laki' => 0];
    }

    public function getLansia()
    {
        $query = $this->db->query("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN jenis_kelamin = 'P' THEN 1 ELSE 0 END) as perempuan,
                SUM(CASE WHEN jenis_kelamin = 'L' THEN 1 ELSE 0 END) as laki
            FROM tb_data_lansia_surobayan
        ");

        return $query->getRowArray();
    }

    public function getUsiaProduktif()
    {
        $total = 0;
        $perempuan = 0;
        $laki = 0;

        for ($i = 1; $i <= 10; $i++) {
            $table = "tb_data_usia_produktif_rt0{$i}";
            $query = $this->db->query("
                SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN jenis_kelamin = 'P' THEN 1 ELSE 0 END) as perempuan,
                    SUM(CASE WHEN jenis_kelamin = 'L' THEN 1 ELSE 0 END) as laki
                FROM $table
            ");

            $data = $query->getRowArray();

            $total += $data['total'];
            $perempuan += $data['perempuan'];
            $laki += $data['laki'];
        }

        return ['total' => $total, 'perempuan' => $perempuan, 'laki' => $laki];
    }

    // 🔥 Fungsi BARU untuk ambil data terbaru (khusus tabel baru)
    public function getDataTerbaruBalita()
    {
        return $this->db->table('tb_data_baru_balita')->get()->getResultArray();
    }

    public function getDataTerbaruIbuHamil()
    {
        return $this->db->table('tb_data_baru_ibu_hamil')->get()->getResultArray();
    }

    public function getDataTerbaruRemajaPutri()
    {
        return $this->db->table('tb_data_baru_remaja_putri')->get()->getResultArray();
    }
}
