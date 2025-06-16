<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Kelola Dokumentasi</h1>

    <a href="/admin/dokumentasi/create" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Tambah Dokumentasi</a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach (array_reverse($dokumentasi) as $item): // Terbaru di atas ?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="<?= base_url('uploads/dokumentasi/' . $item['gambar']) ?>" alt="<?= $item['nama_dokumentasi'] ?>" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold"><?= $item['nama_dokumentasi'] ?></h2>
                    <p class="text-gray-500 text-sm"><?= date('d M Y', strtotime($item['created_at'])) ?></p>

                    <div class="mt-2 flex space-x-2">
                        <a href="/admin/dokumentasi/edit/<?= $item['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <form action="/admin/dokumentasi/delete/<?= $item['id'] ?>" method="POST">
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
