<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBaruModel;


class DataHadirController extends BaseController
{
    public function index()
    {
        return view('admin/data_jumlah_hadir');
    }
    
}