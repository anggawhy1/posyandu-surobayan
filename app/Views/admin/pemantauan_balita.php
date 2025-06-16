<?= $this->extend('layout/main2') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Pemantauan Balita</h2>

    <!-- Search & Filter -->
    <form method="GET" class="mb-4 flex flex-wrap gap-2 justify-between items-center">
        <div class="flex gap-2">
            <input type="text" name="search" id="searchInput" placeholder="Cari Nama Anak..." value="<?= esc($_GET['search'] ?? '') ?>" class="border p-2 text-sm rounded focus:outline-none focus:ring focus:border-blue-300" />
            <select name="ntob" class="border p-2 text-sm rounded">
                <option value="">NTOB</option>
                <option value="N" <?= isset($_GET['ntob']) && $_GET['ntob'] == 'N' ? 'selected' : '' ?>>Naik (N)</option>
                <option value="T" <?= isset($_GET['ntob']) && $_GET['ntob'] == 'T' ? 'selected' : '' ?>>Tetap (T)</option>
                <option value="O" <?= isset($_GET['ntob']) && $_GET['ntob'] == 'O' ? 'selected' : '' ?>>Tidak Hadir (O)</option>
                <option value="B" <?= isset($_GET['ntob']) && $_GET['ntob'] == 'B' ? 'selected' : '' ?>>Baru (B)</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
        </div>
        <a href="<?= base_url('admin/pemantauan-balita/tambah-bulan') ?>" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Bulan</a>
    </form>



    <!-- Wrapper Table -->
    <div class="overflow-x-auto border rounded-lg shadow">
        <table class="table-auto w-full border-collapse border border-gray-400 text-sm">
            <thead class="sticky top-0 z-30 text-xs text-gray-700 uppercase bg-gray-400">
                <tr>
                    <!-- Kolom No -->
                    <th class="border p-2 text-center align-middle sticky-col sticky-header z-30" rowspan="2" style="left: 0; min-width: 40px;">No</th>
                    <!-- Kolom Nama Anak -->
                    <th class="border p-2 text-center align-middle sticky-col sticky-header z-30" rowspan="2" style="left: 40px; min-width: 150px;">Nama Anak</th>
                    <th class="border p-2 text-center align-middle" rowspan="2">Tanggal Lahir</th>
                    <th class="border p-2 text-center align-middle" rowspan="2">Nama Ibu</th>
                    <?php foreach ($bulanTersedia as $bulan): ?>
                        <th class="border p-2 text-center" colspan="7">
                            <?= esc($bulan) ?><br>
                            <?php if (in_array($bulan, $bulanKosong)): ?>
                                <a href="<?= base_url('admin/pemantauan-balita/hapus-bulan/' . $bulan) ?>"
                                    class="text-xs text-red-600 hover:underline"
                                    onclick="return confirm('Yakin ingin menghapus bulan <?= $bulan ?>?')">🗑 Hapus</a>
                            <?php endif; ?>
                        </th>
                    <?php endforeach ?>
                    <th class="border p-2 text-center align-middle" rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <?php foreach ($bulanTersedia as $bulan): ?>
                        <th class="border p-1">BB</th>
                        <th class="border p-1">TB</th>
                        <th class="border p-1">NTOB</th>
                        <th class="border p-1">LILA</th>
                        <th class="border p-1">LK</th>
                        <th class="border p-1">Vit A</th>
                        <th class="border p-1">ASI</th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 + ($pager->getCurrentPage('default') - 1) * 25; ?>
                <?php foreach ($pemantauan as $balita): ?>
                    <?php
                    $keyword = strtolower($_GET['search'] ?? '');
                    $filter = $keyword === '' ||
                        strpos(strtolower($balita['nama_anak']), $keyword) !== false ||
                        strpos(strtolower($balita['tgl_lahir']), $keyword) !== false ||
                        strpos(strtolower($balita['nama_ibu']), $keyword) !== false;
                    ?>
                    <?php if ($filter): ?>
                        <tr>
                            <td class="border p-2 text-center sticky-col z-20 bg-white" style="left: 0; min-width: 40px;"><?= $no++ ?></td>
                            <td class="border p-2 text-center sticky-col z-20 bg-white" style="left: 40px; min-width: 150px;"><?= esc($balita['nama_anak']) ?></td>
                            <td class="border p-2 text-center"><?= esc($balita['tgl_lahir']) ?></td>
                            <td class="border p-2 text-center"><?= esc($balita['nama_ibu']) ?></td>
                            <?php foreach ($bulanTersedia as $bulan): ?>
                                <?php $data = $balita['pemantauan'][$bulan] ?? [] ?>
                                <?php foreach (['bb', 'tb', 'ntob', 'lila', 'lk', 'vit_a', 'asi'] as $field): ?>
                                    <td class="border p-1 text-center">
                                        <input type="text" value="<?= esc($data[$field] ?? '') ?>"
                                            class="editable-cell text-center w-full bg-transparent px-1 py-1 text-xs"
                                            style="min-width:60px"
                                            data-id="<?= $balita['id_balita'] ?>"
                                            data-bulan="<?= $bulan ?>"
                                            data-field="<?= $field ?>">
                                    </td>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            <td class="border p-2 text-center">
                                <button id="simpan-btn-<?= $balita['id_balita'] ?>"
                                    onclick="konfirmasiSimpan(<?= $balita['id_balita'] ?>)"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hidden">Simpan
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <style>
        .sticky-header {
            position: sticky;
            top: 0;
            background-color: #2d3748;
            color: white;
            z-index: 30;
        }

        .sticky-col {
            position: sticky;
            background-color: #3B82F6;
            z-index: 20;
        }

        /* Kolom ke-1 dan ke-2 sticky posisinya */
        th:nth-child(1),
        td:nth-child(1) {
            left: 0;
            z-index: 25;
        }

        th:nth-child(2),
        td:nth-child(2) {
            left: 40px;
            z-index: 25;
        }
    </style>



    <?php if (!empty($pager)) : ?>
        <div class="mt-4 flex justify-center">
            <nav class="pagination flex space-x-2">
                <?= $pager->links('default', 'pagination_custom') ?>
            </nav>
        </div>
    <?php endif; ?>


    <!-- Modal Konfirmasi -->
    <div id="modalKonfirmasi" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-lg font-bold mb-4">Konfirmasi Simpan</h2>
            <p>Apakah Anda yakin ingin menyimpan perubahan?</p>
            <div class="mt-4 flex justify-center gap-2">
                <button onclick="tutupModalKonfirmasi()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button id="btnKonfirmasiSimpan" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Sukses -->
    <div id="modalSukses" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-lg font-bold mb-4 text-green-600">✅ Berhasil!</h2>
            <p class="mb-4">Data berhasil diperbarui.</p>
            <button onclick="tutupModalSukses()" class="bg-green-600 text-white px-4 py-2 rounded">Tutup</button>
        </div>
    </div>

    <script>
        let idTerpilih = null;

        function konfirmasiSimpan(id) {
            idTerpilih = id;
            document.getElementById("modalKonfirmasi").classList.remove("hidden");
        }

        function tutupModalKonfirmasi() {
            document.getElementById("modalKonfirmasi").classList.add("hidden");
        }

        function tutupModalSukses() {
            document.getElementById("modalSukses").classList.add("hidden");
            location.reload();
        }

        document.getElementById("btnKonfirmasiSimpan").addEventListener("click", function() {
            const id = idTerpilih;
            const inputs = document.querySelectorAll(`input[data-id="${id}"]`);
            let updates = [];

            inputs.forEach(input => {
                updates.push({
                    id: id,
                    bulan: input.dataset.bulan,
                    field: input.dataset.field,
                    value: input.value
                });
            });

            fetch("<?= base_url('admin/pemantauan-balita/update') ?>", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(updates)
                })
                .then(res => res.json())
                .then(response => {
                    document.getElementById("modalKonfirmasi").classList.add("hidden");
                    if (response.success) {
                        document.getElementById("modalSukses").classList.remove("hidden");
                    } else {
                        alert('Gagal memperbarui data!');
                    }
                });
        });

        document.querySelectorAll('.editable-cell').forEach(input => {
            input.dataset.original = input.value;
            input.addEventListener('input', () => {
                const rowId = input.dataset.id;
                const rowInputs = document.querySelectorAll(`input[data-id="${rowId}"]`);
                const hasChange = Array.from(rowInputs).some(inp => inp.value !== inp.dataset.original);
                const btn = document.getElementById(`simpan-btn-${rowId}`);
                if (hasChange) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            });
        });
    </script>

    <?= $this->endSection() ?>