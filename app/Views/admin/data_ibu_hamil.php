<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Data Ibu Hamil</h2>

    <!-- Search, Filter RT & Tambah Data -->
    <div class="mb-4 flex flex-wrap gap-2 justify-between items-center">

        <!-- Search + Filter -->
        <form method="GET" class="flex flex-wrap gap-2">
            <!-- Search NIK / Nama -->
            <input type="text" name="search" id="searchInput"
                placeholder="Cari NIK atau Nama..."
                value="<?= esc($_GET['search'] ?? '') ?>"
                class="border p-2 text-sm w-64 rounded focus:outline-none focus:ring focus:border-blue-300">

            <!-- Filter RT -->
            <select name="alamat" id="filterAlamat" class="border p-2 text-sm rounded">
                <option value="">Semua RT</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <?php $rt = sprintf("Surobayan RT %02d", $i); ?>
                    <option value="<?= $rt ?>" <?= ($_GET['alamat'] ?? '') === $rt ? 'selected' : '' ?>>
                        <?= $rt ?>
                    </option>
                <?php endfor; ?>
            </select>

            <!-- Tombol Cari -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 text-sm rounded">Cari</button>
        </form>

        <!-- Tombah Data -->
        <a href="<?= base_url('tambah-ibu-hamil') ?>" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah Data</a>
    </div>



    <!-- Table -->
    <div class="overflow-x-auto border rounded-lg shadow">
        <table class="table-auto min-w-max w-full border-collapse border border-gray-400">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="border border-gray-500 p-2 text-center">No</th>
                    <th class="border border-gray-500 p-2 text-center">NIK</th>
                    <th class="border border-gray-500 p-2 text-center">Nama Ibu</th>
                    <th class="border border-gray-500 p-2 text-center">NIK Suami</th>
                    <th class="border border-gray-500 p-2 text-center">Nama Suami</th>
                    <th class="border border-gray-500 p-2 text-center">Pekerjaan Ibu</th>
                    <th class="border border-gray-500 p-2 text-center">Pekerjaan Suami</th>
                    <th class="border border-gray-500 p-2 text-center">Tgl Mulai Hamil</th>
                    <th class="border border-gray-500 p-2 text-center">Tgl Perkiraan Lahir</th>
                    <th class="border border-gray-500 p-2 text-center">Usia Kehamilan</th>
                    <th class="border border-gray-500 p-2 text-center">Gol. Darah Ibu</th>
                    <th class="border border-gray-500 p-2 text-center">Gol. Darah Suami</th>
                    <th class="border border-gray-500 p-2 text-center">Kadar HB</th>
                    <th class="border border-gray-500 p-2 text-center">BB Sebelum Hamil</th>
                    <th class="border border-gray-500 p-2 text-center">No Telepon</th>
                    <th class="border border-gray-500 p-2 text-center">Alamat</th>
                    <th class="border border-gray-500 p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ibuHamil)) : ?>
                    <?php foreach ($ibuHamil as $index => $row) : ?>
                        <tr class="<?= $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' ?>">
                            <td class="border border-gray-400 p-2 text-center"><?= $index + 1 ?></td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="nik" value="<?= esc($row['nik']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="nama_ibu_hamil" value="<?= esc($row['nama_ibu_hamil']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="nik_suami" value="<?= esc($row['nik_suami']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="nama_suami" value="<?= esc($row['nama_suami']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="pekerjaan_ibu_hamil" value="<?= esc($row['pekerjaan_ibu_hamil']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="pekerjaan_suami" value="<?= esc($row['pekerjaan_suami']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="tgl_mulai_hamil" value="<?= esc($row['tgl_mulai_hamil']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="tgl_perkiraan_lahir" value="<?= esc($row['tgl_perkiraan_lahir']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="usia_kehamilan" value="<?= esc($row['usia_kehamilan']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="golDarah_ibu_hamil" value="<?= esc($row['golDarah_ibu_hamil']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="golDarah_suami" value="<?= esc($row['golDarah_suami']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="kadar_hb" value="<?= esc($row['kadar_hb']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="bb_sebelum_hamil" value="<?= esc($row['bb_sebelum_hamil']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="no_telepon" value="<?= esc($row['no_telepon']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center hover:bg-blue-100">
                                <input type="text" class="w-full bg-transparent text-center editable" data-id="<?= $row['id'] ?>" data-field="alamat" value="<?= esc($row['alamat']) ?>">
                            </td>
                            <td class="border border-gray-400 p-2 text-center">
                                <div class="flex gap-1 justify-center">
                                    <button onclick="updateData(<?= $row['id'] ?>)" id="update-btn-<?= $row['id'] ?>" class="bg-blue-500 text-white px-3 py-1 rounded hidden">Simpan</button>
                                    <button onclick="showArsipModal(<?= $row['id'] ?>)" class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded">Arsip</button>
                                    <button onclick="hapusData(<?= $row['id'] ?>)" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="17" class="border border-gray-400 p-2 text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>


        </table>
    </div>
</div>

<?php if (!empty($pager)) : ?>
    <div class="mt-4 flex justify-center">
        <nav class="pagination flex space-x-2">
            <?= $pager->links('default', 'pagination_custom') ?>
        </nav>
    </div>
<?php endif; ?>

<!-- Modal Popup Sukses -->
<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg text-center">
        <h2 class="text-lg font-semibold mb-4">✅ Sukses!</h2>
        <p id="successMessage" class="mb-4"></p>
        <button onclick="closeSuccessModal()" class="bg-blue-500 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>


<!-- Modal Arsip (Styled seperti di bagian lansia) -->
<div id="arsipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Pilih Kategori Arsip</h2>
        <p class="mb-4 text-gray-600">Pilih kategori arsip untuk data ini:</p>
        <input type="hidden" id="arsipId">
        <select id="kategoriArsip" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="Pindah">Pindah</option>
            <option value="Meninggal">Meninggal</option>
            <option value="Keguguran">Keguguran</option>
            <option value="Melahirkan">Melahirkan</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        <div class="flex justify-end mt-6 space-x-2">
            <button onclick="closeArsipModal()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md transition">Batal</button>
            <button onclick="submitArsip()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">Ya, Arsipkan</button>
        </div>
    </div>
</div>





<!-- Modal Konfirmasi Arsip
<div id="modalKonfirmasiArsip" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Arsip Data</h2>
        <p class="mb-4 text-gray-600">Pilih kategori arsip untuk data ini:</p>
        <select id="kategoriArsip" class="w-full border-gray-300 rounded-md p-2 mb-4">
            <option value="Pindah">Pindah</option>
            <option value="Menikah">Meninggal</option>
            <option value="Keguguran">Keguguran</option>
            <option value="Melahirkan">Melahirkan</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        <div class="flex justify-end gap-2">
            <button onclick="tutupModalArsip()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
            <button id="btnArsipKonfirmasi" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">Ya, Arsipkan</button>
        </div>
    </div>
</div> -->


<!-- Modal Sukses -->
<div id="modalSuksesArsip" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4"> Data berhasil dipindahkan ke arsip.</p>
        <button onclick="tutupModalSukses()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Tutup</button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Balita -->
<div id="modalKonfirmasiHapusIbuHamil" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Hapus</h2>
        <p class="mb-4 text-gray-600">Apakah kamu yakin ingin menghapus data balita ini? Tindakan ini tidak bisa dibatalkan.</p>
        <div class="flex justify-end gap-2">
            <button onclick="tutupModalHapusIbuHamil()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
            <button id="btnHapusKonfirmasiIbuHamil" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Ya, Hapus</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Hapus Balita -->
<div id="modalSuksesHapusIbuHamil" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4">Data balita berhasil dihapus dari sistem.</p>
        <button onclick="tutupModalSuksesHapusIbuHamil()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Tutup</button>
    </div>
</div>

<!-- Modal Konfirmasi Update Balita -->
<div id="modalKonfirmasiUpdateIbuHamil" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-6 w-96 text-center">
        <p class="mb-4">Yakin ingin menyimpan perubahan data balita ini?</p>
        <div class="flex justify-center gap-4">
            <button id="batalUpdateIbuHamil" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
            <button id="konfirmasiUpdateIbuHamil" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Update Balita -->
<div id="modalSuksesUpdateIbuHamil" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-6 w-96 text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600"> ✅ Sukses!</h2>
        <p class="text-gray-700 mb-4">Data berhasil diperbarui dari sistem.</p>

        <button id="closeModalSuksesUpdateIbuHamil" class="px-4 py-2 bg-green-600 text-white rounded">OK</button>
    </div>
</div>


<script>
    // Fungsi Tampilkan Modal Sukses Arsip
    function showSuccessArsipModal() {
        document.getElementById("modalSuksesArsip").classList.remove("hidden");
    }

    function tutupModalSukses() {
        document.getElementById("modalSuksesArsip").classList.add("hidden");
        location.reload();
    }

    // Fungsi Tampilkan Modal Konfirmasi Hapus
    function showConfirmDeleteModal(action) {
        document.getElementById("modalKonfirmasiHapusIbuHamil").classList.remove("hidden");
        const btnHapus = document.getElementById("btnHapusKonfirmasiIbuHamil");

        // Unbind event listener sebelumnya
        const newBtnHapus = btnHapus.cloneNode(true);
        btnHapus.parentNode.replaceChild(newBtnHapus, btnHapus);

        newBtnHapus.addEventListener("click", action);
    }

    function tutupModalHapusIbuHamil() {
        document.getElementById("modalKonfirmasiHapusIbuHamil").classList.add("hidden");
    }

    function showSuccessDeleteModal() {
        document.getElementById("modalSuksesHapusIbuHamil").classList.remove("hidden");
    }

    function tutupModalSuksesHapusIbuHamil() {
        document.getElementById("modalSuksesHapusIbuHamil").classList.add("hidden");
        location.reload();
    }

    // Fungsi Tampilkan Modal Konfirmasi Update
    function showConfirmUpdateModal(action) {
        document.getElementById("modalKonfirmasiUpdateIbuHamil").classList.remove("hidden");

        const btnSimpan = document.getElementById("konfirmasiUpdateIbuHamil");
        const btnBatal = document.getElementById("batalUpdateIbuHamil");

        // Unbind event listener sebelumnya
        const newBtnSimpan = btnSimpan.cloneNode(true);
        btnSimpan.parentNode.replaceChild(newBtnSimpan, btnSimpan);

        newBtnSimpan.addEventListener("click", action);

        btnBatal.onclick = function() {
            document.getElementById("modalKonfirmasiUpdateIbuHamil").classList.add("hidden");
        }
    }

    function showSuccessUpdateModal() {
        document.getElementById("modalSuksesUpdateIbuHamil").classList.remove("hidden");

        document.getElementById("closeModalSuksesUpdateIbuHamil").onclick = function() {
            document.getElementById("modalSuksesUpdateIbuHamil").classList.add("hidden");
            location.reload();
        }
    }
</script>

<script>
    function showArsipModal(id) {
        document.getElementById("arsipId").value = id;
        document.getElementById("arsipModal").classList.remove("hidden");
    }

    function closeArsipModal() {
        document.getElementById("arsipModal").classList.add("hidden");
    }

    function submitArsip() {
        const id = document.getElementById("arsipId").value;
        const kategori = document.getElementById("kategoriArsip").value;

        fetch("<?= base_url('arsipkan-ibu-hamil') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id,
                    kategori
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    closeArsipModal();
                    showSuccessArsipModal();
                } else {
                    alert("Gagal mengarsipkan: " + data.message);
                }
            })
            .catch(error => {
                console.error(error);
                alert("Terjadi kesalahan. Cek konsol untuk detail.");
            });
    }

    function hapusData(id) {
        showConfirmDeleteModal(function() {
            fetch("<?= base_url('hapus-ibu-hamil') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        tutupModalHapusIbuHamil();
                        showSuccessDeleteModal();
                    } else {
                        alert("Gagal menghapus: " + data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Terjadi kesalahan. Cek konsol.");
                });
        });
    }

    function updateData(id) {
        showConfirmUpdateModal(function() {
            let inputs = document.querySelectorAll(`input[data-id='${id}']`);
            let data = {
                id: id
            };

            let valid = true;

            inputs.forEach(input => {
                let field = input.getAttribute("data-field");
                let value = input.value.trim();

                if (field === "nik" && (!/^\d{16}$/.test(value))) {
                    alert("NIK harus 16 digit angka!");
                    valid = false;
                }

                data[field] = value;
            });

            if (!valid) return;

            fetch("<?= base_url('update-ibu-hamil') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById("modalKonfirmasiUpdateIbuHamil").classList.add("hidden");
                        showSuccessUpdateModal();
                    } else {
                        alert("Gagal memperbarui data: " + data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                });
        });
    }
</script>

<script>
    // SEARCH: langsung filter baris tabel berdasarkan inputan user
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            let nikInput = row.querySelector("td:nth-child(2) input");
            let namaInput = row.querySelector("td:nth-child(3) input");

            if (!nikInput || !namaInput) return;

            let nik = nikInput.value.toLowerCase();
            let nama = namaInput.value.toLowerCase();

            if (nik.includes(keyword) || nama.includes(keyword)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    // TOMBOL SIMPAN MUNCUL SAAT ADA EDIT
    document.querySelectorAll('.editable').forEach(input => {
        const row = input.closest('tr');
        const id = input.dataset.id;
        const updateBtn = document.getElementById(`update-btn-${id}`);

        input.dataset.original = input.value;

        input.addEventListener('input', () => {
            const hasChanges = Array.from(row.querySelectorAll('.editable')).some(inp => inp.value !== inp.dataset.original);
            if (hasChanges) {
                updateBtn.classList.remove('hidden');
            } else {
                updateBtn.classList.add('hidden');
            }
        });

        input.addEventListener('blur', () => {
            const hasChanges = Array.from(row.querySelectorAll('.editable')).some(inp => inp.value !== inp.dataset.original);
            if (!hasChanges) {
                updateBtn.classList.add('hidden');
            }
        });
    });
</script>





<?= $this->endSection() ?>