<?php

namespace App\Controllers;

use App\Models\DokumentasiModel;
use CodeIgniter\Controller;

class Dokumentasi extends Controller
{
    protected $dokumentasiModel;
    protected $perPage = 6;

    public function __construct()
    {
        $this->dokumentasiModel = new DokumentasiModel();
    }

    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $offset = ($page - 1) * $this->perPage;

        $data['dokumentasi'] = $this->dokumentasiModel->getDokumentasi($this->perPage, $offset);
        $data['totalData'] = $this->dokumentasiModel->countDokumentasi();
        $data['currentPage'] = $page;
        $data['perPage'] = $this->perPage;

        return view('dokumentasi', $data);
    }

    public function admin()
    {
        $data['dokumentasi'] = $this->dokumentasiModel->findAll();
        return view('admin/dokumentasi', $data);
    }

    public function store()
    {
        $file = $this->request->getFile('gambar');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/dokumentasi', $newName);

            $tanggalInput = $this->request->getPost('tanggal') ?? date('Y-m-d');

            $data = [
                'nama_dokumentasi' => $this->request->getPost('nama_dokumentasi'),
                'gambar' => $newName,
                'created_at' => date('Y-m-d H:i:s', strtotime($tanggalInput)),
            ];

            $this->dokumentasiModel->tambahDokumentasi($data);
        }

        return redirect()->to('/admin/dokumentasi')->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $this->dokumentasiModel->hapusDokumentasi($id);
        return redirect()->to('/admin/dokumentasi')->with('success', 'Dokumentasi berhasil dihapus!');
    }

    public function create()
    {
        return view('admin/tambah_dokumentasi');
    }

    public function edit($id)
    {
        $dokumentasi = $this->dokumentasiModel->find($id);

        if (!$dokumentasi) {
            return redirect()->to('/admin/dokumentasi')->with('error', 'Data tidak ditemukan!');
        }

        return view('admin/edit_dokumentasi', ['dokumentasi' => $dokumentasi]);
    }

    public function update($id)
    {
        $data = [
            'nama_dokumentasi' => $this->request->getPost('nama_dokumentasi'),
            'created_at' => $this->request->getPost('created_at') ?? date('Y-m-d H:i:s'),
        ];
        
       

        $tanggalInput = $this->request->getPost('tanggal');
        if ($tanggalInput) {
            $data['created_at'] = date('Y-m-d H:i:s', strtotime($tanggalInput));
        }

        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $oldData = $this->dokumentasiModel->find($id);
            if ($oldData && file_exists('uploads/dokumentasi/' . $oldData['gambar'])) {
                unlink('uploads/dokumentasi/' . $oldData['gambar']);
            }

            $newName = $gambar->getRandomName();
            $gambar->move('uploads/dokumentasi', $newName);
            $data['gambar'] = $newName;
        }

        $this->dokumentasiModel->update($id, $data);
        return redirect()->to('/admin/dokumentasi')->with('success', 'Dokumentasi berhasil diperbarui!');
    }
}