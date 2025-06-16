<?php echo $this->extend('layout/main2') ?>

<?php echo $this->section('content') ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Data Jumlah Hadir</h1>
        <p class="text-gray-600">Berikut adalah data rekap kehadiran berdasarkan kategori. Silakan klik untuk melihat detail kehadiran masing-masing kategori.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="<?= base_url('admin/jumlah-balita-per-bulan') ?>" class="block bg-blue-100 hover:bg-blue-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-baby text-blue-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-blue-800">Kehadiran Balita</h2>
            </div>
            <p class="text-sm text-gray-700">Lihat jumlah kehadiran balita berdasarkan data yang masuk.</p>
        </a>

        <a href="<?= base_url('admin/jumlah-remaja-per-bulan') ?>" class="block bg-pink-100 hover:bg-pink-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-user-graduate text-pink-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-pink-800">Kehadiran Remaja Putri</h2>
            </div>
            <p class="text-sm text-gray-700">Cek kehadiran remaja putri dalam kegiatan atau pemeriksaan terbaru.</p>
        </a>

        <a href="<?= base_url('admin/jumlah-lansia-per-bulan') ?>" class="block bg-yellow-100 hover:bg-yellow-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-user-clock text-yellow-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-yellow-800">Kehadiran Lansia</h2>
            </div>
            <p class="text-sm text-gray-700">Pantau jumlah kehadiran lansia dalam program yang telah dijadwalkan.</p>
        </a>

    </div>
</div>
<?php echo $this->endSection() ?>