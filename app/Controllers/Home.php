<?php

namespace App\Controllers;
use Config\Database;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dokumentasi()
    {
        return view('dokumentasi');
    }


    public function jadwal()
    {
        return view('jadwal');
    }

    public function inputData()
    {
        return view('input_data');
    }

    public function pemantauanBalita()
    {
        return view('pemantauan_balita');
    }

    public function dataBalita()
    {
        return view('data_balita');
    }

    // public function dataLansia()
    // {
    //     return view('data_lansia');
    // }

    public function dataRemajaPutri()
    {
        return view('data_remaja');
    }

    public function dataIbuHamil()
    {
        return view('data_ibu_hamil');
    }

    public function dataUsiaProduktif()
    {
        return view('data_usia_produktif');
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function login()
    {
        return view('login');
    }
    public function testDB()
    {
        $db = Database::connect();
        if ($db->connect_error) {
            return "Koneksi database gagal: " . $db->connect_error;
        } else {
            return "Koneksi database berhasil!";
        }
    }
}
