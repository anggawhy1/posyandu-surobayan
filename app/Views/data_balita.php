<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-6">
    <!-- Breadcrumb -->
    <nav class="text-gray-700 text-sm mb-4">
        <a href="<?= base_url('/') ?>" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">
            Beranda
        </a> 
        / Data Balita
    </nav>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Form Data Balita</h2>
        <form action="<?= base_url('/data-balita/store') ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6" onsubmit="submitForm(event)">

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">NIK Anak <span class="text-red-500">*</span></label>
                <input type="text" name="nik_anak" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Nama Anak <span class="text-red-500">*</span></label>
                <input type="text" name="nama_anak" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tgl_lahir" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Berat Badan Lahir (kg) <span class="text-red-500">*</span></label>
                <input type="number" step="0.1" name="berat_badan_lahir" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Panjang Badan Lahir (cm) <span class="text-red-500">*</span></label>
                <input type="number" step="0.1" name="panjang_badan_lahir" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Lingkar Kepala Lahir (cm) <span class="text-red-500">*</span></label>
                <input type="number" step="0.1" name="lingkar_kepala_lahir" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Premature / Mature <span class="text-red-500">*</span></label>
                <select class="w-full border border-gray-300 rounded-lg p-2 mt-1" name="premature_mature" required>
                    <option value="">Pilih Status</option>
                    <option value="Premature">Premature</option>
                    <option value="Mature">Mature</option>
                </select>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">No KK <span class="text-red-500">*</span></label>
                <input type="text" name="no_kk" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">NIK Ibu <span class="text-red-500">*</span></label>
                <input type="text" name="nik_ibu" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Nama Ibu <span class="text-red-500">*</span></label>
                <input type="text" name="nama_ibu" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">NIK Ayah <span class="text-red-500">*</span></label>
                <input type="text" name="nik_ayah" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="col-span-1">
                <label class="block text-gray-700 font-medium">Nama Ayah <span class="text-red-500">*</span></label>
                <input type="text" name="nama_ayah" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Sukses -->
<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Data Berhasil Disimpan!</h2>
        <p class="text-gray-600">Terima kasih telah menginputkan data.</p>
        <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-600 transition">
            OK
        </button>
    </div>
</div>

<script>
    function submitForm(event) {
        event.preventDefault();
        let form = event.target;

        fetch(form.action, {
            method: form.method,
            body: new FormData(form)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("successModal").classList.remove("hidden");
                setTimeout(() => { 
                    closeModal();
                    window.location.reload();
                }, 2000);
            }
        });
    }

    function closeModal() {
        document.getElementById("successModal").classList.add("hidden");
    }
</script>

<?= $this->endSection() ?>
