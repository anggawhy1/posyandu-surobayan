<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Data Remaja Putri</h2>

    <form method="GET" class="mb-4 flex flex-wrap gap-2 justify-between items-center">
        <!-- Kiri: Search + Filter RT -->
        <div class="flex gap-2 items-center">
            <input type="text" name="search" class="border p-2" placeholder="Cari Nama atau NIK..." value="<?= esc(@$_GET['search']) ?>">

            <select name="rt" class="border p-2">
                <option value="">Semua RT</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <option value="Surobayan RT <?= sprintf('%02d', $i) ?>" <?= @$_GET['rt'] == "Surobayan RT " . sprintf('%02d', $i) ? 'selected' : '' ?>>
                        Surobayan RT <?= sprintf('%02d', $i) ?>
                    </option>
                <?php endfor; ?>
            </select>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Cari</button>
        </div>

        <!-- Kanan: Tombol Tambah -->
        <a href="<?= base_url('/admin/remajaputri/tambah') ?>" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah Data</a>
    </form>



    <!-- Table -->
    <div class="overflow-x-auto border rounded-lg shadow">
        <table class="table-auto min-w-max w-full border-collapse border border-gray-400">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="border border-gray-500 p-2 text-center">No</th>
                    <th class="border border-gray-500 p-2 text-center">NIK</th>
                    <th class="border border-gray-500 p-2 text-center">Nama Lengkap</th>
                    <th class="border border-gray-500 p-2 text-center">Tanggal Lahir</th>
                    <th class="border border-gray-500 p-2 text-center">Golongan Darah</th>
                    <th class="border border-gray-500 p-2 text-center">Kadar HB</th>
                    <th class="border border-gray-500 p-2 text-center">Alamat</th>
                    <th class="border border-gray-500 p-2 text-center">Nomor Telepon</th>
                    <th class="border border-gray-500 p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="dataTable">
                <?php foreach ($remajaputri as $index => $row): ?>
                    <tr data-id="<?= $row['id'] ?>" class="<?= $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' ?>">
                        <!-- No -->
                        <td class="border border-gray-300 px-2 py-1 text-center"><?= $index + 1 ?></td>

                        <!-- NIK -->
                        <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="nik"><?= esc($row['nik']) ?></td>

                        <!-- Nama -->
                        <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="nama_lengkap"><?= esc($row['nama_lengkap']) ?></td>

                        <!-- Tanggal Lahir -->
                        <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="tanggal_lahir"><?= esc($row['tanggal_lahir']) ?></td>
                        <!-- Golongan Darah -->
                        <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="golongan_darah"><?= esc($row['golongan_darah']) ?></td>

                         <!-- Kadar HB -->
                         <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="kadar_hb"><?= esc($row['kadar_hb']) ?></td>

                        <!-- Alamat -->
                        <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="alamat"><?= esc($row['alamat']) ?></td>

                        

                       

                        <!-- Nomor Telepon -->
                        <td class="border border-gray-300 px-2 py-1 text-center edit-remaja hover:bg-blue-100" contenteditable="true" data-field="nomor_telepon"><?= esc($row['nomor_telepon']) ?></td>

                        <!-- Aksi -->
                        <td class="border border-gray-300 px-2 py-1 text-center space-x-1">
                            <button class="simpan-btn-remaja hidden bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm" data-id="<?= $row['id'] ?>">Simpan</button>
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
        <select id="kategoriArsip" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="Pindah">Pindah</option>
            <option value="Menikah">Menikah</option>
            <option value="Meninggal">Meninggal</option>
            <option value="Lulus">Lulus</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        <div class="flex justify-end mt-6 space-x-2">
            <button onclick="tutupModalArsip()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
            <button id="btnArsipKonfirmasi" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">Ya, Arsipkan</button>
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

<div id="modalKonfirmasiHapus" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Hapus</h2>
        <p class="mb-4 text-gray-600">Apakah kamu yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan.</p>
        <div class="flex justify-end gap-2">
            <button onclick="tutupModalHapus()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
            <button id="btnHapusKonfirmasi" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Ya, Hapus</button>
        </div>
    </div>
</div>

<div id="modalSuksesHapus" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4">Data berhasil dihapus dari sistem.</p>
        <button onclick="tutupModalSuksesHapus()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Tutup</button>
    </div>
</div>


<div id="modalSuksesUpdateRemaja" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-6 w-96 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4">Data berhasil diperbarui dari sistem.</p>
        <button id="closeModalSuksesUpdateRemaja" class="px-4 py-2 bg-green-600 text-white rounded">OK</button>
    </div>
</div>
<div id="modalKonfirmasiUpdateRemaja" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-6 w-96 text-center">
        <p class="mb-4">Yakin ingin menyimpan perubahan data ini?</p>
        <div class="flex justify-center gap-4">
            <button id="batalUpdateRemaja" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
            <button id="konfirmasiUpdateRemaja" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Simpan</button>
        </div>
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

        fetch(`<?= base_url('/admin/remajaputri/search') ?>?keyword=${keyword}&rt=${encodeURIComponent(rt)}`)
            .then(response => response.json())
            .then(data => renderTable(data))
            .catch(error => console.error("Error fetching data:", error));
    }

    function renderTable(data) {
        let tableBody = document.getElementById("dataTable");
        tableBody.innerHTML = "";

        if (data.length > 0) {
            data.forEach((row, index) => {
                let tr = `<tr class="${index % 2 == 0 ? 'bg-white' : 'bg-green-100'}">
                    <td class="border border-gray-400 p-2 text-center">${index + 1}</td>
                    <td class="border border-gray-400 p-2">${row.nama_lengkap}</td>
                    <td class="border border-gray-400 p-2">${row.nik}</td>
                    <td class="border border-gray-400 p-2">${row.tanggal_lahir}</td>
                    <td class="border border-gray-400 p-2 text-center">${row.golongan_darah}</td>
                    <td class="border border-gray-400 p-2 text-center">${row.kadar_hb}</td>
                    <td class="border border-gray-400 p-2">${row.alamat}</td>
                    <td class="border border-gray-400 p-2 text-center">${row.nomor_telepon}</td>
                    <td class="border border-gray-400 p-2 text-center">
                        <button class="bg-green-500 text-white px-3 py-1 rounded">Update</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += tr;
            });
        } else {
            tableBody.innerHTML = `<tr><td colspan="9" class="border border-gray-400 p-2 text-center text-red-500">Data tidak ditemukan</td></tr>`;
        }
    }
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

        fetch("<?= base_url('admin/remajaputri/arsipkan') ?>", {
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
    let idHapus = null;

    function tutupModalHapus() {
        document.getElementById("modalKonfirmasiHapus").classList.add("hidden");
        idHapus = null;
    }

    function tutupModalSuksesHapus() {
        document.getElementById("modalSuksesHapus").classList.add("hidden");
        location.reload(); // Refresh halaman setelah hapus
    }

    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            idHapus = row.dataset.id;
            document.getElementById("modalKonfirmasiHapus").classList.remove("hidden");
        });
    });

    document.getElementById("btnHapusKonfirmasi").addEventListener('click', function() {
        fetch("<?= base_url('admin/remajaputri/hapus') ?>", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: `id=${idHapus}`
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    document.getElementById("modalKonfirmasiHapus").classList.add("hidden");
                    document.getElementById("modalSuksesHapus").classList.remove("hidden");
                } else {
                    alert("Gagal menghapus data.");
                }
            });
    });
</script>

<script>
    let dataRemajaUpdate = {}; // global var

    document.querySelectorAll('.edit-remaja').forEach(cell => {
        cell.addEventListener('focus', function() {
            this.dataset.oldValue = this.innerText.trim();
        });

        cell.addEventListener('input', function() {
            const row = this.closest('tr');
            const saveBtn = row.querySelector('.simpan-btn-remaja');

            if (this.innerText.trim() !== this.dataset.oldValue) {
                saveBtn.classList.remove('hidden');
            } else {
                saveBtn.classList.add('hidden');
            }
        });

        cell.addEventListener('blur', function() {
            const row = this.closest('tr');
            const saveBtn = row.querySelector('.simpan-btn-remaja');

            if (this.innerText.trim() === this.dataset.oldValue) {
                saveBtn.classList.add('hidden');
            }
        });
    });

    document.querySelectorAll('.simpan-btn-remaja').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const id = this.dataset.id;

            dataRemajaUpdate = {
                id,
                nik: row.querySelector('[data-field="nik"]').innerText.trim(),
                nama_lengkap: row.querySelector('[data-field="nama_lengkap"]').innerText.trim(),
                tanggal_lahir: row.querySelector('[data-field="tanggal_lahir"]').innerText.trim(),
                alamat: row.querySelector('[data-field="alamat"]').innerText.trim(),
                golongan_darah: row.querySelector('[data-field="golongan_darah"]').innerText.trim(),
                kadar_hb: row.querySelector('[data-field="kadar_hb"]').innerText.trim(),
                nomor_telepon: row.querySelector('[data-field="nomor_telepon"]').innerText.trim()
            };

            document.getElementById('modalKonfirmasiUpdateRemaja').classList.remove('hidden');
        });
    });

    document.getElementById('batalUpdateRemaja').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiUpdateRemaja').classList.add('hidden');
    });

    document.getElementById('konfirmasiUpdateRemaja').addEventListener('click', function() {
        fetch('<?= base_url("/admin/remajaputri/update") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dataRemajaUpdate)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalKonfirmasiUpdateRemaja').classList.add('hidden');

                if (data.status === 'error') {
                    alert(data.message);
                } else {
                    document.getElementById('modalSuksesUpdateRemaja').classList.remove('hidden');
                    const row = document.querySelector(`.simpan-btn-remaja[data-id="${dataRemajaUpdate.id}"]`).closest('tr');
                    row.querySelector('.simpan-btn-remaja').classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data.');
            });
    });

    document.getElementById('closeModalSuksesUpdateRemaja').addEventListener('click', function() {
        document.getElementById('modalSuksesUpdateRemaja').classList.add('hidden');
        location.reload();
    });
</script>





<?= $this->endSection() ?>