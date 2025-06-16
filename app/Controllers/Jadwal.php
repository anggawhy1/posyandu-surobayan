<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use CodeIgniter\Controller;

class Jadwal extends Controller
{
    protected $jadwalModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
    }

    // Halaman untuk user melihat jadwal
    public function index()
    {
        $data['jadwal'] = $this->jadwalModel->getJadwal();
        return view('jadwal', $data);
    }

    // Halaman admin untuk mengelola jadwal
    public function admin()
    {
        $data['jadwal'] = $this->jadwalModel->getJadwal();
        return view('admin/jadwal', $data);
    }

    // Form tambah jadwal
    public function create()
    {
        return view('admin/form_tambah');
    }

    // Simpan data jadwal baru
    public function store()
    {
        $data = [
            'kegiatan' => $this->request->getPost('kegiatan'),
            'tanggal'  => $this->request->getPost('tanggal'),
            'waktu'    => $this->request->getPost('waktu'),
            'lokasi'   => $this->request->getPost('lokasi'),
        ];

        $this->jadwalModel->tambahJadwal($data);

        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Hapus jadwal
    public function delete($id)
    {
        $this->jadwalModel->hapusJadwal($id);
        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil dihapus!');
    }
}
