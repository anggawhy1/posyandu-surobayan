<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Data Usia Produktif</h2>

    <!-- Search & Filter -->
    <div class="mb-4 flex justify-between items-center">
        <form method="GET" id="filterForm" class="flex space-x-2">
            <input type="text" name="search" id="search"
                class="border px-4 h-10 w-64 rounded"
                placeholder="Cari Nama atau NIK..." value="<?= esc($_GET['search'] ?? '') ?>">

            <select name="alamat" id="filterAlamat"
                class="border px-4 h-10 rounded">
                <option value="">Semua RT</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <?php $rt = sprintf("Surobayan RT %02d", $i); ?>
                    <option value="<?= $rt ?>" <?= ($_GET['alamat'] ?? '') === $rt ? 'selected' : '' ?>>
                        <?= $rt ?>
                    </option>
                <?php endfor; ?>
            </select>

            <select name="jenis_kelamin" id="filterJK"
                class="border px-4 h-10 rounded">
                <option value="">Semua</option>
                <option value="L" <?= ($_GET['jenis_kelamin'] ?? '') === "L" ? "selected" : "" ?>>Laki-laki</option>
                <option value="P" <?= ($_GET['jenis_kelamin'] ?? '') === "P" ? "selected" : "" ?>>Perempuan</option>
            </select>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 h-10 rounded">Cari</button>
        </form>

        <!-- Tombol Tambah Data -->
        <a href="<?= base_url('admin/tambah-usia-produktif') ?>"
            class="bg-green-500 hover:bg-green-700 text-white px-4 h-10 rounded flex items-center">
            Tambah Data
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto border rounded-lg shadow">
        <table class="table-auto min-w-max w-full border-collapse border border-gray-400">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="border border-gray-500 p-2 text-center">No</th>
                    <th class="border border-gray-500 p-2 text-center">NIK</th>
                    <th class="border border-gray-500 p-2 text-center">Nama</th>
                    <th class="border border-gray-500 p-2 text-center">Alamat</th>
                    <th class="border border-gray-500 p-2 text-center">Usia</th>
                    <th class="border border-gray-500 p-2 text-center">JK</th>
                    <th class="border border-gray-500 p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="dataTable">
                <?php if (!empty($usiaProduktif)) : ?>
                    <?php foreach ($usiaProduktif as $index => $row) : ?>
                        <tr class="<?= $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' ?>">
                            <td class="border border-gray-400 p-2 text-center"><?= $startIndex + $index + 1 ?></td>
                            <td class="border border-gray-400 p-2 editable hover:bg-blue-100" data-field="nik" data-id="<?= $row['id'] ?>"><?= esc($row['nik']) ?></td>
                            <td class="border border-gray-400 p-2 editable hover:bg-blue-100" data-field="nama" data-id="<?= $row['id'] ?>"><?= esc($row['nama']) ?></td>
                            <td class="border border-gray-400 p-2 editable hover:bg-blue-100" data-field="alamat" data-id="<?= $row['id'] ?>"><?= esc($row['alamat']) ?></td>
                            <td class="border border-gray-400 p-2 text-center editable hover:bg-blue-100" data-field="usia" data-id="<?= $row['id'] ?>"><?= esc($row['usia']) ?></td>
                            <td class="border border-gray-400 p-2 text-center editable hover:bg-blue-100" data-field="jenis_kelamin" data-id="<?= $row['id'] ?>"><?= esc($row['jenis_kelamin']) ?></td>
                            <td class="border border-gray-400 p-2 text-center">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded save-btn hidden" data-id="<?= $row['id'] ?>">Simpan</button>
                                <button class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded arsipkan-btn"
                                    data-id="<?= $row['id'] ?>"
                                    data-nik="<?= $row['nik'] ?>"
                                    data-nama="<?= $row['nama'] ?>"
                                    data-alamat="<?= $row['alamat'] ?>"
                                    data-usia="<?= $row['usia'] ?>"
                                    data-jenis-kelamin="<?= $row['jenis_kelamin'] ?>">
                                    Arsip
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded hapus-btn" data-id="<?= $row['id'] ?>" data-nama="<?= esc($row['nama']) ?>">Hapus</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="border border-gray-400 p-2 text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>


        </table>

        <!-- Pagination -->
        <?php if (!empty($pager)) : ?>
            <div class="mt-4 flex justify-center">
                <nav class="pagination flex space-x-2">
                    <?= $pager->links('default', 'pagination_custom') ?>
                </nav>
            </div>
        <?php endif; ?>


    </div>

</div>

<!-- Modal Arsip -->
<div id="modalArsip" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Arsipkan Data</h2>
        <p id="infoArsip" class="mb-4"></p>

        <p class="mb-4 text-gray-600">Pilih kategori arsip untuk data ini:</p>
        <select id="kategoriArsip" class="border p-2 w-full">
            <option value="Pindah">Pindah</option>
            <option value="Meninggal">Meninggal</option>
            <option value="Lulus">Lulus</option>
            <option value="Lainnya">Lainnya</option>
        </select>

        <div class="flex justify-end mt-4">
            <button id="tutupBatal" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded mr-2">Batal</button>
            <button id="confirmArsip" class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded">Arsipkan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="modalSukses" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600">✅ Sukses!</h2>
        <p id="suksesMessage" class="text-gray-700">Data berhasil diarsipkan.</p>
        <button id="closeSukses" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded mt-4">OK</button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-2 text-red-600">Konfirmasi Hapus</h2>
        <p id="infoHapus" class="text-gray-700">Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="flex justify-center mt-4 space-x-4">
            <button id="confirmHapus" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
            <button id="closeHapusModal" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Batal</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Hapus -->
<div id="modalSuksesHapus" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600">✅ Sukses!</h2>
        <p id="suksesHapusMessage" class="text-gray-700">Data berhasil dihapus.</p>
        <button id="closeSuksesHapus" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded mt-4">OK</button>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="modalKonfirmasi" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-lg font-semibold">Apakah Anda yakin ingin menyimpan perubahan?</p>
        <div class="mt-4 flex justify-end">
            <button id="batalUpdate" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
            <button id="konfirmasiUpdate" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="modalSukses" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-2 text-green-600">✅ Sukses!</h2>
        <p class="text-lg font-semibold">Perubahan berhasil disimpan!</p>
        <div class="mt-4 flex justify-end">
            <button id="tutupSukses" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">OK</button>
        </div>
    </div>
</div>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectedData = {};

        // Tampilkan modal saat tombol "Arsipkan" diklik
        document.querySelectorAll(".arsipkan-btn").forEach(button => {
            button.addEventListener("click", function() {
                selectedData = {
                    id: this.getAttribute("data-id"),
                    nik: this.getAttribute("data-nik"),
                    nama: this.getAttribute("data-nama"),
                    alamat: this.getAttribute("data-alamat"),
                    usia: this.getAttribute("data-usia"),
                    jenis_kelamin: this.getAttribute("data-jenis-kelamin")


                };

                document.getElementById("infoArsip").innerText =
                    `Apakah Anda yakin ingin mengarsipkan ${selectedData.nama} (${selectedData.nik})?`;

                document.getElementById("modalArsip").classList.remove("hidden");
            });
        });

        // Menutup modal saat tombol "Batal" diklik
        document.getElementById("tutupBatal").addEventListener("click", function() {
            document.getElementById("modalArsip").classList.add("hidden");
        });


        // Tombol "Arsipkan" (Konfirmasi)
        document.getElementById("confirmArsip").addEventListener("click", function() {
            let kategori = document.getElementById("kategoriArsip").value;

            fetch("<?= base_url('arsipkan-usia-produktif') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        ...selectedData,
                        kategori: kategori
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("modalArsip").classList.add("hidden");

                    // Tampilkan modal sukses dengan pesan dari server
                    document.getElementById("suksesMessage").innerText = data.message;
                    document.getElementById("modalSukses").classList.remove("hidden");
                })
                .catch(error => console.error("Error:", error));
        });

        // Tombol "OK" di modal sukses
        document.getElementById("closeSukses").addEventListener("click", function() {
            document.getElementById("modalSukses").classList.add("hidden");
            location.reload();
        });
    });
</script>



<!-- hapus -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectedHapusId = null;

        // Tampilkan modal saat tombol "Hapus" diklik
        document.querySelectorAll(".hapus-btn").forEach(button => {
            button.addEventListener("click", function() {
                selectedHapusId = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");

                document.getElementById("infoHapus").innerText =
                    `Apakah Anda yakin ingin menghapus ${nama}?`;

                document.getElementById("modalHapus").classList.remove("hidden");
            });
        });

        // Tombol "Batal" pada modal hapus
        document.getElementById("closeHapusModal").addEventListener("click", function() {
            document.getElementById("modalHapus").classList.add("hidden");
        });

        // Tombol "Hapus" (Konfirmasi)
        document.getElementById("confirmHapus").addEventListener("click", function() {
            if (!selectedHapusId) return;

            fetch(`<?= base_url('hapus-usia-produktif') ?>/${selectedHapusId}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("modalHapus").classList.add("hidden");

                    // Tampilkan modal sukses dengan pesan dari server
                    document.getElementById("suksesHapusMessage").innerText = data.message;
                    document.getElementById("modalSuksesHapus").classList.remove("hidden");
                })
                .catch(error => console.error("Error:", error));
        });

        // Tombol "OK" di modal sukses hapus
        document.getElementById("closeSuksesHapus").addEventListener("click", function() {
            document.getElementById("modalSuksesHapus").classList.add("hidden");
            location.reload();
        });
    });
</script>


<!-- update -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectedData = {};

        // Membuat kolom menjadi input saat diklik
        document.querySelectorAll(".editable").forEach(cell => {
            cell.addEventListener("click", function() {
                if (!this.querySelector("input")) {
                    let input = document.createElement("input");
                    input.type = "text";
                    input.value = this.innerText.trim();
                    input.classList.add("border", "p-1", "w-full");
                    this.innerHTML = "";
                    this.appendChild(input);
                    input.focus();

                    // Tampilkan tombol simpan
                    this.closest("tr").querySelector(".save-btn").classList.remove("hidden");
                }
            });
        });

        // Saat tombol "Simpan" ditekan
        document.querySelectorAll(".save-btn").forEach(button => {
            button.addEventListener("click", function() {
                let row = this.closest("tr");
                let id = this.getAttribute("data-id");
                let updatedData = {
                    id: id
                };

                // Ambil data dari kolom yang diedit
                row.querySelectorAll(".editable").forEach(cell => {
                    let field = cell.getAttribute("data-field");
                    let value = cell.querySelector("input") ? cell.querySelector("input").value.trim() : cell.innerText.trim();
                    updatedData[field] = value;
                });

                selectedData = updatedData;
                document.getElementById("modalKonfirmasi").classList.remove("hidden");
            });
        });

        // Tombol "Batal" pada modal konfirmasi
        document.getElementById("batalUpdate").addEventListener("click", function() {
            document.getElementById("modalKonfirmasi").classList.add("hidden");
        });

        // Tombol "Simpan" pada modal konfirmasi
        document.getElementById("konfirmasiUpdate").addEventListener("click", function() {
            fetch("<?= base_url('update-usia-produktif') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(selectedData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("modalKonfirmasi").classList.add("hidden");
                        document.getElementById("modalSukses").classList.remove("hidden");
                    } else {
                        alert("Gagal menyimpan data!");
                    }
                })
                .catch(error => console.error("Error:", error));
        });

        // Tombol "OK" pada modal sukses
        document.getElementById("tutupSukses").addEventListener("click", function() {
            document.getElementById("modalSukses").classList.add("hidden");
            location.reload();
        });
    });
</script>


<script>
    document.getElementById("btnCari").addEventListener("click", function() {
        searchData();
    });

    document.getElementById("search").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        let keyword = document.getElementById("search").value.trim();
        let filterJK = document.getElementById("filterJK").value;
        let filterAlamat = document.getElementById("filterAlamat").value;

        let query = `keyword=${keyword}&jenis_kelamin=${filterJK}&alamat=${filterAlamat}`;

        fetch("<?= base_url('search-usia-produktif') ?>?" + query)
            .then(response => response.json())
            .then(data => {
                renderTable(data);
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    function renderTable(data) {
        let tableBody = document.getElementById("dataTable");
        tableBody.innerHTML = "";

        if (data.length > 0) {
            data.forEach((row, index) => {
                let tr = `<tr class="${index % 2 == 0 ? 'bg-white' : 'bg-green-100'}">
                    <td class="border border-gray-400 p-2 text-center">${index + 1}</td>
                    <td class="border border-gray-400 p-2">${row.nik}</td>
                    <td class="border border-gray-400 p-2">${row.nama}</td>
                    <td class="border border-gray-400 p-2">${row.alamat}</td>
                    <td class="border border-gray-400 p-2 text-center">${row.usia}</td>
                    <td class="border border-gray-400 p-2 text-center">${row.jenis_kelamin}</td>
                    <td class="border border-gray-400 p-2 text-center">
                        <button class="bg-green-500 text-white px-3 py-1 rounded">Update</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += tr;
            });
        } else {
            tableBody.innerHTML = `<tr><td colspan="7" class="border border-gray-400 p-2 text-center text-red-500">Data tidak ditemukan</td></tr>`;
        }
    }
</script>


<?= $this->endSection() ?>