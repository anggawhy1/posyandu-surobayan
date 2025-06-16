<?php

namespace App\Controllers;
use App\Models\DataBalitaModel;
use CodeIgniter\Controller;

class DataBalita extends Controller
{
    public function index()
    {
        return view('data_balita');
    }

    public function store()
    {
        $model = new DataBalitaModel();

        $data = [
            'nik_anak' => $this->request->getPost('nik_anak'),
            'nama_anak' => $this->request->getPost('nama_anak'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'berat_badan_lahir' => $this->request->getPost('berat_badan_lahir'),
            'panjang_badan_lahir' => $this->request->getPost('panjang_badan_lahir'),
            'lingkar_kepala_lahir' => $this->request->getPost('lingkar_kepala_lahir'),
            'premature_mature' => $this->request->getPost('premature_mature'),
            'no_kk' => $this->request->getPost('no_kk'),
            'nik_ibu' => $this->request->getPost('nik_ibu'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'nik_ayah' => $this->request->getPost('nik_ayah'),
            'nama_ayah' => $this->request->getPost('nama_ayah')
        ];

        $model->insert($data);

        return $this->response->setJSON(['success' => true]);
    }
}