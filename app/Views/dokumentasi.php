<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-6">
    <!-- Breadcrumb -->
    <nav class="text-gray-700 text-sm mb-4" aria-label="Breadcrumb">
        <ol class="list-reset flex">
            <li><a href="/" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-500">Dokumentasi</li>
        </ol>
    </nav>

    <!-- Judul -->
    <h1 class="text-2xl font-bold mb-6 text-center">Dokumentasi Posyandu</h1>

    <!-- Galeri Dokumentasi -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach ($dokumentasi as $item): ?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="<?= base_url('uploads/dokumentasi/' . $item['gambar']) ?>" alt="<?= $item['nama_dokumentasi'] ?>" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold"><?= $item['nama_dokumentasi'] ?></h2>
                    <p class="text-gray-500 text-sm"><?= date('d M Y', strtotime($item['created_at'])) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        <?php 
        $totalPages = ceil($totalData / $perPage);
        for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="mx-2 px-4 py-2 bg-blue-500 text-white rounded <?= $currentPage == $i ? 'bg-blue-700' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>
<?= $this->endSection() ?>
