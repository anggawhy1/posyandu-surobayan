<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Data Usia Produktif</h2>

    <form id="usiaProduktifForm" method="POST" action="<?= base_url('/admin/usia-produktif/simpan') ?>">
        <div class="mb-4">
            <label class="block text-gray-700">NIK</label>
            <input type="text" name="nik" id="nik" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Alamat</label>
            <select name="alamat" id="alamat" class="border p-2 w-full">
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <option value="Surobayan RT <?= sprintf('%02d', $i) ?>">Surobayan RT <?= sprintf('%02d', $i) ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Usia</label>
            <input type="number" name="usia" id="usia" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="border p-2 w-full">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <button type="button" id="btnSimpan" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div id="modalKonfirmasi" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg">
        <p class="text-lg font-semibold">Apakah Anda yakin ingin menyimpan data?</p>
        <div class="mt-4 flex justify-end space-x-2">
            <button id="batalSimpan" class="px-4 py-2 bg-gray-400 rounded">Batal</button>
            <button id="konfirmasiSimpan" class="px-4 py-2 bg-blue-500 text-white rounded">Ya, Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="modalSukses" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg">
        <p class="text-lg font-semibold">Data berhasil disimpan!</p>
        <div class="mt-4 flex justify-end">
            <button id="tutupSukses" class="px-4 py-2 bg-green-500 text-white rounded">OK</button>
        </div>
    </div>
</div>

<!-- Modal Peringatan -->
<div id="modalPeringatan" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg">
        <p class="text-lg font-semibold text-red-500">NIK sudah terdaftar!</p>
        <div class="mt-4 flex justify-end">
            <button id="tutupPeringatan" class="px-4 py-2 bg-red-500 text-white rounded">OK</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnSimpan = document.getElementById('btnSimpan');
    const modalKonfirmasi = document.getElementById('modalKonfirmasi');
    const modalSukses = document.getElementById('modalSukses');
    const modalPeringatan = document.getElementById('modalPeringatan');

    // Tombol Simpan
    btnSimpan.addEventListener('click', function () {
        modalKonfirmasi.classList.remove('hidden');
    });

    // Batal Simpan
    document.getElementById('batalSimpan').addEventListener('click', function () {
        modalKonfirmasi.classList.add('hidden');
    });

    // Konfirmasi Simpan
    document.getElementById('konfirmasiSimpan').addEventListener('click', function () {
        modalKonfirmasi.classList.add('hidden');

        let formData = new FormData(document.getElementById('usiaProduktifForm'));

        fetch("<?= base_url('/admin/usia-produktif/simpan') ?>", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                modalSukses.classList.remove('hidden');
            } else if (data.status === "error") {
                modalPeringatan.classList.remove('hidden');
            }
        });
    });

    // Tutup Modal Sukses
    document.getElementById('tutupSukses').addEventListener('click', function () {
        modalSukses.classList.add('hidden');
        window.location.href = "<?= base_url('/admin/data-usia-produktif') ?>";
    });

    // Tutup Modal Peringatan
    document.getElementById('tutupPeringatan').addEventListener('click', function () {
        modalPeringatan.classList.add('hidden');
    });
});
</script>

<?= $this->endSection() ?>
