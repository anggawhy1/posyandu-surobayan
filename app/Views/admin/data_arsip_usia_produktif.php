<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Data Arsip Usia Produktif </h1>


    <!-- Keterangan tentang data input masyarakat -->
    <div class="bg-white border-l-4 border-blue-500 p-4 mb-4 shadow rounded">
        <p class="text-gray-700">
            Halaman ini menampilkan data yang telah dipindahkan ke arsip.
            Setiap data memiliki kategori arsip yang menunjukkan alasan pengarsipan, seperti
            <span class="font-semibold text-blue-600">Pindah</span>,
            <span class="font-semibold text-red-600">Meninggal</span>,
            <span class="font-semibold text-green-600">Lulus</span>, atau
            <span class="font-semibold text-yellow-600">Lainnya</span>.
        </p>
    </div>

    <?php
    $badgeColors = [
        'meninggal'   => 'bg-red-200 text-red-800',
        'pindah'      => 'bg-blue-200 text-blue-800',
        'lulus'       => 'bg-green-200 text-green-800',
        'keguguran'   => 'bg-pink-200 text-pink-800',
        'melahirkan'  => 'bg-purple-200 text-purple-800',
        'menikah'     => 'bg-orange-200 text-orange-800',
        'lainnya'     => 'bg-yellow-200 text-yellow-800',
    ];
    ?>

    <?php if (!empty($usiaProduktif)) : ?>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">NIK</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Alamat</th>
                        <th class="p-2 border">Usia</th>
                        <th class="p-2 border">Jenis Kelamin</th>
                        <th class="p-2 border">Kategori</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usiaProduktif as $index => $row): ?>
                        <tr data-id="<?= $row['id'] ?>" class="bg-white border">
                            <td class="p-2 border text-center"><?= $index + 1 ?></td>
                            <td class="p-2 border text-center"><?= esc($row['nik']) ?></td>
                            <td class="p-2 border text-center"><?= esc($row['nama']) ?></td>
                            <td class="p-2 border text-center"><?= esc($row['alamat']) ?></td>
                            <td class="p-2 border text-center"><?= esc($row['usia']) ?></td>
                            <td class="p-2 border text-center"><?= esc($row['jenis_kelamin']) ?></td>
                            <td class="p-2 border text-center">
                                <?php
                                $kategori = strtolower($row['kategori'] ?? 'lainnya');
                                $badge = $badgeColors[$kategori] ?? $badgeColors['lainnya'];
                                ?>
                                <span class="px-2 py-1 rounded text-xs font-semibold <?= $badge ?>">
                                    <?= ucfirst($kategori) ?>
                                </span>
                            </td>
                            <td class="p-2 border text-center flex justify-center space-x-2">
                                <button class="btn-konfirmasi bg-green-500 text-white px-4 py-2 rounded text-sm" data-id="<?= $row['id'] ?>">Pulihkan</button>
                                <button class="btn-hapus bg-red-500 text-white px-4 py-2 rounded text-sm" data-id="<?= $row['id'] ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



        <!-- Modal Konfirmasi -->
        <div id="modalKonfirmasi" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <p class="mb-4">Yakin ingin Memulihkan data ini ke database utama?</p>
                <div class="flex justify-center gap-4">
                    <button id="btnBatalKonfirmasi" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
                    <button id="btnLanjutKonfirmasi" class="bg-green-600 text-white px-4 py-2 rounded">Lanjutkan Konfirmasi</button>

                </div>
            </div>
        </div>

        <!-- Modal Sukses -->
        <div id="modalSukses" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <p class="text-green-600 font-bold">✅ Aksi berhasil!</p>
                <button id="btnTutupModalSukses" class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Tutup</button>
            </div>
        </div>

        <!-- Modal Hapus -->
        <div id="modalHapus" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <p class="mb-4 text-red-600">Yakin ingin menghapus data ini secara permanen?</p>
                <div class="flex justify-center gap-4">
                    <button id="btnBatalHapus" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
                    <button id="btnLanjutHapus" class="px-4 py-2 bg-red-600 text-white rounded">Ya, Hapus</button>
                </div>
            </div>
        </div>



        <!-- Modal Sukses Konfirmasi -->
        <div id="modalSuksesKonfirmasi" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <p class="text-green-600 font-bold">✅ Data berhasil dikonfirmasi ke database utama!</p>
                <button id="btnTutupModalSuksesKonfirmasi" class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Tutup</button>
            </div>
        </div>

    <?php else : ?>
        <div class="mt-4 text-center">
            <p class="text-red-500">Tidak ada data usia produktif baru untuk dikonfirmasi.</p>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($pager)) : ?>
    <div class="mt-4 flex justify-center">
        <nav class="pagination flex space-x-2">
            <?= $pager->links('default', 'pagination_custom') ?>
        </nav>
    </div>
<?php endif; ?>

<script>
    let idTerpilih = null;
    let rowTerpilih = null;
    let simpanButtonAktif = null;



    // ✅ FIXED: Tombol Konfirmasi pakai fetch, bukan href
    document.querySelectorAll(".btn-konfirmasi").forEach(button => {
        button.addEventListener("click", function() {
            idTerpilih = this.closest("tr").dataset.id;
            document.getElementById("modalKonfirmasi").classList.remove("hidden");
        });
    });

    // Tombol lanjut konfirmasi AJAX
    document.getElementById("btnLanjutKonfirmasi").addEventListener("click", function() {
        fetch(`/admin/data-arsip-usia-produktif/konfirmasi/${idTerpilih}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(response => {
                document.getElementById("modalKonfirmasi").classList.add("hidden");
                if (response.success) {
                    document.getElementById("modalSuksesKonfirmasi").classList.remove("hidden");
                } else {
                    alert("❌ Gagal konfirmasi: " + response.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("❌ Terjadi kesalahan saat konfirmasi.");
            });
    });

    document.getElementById("btnBatalKonfirmasi").addEventListener("click", function() {
        document.getElementById("modalKonfirmasi").classList.add("hidden");
    });

    document.getElementById("btnTutupModalSukses").addEventListener("click", function() {
        document.getElementById("modalSukses").classList.add("hidden");
        location.reload();
    });

    document.getElementById('btnTutupModalSuksesKonfirmasi').addEventListener('click', function() {
        document.getElementById('modalSuksesKonfirmasi').classList.add('hidden');
        window.location.reload();
    });

    document.querySelectorAll(".btn-hapus").forEach(button => {
        button.addEventListener("click", function() {
            idTerpilih = this.closest("tr").dataset.id;
            rowTerpilih = this.closest("tr");
            document.getElementById("modalHapus").classList.remove("hidden");
        });
    });

    document.getElementById("btnLanjutHapus").addEventListener("click", function() {
        fetch(`/admin/data-arsip-usia-produktif/hapus/${idTerpilih}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(res => res.json()).then(response => {
            if (response.success) {
                document.getElementById("modalHapus").classList.add("hidden");
                document.getElementById("modalSukses").classList.remove("hidden");
            }
        });
    });

    document.getElementById("btnBatalHapus").addEventListener("click", function() {
        document.getElementById("modalHapus").classList.add("hidden");
    });
</script>



<?php echo $this->endSection() ?>