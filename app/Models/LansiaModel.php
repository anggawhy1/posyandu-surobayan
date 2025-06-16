<?php

namespace App\Models;

use CodeIgniter\Model;

class LansiaModel extends Model
{
    protected $table = 'tb_data_lansia_surobayan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nik', 'nama', 'alamat', 'usia', 'jenis_kelamin'];

    // 🔹 Ambil data dengan filter pencarian
    public function getFilteredData($search = null, $alamat = null, $jenisKelamin = null)
    {
        $builder = $this->table($this->table);

        if ($search) {
            $builder->groupStart()
                ->like('nama', $search)
                ->orLike('nik', $search)
                ->groupEnd();
        }
        if ($alamat) {
            $builder->where('alamat', $alamat);
        }
        if ($jenisKelamin) {
            $builder->where('jenis_kelamin', $jenisKelamin);
        }

        return $builder->paginate(50, 'default');
    }

    // 🔹 Cek duplikat NIK
    public function checkDuplicateNik($nik)
    {
        return $this->where('nik', $nik)->findColumn('id');
    }

    // 🔹 Update data berdasarkan ID
    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    // 🔹 Hapus data lansia berdasarkan ID
    public function deleteData($id)
    {
        return $this->delete($id);
    }
    public function arsipkanData($id, $kategori)
    {
        $db = db_connect();
        $data = $this->find($id);

        if ($data) {
            // Tambahkan kategori ke dalam data
            $data['kategori'] = $kategori;

            // Simpan ke tabel arsip
            $db->table('tb_arsip_lansia_surobayan')->insert($data);

            // Hapus dari tabel utama
            return $this->delete($id);
        }

        return false;
    }
}
