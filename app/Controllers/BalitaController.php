<?php

namespace App\Controllers;

use App\Models\BalitaModel;
use CodeIgniter\Controller;
use CodeIgniter\Log\Logger;

class BalitaController extends Controller
{
    protected $balitaModel;

    public function __construct()
    {
        $this->balitaModel = new BalitaModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');
        $rt = $this->request->getGet('rt');
        $jk = $this->request->getGet('jk'); // Ambil dari dropdown
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 20;

        if ($keyword || $rt || $jk) {
            $balitaBuilder = $this->balitaModel->getDataFiltered($jk, $keyword, $rt);
            
        } else {
            $data['balita'] = $this->balitaModel->paginate($perPage, 'default');
        }

        $data['pager'] = $this->balitaModel->pager;
        $data['currentPage'] = $this->balitaModel->pager->getCurrentPage('default');  // Tambahkan baris ini
        $data['perPage'] = $perPage; // Pastikan perPage juga dikirim

        return view('admin/data_balita', $data);
    }


    public function tambah()
    {
        return view('admin/tambah-balita');
    }

    public function simpan()
    {
        $nik = $this->request->getPost('nik_anak');

        $cek = $this->balitaModel->where('nik_anak', $nik)->first();
        if ($cek) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'NIK sudah ada']);
        }

        $insert = $this->balitaModel->insert([
            'nik_anak'              => $nik,
            'nama_anak'             => $this->request->getPost('nama_anak'),
            'tgl_lahir'             => $this->request->getPost('tgl_lahir'),
            'jenis_kelamin'         => $this->request->getPost('jenis_kelamin'),
            'berat_badan_lahir'     => (float) $this->request->getPost('berat_badan_lahir'),
            'panjang_badan_lahir'   => (float) $this->request->getPost('panjang_badan_lahir'),
            'lingkar_kepala_lahir'  => (float) $this->request->getPost('lingkar_kepala_lahir'),
            'premature_mature'      => $this->request->getPost('premature_mature'),
            'no_kk'                 => $this->request->getPost('no_kk'),
            'nik_ibu'               => $this->request->getPost('nik_ibu'),
            'nama_ibu'              => $this->request->getPost('nama_ibu'),
            'nik_ayah'              => $this->request->getPost('nik_ayah'),
            'nama_ayah'             => $this->request->getPost('nama_ayah'),
        ]);

        if ($insert) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal simpan']);
        }
    }

    public function arsipkan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $kategori = $this->request->getPost('kategori');

            if ($this->balitaModel->arsipkan($id, $kategori)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                log_message('error', 'Gagal mengarsipkan ID: ' . $id);
                return $this->response->setJSON(['success' => false]);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }
    }

    public function hapus()
    {
        $data = $this->request->getJSON();
        $id = $data->id;

        if ($id) {
            $this->balitaModel->delete($id);
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }

    public function update()
    {
        log_message('debug', 'Masuk ke method update balita');

        $data = $this->request->getJSON();
        log_message('debug', 'Data diterima: ' . json_encode($data));

        if (!$data || !isset($data->id)) {
            log_message('error', 'Data tidak valid saat update');
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak valid.'
            ]);
        }

        $updateData = [
            'nik_anak'             => $data->nik_anak,
            'nama_anak'            => $data->nama_anak,
            'tgl_lahir'            => $data->tgl_lahir,
            'jenis_kelamin'        => $data->jenis_kelamin,
            'berat_badan_lahir'    => (float) $data->berat_badan_lahir,
            'panjang_badan_lahir'  => (float) $data->panjang_badan_lahir,
            'lingkar_kepala_lahir' => (float) $data->lingkar_kepala_lahir,
            'premature_mature'     => $data->premature_mature,
            'no_kk'                => $data->no_kk,
            'nik_ibu'              => $data->nik_ibu,
            'nama_ibu'             => $data->nama_ibu,
            'nik_ayah'             => $data->nik_ayah,
            'nama_ayah'            => $data->nama_ayah,
        ];

        if ($this->balitaModel->update($data->id, $updateData)) {
            log_message('debug', 'Update berhasil untuk ID: ' . $data->id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diupdate.'
            ]);
        }

        log_message('error', 'Update GAGAL untuk ID: ' . $data->id);
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal memperbarui data.'
        ]);
    }
}
