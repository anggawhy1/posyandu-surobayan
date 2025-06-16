<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBaruBalitaModel;
use App\Models\BalitaModel;

class DataBaruBalitaController extends BaseController
{
    public function balita()
    {
        $model = new DataBaruBalitaModel();

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $data['balita'] = $model->paginate($perPage, 'default', $page);
        $data['pager'] = $model->pager;

        return view('admin/data_baru_balita', $data);
    }

    public function update()
    {
        $data = $this->request->getJSON();
        if (!$data || !isset($data->id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak valid.'
            ]);
        }

        $model = new DataBaruBalitaModel();

        $updateData = [
            'nik_anak'             => $data->nik_anak,
            'nama_anak'            => $data->nama_anak,
            'tgl_lahir'            => $data->tgl_lahir,
            'jenis_kelamin'        => $data->jenis_kelamin,
            'berat_badan_lahir'    => $data->berat_badan_lahir,
            'panjang_badan_lahir'  => $data->panjang_badan_lahir,
            'lingkar_kepala_lahir' => $data->lingkar_kepala_lahir,
            'premature_mature'     => $data->premature_mature,
            'no_kk'                => $data->no_kk,
            'nik_ibu'              => $data->nik_ibu,
            'nama_ibu'             => $data->nama_ibu,
            'nik_ayah'             => $data->nik_ayah,
            'nama_ayah'            => $data->nama_ayah,
        ];

        $model->update($data->id, $updateData);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil diupdate.'
        ]);
    }

    public function konfirmasi($id)
    {
        $modelBaru = new DataBaruBalitaModel();
        $modelUtama = new BalitaModel();

        $data = $modelBaru->find($id);
        if (!$data) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }

        unset($data['id']);
        $data['created_at'] = date('Y-m-d H:i:s');

        $modelUtama->insert($data);
        $modelBaru->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Data berhasil dikonfirmasi dan dipindahkan.'
        ]);
    }


    public function hapus($id)
    {
        $model = new DataBaruBalitaModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
