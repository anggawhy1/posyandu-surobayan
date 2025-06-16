<?php

namespace App\Controllers;

use App\Models\JumlahBalitaPerBulanModel;

class JumlahBalitaPerBulanController extends BaseController
{
    protected $jumlahBalitaPerBulanModel;

    public function __construct()
    {
        $this->jumlahBalitaPerBulanModel = new JumlahBalitaPerBulanModel();
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
        $jumlahBalita = $this->jumlahBalitaPerBulanModel->getJumlahBalitaPerBulan();

        // Urutkan berdasarkan urutan bulan kalender
        usort($jumlahBalita, function ($a, $b) use ($data) {
            return array_search($a['bulan'], $data['bulan']) - array_search($b['bulan'], $data['bulan']);
        });

        $data['jumlahBalita'] = $jumlahBalita;

        return view('admin/jumlah_balita_per_bulan', $data);
    }


    public function save()
    {
        $bulan = $this->request->getPost('bulan');
        $jumlah = $this->request->getPost('jumlah');

        if ($bulan && $jumlah) {
            foreach ($bulan as $key => $month) {
                // Cek apakah bulan sudah ada
                $existing = $this->jumlahBalitaPerBulanModel
                    ->where('bulan', $month)
                    ->first();

                if ($existing) {
                    // Kalau ada, update data
                    $this->jumlahBalitaPerBulanModel->update($existing['id'], [
                        'jumlah_balita' => $jumlah[$key],
                    ]);
                } else {
                    // Kalau belum ada, insert data baru
                    $this->jumlahBalitaPerBulanModel->insert([
                        'bulan' => $month,
                        'jumlah_balita' => $jumlah[$key],
                    ]);
                }
            }
        }

        return redirect()->to('/admin/jumlah-balita-per-bulan')->with('success', 'Data berhasil disimpan.');
    }
}
