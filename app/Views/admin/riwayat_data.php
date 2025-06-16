<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Data yang Telah Diarsipkan</h1>
        <p class="text-gray-600">Berikut adalah riwayat data yang telah diarsipkan. Anda bisa memilih kategori data yang ingin dikelola.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Balita -->
        <a href="<?= base_url('admin/data-arsip-balita') ?>" class="block bg-blue-100 hover:bg-blue-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-baby text-blue-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-blue-800">Data Balita</h2>
            </div>
            <p class="text-sm text-gray-700">Lihat data balita yang telah diarsipkan dan kelola lebih lanjut.</p>
        </a>

        <!-- Remaja Putri (Ungu) -->
        <a href="<?= base_url('admin/data-arsip-remaja') ?>" class="block bg-purple-100 hover:bg-purple-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-user-graduate text-purple-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-purple-800">Data Remaja Putri</h2>
            </div>
            <p class="text-sm text-gray-700">Lihat dan kelola data remaja putri yang sudah diarsipkan.</p>
        </a>

        <!-- Ibu Hamil (Hijau) -->
        <a href="<?= base_url('admin/data-arsip-ibu-hamil') ?>" class="block bg-green-100 hover:bg-green-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-female text-green-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-green-800">Data Ibu Hamil</h2>
            </div>
            <p class="text-sm text-gray-700">Lihat data ibu hamil yang telah diarsipkan dan kelola lebih lanjut.</p>
        </a>

        <!-- Usia Produktif (Merah) -->
        <a href="<?= base_url('admin/data-arsip-usia-produktif') ?>" class="block bg-red-100 hover:bg-red-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-user-md text-red-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-red-800">Data Usia Produktif</h2>
            </div>
            <p class="text-sm text-gray-700">Lihat data usia produktif yang telah diarsipkan.</p>
        </a>

        <!-- Lansia (Kuning) -->
        <a href="<?= base_url('admin/data-arsip-lansia') ?>" class="block bg-yellow-100 hover:bg-yellow-200 transition rounded-lg shadow p-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-user-alt text-yellow-600 text-2xl mr-2"></i>
                <h2 class="text-xl font-semibold text-yellow-800">Data Lansia</h2>
            </div>
            <p class="text-sm text-gray-700">Lihat data lansia yang telah diarsipkan dan kelola lebih lanjut.</p>
        </a>
    </div>

</div>
<?= $this->endSection() ?>