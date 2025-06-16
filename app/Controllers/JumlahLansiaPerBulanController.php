<?php

namespace App\Controllers;

use App\Models\JumlahLansiaPerBulanModel;

class JumlahLansiaPerBulanController extends BaseController
{
    protected $jumlahLansiaPerBulanModel;

    public function __construct()
    {
        $this->jumlahLansiaPerBulanModel = new JumlahLansiaPerBulanModel();
    }
    public function index()
    {
        $data['bulan'] = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Ambil data jumlah balita per bulan dari database
        $jumlahLansia = $this->jumlahLansiaPerBulanModel->getJumlahLansiaPerBulan();

        // Urutkan berdasarkan urutan bulan kalender
        usort($jumlahLansia, function ($a, $b) use ($data) {
            return array_search($a['bulan'], $data['bulan']) - array_search($b['bulan'], $data['bulan']);
        });

        $data['jumlahLansia'] = $jumlahLansia;

        return view('admin/jumlah_lansia_per_bulan', $data);
    }


    public function save()
    {
        $bulan = $this->request->getPost('bulan');
        $jumlah = $this->request->getPost('jumlah');

        if ($bulan && $jumlah) {
            foreach ($bulan as $key => $month) {
                // Cek apakah bulan sudah ada
                $existing = $this->jumlahLansiaPerBulanModel
                    ->where('bulan', $month)
                    ->first();

                if ($existing) {
                    // Kalau ada, update data
                    $this->jumlahLansiaPerBulanModel->update($existing['id'], [
                        'jumlah_lansia' => $jumlah[$key],
                    ]);
                } else {
                    // Kalau belum ada, insert data baru
                    $this->jumlahLansiaPerBulanModel->insert([
                        'bulan' => $month,
                        'jumlah_lansia' => $jumlah[$key],
                    ]);
                }
            }
        }

        return redirect()->to('/admin/jumlah-lansia-per-bulan')->with('success', 'Data berhasil disimpan.');
    }
}
