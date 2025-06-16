<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-6">
    <!-- Breadcrumb -->
    <nav class="text-gray-700 text-sm mb-4" aria-label="Breadcrumb">
        <ol class="list-reset flex">
            <li><a href="/" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-500">Jadwal</li>
        </ol>
    </nav>

    <!-- Judul -->
    <h1 class="text-2xl font-bold mb-6 text-center">Jadwal Kegiatan Posyandu</h1>

    <!-- Tabel Jadwal -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Kegiatan</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Waktu</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Lokasi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if (empty($jadwal)): ?>
                    <tr>
                        <td colspan="5" class="border border-gray-300 px-4 py-4 text-center text-gray-500">
                            Belum ada jadwal tersedia
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($jadwal as $index => $data): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2"><?= $index + 1; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $data['kegiatan']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $data['tanggal']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $data['waktu']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $data['lokasi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
