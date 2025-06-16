<?php

namespace App\Controllers;
use App\Models\DataRemajaModel;
use CodeIgniter\Controller;

class DataRemaja extends Controller
{
    public function index()
    {
        return view('data_remaja');
    }

    public function store()
    {
        $model = new DataRemajaModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nik' => $this->request->getPost('nik'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'golongan_darah' => $this->request->getPost('golongan_darah'),
            'kadar_hb' => $this->request->getPost('kadar_hb') ?: null,
            'alamat' => $this->request->getPost('alamat'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon') ?: null
        ];

        $model->insert($data);

        return $this->response->setJSON(['success' => true]);
    }
}
