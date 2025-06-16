<?php

namespace App\Controllers;

use App\Models\PemantauanModel;
use CodeIgniter\Controller;

class PemantauanController extends Controller
{
    protected $pemantauanModel;

    public function __construct()
    {
        $this->pemantauanModel = new PemantauanModel();
    }

    public function index()
    {
        $data['pemantauan'] = $this->pemantauanModel->getPivotData();

        $daftarBulanResmi = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $bulanTersedia = [];
        foreach ($daftarBulanResmi as $bln) {
            foreach ($data['pemantauan'] as $balita) {
                if (isset($balita['pemantauan'][$bln]) && !in_array($bln, $bulanTersedia)) {
                    $bulanTersedia[] = $bln;
                }
            }
        }


        // Ambil nilai filter dari URL (misal: ntob=N)
        $ntobFilter = $this->request->getGet('ntob');

        // Jika ada filter ntob, saring data yang sesuai dengan nilai ntob
        if ($ntobFilter) {
            $data['pemantauan'] = array_filter($data['pemantauan'], function ($balita) use ($ntobFilter) {
                foreach ($balita['pemantauan'] as $bulan => $pemantauanData) {
                    // Hanya tampilkan yang sesuai dengan ntob dan bulan terbaru
                    if (isset($pemantauanData['ntob']) && $pemantauanData['ntob'] === $ntobFilter) {
                        return true;
                    }
                }
                return false;
            });
        }

        $data['bulanTersedia'] = $bulanTersedia;
        $data['bulanKosong'] = $this->pemantauanModel->getBulanKosong();

        $pager = \Config\Services::pager();
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 20;
        $total = count($data['pemantauan']);
        $offset = ($page - 1) * $perPage;

        $data['pemantauan'] = array_slice($data['pemantauan'], $offset, $perPage);
        $pager->store('default', $page, $perPage, $total);
        $data['pager'] = $pager;

        return view('admin/pemantauan_balita', $data);
    }

    public function update()
    {
        $json = $this->request->getJSON();
        $db = \Config\Database::connect();
        $builder = $db->table('tb_pemantauan_balita2025new');

        $success = true;
        foreach ($json as $item) {
            $update = [$item->field => $item->value];
            $builder->where('id', $item->id)->where('bulan', $item->bulan);
            if (!$builder->update($update)) {
                $success = false;
                break;
            }
        }

        return $this->response->setJSON(['success' => $success]);
    }

    public function tambahBulan()
    {
        $db = \Config\Database::connect();
        $bulanAda = $db->table('tb_pemantauan_balita2025new')->select('bulan')->distinct()->get()->getResultArray();
        $bulanList = array_map(fn($b) => $b['bulan'], $bulanAda);

        $daftarBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $bulanTerakhir = end($bulanList);
        $indexBulanBaru = array_search($bulanTerakhir, $daftarBulan) + 1;

        if ($indexBulanBaru >= count($daftarBulan)) {
            return redirect()->back()->with('message', 'Bulan sudah penuh sampai Desember!');
        }

        $bulanBaru = $daftarBulan[$indexBulanBaru];
        $balita = $db->table('tb_data_balita2025_surobayan')->select('id')->get()->getResultArray();

        foreach ($balita as $b) {
            $db->table('tb_pemantauan_balita2025new')->insert([
                'id' => $b['id'],
                'bulan' => $bulanBaru,
                'bb' => 0,
                'tb' => 0,
                'ntob' => '',
                'lila' => 0,
                'lk' => 0,
                'vit_a' => '',
                'asi' => ''
            ]);
        }

        return redirect()->back()->with('message', 'Bulan ' . $bulanBaru . ' berhasil ditambahkan!');
    }

    public function hapusBulan($namaBulan)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_pemantauan_balita2025new');
        $rows = $builder->where('bulan', $namaBulan)->get()->getResultArray();

        $semuaKosong = true;
        foreach ($rows as $row) {
            foreach (['bb', 'tb', 'ntob', 'lila', 'lk', 'vit_a', 'asi'] as $kolom) {
                $nilai = $row[$kolom];
                if (!is_null($nilai) && $nilai !== '' && floatval($nilai) != 0.0) {
                    $semuaKosong = false;
                    break 2;
                }
            }
        }

        if ($semuaKosong) {
            $builder->where('bulan', $namaBulan)->delete();
            return redirect()->back()->with('message', 'Bulan ' . $namaBulan . ' berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Bulan tidak bisa dihapus karena sudah ada data.');
        }
    }
}
