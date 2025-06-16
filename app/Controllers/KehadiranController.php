<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KehadiranModel;
use App\Models\BalitaModel;
use App\Models\RemajaPutriModel;
use App\Models\LansiaModel;

class KehadiranController extends BaseController
{
    protected $kehadiranModel;

    public function __construct()
    {
        $this->kehadiranModel = new KehadiranModel();
    }

    public function index()
    {
        $tahun = date('Y');
        $kategori = $this->request->getGet('kategori') ?? 'balita';

        $data['bulan'] = range(1, 12);
        $data['kategori'] = $kategori;
        $data['tahun'] = $tahun;
        $data['kehadiran'] = $this->kehadiranModel->getByKategori($kategori, $tahun);

        switch ($kategori) {
            case 'remaja':
                $data['peserta'] = (new RemajaPutriModel())->findAll();
                break;
            case 'lansia':
                $data['peserta'] = (new LansiaModel())->findAll();
                break;
            default:
                $data['peserta'] = (new BalitaModel())->findAll();
                break;
        }

        return view('admin/kehadiran_index', $data);
    }

    public function simpan()
    {
        $id_peserta = $this->request->getPost('id_peserta');
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $kategori = $this->request->getPost('kategori');
        $hadir = $this->request->getPost('hadir');

        $data = [
            'id_peserta' => $id_peserta,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'kategori' => $kategori,
            'hadir' => $hadir,
        ];

        $this->kehadiranModel->simpanData($data);

        return $this->response->setJSON(['status' => 'success']);
    }
}
