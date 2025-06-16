<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Data Balita</h2>

    <form method="GET" class="mb-4 flex flex-wrap gap-2 justify-between items-center">
        <div class="flex gap-2 items-center">

            <input type="text" name="search" id="searchInput" placeholder="Cari NIK / Nama"
                value="<?= esc(@$_GET['search']) ?>" class="p-2 border rounded" />
            <select name="jk" id="filterJK" class="p-2 border rounded">
                <option value="">Semua</option>
                <option value="L" <?= @$_GET['jk'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= @$_GET['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>


            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Cari</button>
        </div>

        <a href="<?= base_url('/admin/databalita/tambah') ?>" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah Data</a>
    </form>




    <!-- Table -->
    <div class="overflow-x-auto border rounded-lg shadow">
        <table class="table-auto min-w-max w-full border-collapse border border-gray-400">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="border border-gray-500 p-2 text-center">No</th>
                    <th class="border border-gray-500 p-2 text-center">NIK Anak</th>
                    <th class="border border-gray-500 p-2 text-center">Nama Anak</th>
                    <th class="border border-gray-500 p-2 text-center">Tanggal Lahir</th>
                    <th class="border border-gray-500 p-2 text-center">Jenis Kelamin</th>
                    <th class="border border-gray-500 p-2 text-center">BB Lahir</th>
                    <th class="border border-gray-500 p-2 text-center">PB Lahir</th>
                    <th class="border border-gray-500 p-2 text-center">Lingkar Kepala</th>
                    <th class="border border-gray-500 p-2 text-center">Premature / Mature</th>
                    <th class="border border-gray-500 p-2 text-center">No KK</th>
                    <th class="border border-gray-500 p-2 text-center">NIK Ibu</th>
                    <th class="border border-gray-500 p-2 text-center">Nama Ibu</th>
                    <th class="border border-gray-500 p-2 text-center">NIK Ayah</th>
                    <th class="border border-gray-500 p-2 text-center">Nama Ayah</th>
                    <th class="border border-gray-500 p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="dataTable">
                <?php foreach ($balita as $index => $row): ?>
                    <tr data-id="<?= $row['id'] ?>" class="<?= $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' ?>">
                        <td class="border border-gray-300 px-2 py-1 text-center"><?= $index + 1 + ($perPage * ($currentPage - 1)) ?></td>

                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="nik_anak"><?= esc($row['nik_anak']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="nama_anak"><?= esc($row['nama_anak']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="tgl_lahir"><?= esc($row['tgl_lahir']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="jenis_kelamin"><?= esc($row['jenis_kelamin']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="berat_badan_lahir"><?= esc($row['berat_badan_lahir']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="panjang_badan_lahir"><?= esc($row['panjang_badan_lahir']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="lingkar_kepala_lahir"><?= esc($row['lingkar_kepala_lahir']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="premature_mature"><?= esc($row['premature_mature']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="no_kk"><?= esc($row['no_kk']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="nik_ibu"><?= esc($row['nik_ibu']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="nama_ibu"><?= esc($row['nama_ibu']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="nik_ayah"><?= esc($row['nik_ayah']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center edit-balita hover:bg-blue-100" contenteditable="true" data-field="nama_ayah"><?= esc($row['nama_ayah']) ?></td>
                        <td class="border border-gray-300 px-2 py-1 text-center space-x-1">
                            <button class="simpan-btn-balita hidden bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm" data-id="<?= $row['id'] ?>">Simpan</button>
                            <button class="btn-arsip bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-sm">Arsip</button>
                            <button class="btn-hapus bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Arsip -->
<div id="modalKonfirmasiArsip" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Arsip Data</h2>
        <p class="mb-4 text-gray-600">Pilih kategori arsip untuk data ini:</p>
        <select id="kategoriArsip" class="border p-2 w-full">
            <option value="Pindah">Pindah</option>
            <option value="Meninggal">Meninggal</option>
            <option value="Lulus">Lulus</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        <div class="flex justify-end gap-2 mt-4">
            <button onclick="tutupModalArsip()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
            <button id="btnArsipKonfirmasi" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">Ya, Arsipkan</button>
        </div>
    </div>
</div>


<!-- Modal Sukses -->
<div id="modalSuksesArsip" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4"> Data berhasil dipindahkan ke arsip.</p>
        <button onclick="tutupModalSukses()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Tutup</button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Balita -->
<div id="modalKonfirmasiHapusBalita" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Hapus</h2>
        <p class="mb-4 text-gray-600">Apakah kamu yakin ingin menghapus data balita ini? Tindakan ini tidak bisa dibatalkan.</p>
        <div class="flex justify-end gap-2">
            <button onclick="tutupModalHapusBalita()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
            <button id="btnHapusKonfirmasiBalita" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Ya, Hapus</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Hapus Balita -->
<div id="modalSuksesHapusBalita" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4">Data balita berhasil dihapus dari sistem.</p>
        <button onclick="tutupModalSuksesHapusBalita()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Tutup</button>
    </div>
</div>

<!-- Modal Konfirmasi Update Balita -->
<div id="modalKonfirmasiUpdateBalita" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-6 w-96 text-center">
        <p class="mb-4">Yakin ingin menyimpan perubahan data balita ini?</p>
        <div class="flex justify-center gap-4">
            <button id="batalUpdateBalita" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
            <button id="konfirmasiUpdateBalita" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Update Balita -->
<div id="modalSuksesUpdateBalita" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-6 w-96 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4">Data berhasil diperbarui dari sistem.</p>

        <button id="closeModalSuksesUpdateBalita" class="px-4 py-2 bg-green-600 text-white rounded">OK</button>
    </div>
</div>


<?php if (!empty($pager)) : ?>
    <div class="mt-4 flex justify-center">
        <nav class="pagination flex space-x-2">
            <?= $pager->links('default', 'pagination_custom') ?>
        </nav>
    </div>
<?php endif; ?>


<script>
    document.getElementById("btnCari").addEventListener("click", function() {
        fetchData();
    });

    function fetchData() {
        let keyword = document.getElementById("search").value.trim().toLowerCase();
        let rt = document.getElementById("filterRT").value;

        fetch(`<?= base_url('/admin/databalita/search') ?>?keyword=${keyword}&rt=${encodeURIComponent(rt)}`)
            .then(response => response.json())
            .then(data => renderTable(data))
            .catch(error => console.error("Error fetching data:", error));
    }

    function renderTable(data) {
        let tableBody = document.getElementById("dataTable");
        tableBody.innerHTML = "";

        if (data.length > 0) {
            data.forEach((row, i) => {
                let tr = `<tr class="${i % 2 === 0 ? 'bg-white' : 'bg-green-50'}" data-id="${row.id}">
                <td class="border p-2 text-center">${i + 1}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="nik_anak">${row.nik_anak}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="nama_anak">${row.nama_anak}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="tgl_lahir">${row.tgl_lahir}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50 text-center" contenteditable data-field="jenis_kelamin">${row.jenis_kelamin}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50 text-center" contenteditable data-field="berat_badan_lahir">${row.berat_badan_lahir}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50 text-center" contenteditable data-field="panjang_badan_lahir">${row.panjang_badan_lahir}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50 text-center" contenteditable data-field="lingkar_kepala_lahir">${row.lingkar_kepala_lahir}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50 text-center" contenteditable data-field="premature_mature">${row.premature_mature}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="no_kk">${row.no_kk}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="nik_ibu">${row.nik_ibu}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="nama_ibu">${row.nama_ibu}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="nik_ayah">${row.nik_ayah}</td>
                <td class="border p-2 edit-balita cursor-text hover:bg-blue-50" contenteditable data-field="nama_ayah">${row.nama_ayah}</td>
                <td class="border p-2 text-center space-x-1">
                    <button class="simpan-btn-balita hidden text-xs bg-blue-500 text-white px-2 py-1 rounded" data-id="${row.id}">Simpan</button>
                    <button class="btn-arsip text-xs bg-yellow-500 text-white px-2 py-1 rounded">Arsip</button>
                    <button class="btn-hapus text-xs bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                </td>
            </tr>`;
                tableBody.innerHTML += tr;
            });
        } else {
            tableBody.innerHTML = `<tr><td colspan="15" class="border p-2 text-center text-red-500">Data tidak ditemukan</td></tr>`;
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let originalData = {};

        // Simpan data awal pas load
        document.querySelectorAll("tr[data-id]").forEach(row => {
            const id = row.dataset.id;
            originalData[id] = {};

            row.querySelectorAll(".edit-balita").forEach(cell => {
                const field = cell.dataset.field;
                originalData[id][field] = cell.innerText.trim();
            });
        });

        // Cek perubahan pas input
        document.addEventListener("input", function(e) {
            if (e.target.classList.contains("edit-balita")) {
                const row = e.target.closest("tr");
                const id = row.dataset.id;
                const btn = row.querySelector(".simpan-btn-balita");

                let changed = false;
                row.querySelectorAll(".edit-balita").forEach(cell => {
                    const field = cell.dataset.field;
                    if (cell.innerText.trim() !== originalData[id][field]) {
                        changed = true;
                    }
                });

                if (changed) {
                    btn.classList.remove("hidden");
                } else {
                    btn.classList.add("hidden");
                }
            }
        });

        // Klik tombol simpan
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("simpan-btn-balita")) {
                const row = e.target.closest("tr");
                const id = e.target.dataset.id;

                const dataBalita = {
                    id,
                    nik_anak: row.querySelector('[data-field="nik_anak"]').innerText.trim(),
                    nama_anak: row.querySelector('[data-field="nama_anak"]').innerText.trim(),
                    tgl_lahir: row.querySelector('[data-field="tgl_lahir"]').innerText.trim(),
                    jenis_kelamin: row.querySelector('[data-field="jenis_kelamin"]').innerText.trim(),
                    berat_badan_lahir: row.querySelector('[data-field="berat_badan_lahir"]').innerText.trim(),
                    panjang_badan_lahir: row.querySelector('[data-field="panjang_badan_lahir"]').innerText.trim(),
                    lingkar_kepala_lahir: row.querySelector('[data-field="lingkar_kepala_lahir"]').innerText.trim(),
                    premature_mature: row.querySelector('[data-field="premature_mature"]').innerText.trim(),
                    no_kk: row.querySelector('[data-field="no_kk"]').innerText.trim(),
                    nik_ibu: row.querySelector('[data-field="nik_ibu"]').innerText.trim(),
                    nama_ibu: row.querySelector('[data-field="nama_ibu"]').innerText.trim(),
                    nik_ayah: row.querySelector('[data-field="nik_ayah"]').innerText.trim(),
                    nama_ayah: row.querySelector('[data-field="nama_ayah"]').innerText.trim()
                };

                window.dataBalitaUpdate = dataBalita;
                document.getElementById("modalKonfirmasiUpdateBalita").classList.remove("hidden");
            }
        });

        // Konfirmasi update
        document.getElementById("konfirmasiUpdateBalita").addEventListener("click", function() {
            fetch("<?= base_url('/admin/databalita/update') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(window.dataBalitaUpdate)
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById("modalKonfirmasiUpdateBalita").classList.add("hidden");

                    if (data.status === "success") {
                        document.getElementById("modalSuksesUpdateBalita").classList.remove("hidden");
                    } else {
                        alert("Gagal memperbarui data.");
                    }
                });
        });

        // Tutup modal sukses
        document.getElementById("closeModalSuksesUpdateBalita").addEventListener("click", function() {
            document.getElementById("modalSuksesUpdateBalita").classList.add("hidden");
            location.reload();
        });

        // Batal update
        document.getElementById("batalUpdateBalita").addEventListener("click", function() {
            document.getElementById("modalKonfirmasiUpdateBalita").classList.add("hidden");
        });
    });
</script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedBalitaId = null;

        // Tombol HAPUS
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function() {
                const tr = this.closest('tr');
                selectedBalitaId = tr.dataset.id;
                document.getElementById('modalKonfirmasiHapusBalita').classList.remove('hidden');
            });
        });

        document.getElementById('btnHapusKonfirmasiBalita').addEventListener('click', function() {
            fetch(`<?= base_url('/admin/databalita/hapus') ?>`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        id: selectedBalitaId
                    })
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        document.getElementById('modalKonfirmasiHapusBalita').classList.add('hidden');
                        document.getElementById('modalSuksesHapusBalita').classList.remove('hidden');
                        setTimeout(() => location.reload(), 1500);
                    }
                });
        });

        window.tutupModalHapusBalita = () => document.getElementById('modalKonfirmasiHapusBalita').classList.add('hidden');
        window.tutupModalSuksesHapusBalita = () => document.getElementById('modalSuksesHapusBalita').classList.add('hidden');
    });
</script>

<script>
    let idTerpilih = null;

    function tutupModalArsip() {
        document.getElementById("modalKonfirmasiArsip").classList.add("hidden");
        idTerpilih = null;
    }

    function tutupModalSukses() {
        document.getElementById("modalSuksesArsip").classList.add("hidden");
        location.reload(); // Reload untuk merefresh tabel setelah arsip
    }

    document.querySelectorAll('.btn-arsip').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            idTerpilih = row.dataset.id;
            document.getElementById("modalKonfirmasiArsip").classList.remove("hidden");
        });
    });

    document.getElementById("btnArsipKonfirmasi").addEventListener('click', function() {
        const kategori = document.getElementById("kategoriArsip").value;

        fetch("<?= base_url('admin/databalita/arsipkan') ?>", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: `id=${idTerpilih}&kategori=${kategori}`
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    document.getElementById("modalKonfirmasiArsip").classList.add("hidden");
                    document.getElementById("modalSuksesArsip").classList.remove("hidden");
                } else {
                    alert("Gagal mengarsipkan data. Coba lagi.");
                }
            });
    });
</script>
<script>
    function filterDataJK() {
        const jk = document.getElementById('filterJK').value;
        const keyword = document.getElementById('searchInput').value;

        const url = `?jk=${jk}&keyword=${keyword}`;

        fetch(url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('#dataContainer').innerHTML;
                document.getElementById('dataContainer').innerHTML = newContent;
            });
    }
</script>




<?= $this->endSection() ?>