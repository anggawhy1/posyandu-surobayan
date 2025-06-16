<?php

namespace App\Controllers;

use App\Models\DataIbuHamilModel;
use CodeIgniter\Controller;

class DataIbuHamil extends Controller
{
    public function index()
    {
        $model = new DataIbuHamilModel();
        $data['ibu_hamil'] = $model->findAll();

        return view('data_ibu_hamil', $data);
    }

    public function store()
    {
        $model = new DataIbuHamilModel();

        $data = [
            'nik'                => $this->request->getPost('nik'),
            'nama_ibu_hamil'     => $this->request->getPost('nama_ibu_hamil'),
            'nik_suami'          => $this->request->getPost('nik_suami'),
            'nama_suami'         => $this->request->getPost('nama_suami'),
            'pekerjaan_ibu_hamil'=> $this->request->getPost('pekerjaan_ibu_hamil'),
            'pekerjaan_suami'    => $this->request->getPost('pekerjaan_suami'),
            'tgl_mulai_hamil'    => $this->request->getPost('tgl_mulai_hamil'),
            'tgl_perkiraan_lahir'=> $this->request->getPost('tgl_perkiraan_lahir'),
            'usia_kehamilan'     => $this->request->getPost('usia_kehamilan'),
            'golDarah_ibu_hamil' => $this->request->getPost('golDarah_ibu_hamil'),
            'golDarah_suami'     => $this->request->getPost('golDarah_suami'),
            'kadar_hb'           => $this->request->getPost('kadar_hb'),
            'bb_sebelum_hamil'   => $this->request->getPost('bb_sebelum_hamil'),
            'no_telepon'         => $this->request->getPost('no_telepon'),
            'alamat'             => $this->request->getPost('alamat')
        ];

        $model->insert($data);

        return $this->response->setJSON(['success' => true]);
    }
}
