<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    <!-- Kartu Statistik Total Data -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <?php foreach ($dataKategori as $kategori) : ?>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-gray-600"><?= esc($kategori['label']) ?></h2>
                <p class="text-3xl font-bold text-<?= esc($kategori['color']) ?>-600"><?= esc($kategori['total']) ?></p>
                <div class="mt-2 text-sm text-gray-500">
                    <p class="text-pink-500 font-semibold">♀ Perempuan: <?= esc($kategori['cewek']) ?></p>
                    <p class="text-blue-500 font-semibold">♂ Laki-Laki: <?= esc($kategori['cowok']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <!-- Statistik Pengunjung (Chart) -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Statistik Pengunjung 2025</h2>
        <div class="w-full h-64">
            <canvas id="statistikChart"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h2>
        <ul class="divide-y divide-gray-200">
            <li class="py-2 flex justify-between">
                <span>Data balita baru ditambahkan</span>
                <span class="text-gray-500 text-sm">10 Menit Lalu</span>
            </li>
            <li class="py-2 flex justify-between">
                <span>Data ibu hamil diperbarui</span>
                <span class="text-gray-500 text-sm">30 Menit Lalu</span>
            </li>
            <li class="py-2 flex justify-between">
                <span>Admin menambahkan dokumentasi baru</span>
                <span class="text-gray-500 text-sm">1 Jam Lalu</span>
            </li>
        </ul>
    </div> -->

    <!-- Data Terbaru -->
    <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Data Terbaru</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Kategori</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataTerbaru)) : ?>
                    <?php $no = 1;
                    foreach ($dataTerbaru as $row) : ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= $no++ ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= esc($row['nama']) ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-<?= esc($row['warna']) ?>-600 font-semibold"><?= esc($row['kategori']) ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($row['tanggal']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data terbaru</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

    <!-- Dokumentasi Kegiatan -->
    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg font-semibold">Dokumentasi Terbaru</h2>
            <a href="<?= base_url('admin/dokumentasi') ?>" class="text-blue-500 hover:underline">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <?php foreach ($dokumentasiTerbaru as $dok): ?>
                <a href="<?= base_url('admin/dokumentasi') ?>">
                    <img src="<?= base_url('uploads/dokumentasi/' . $dok['gambar']) ?>" alt="<?= $dok['nama_dokumentasi'] ?>" class="rounded-lg h-32 object-cover w-full">
                </a>
            <?php endforeach; ?>

            <?php if (empty($dokumentasiTerbaru)): ?>
                <p class="text-gray-500 col-span-3 text-center">Belum ada dokumentasi terbaru</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    const statistikChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartLabels) ?>,
            datasets: [{
                    label: 'Balita',
                    data: <?= json_encode($dataBalita) ?>,
                    backgroundColor: '#1D4ED8', // biru terang
                    borderColor: '#1D4ED8',
                    borderWidth: 1
                },
                {
                    label: 'Remaja Putri',
                    data: <?= json_encode($dataRemaja) ?>,
                    backgroundColor: '#7C3AED', // ungu terang
                    borderColor: '#7C3AED',
                    borderWidth: 1
                },
                {
                    label: 'Lansia',
                    data: <?= json_encode($dataLansia) ?>,
                    backgroundColor: '#D97706', // merah terang
                    borderColor: '#D97706',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#000', // warna teks label
                        font: {
                            size: 12, // ukuran font
                            weight: 'normal' // normal, bukan bold
                        }
                    }
                }
            }
        }
    });
</script>


<?= $this->endSection() ?>