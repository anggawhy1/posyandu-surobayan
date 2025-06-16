<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipBalitaModel;
use App\Models\BalitaModel;

class DataArsipBalitaController extends BaseController
{
    public function arsip()
    {
        $model = new ArsipBalitaModel();

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $data['balita'] = $model->paginate($perPage, 'default', $page);
        $data['pager'] = $model->pager;

        return view('admin/data_arsip_balita', $data);
    }

    

    public function konfirmasi($id)
    {
        $modelBaru = new ArsipBalitaModel();
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
        $model = new ArsipBalitaModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
