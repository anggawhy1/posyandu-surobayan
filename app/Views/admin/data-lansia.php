<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Data Lansia</h2>

    <div class="mb-4 flex justify-between">
        <form method="GET" id="filterForm" class="flex space-x-2">
            <input type="text" name="search" id="search" class="border p-2 w-64"
                placeholder="Cari Nama atau NIK..." value="<?= esc($_GET['search'] ?? '') ?>">

            <select name="alamat" id="filterAlamat" class="border p-2">
                <option value="" <?= empty($_GET['alamat']) ? 'selected' : '' ?>>Semua RT</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <?php $rtValue = "Surobayan RT " . sprintf('%02d', $i); ?>
                    <option value="<?= $rtValue ?>" <?= (isset($_GET['alamat']) && $_GET['alamat'] === $rtValue) ? 'selected' : '' ?>>
                        <?= $rtValue ?>
                    </option>
                <?php endfor; ?>
            </select>


            <select name="jenis_kelamin" id="filterJK" class="border p-2">
                <option value="">Semua</option>
                <option value="L" <?= ($_GET['jenis_kelamin'] ?? '') === "L" ? "selected" : "" ?>>Laki-laki</option>
                <option value="P" <?= ($_GET['jenis_kelamin'] ?? '') === "P" ? "selected" : "" ?>>Perempuan</option>
            </select>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Cari</button>
        </form>

        <a href="<?= base_url('/admin/tambah-lansia') ?>" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah Data</a>
    </div>

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
            <tbody id="dataLansia">
                <?php foreach ($lansia as $index => $row) : ?>
                    <tr data-id="<?= $row['id'] ?>" class="<?= $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' ?>  transition">
                        <td class="border border-gray-400 p-2 text-center"><?= ($pager->getCurrentPage() - 1) * 50 + $index + 1 ?></td>
                        <td contenteditable="true" class="border border-gray-400 p-2 edit hover:bg-blue-100" data-field="nik"><?= esc($row['nik']) ?></td>
                        <td contenteditable="true" class="border border-gray-400 p-2 edit hover:bg-blue-100" data-field="nama"><?= esc($row['nama']) ?></td>
                        <td contenteditable="true" class="border border-gray-400 p-2 edit hover:bg-blue-100" data-field="alamat"><?= esc($row['alamat']) ?></td>
                        <td contenteditable="true" class="border border-gray-400 p-2 edit hover:bg-blue-100" data-field="usia"><?= esc($row['usia']) ?></td>
                        <td contenteditable="true" class="border border-gray-400 p-2 edit hover:bg-blue-100" data-field="jenis_kelamin"><?= esc($row['jenis_kelamin']) ?></td>
                        <td class="border border-gray-400 p-2 text-center">
                            <button class="arsip-btn bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded"
                                data-id="<?= $row['id'] ?>"
                                data-nama="<?= $row['nama'] ?>">
                                Arsip
                            </button>
                            <button class="hapus-btn bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded" data-id="<?= $row['id'] ?>">Hapus</button>



                            <button class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded simpan-btn hidden" data-id="<?= $row['id'] ?>">Simpan</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>


        <?php if (!empty($pager)) : ?>
            <div class="mt-4 flex justify-center">
                <nav class="pagination flex space-x-2">
                    <?= $pager->links('default', 'pagination_custom') ?>
                </nav>
            </div>
        <?php endif; ?>

    </div>
</div>


<!-- Modal Arsip Lansia -->
<div id="modalArsipLansia" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Arsipkan Data Lansia</h2>
        <p id="infoArsipLansia" class="mb-4"></p>

        <label class="block mb-2 font-semibold">Kategori Arsip</label>
        <select id="kategoriArsipLansia" class="border p-2 w-full">
            <option value="Pindah">Pindah</option>
            <option value="Meninggal">Meninggal</option>
            <option value="Lainnya">Lainnya</option>
        </select>

        <div class="flex justify-end mt-4">
            <button id="closeModalLansia" class="bg-gray-500 hover:bg-gray-700  text-white px-3 py-1 rounded mr-2">Batal</button>
            <button id="confirmArsipLansia" class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded">Arsipkan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Arsip -->
<div id="modalSuksesLansia" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600">✅ Sukses!</h2>
        <p id="suksesMessageLansia" class="text-gray-700"> Data berhasil diarsipkan.</p>
        <button id="closeSuksesLansia" class="bg-green-500 text-white px-4 py-2 rounded mt-4">OK</button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapusLansia" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-4">Apakah kamu yakin ingin menghapus data ini?</p>
        <div class="flex justify-end gap-2">
            <button id="batalHapusLansia" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Batal</button>
            <button id="confirmHapusLansia" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
        </div>
    </div>
</div>


<!-- Modal Sukses Hapus -->
<div id="modalSuksesHapusLansia" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-2 text-green-600">✅ Sukses!</h2>
        <p id="suksesHapusMessageLansia" class="text-gray-700">Data berhasil dihapus.</p>
        <button id="closeSuksesHapusLansia" class="bg-green-500 text-white px-4 py-2 rounded mt-4">OK</button>
    </div>
</div>

<!-- Modal Konfirmasi Update Lansia -->
<div id="modalKonfirmasiUpdateLansia" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-md text-center">
        <p class="text-lg font-semibold text-gray-800">Apakah Anda yakin ingin menyimpan perubahan?</p>
        <div class="mt-4 flex justify-center gap-3">
            <button id="batalUpdateLansia" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
            <button id="konfirmasiUpdateLansia" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Update Lansia -->
<div id="modalSuksesUpdateLansia" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-md text-center">
        <h2 class="text-lg font-semibold text-green-700 mb-2">✅ Sukses !</h2>
        <p class="mb-4 text-gray-700">Data lansia berhasil diperbarui.</p>
        <button id="closeModalSuksesUpdateLansia" class="bg-green-600 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>





<script>
    let idToArsip = null;

    document.querySelectorAll('.arsip-btn').forEach(button => {
        button.addEventListener('click', function() {
            idToArsip = this.dataset.id;
            const nama = this.dataset.nama;

            // Tampilkan nama di modal
            document.getElementById('infoArsipLansia').textContent = `Apakah kamu yakin ingin mengarsipkan data atas nama ${nama}?`;

            // Tampilkan modal arsip
            document.getElementById('modalArsipLansia').classList.remove('hidden');
        });
    });

    // Batal arsip
    document.getElementById('closeModalLansia').addEventListener('click', function() {
        document.getElementById('modalArsipLansia').classList.add('hidden');
        idToArsip = null;
    });

    // Konfirmasi arsip
    document.getElementById('confirmArsipLansia').addEventListener('click', function() {
        const kategori = document.getElementById('kategoriArsipLansia').value;

        if (idToArsip && kategori) {
            fetch(`<?= base_url('/admin/lansia/arsipkan/') ?>${idToArsip}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        kategori
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Tutup modal arsip
                    document.getElementById('modalArsipLansia').classList.add('hidden');

                    // Tampilkan modal sukses
                    document.getElementById('suksesHapusMessageLansia').textContent = data.message || 'Data berhasil diarsipkan.';
                    document.getElementById('modalSuksesHapusLansia').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengarsipkan data.');
                });
        }
    });

    // Tombol OK modal sukses
    document.getElementById('closeSuksesHapusLansia').addEventListener('click', function() {
        document.getElementById('modalSuksesHapusLansia').classList.add('hidden');
        location.reload();
    });
</script>



<script>
    let dataLansiaUpdate = {}; // disimpan global supaya bisa diakses saat konfirmasi

    document.querySelectorAll('.edit').forEach(cell => {
        cell.addEventListener('focus', function() {
            this.dataset.oldValue = this.innerText.trim();
        });

        cell.addEventListener('input', function() {
            const row = this.closest('tr');
            const saveBtn = row.querySelector('.simpan-btn');

            if (this.innerText.trim() !== this.dataset.oldValue) {
                saveBtn.classList.remove('hidden');
            } else {
                saveBtn.classList.add('hidden');
            }
        });

        cell.addEventListener('blur', function() {
            const row = this.closest('tr');
            const saveBtn = row.querySelector('.simpan-btn');
            if (this.innerText.trim() === this.dataset.oldValue) {
                saveBtn.classList.add('hidden');
            }
        });
    });

    document.querySelectorAll('.simpan-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const id = this.dataset.id;

            // Simpan ke variable global untuk dikonfirmasi
            dataLansiaUpdate = {
                id,
                nik: row.querySelector('[data-field="nik"]').innerText.trim(),
                nama: row.querySelector('[data-field="nama"]').innerText.trim(),
                alamat: row.querySelector('[data-field="alamat"]').innerText.trim(),
                usia: row.querySelector('[data-field="usia"]').innerText.trim(),
                jenis_kelamin: row.querySelector('[data-field="jenis_kelamin"]').innerText.trim()
            };

            // Tampilkan modal konfirmasi
            document.getElementById('modalKonfirmasiUpdateLansia').classList.remove('hidden');
        });
    });

    // Modal konfirmasi batal
    document.getElementById('batalUpdateLansia').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiUpdateLansia').classList.add('hidden');
    });

    // Modal konfirmasi simpan
    document.getElementById('konfirmasiUpdateLansia').addEventListener('click', function() {
        fetch('<?= base_url("/admin/lansia/update") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dataLansiaUpdate)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalKonfirmasiUpdateLansia').classList.add('hidden');

                if (data.status === 'error') {
                    alert(data.message);
                } else {
                    document.getElementById('modalSuksesUpdateLansia').classList.remove('hidden');
                    // Sembunyikan tombol simpan
                    const row = document.querySelector(`.simpan-btn[data-id="${dataLansiaUpdate.id}"]`).closest('tr');
                    row.querySelector('.simpan-btn').classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data.');
            });
    });

    // Modal sukses OK
    document.getElementById('closeModalSuksesUpdateLansia').addEventListener('click', function() {
        document.getElementById('modalSuksesUpdateLansia').classList.add('hidden');
        location.reload();
    });
</script>



<script>
    let idToDelete = null;

    document.querySelectorAll('.hapus-btn').forEach(button => {
        button.addEventListener('click', function() {
            idToDelete = this.dataset.id;
            document.getElementById('modalHapusLansia').classList.remove('hidden');
        });
    });

    document.getElementById('batalHapusLansia').addEventListener('click', function() {
        document.getElementById('modalHapusLansia').classList.add('hidden');
        idToDelete = null;
    });

    document.getElementById('confirmHapusLansia').addEventListener('click', function() {
        if (idToDelete) {
            fetch(`<?= base_url('/admin/lansia/hapus/') ?>${idToDelete}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    // Tutup modal konfirmasi
                    document.getElementById('modalHapusLansia').classList.add('hidden');

                    // Tampilkan modal sukses
                    document.getElementById('suksesHapusMessageLansia').textContent = data.message || 'Data berhasil dihapus.';
                    document.getElementById('modalSuksesHapusLansia').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus data.');
                });
        }
    });

    // Tombol OK di modal sukses
    document.getElementById('closeSuksesHapusLansia').addEventListener('click', function() {
        document.getElementById('modalSuksesHapusLansia').classList.add('hidden');
        location.reload(); // reload setelah klik OK
    });
</script>





<?= $this->endSection() ?>