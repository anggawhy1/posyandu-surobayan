<?= $this->extend('layout/main2') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Data Balita</h2>

    <form id="balitaForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label>NIK Anak</label>
            <input type="text" name="nik_anak" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Nama Anak</label>
            <input type="text" name="nama_anak" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="border p-2 w-full" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div>
            <label>Berat Badan Lahir (kg)</label>
            <input type="number" step="0.01" name="berat_badan_lahir" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Panjang Badan Lahir (cm)</label>
            <input type="number" step="0.1" name="panjang_badan_lahir" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Lingkar Kepala Lahir (cm)</label>
            <input type="number" step="0.1" name="lingkar_kepala_lahir" class="border p-2 w-full" required>
        </div>

        <div>
            <label>Kelahiran</label>
            <select name="premature_mature" class="border p-2 w-full">
                <option value="">Pilih</option>
                <option value="Premature">Premature</option>
                <option value="Mature">Mature</option>
            </select>
        </div>

        <div>
            <label>No. KK</label>
            <input type="text" name="no_kk" class="border p-2 w-full" required>
        </div>

        <div>
            <label>NIK Ibu</label>
            <input type="text" name="nik_ibu" class="border p-2 w-full">
        </div>

        <div>
            <label>Nama Ibu</label>
            <input type="text" name="nama_ibu" class="border p-2 w-full">
        </div>

        <div>
            <label>NIK Ayah</label>
            <input type="text" name="nik_ayah" class="border p-2 w-full">
        </div>

        <div>
            <label>Nama Ayah</label>
            <input type="text" name="nama_ayah" class="border p-2 w-full">
        </div>
    </form>

    <div class="mt-4">
        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded" id="btnSimpan">Simpan</button>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="modalKonfirmasi" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg">
        <p class="text-lg font-semibold">Apakah Anda yakin ingin menyimpan data ini?</p>
        <div class="mt-4 flex justify-end">
            <button id="batal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
            <button id="konfirmasi" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="modalSukses" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg text-center">
        <p class="text-lg font-semibold text-green-600"> ✅ Data berhasil disimpan!</p>
        <button id="tutupModal" class="mt-4 bg-green-600 text-white px-4 py-2 rounded">Tutup</button>
    </div>
</div>

<!-- Modal Gagal -->
<div id="modalGagal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg text-center">
        <p class="text-lg font-semibold text-red-600">NIK sudah ada, tidak bisa disimpan!</p>
        <button id="tutupGagal" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Tutup</button>
    </div>
</div>

<script>
    const form = document.getElementById("balitaForm");
    const btnSimpan = document.getElementById("btnSimpan");
    const modalKonfirmasi = document.getElementById("modalKonfirmasi");
    const modalSukses = document.getElementById("modalSukses");
    const modalGagal = document.getElementById("modalGagal");

    btnSimpan.addEventListener("click", () => {
        modalKonfirmasi.classList.remove("hidden");
    });

    document.getElementById("batal").onclick = () => modalKonfirmasi.classList.add("hidden");

    document.getElementById("konfirmasi").onclick = () => {
        modalKonfirmasi.classList.add("hidden");
        const formData = new FormData(form);

        fetch("<?= base_url('/admin/databalita/simpan') ?>", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.status === "error") {
                modalGagal.classList.remove("hidden");
            } else {
                modalSukses.classList.remove("hidden");
                form.reset();
            }
        });
    };

    document.getElementById("tutupModal").onclick = () => location.href = "<?= base_url('/admin/data-balita') ?>";
    document.getElementById("tutupGagal").onclick = () => modalGagal.classList.add("hidden");
</script>

<?= $this->endSection() ?>
