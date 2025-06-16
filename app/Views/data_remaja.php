<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-6">
    <nav class="text-gray-700 text-sm mb-4">
        <a href="<?= base_url('/') ?>" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">
            Beranda
        </a> 
        / Data Remaja Putri
    </nav>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Form Data Remaja Putri</h2>
        <form action="<?= base_url('/data-remaja/store') ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6" onsubmit="return submitForm(event)">
            
            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" class="border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" class="border border-gray-300 rounded-lg p-2 mt-1" required pattern="\d{16}">
            </div>

            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" class="border border-gray-300 rounded-lg p-2 mt-1" required>
            </div>

            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Golongan Darah <span class="text-red-500">*</span></label>
                <select name="golongan_darah" class="border border-gray-300 rounded-lg p-2 mt-1" required>
                    <option value="">Pilih Golongan Darah</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Kadar HB (g/dL) (Opsional)</label>
                <input type="number" step="0.1" name="kadar_hb" class="border border-gray-300 rounded-lg p-2 mt-1">
            </div>

            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Alamat <span class="text-red-500">*</span></label>
                <select name="alamat" class="border border-gray-300 rounded-lg p-2 mt-1" required>
                    <option value="">Pilih Alamat</option>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="SUROBAYAN RT <?= sprintf('%02d', $i) ?>">SUROBAYAN RT <?= sprintf('%02d', $i) ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Nomor Telepon (Opsional)</label>
                <input type="text" name="nomor_telepon" class="border border-gray-300 rounded-lg p-2 mt-1">
            </div>

            <div class="col-span-1 md:col-span-2 flex justify-end mt-4">
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
        let formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("successModal").classList.remove("hidden");
                setTimeout(() => { 
                    closeModal();
                    window.location.reload();
                }, 2000);
            }
        }).catch(error => {
            console.error("Error:", error);
            alert("Gagal menyimpan data. Silakan coba lagi.");
        });
    }

    function closeModal() {
        document.getElementById("successModal").classList.add("hidden");
    }
</script>
<?= $this->endSection() ?>
