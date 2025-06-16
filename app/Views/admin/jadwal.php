<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-6 py-6">
    <h1 class="text-2xl font-bold mb-4">Kelola Jadwal Posyandu</h1>

    <a href="/admin/jadwal/create" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700">
        Tambah Jadwal
    </a>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4 mt-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Kegiatan</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2">Waktu</th>
                    <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($jadwal)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 border px-4 py-2">
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
                            <td class="border border-gray-300 px-4 py-2">
                                <form action="/admin/jadwal/delete/<?= $data['id']; ?>" method="post">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
