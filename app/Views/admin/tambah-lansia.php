<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Data Lansia</h2>

    <form id="lansiaForm" onsubmit="return false;">
        <label>NIK</label>
        <input type="text" name="nik" id="nik" class="border p-2 w-full" required>

        <label>Nama</label>
        <input type="text" name="nama" id="nama" class="border p-2 w-full" required>

        <label>Alamat</label>
        <select name="alamat" id="alamat" class="border p-2 w-full">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
                <option value="Surobayan RT <?= sprintf('%02d', $i) ?>">Surobayan RT <?= sprintf('%02d', $i) ?></option>
            <?php endfor; ?>
        </select>

        <label>Usia</label>
        <input type="number" name="usia" id="usia" class="border p-2 w-full" required>

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="border p-2 w-full">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <button type="button" onclick="showModalKonfirmasi()" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mt-4">Simpan</button>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div id="modalKonfirmasiTambah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md text-center">
        <p class="text-lg font-semibold text-gray-800">Apakah Anda yakin ingin menyimpan data ini?</p>
        <div class="mt-4 flex justify-center gap-3">
            <button onclick="tutupModalKonfirmasi()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            <button onclick="submitLansia()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="modalSuksesTambah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md text-center">
        <h2 class="text-lg font-semibold text-green-700 mb-2"> ✅ Berhasil!</h2>
        <p class="mb-4 text-gray-700">Data lansia berhasil ditambahkan.</p>
        <button onclick="tutupModalSukses()" class="bg-green-600 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<!-- Modal Gagal -->
<div id="modalGagalTambah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md text-center">
        <h2 class="text-lg font-semibold text-red-600 mb-2">Gagal!</h2>
        <p class="mb-4 text-gray-700" id="pesanGagal">NIK sudah terdaftar. Silakan cek kembali.</p>
        <button onclick="tutupModalGagal()" class="bg-red-600 text-white px-4 py-2 rounded">OK</button>
    </div>
</div>

<script>
    function showModalKonfirmasi() {
        document.getElementById('modalKonfirmasiTambah').classList.remove('hidden');
    }

    function tutupModalKonfirmasi() {
        document.getElementById('modalKonfirmasiTambah').classList.add('hidden');
    }

    function tutupModalSukses() {
        document.getElementById('modalSuksesTambah').classList.add('hidden');
        window.location.href = "<?= base_url('/admin/data-lansia') ?>"; // balik ke daftar lansia
    }

    function tutupModalGagal() {
        document.getElementById('modalGagalTambah').classList.add('hidden');
    }

    function submitLansia() {
        const nik = document.getElementById('nik').value.trim();
        const nama = document.getElementById('nama').value.trim();
        const alamat = document.getElementById('alamat').value;
        const usia = document.getElementById('usia').value.trim();
        const jenis_kelamin = document.getElementById('jenis_kelamin').value;

        fetch('<?= base_url("/admin/lansia/simpan") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nik, nama, alamat, usia, jenis_kelamin })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalKonfirmasiTambah').classList.add('hidden');

            if (data.status === 'error') {
                document.getElementById('pesanGagal').innerText = data.message || "NIK sudah digunakan.";
                document.getElementById('modalGagalTambah').classList.remove('hidden');
            } else {
                document.getElementById('modalSuksesTambah').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Gagal simpan:', error);
            alert('Terjadi kesalahan saat mengirim data.');
        });
    }
</script>


<?= $this->endSection() ?>
