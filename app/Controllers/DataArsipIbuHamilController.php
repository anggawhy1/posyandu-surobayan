<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipIbuHamilModel;
use App\Models\IbuHamilModel;

class DataArsipIbuHamilController extends BaseController
{
    public function arsip()
    {
        $model = new ArsipIbuHamilModel();

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $data['ibuHamil'] = $model->paginate($perPage, 'default', $page);
        $data['pager'] = $model->pager;

        return view('admin/data_arsip_ibu_hamil', $data);
    }

    

    public function konfirmasi($id)
    {
        $modelBaru = new ArsipIbuHamilModel();
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
        $model = new ArsipIbuHamilModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false]);
    }
}
