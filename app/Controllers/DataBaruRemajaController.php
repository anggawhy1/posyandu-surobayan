<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBaruRemajaModel;
use App\Models\RemajaPutriModel;

class DataBaruRemajaController extends BaseController
{
    public function remaja()
{
    $model = new DataBaruRemajaModel();

    $page = $this->request->getGet('page') ?? 1;
    $perPage = 15;
    $offset = ($page - 1) * $perPage;
    $data['remaja'] = $model->paginate($perPage, 'default', $page);
    $data['pager'] = $model->pager;

    return view('admin/data_baru_remaja', $data);
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

        $model = new DataBaruRemajaModel();

        $updateData = [
            'nama_lengkap'        => $data->nama_lengkap,
            'nik'                 => $data->nik,
            'tanggal_lahir'       => $data->tanggal_lahir,
            'golongan_darah'      => $data->golongan_darah,
            'kadar_hb'            => $data->kadar_hb,
            'alamat'              => $data->alamat,
            'nomor_telepon'       => $data->nomor_telepon,
            // 'updated_at'          => date('Y-m-d H:i:s') // Update timestamp
        ];
        

        $model->update($data->id, $updateData);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil diupdate.'
        ]);
    }

    public function konfirmasi($id)
{
    $modelBaru = new DataBaruRemajaModel();
    $modelUtama = new RemajaPutriModel();

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
    $model = new DataBaruRemajaModel();
    $deleted = $model->delete($id);

    if ($deleted) {
        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setJSON(['success' => false]);
}

}
