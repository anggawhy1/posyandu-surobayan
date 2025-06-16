<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-6 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Jadwal</h1>

    <form action="/admin/jadwal/store" method="post" class="bg-white shadow-lg rounded-lg p-6">
        <div class="mb-4">
            <label class="block text-gray-700">Kegiatan:</label>
            <input type="text" name="kegiatan" class="border w-full p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Tanggal:</label>
            <input type="date" name="tanggal" class="border w-full p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Waktu:</label>
            <input type="time" name="waktu" class="border w-full p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Lokasi:</label>
            <input type="text" name="lokasi" class="border w-full p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>

<?= $this->endSection() ?>
