<?php

namespace App\Controllers;

use App\Models\LansiaModel;
use CodeIgniter\Controller;

class LansiaController extends Controller
{
    protected $lansiaModel;

    public function __construct()
    {
        $this->lansiaModel = new LansiaModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $alamat = $this->request->getGet('alamat');
        $jenisKelamin = $this->request->getGet('jenis_kelamin');

        $data = [
            'lansia' => $this->lansiaModel->getFilteredData($search, $alamat, $jenisKelamin),
            'pager' => $this->lansiaModel->pager
        ];

        return view('admin/data-lansia', $data);
    }

    public function tambah()
    {
        return view('admin/tambah-lansia');
    }

    public function simpan()
    {
        $data = $this->request->getJSON();
        $model = new LansiaModel();

        // Cek apakah NIK sudah ada
        if ($model->where('nik', $data->nik)->first()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'NIK sudah terdaftar. Silakan gunakan NIK lain.'
            ]);
        }

        $model->save([
            'nik' => $data->nik,
            'nama' => $data->nama,
            'alamat' => $data->alamat,
            'usia' => $data->usia,
            'jenis_kelamin' => $data->jenis_kelamin,
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function update()
    {
        $request = $this->request->getJSON(); // Ambil data JSON dari request

        if (!$request) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid']);
        }

        $id = $request->id;
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        $model = new LansiaModel();
        $update = $model->update($id, $data);

        if ($update) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui data']);
        }
    }


    public function arsipkan($id)
    {
        $json = $this->request->getJSON(true);
        $kategori = $json['kategori'] ?? null;

        if (!$kategori || !$id) {
            return $this->response->setJSON(['message' => 'Data tidak lengkap.']);
        }

        $model = new \App\Models\LansiaModel();

        $success = $model->arsipkanData($id, $kategori);

        if ($success) {
            return $this->response->setJSON(['message' => 'Data berhasil diarsipkan.']);
        }

        return $this->response->setJSON(['message' => 'Gagal mengarsipkan data.']);
    }



    public function hapus($id)
    {
        if ($this->lansiaModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal dihapus']);
        }
    }
}
