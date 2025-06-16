<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Input Jumlah Balita Per Bulan</h1>

    


<!-- Form untuk input jumlah balita per bulan -->
<form action="<?= base_url('/admin/jumlah-balita-per-bulan/save') ?>" method="post">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Pilih bulan -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Pilih Bulan</label>
            <select name="bulan[]" class="w-full p-2 border rounded-lg" required>
                <option value="" disabled selected>Pilih Bulan</option>
                <?php foreach ($bulan as $month): ?>
                    <option value="<?= $month ?>"><?= $month ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Input jumlah balita -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Jumlah Balita</label>
            <div class="flex items-center space-x-4">
                <input type="number" name="jumlah[]" class="w-full p-2 border rounded-lg" required>
                <!-- Tombol simpan kecil di sebelah kanan input -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 text-sm rounded">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>


    <!-- Menampilkan data jumlah balita per bulan -->
    <h2 class="mt-8 text-xl font-bold mb-4">Data Jumlah Balita Per Bulan</h2>
    <?php if (!empty($jumlahBalita)): ?>
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="table-auto w-full border-collapse bg-white text-gray-800">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="p-3 text-center border">Bulan</th>
                        <th class="p-3 text-center border">Jumlah Balita</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jumlahBalita as $item): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-3 text-center"><?= esc($item['bulan']) ?></td>
                            <td class="p-3 text-center"><?= esc($item['jumlah_balita']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-red-500">Belum ada data jumlah balita per bulan.</p>
    <?php endif; ?>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md mx-auto p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-bold text-green-600 mb-4">Berhasil!</h2>
            <p class="text-gray-700 mb-6"><?= session()->getFlashdata('success') ?></p>
            <button onclick="document.getElementById('successModal').style.display='none'" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg">
                Tutup
            </button>
        </div>
    </div>
<?php endif; ?>


<script>
    window.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('successModal');
        if (modal) {
            setTimeout(() => {
                modal.style.display = 'none';
            }, 5000); // Modal akan tertutup setelah 3 detik
        }
    });
</script>

<?= $this->endSection() ?>

