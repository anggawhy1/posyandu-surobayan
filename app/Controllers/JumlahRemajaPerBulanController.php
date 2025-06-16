<?php

namespace App\Controllers;

use App\Models\JumlahRemajaPerBulanModel;

class JumlahRemajaPerBulanController extends BaseController
{
    protected $jumlahRemajaPerBulanModel;

    public function __construct()
    {
        $this->jumlahRemajaPerBulanModel = new JumlahRemajaPerBulanModel();
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
        $jumlahRemaja = $this->jumlahRemajaPerBulanModel->getJumlahRemajaPerBulan();

        // Urutkan berdasarkan urutan bulan kalender
        usort($jumlahRemaja, function ($a, $b) use ($data) {
            return array_search($a['bulan'], $data['bulan']) - array_search($b['bulan'], $data['bulan']);
        });

        $data['jumlahRemaja'] = $jumlahRemaja;

        return view('admin/jumlah_remaja_per_bulan', $data);
    }


    public function save()
    {
        $bulan = $this->request->getPost('bulan');
        $jumlah = $this->request->getPost('jumlah');

        if ($bulan && $jumlah) {
            foreach ($bulan as $key => $month) {
                // Cek apakah bulan sudah ada
                $existing = $this->jumlahRemajaPerBulanModel
                    ->where('bulan', $month)
                    ->first();

                if ($existing) {
                    // Kalau ada, update data
                    $this->jumlahRemajaPerBulanModel->update($existing['id'], [
                        'jumlah_remaja' => $jumlah[$key],
                    ]);
                } else {
                    // Kalau belum ada, insert data baru
                    $this->jumlahRemajaPerBulanModel->insert([
                        'bulan' => $month,
                        'jumlah_remaja' => $jumlah[$key],
                    ]);
                }
            }
        }

        return redirect()->to('/admin/jumlah-remaja-per-bulan')->with('success', 'Data berhasil disimpan.');
    }
}
