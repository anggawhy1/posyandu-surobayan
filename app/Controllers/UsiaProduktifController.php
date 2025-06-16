<?php

namespace App\Controllers;

use App\Models\UsiaProduktifModel;
use CodeIgniter\Controller;

class UsiaProduktifController extends Controller
{
    protected $usiaProduktifModel;

    public function __construct()
    {
        $this->usiaProduktifModel = new UsiaProduktifModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $alamat = $this->request->getGet('alamat');
        $jenisKelamin = $this->request->getGet('jenis_kelamin');

        $perPage = 50; // Data per halaman
        $page = $this->request->getVar('page') ?? 1; // Halaman aktif

        $data['usiaProduktif'] = $this->usiaProduktifModel
            ->getFilteredData($search, $alamat, $jenisKelamin, $perPage, $page);

        $total = $this->usiaProduktifModel->countFilteredData($search, $alamat, $jenisKelamin);

        $data['pager'] = $this->usiaProduktifModel->pager;
        $data['startIndex'] = ($page - 1) * $perPage; // Index untuk nomor urut

        return view('admin/data_usia_produktif', $data);
    }


    public function searchUsiaProduktif()
    {
        $keyword = $this->request->getGet('keyword');
        $jenis_kelamin = $this->request->getGet('jenis_kelamin');
        $alamat = $this->request->getGet('alamat');

        $model = new UsiaProduktifModel();
        $data = $model->searchData($keyword, $jenis_kelamin, $alamat);

        return $this->response->setJSON($data);
    }

    public function arsipkan()
    {
        $request = service('request');
        $data = json_decode($request->getBody(), true);
    
        // Simpan ke tabel arsip lansia
        $db = db_connect();
        $builder = $db->table('tb_arsip_usia_produktif');
    
        $builder->insert([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'usia' => $data['usia'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'kategori' => $data['kategori']
            
        ]);
    
        // Hapus dari tabel utama
        $db->table('tb_data_usia_produktif_surobayan')->delete(['id' => $data['id']]);
    
        return $this->response->setJSON(["message" => "Data berhasil diarsipkan!"]);
    }
    
    public function hapus($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_data_usia_produktif_surobayan');
    
        $delete = $builder->delete(['id' => $id]);
    
        if ($delete) {
            return $this->response->setJSON(['message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['message' => 'Gagal menghapus data'], 500);
        }
    }
    

    public function update()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID tidak valid']);
        }

        $updateData = [
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'usia' => $data['usia'],
            'jenis_kelamin' => $data['jenis_kelamin']
        ];

        // Simpan pakai model
        if ($this->usiaProduktifModel->updateData($data['id'], $updateData)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function store()
    {
        $model = new UsiaProduktifModel();

        $nik = $this->request->getPost('nik');

        // Cek apakah NIK sudah ada
        $existing = $model->where('nik', $nik)->first();
        if ($existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'NIK sudah terdaftar!'
            ]);
        }

        $data = [
            'nik' => $nik,
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'usia' => $this->request->getPost('usia'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ];

        $model->insert($data);

        return $this->response->setJSON(['success' => true]);
    }

    public function tambah()
    {
        return view('admin/tambah-usia-produktif');
    }

    

    public function simpan()
    {
        $nik = $this->request->getPost('nik');
        
        // Cek apakah NIK sudah ada
        if ($this->usiaProduktifModel->isNikExists($nik)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'NIK sudah terdaftar!']);
        }

        $data = [
            'nik' => $nik,
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'usia' => $this->request->getPost('usia'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ];

        $this->usiaProduktifModel->insertData($data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil ditambahkan!']);
    }
}
