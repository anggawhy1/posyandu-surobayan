<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\BaseConnection;
use App\Models\DokumentasiModel;
use App\Models\DashboardModel;

class Dashboard extends Controller
{
    protected $db;
    protected $dashboardModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->dashboardModel = new DashboardModel();
    }

    public function index()
    {
        // Balita
        $balitaQuery = $this->db->table('tb_data_balita2025_surobayan')
            ->select('COUNT(id) as total, 
                      SUM(CASE WHEN jenis_kelamin = "L" THEN 1 ELSE 0 END) as laki,
                      SUM(CASE WHEN jenis_kelamin = "P" THEN 1 ELSE 0 END) as perempuan')
            ->get()->getRowArray();

        // Remaja Putri
        $remajaPutriQuery = $this->db->table('tb_data_remajaputri2025_surobayan')
            ->select('COUNT(id) as total')
            ->get()->getRowArray();
        $remajaPutriQuery['perempuan'] = $remajaPutriQuery['total'];
        $remajaPutriQuery['laki'] = 0;

        // Ibu Hamil
        $ibuHamilQuery = $this->db->table('tb_data_ibuhamil_surobayan')
            ->select('COUNT(id) as total')
            ->get()->getRowArray();
        $ibuHamilQuery['perempuan'] = $ibuHamilQuery['total'];
        $ibuHamilQuery['laki'] = 0;

        // Lansia
        $lansiaQuery = $this->db->table('tb_data_lansia_surobayan')
            ->select('COUNT(id) as total, 
                      SUM(CASE WHEN jenis_kelamin = "L" THEN 1 ELSE 0 END) as laki,
                      SUM(CASE WHEN jenis_kelamin = "P" THEN 1 ELSE 0 END) as perempuan')
            ->get()->getRowArray();

        // Usia Produktif
        $usiaProduktifQuery = $this->db->table('tb_data_usia_produktif_surobayan')
            ->select('COUNT(id) as total, 
                      SUM(CASE WHEN jenis_kelamin = "L" THEN 1 ELSE 0 END) as laki,
                      SUM(CASE WHEN jenis_kelamin = "P" THEN 1 ELSE 0 END) as perempuan')
            ->get()->getRowArray();

        // Data Statistik
        $dataKategori = [
            ['label' => 'Balita', 'total' => $balitaQuery['total'], 'cewek' => $balitaQuery['perempuan'], 'cowok' => $balitaQuery['laki'], 'color' => 'blue'],
            ['label' => 'Remaja Putri', 'total' => $remajaPutriQuery['total'], 'cewek' => $remajaPutriQuery['perempuan'], 'cowok' => 0, 'color' => 'purple'],
            ['label' => 'Ibu Hamil', 'total' => $ibuHamilQuery['total'], 'cewek' => $ibuHamilQuery['perempuan'], 'cowok' => 0, 'color' => 'green'],
            ['label' => 'Lansia', 'total' => $lansiaQuery['total'], 'cewek' => $lansiaQuery['perempuan'], 'cowok' => $lansiaQuery['laki'], 'color' => 'yellow'],
            ['label' => 'Usia Produktif', 'total' => $usiaProduktifQuery['total'], 'cewek' => $usiaProduktifQuery['perempuan'], 'cowok' => $usiaProduktifQuery['laki'], 'color' => 'red']
        ];

        // Dokumentasi Terbaru
        $dokumentasiModel = new DokumentasiModel();
        $dokumentasiTerbaru = $dokumentasiModel->orderBy('created_at', 'DESC')->limit(3)->findAll();

        // Tambahan: Data Balita Terbaru (ambil 5 data) dari DashboardModel
        $balitaTerbaru = $this->dashboardModel->getBalita(); 

        // Tambahan: Data terbaru (balita, ibu hamil, remaja putri) union
        $query = $this->db->query("
            SELECT 
                nama_anak AS nama, 
                'Balita' AS kategori, 
                created_at AS tanggal, 
                'blue' AS warna
            FROM tb_data_baru_balita
            UNION ALL
            SELECT 
                nama_ibu_hamil AS nama, 
                'Ibu Hamil' AS kategori, 
                created_at AS tanggal, 
                'green' AS warna
            FROM tb_data_baru_ibu_hamil
            UNION ALL
            SELECT 
                nama_lengkap AS nama, 
                'Remaja Putri' AS kategori, 
                created_at AS tanggal, 
                'purple' AS warna
            FROM tb_data_baru_remaja_putri
            ORDER BY tanggal DESC
            LIMIT 10
        ");
        $dataTerbaru = $query->getResultArray();

        // Fungsi internal
        function getJumlahPerBulan($db, $tableName, $jumlahKolom) {
            $builder = $db->table($tableName);
            $builder->select("bulan, $jumlahKolom as jumlah");
            $builder->orderBy('FIELD(bulan, "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember")');
            $results = $builder->get()->getResultArray();

            $data = [];
            foreach ($results as $row) {
                $data[$row['bulan']] = (int)$row['jumlah'];
            }
            return $data;
        }

        // Data Chart
        $balitaData = getJumlahPerBulan($this->db, 'tb_jumlah_balita_per_bulan', 'jumlah_balita');
        $remajaData = getJumlahPerBulan($this->db, 'tb_jumlah_remaja_per_bulan', 'jumlah_remaja');
        $lansiaData = getJumlahPerBulan($this->db, 'tb_jumlah_lansia_per_bulan', 'jumlah_lansia');

        $allMonths = array_unique(array_merge(array_keys($balitaData), array_keys($remajaData), array_keys($lansiaData)));

        $bulanUrut = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        usort($allMonths, fn($a, $b) => array_search($a, $bulanUrut) - array_search($b, $bulanUrut));

        $finalBalita = $finalRemaja = $finalLansia = [];
        foreach ($allMonths as $bulan) {
            $finalBalita[] = $balitaData[$bulan] ?? 0;
            $finalRemaja[] = $remajaData[$bulan] ?? 0;
            $finalLansia[] = $lansiaData[$bulan] ?? 0;
        }

        return view('admin/dashboard', [
            'dataKategori' => $dataKategori,
            'dokumentasiTerbaru' => $dokumentasiTerbaru,
            'chartLabels' => $allMonths,
            'dataBalita' => $finalBalita,
            'dataRemaja' => $finalRemaja,
            'dataLansia' => $finalLansia,
            'balitaTerbaru' => $balitaTerbaru,
            'dataTerbaru' => $dataTerbaru, // <-- Tambahkan kiriman ke view
        ]);
    }
}
