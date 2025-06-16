<?php

namespace App\Controllers;

use App\Models\RemajaPutriModel;
use CodeIgniter\Controller;

class RemajaPutriController extends Controller
{
    protected $remajaputriModel;

    public function __construct()
    {
        $this->remajaputriModel = new RemajaPutriModel();
    }

    public function index()
{
    $keyword = $this->request->getGet('search');
    $rt = $this->request->getGet('rt');
    $perPage = 50;

    if ($keyword || $rt) {
        // search() sekarang return query builder
        $remajaputriBuilder = $this->remajaputriModel->search($keyword, $rt);
        $data['remajaputri'] = $remajaputriBuilder->paginate($perPage, 'default');
    } else {
        $data['remajaputri'] = $this->remajaputriModel->paginate($perPage, 'default');
    }

    $data['pager'] = $this->remajaputriModel->pager;

    return view('admin/data_remaja_putri', $data);
}


    public function tambah()
    {
        return view('admin/tambah_remaja_putri');
    }

    public function simpan()
    {
        $nik = $this->request->getPost('nik');

        $cek = $this->remajaputriModel->where('nik', $nik)->first();
        if ($cek) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'NIK sudah ada']);
        }

        $this->remajaputriModel->insert([
            'nik' => $nik,
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'golongan_darah' => $this->request->getPost('golongan_darah'),
            'kadar_hb' => $this->request->getPost('kadar_hb'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon')
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function arsipkan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $kategori = $this->request->getPost('kategori');

            if ($this->remajaputriModel->arsipkan($id, $kategori)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        }
    }


    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $hapus = $this->remajaputriModel->delete($id);

            return $this->response->setJSON([
                'success' => $hapus ? true : false
            ]);
        }
    }

    public function update()
{
    $data = $this->request->getJSON();

    if (!$data) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Data tidak valid.'
        ]);
    }

    $model = new RemajaPutriModel();

    $updateData = [
        'nik'             => $data->nik,
        'nama_lengkap'    => $data->nama_lengkap,
        'tanggal_lahir'   => $data->tanggal_lahir,
        'alamat'          => $data->alamat,
        'golongan_darah'  => $data->golongan_darah,
        'kadar_hb'        => $data->kadar_hb,
        'nomor_telepon'   => $data->nomor_telepon
    ];

    $model->update($data->id, $updateData);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Data berhasil diupdate.'
    ]);
}


}
