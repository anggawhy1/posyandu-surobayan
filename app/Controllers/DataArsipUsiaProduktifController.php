<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipUsiaProduktifModel;
use App\Models\UsiaProduktifModel;

class DataArsipUsiaProduktifController extends BaseController
{
    public function arsip()
    {
        $model = new ArsipUsiaProduktifModel();

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $data['usiaProduktif'] = $model->paginate($perPage, 'default', $page);
        $data['pager'] = $model->pager;

        return view('admin/data_arsip_usia_produktif', $data);
    }

    

    public function konfirmasi($id)
    {
        $modelBaru = new ArsipUsiaProduktifModel();
        $modelUtama = new UsiaProduktifModel();

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
        $model = new ArsipUsiaProduktifModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
