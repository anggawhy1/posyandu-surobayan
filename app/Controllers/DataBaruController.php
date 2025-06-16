<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBaruModel;


class DataBaruController extends BaseController
{
    public function index()
    {
        return view('admin/data_baru');
    }
    

    public function balita()
    {
        return view('admin/data_baru_balita');
    }

    public function remaja()
    {
        return view('admin/data_baru_remaja');
    }

    public function ibuHamil()
    {
        return view('admin/data_baru_ibu_hamil');
    }
}
