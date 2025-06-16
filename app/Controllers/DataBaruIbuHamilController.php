<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBaruIbuHamilModel;
use App\Models\IbuHamilModel;

class DataBaruIbuHamilController extends BaseController
{
    public function ibuHamil()
    {
        $model = new DataBaruIbuHamilModel();

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $data['ibuHamil'] = $model->paginate($perPage, 'default', $page);
        $data['pager'] = $model->pager;

        return view('admin/data_baru_ibu_hamil', $data);
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

        $model = new DataBaruIbuHamilModel();

        $updateData = [
            'nik'                  => $data->nik,
            'nama_ibu_hamil'       => $data->nama_ibu_hamil,
            'nik_suami'            => $data->nik_suami,
            'nama_suami'           => $data->nama_suami,
            'pekerjaan_ibu_hamil'  => $data->pekerjaan_ibu_hamil,
            'pekerjaan_suami'      => $data->pekerjaan_suami,
            'tgl_mulai_hamil'      => $data->tgl_mulai_hamil,
            'tgl_perkiraan_lahir'  => $data->tgl_perkiraan_lahir,
            'usia_kehamilan'       => $data->usia_kehamilan,
            'golDarah_ibu_hamil'   => $data->golDarah_ibu_hamil,
            'golDarah_suami'       => $data->golDarah_suami,
            'kadar_hb'             => $data->kadar_hb,
            'bb_sebelum_hamil'     => $data->bb_sebelum_hamil,
            'no_telepon'           => $data->no_telepon,
            'alamat'               => $data->alamat,
        ];
        
        $model->update($data->id, $updateData);
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil diupdate.'
        ]);
    }

    public function konfirmasi($id)
    {
        $modelBaru = new DataBaruIbuHamilModel();
        $modelUtama = new IbuHamilModel();

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
        $model = new DataBaruIbuHamilModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
