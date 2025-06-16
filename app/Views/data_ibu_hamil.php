<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-6">
    <nav class="text-gray-700 text-sm mb-4">
        <a href="<?= base_url('/') ?>" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">
            Beranda
        </a> 
        / Data Ibu Hamil
    </nav>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Form Data Ibu Hamil</h2>
        <form action="<?= base_url('/data-ibu-hamil/store') ?>" method="post" onsubmit="return submitForm(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- NIK Ibu Hamil -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">NIK Ibu Hamil <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="w-full border border-gray-300 rounded-lg p-2" required pattern="\d{16}">
                </div>

                <!-- Nama Ibu Hamil -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Nama Ibu Hamil <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_ibu_hamil" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- NIK Suami -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">NIK Suami</label>
                    <input type="text" name="nik_suami" class="w-full border border-gray-300 rounded-lg p-2" pattern="\d{16}">
                </div>

                <!-- Nama Suami -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Nama Suami</label>
                    <input type="text" name="nama_suami" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Pekerjaan Ibu Hamil -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Pekerjaan Ibu Hamil</label>
                    <input type="text" name="pekerjaan_ibu_hamil" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Pekerjaan Suami -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Pekerjaan Suami</label>
                    <input type="text" name="pekerjaan_suami" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Tanggal Mulai Hamil -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Tanggal Mulai Hamil <span class="text-red-500">*</span></label>
                    <input type="date" name="tgl_mulai_hamil" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- Perkiraan Tanggal Lahir -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Perkiraan Tanggal Lahir</label>
                    <input type="date" name="tgl_perkiraan_lahir" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Usia Kehamilan -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Usia Kehamilan (minggu)</label>
                    <input type="number" name="usia_kehamilan" class="w-full border border-gray-300 rounded-lg p-2" min="0">
                </div>

                <!-- Golongan Darah Ibu Hamil -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Golongan Darah Ibu Hamil <span class="text-red-500">*</span></label>
                    <select name="golDarah_ibu_hamil" class="w-full border border-gray-300 rounded-lg p-2" required>
                        <option value="">Pilih Golongan Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <!-- Golongan Darah Suami -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Golongan Darah Suami</label>
                    <select name="golDarah_suami" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="">Pilih Golongan Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <!-- Kadar HB -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Kadar HB (g/dL)</label>
                    <input type="number" step="0.1" name="kadar_hb" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Berat Badan Sebelum Hamil -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Berat Badan Sebelum Hamil (kg)</label>
                    <input type="number" step="0.1" name="bb_sebelum_hamil" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Nomor Telepon -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Nomor Telepon</label>
                    <input type="text" name="no_telepon" class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Alamat -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Alamat <span class="text-red-500">*</span></label>
                    <select name="alamat" class="w-full border border-gray-300 rounded-lg p-2" required>
                        <option value="">Pilih Alamat</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="SUROBAYAN RT <?= sprintf('%02d', $i) ?>">SUROBAYAN RT <?= sprintf('%02d', $i) ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

            </div>

            <div class="flex justify-end mt-8">
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
