<?php

namespace App\Controllers;
use App\Models\BerandaModel;

class BerandaController extends BaseController
{
    public function index()
    {
        $model = new BerandaModel();
        $db = \Config\Database::connect();

        // Data total (yang sudah ada)
        $data = [
            'balita' => $model->getTotal('tb_data_balita2025_surobayan'),
            'lansia' => $model->getTotal('tb_data_lansia_surobayan'),
            'ibu_hamil' => $model->getTotal('tb_data_ibuhamil_surobayan'),
            'remaja_putri' => $model->getTotal('tb_data_remajaputri2025_surobayan'),
            'usia_produktif' => $model->getTotal('tb_data_usia_produktif_surobayan'),
        ];

        // Data grafik dari tabel per bulan (tanpa filter tahun)
        $balita = $db->table('tb_jumlah_balita_per_bulan')
            ->select('bulan, jumlah_balita')
            ->get()
            ->getResultArray();

        $remaja = $db->table('tb_jumlah_remaja_per_bulan')
            ->select('bulan, jumlah_remaja')
            ->get()
            ->getResultArray();

        $lansia = $db->table('tb_jumlah_lansia_per_bulan')
            ->select('bulan, jumlah_lansia')
            ->get()
            ->getResultArray();

        // Urutan bulan tetap
        $bulanUrut = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // Buat mapping dari bulan ke data
        $mapBalita = [];
        foreach ($balita as $row) {
            $mapBalita[$row['bulan']] = $row['jumlah_balita'];
        }

        $mapRemaja = [];
        foreach ($remaja as $row) {
            $mapRemaja[$row['bulan']] = $row['jumlah_remaja'];
        }

        $mapLansia = [];
        foreach ($lansia as $row) {
            $mapLansia[$row['bulan']] = $row['jumlah_lansia'];
        }

        // Bangun array final berdasarkan urutan bulan tetap
        $chartLabels = [];
        $dataBalita = [];
        $dataRemaja = [];
        $dataLansia = [];

        foreach ($bulanUrut as $bulan) {
            if (isset($mapBalita[$bulan]) || isset($mapRemaja[$bulan]) || isset($mapLansia[$bulan])) {
                $chartLabels[] = $bulan;
                $dataBalita[] = $mapBalita[$bulan] ?? 0;
                $dataRemaja[] = $mapRemaja[$bulan] ?? 0;
                $dataLansia[] = $mapLansia[$bulan] ?? 0;
            }
        }

        // Masukkan ke view
        $data['chartLabels'] = $chartLabels;
        $data['dataBalita'] = $dataBalita;
        $data['dataRemaja'] = $dataRemaja;
        $data['dataLansia'] = $dataLansia;

        return view('welcome_message', $data);
    }
}
