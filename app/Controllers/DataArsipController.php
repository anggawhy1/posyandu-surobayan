<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataArsipModel;


class DataArsipController extends BaseController
{
    public function index()
    {
        return view('admin/riwayat_data');
    }

}