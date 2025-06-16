<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipLansiaModel;
use App\Models\LansiaModel;

class DataArsipLansiaController extends BaseController
{
    public function arsip()
    {
        $model = new ArsipLansiaModel();

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $data['lansia'] = $model->paginate($perPage, 'default', $page);
        $data['pager'] = $model->pager;

        return view('admin/data_arsip_lansia', $data);
    }

    

    public function konfirmasi($id)
    {
        $modelBaru = new ArsipLansiaModel();
        $modelUtama = new LansiaModel();

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
        $model = new ArsipLansiaModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
