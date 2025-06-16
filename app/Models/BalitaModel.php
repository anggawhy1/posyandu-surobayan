<?php

namespace App\Models;

use CodeIgniter\Model;

class BalitaModel extends Model
{
    protected $table = 'tb_data_balita2025_surobayan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nik_anak',
        'nama_anak',
        'tgl_lahir',
        'jenis_kelamin',
        'berat_badan_lahir',
        'panjang_badan_lahir',
        'lingkar_kepala_lahir',
        'premature_mature',
        'no_kk',
        'nik_ibu',
        'nama_ibu',
        'nik_ayah',
        'nama_ayah',
    ];

    protected $useTimestamps = true;

    public function search($keyword, $rt = null, $jenisKelamin = null)
    {
        $builder = $this;

        $builder->groupStart()
            ->like('nama_anak', $keyword)
            ->orLike('nik_anak', $keyword)
            ->groupEnd();

        if ($rt) {
            $builder->where('alamat', $rt);
        }

        if ($jenisKelamin) {
            $builder->where('jenis_kelamin', $jenisKelamin);
        }

        return $builder;
    }

    public function getDataFiltered($jk = '', $keyword = '')
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_data_balita2025_surobayan');

        if ($jk !== '') {
            $builder->where('jenis_kelamin', $jk);
        }

        if ($keyword !== '') {
            $builder->groupStart()
                ->like('nik_anak', $keyword)
                ->orLike('nama_anak', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }



    public function arsipkan($id, $kategori)
    {
        $data = $this->find($id);
        if (!$data) return false;

        unset($data['id']);
        $data['kategori_arsip'] = $kategori;
        $data['created_at'] = date('Y-m-d H:i:s');

        $inserted = $this->db->table('tb_arsip_balita2025')->insert($data);

        if ($inserted) {
            return $this->delete($id);
        }

        return false;
    }
}
