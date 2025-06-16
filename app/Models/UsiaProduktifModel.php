<?php

namespace App\Models;

use CodeIgniter\Model;

class UsiaProduktifModel extends Model
{
    protected $table = 'tb_data_usia_produktif_surobayan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nik', 'nama', 'alamat', 'usia', 'jenis_kelamin', 'kategori'];

    public function getFilteredData($search = null, $alamat = null, $jenisKelamin = null, $perPage = 50, $page = 1)
    {
        $builder = $this->table($this->table);

        if ($search) {
            $builder->like('nama', $search)->orLike('nik', $search);
        }
        if ($alamat) {
            $builder->where('alamat', $alamat);
        }
        if ($jenisKelamin) {
            $builder->where('jenis_kelamin', $jenisKelamin);
        }

        return $this->paginate($perPage, 'default', $page);
    }

    // Fungsi untuk menghitung total data sesuai filter
    public function countFilteredData($search = null, $alamat = null, $jenisKelamin = null)
    {
        $builder = $this->table($this->table);

        if ($search) {
            $builder->like('nama', $search)->orLike('nik', $search);
        }
        if ($alamat) {
            $builder->where('alamat', $alamat);
        }
        if ($jenisKelamin) {
            $builder->where('jenis_kelamin', $jenisKelamin);
        }

        return $builder->countAllResults();
    }


    public function searchData($keyword = "", $jenis_kelamin = "", $alamat = "")
    {
        $builder = $this->table($this->table);

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('LOWER(TRIM(nama))', strtolower(trim($keyword)))
                ->orLike('LOWER(TRIM(nik))', strtolower(trim($keyword)))
                ->groupEnd();
        }

        if (!empty($jenis_kelamin)) {
            $builder->where('jenis_kelamin', $jenis_kelamin);
        }

        if (!empty($alamat)) {
            $builder->like('LOWER(TRIM(alamat))', strtolower(trim($alamat)));
        }

        return $builder->get()->getResultArray();
    }

    // Fungsi untuk update data
    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }


    public function isNikExists($nik)
    {
        return $this->where('nik', $nik)->countAllResults() > 0;
    }

    public function insertData($data)
    {
        return $this->insert($data);
    }
}
