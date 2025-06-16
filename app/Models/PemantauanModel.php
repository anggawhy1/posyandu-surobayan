<?php

namespace App\Models;

use CodeIgniter\Model;

class PemantauanModel extends Model
{
    protected $table = 'view_pemantauan_balita';
    protected $primaryKey = 'id_balita';
    protected $allowedFields = [
        'id_balita', 'nama_anak', 'tgl_lahir', 'nama_ibu', 'bulan',
        'bb', 'tb', 'ntob', 'lila', 'lk', 'vit_a', 'asi'
    ];

    // Mengubah data mentah menjadi pivot berdasarkan bulan
    public function getPivotData()
    {
        $rawData = $this->orderBy('id_balita')->findAll();
        $result = [];

        foreach ($rawData as $row) {
            $id = $row['id_balita'];
            $bulan = $row['bulan'];

            if (!isset($result[$id])) {
                $result[$id] = [
                    'id_balita' => $id,
                    'nama_anak' => $row['nama_anak'],
                    'tgl_lahir' => $row['tgl_lahir'],
                    'nama_ibu' => $row['nama_ibu'],
                    'pemantauan' => []
                ];
            }

            $result[$id]['pemantauan'][$bulan] = [
                'bb'     => $row['bb'],
                'tb'     => $row['tb'],
                'ntob'   => $row['ntob'],
                'lila'   => $row['lila'],
                'lk'     => $row['lk'],
                'vit_a'  => $row['vit_a'],
                'asi'    => $row['asi']
            ];
        }

        return array_values($result);
    }

    // Ambil data bergabung balita dan pemantauan
    public function getPemantauanWithBalita()
    {
        return $this->db->table('tb_pemantauan_balita2025new p')
            ->select('p.*, b.nama_anak, b.nama_ibu, b.tgl_lahir, b.jenis_kelamin')
            ->join('tb_data_balita2025_surobayan b', 'p.id = b.id')
            ->get()
            ->getResultArray();
    }

    // Cek bulan yang seluruh datanya kosong
    public function getBulanKosong()
    {
        $builder = $this->db->table('tb_pemantauan_balita2025new');
        $bulanList = $builder->select('bulan')->distinct()->get()->getResultArray();
        $bulanKosong = [];

        foreach ($bulanList as $b) {
            $bulan = $b['bulan'];
            $rows = $builder->where('bulan', $bulan)->get()->getResultArray();

            $semuaKosong = true;

            foreach ($rows as $row) {
                foreach (['bb', 'tb', 'ntob', 'lila', 'lk', 'vit_a', 'asi'] as $kolom) {
                    $nilai = $row[$kolom];
                    if (!is_null($nilai) && $nilai !== '' && floatval($nilai) != 0.0) {
                        $semuaKosong = false;
                        break 2;
                    }
                }
            }

            if ($semuaKosong) {
                $bulanKosong[] = $bulan;
            }
        }

        return $bulanKosong;
    }

    public function getFilteredData($search = null, $jenisKelamin = null, $perPage = 50, $page = 1)
{
    $builder = $this->table('tb_data_balita2025_surobayan');  // Gunakan tabel asli tb_data_balita2025_surobayan

    if ($jenisKelamin) {
        $builder->where('jenis_kelamin', $jenisKelamin);
    }
    return $builder->paginate($perPage, 'default', $page);
}

}