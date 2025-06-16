<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard'); // Pastikan ada file `admin/dashboard.php`
    }

    public function dataBalita()
    {
        return view('admin/data_balita');
    }

    public function pemantauanBalita()
    {
        return view('admin/pemantauan_balita');
    }

    public function dataLansia()
    {
        return view('admin/data_lansia');
    }
    public function dataUsiaProduktif()
    {
        return view('admin/data_produktif');
    }
    public function dokumentasi()
    {
        return view('admin/dokumentasi');
    }
    public function dataIbuHamil()
    {
        return view('admin/data_ibu_hamil');
    }
    public function dataRemajaPutri()
    {
        return view('admin/data_remaja');
    }
    public function dataBaru()
    {
        return view('admin/data_baru');
    }
    public function riwayatData()
    {
        return view('admin/riwayat_data');
    }
    public function jadwal()
    {
        return view('admin/jadwal');
    }
}
