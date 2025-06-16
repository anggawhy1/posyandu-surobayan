<?php

namespace App\Controllers;

use App\Models\IbuHamilModel;
use CodeIgniter\Controller;

class IbuHamilController extends Controller
{
    protected $ibuHamilModel;

    public function __construct()
    {
        $this->ibuHamilModel = new IbuHamilModel();
    }

    public function index()
{
    $model = new \App\Models\IbuHamilModel();
    $searchQuery = $this->request->getGet('search');
    $filterAlamat = $this->request->getGet('alamat');

    $query = $this->ibuHamilModel;

    if (!empty($searchQuery)) {
        $query = $query->groupStart()
                        ->like('nik', $searchQuery)
                        ->orLike('nama_ibu_hamil', $searchQuery)
                      ->groupEnd();
    }

    if (!empty($filterAlamat)) {
        $query = $query->where('alamat', $filterAlamat);
    }

    $data['ibuHamil'] = $query->findAll();
    $data['searchQuery'] = $searchQuery;
    $data['filterAlamat'] = $filterAlamat;
    // Ambil 50 data per halaman
    $data['ibuHamil'] = $model->paginate(25, 'default');
    $data['pager'] = $model->pager;
    return view('admin/data_ibu_hamil', $data);
}



    public function arsipkanIbuHamil()
    {
        $json = $this->request->getJSON();
        $id = $json->id;
        $kategori = $json->kategori;

        // Gunakan model untuk mengarsipkan
        $arsipkan = $this->ibuHamilModel->arsipkanIbuHamil($id, $kategori);

        if ($arsipkan) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengarsipkan']);
        }
    }

    public function hapus()
    {
        $request = service('request');
        $id = $request->getJSON()->id ?? null;

        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID tidak valid']);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('tb_data_ibuhamil_surobayan');
        $deleted = $builder->where('id', $id)->delete();

        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function tambah()
    {
        return view('admin/tambah_ibu_hamil');
    }


    public function simpan()
{
    $request = service('request');
    $db = \Config\Database::connect();
    $builder = $db->table('tb_data_ibuhamil_surobayan');

    $nik = $request->getPost('nik');

    // Cek apakah NIK sudah ada
    $cek = $builder->where('nik', $nik)->get()->getRow();

    if ($cek) {
        // Kalau NIK duplikat, kirim data inputan ke view biar ga kosong
        return view('admin/tambah_ibu_hamil', [
            'duplikat' => true,
            'old' => $request->getPost() // <-- ini penting
        ]);
    }
    

    $data = [
        'nik' => $nik,
        'nama_ibu_hamil' => $request->getPost('nama_ibu_hamil'),
        'nik_suami' => $request->getPost('nik_suami'),
        'nama_suami' => $request->getPost('nama_suami'),
        'pekerjaan_ibu_hamil' => $request->getPost('pekerjaan_ibu_hamil'),
        'pekerjaan_suami' => $request->getPost('pekerjaan_suami'),
        'tgl_mulai_hamil' => $request->getPost('tgl_mulai_hamil'),
        'tgl_perkiraan_lahir' => $request->getPost('tgl_perkiraan_lahir'),
        'usia_kehamilan' => $request->getPost('usia_kehamilan'),
        'golDarah_ibu_hamil' => $request->getPost('golDarah_ibu_hamil'),
        'golDarah_suami' => $request->getPost('golDarah_suami'),
        'kadar_hb' => $request->getPost('kadar_hb'),
        'bb_sebelum_hamil' => $request->getPost('bb_sebelum_hamil'),
        'no_telepon' => $request->getPost('no_telepon'),
        'alamat' => $request->getPost('alamat'),
    ];

    if ($builder->insert($data)) {
        return view('admin/tambah_ibu_hamil', ['success' => true]);
    } else {
        return view('admin/tambah_ibu_hamil', ['error' => true]);
    }
}


    public function updateData()
    {
        $request = service('request');
        $data = json_decode($request->getBody(), true);

        if (!isset($data['id'])) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "ID tidak ditemukan"
            ]);
        }

        $id = $data['id'];
        unset($data['id']); // Hapus ID dari array sebelum update

        $ibuHamilModel = new IbuHamilModel();
        $update = $ibuHamilModel->update($id, $data);

        if ($update) {
            return $this->response->setJSON([
                "status" => "success",
                "message" => "Data berhasil diperbarui"
            ]);
        } else {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Gagal memperbarui data"
            ]);
        }

        // Cek duplikat NIK
        $cek = $model->where('nik', $nik)->first();

        if ($cek) {
            return view('admin/tambah_ibu_hamil', ['duplikat' => true]);
        }
    }

    // public function searchIbuHamil()
    // {
    //     $query = $this->request->getGet('query');
    //     $model = new IbuHamilModel();

    //     if (!empty($query)) {
    //         $data = $model->like('nik', $query)
    //             ->orLike('nama_ibu_hamil', $query)
    //             ->findAll();
    //     } else {
    //         $data = $model->findAll();
    //     }

    //     return $this->response->setJSON($data);
    // }
}
