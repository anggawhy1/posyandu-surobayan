<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Edit Dokumentasi</h1>

    <form action="/admin/dokumentasi/update/<?= $dokumentasi['id'] ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Nama Dokumentasi</label>
            <input type="text" name="nama_dokumentasi" value="<?= $dokumentasi['nama_dokumentasi'] ?>" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Tanggal Dokumentasi</label>
            <input type="datetime-local" name="created_at" class="w-full p-2 border rounded-lg" value="<?= date('Y-m-d\TH:i', strtotime($dokumentasi['created_at'])) ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Gambar Saat Ini</label>
            <img src="<?= base_url('uploads/dokumentasi/' . $dokumentasi['gambar']) ?>" alt="<?= $dokumentasi['nama_dokumentasi'] ?>" class="w-full h-48 object-cover rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Upload Gambar Baru (Opsional)</label>
            <input type="file" name="gambar" class="w-full p-2 border rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        <a href="/admin/dokumentasi" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>