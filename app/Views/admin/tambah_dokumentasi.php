// File: app/Views/admin/tambah_dokumentasi.php

<?= $this->extend('layout/main2') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-bold mb-4">Tambah Dokumentasi</h2>

    <form action="<?= base_url('/admin/dokumentasi/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="nama_dokumentasi" class="block font-medium">Nama Dokumentasi</label>
            <input type="text" name="nama_dokumentasi" class="border border-gray-300 p-2 rounded w-full" required>
        </div>

        <div>
            <label for="gambar" class="block font-medium">Gambar</label>
            <input type="file" name="gambar" class="border border-gray-300 p-2 rounded w-full" required>
        </div>

        <div>
            <label for="tanggal" class="block font-medium">Tanggal Dokumentasi (opsional)</label>
            <input type="datetime-local" name="tanggal" class="border border-gray-300 p-2 rounded w-full">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
