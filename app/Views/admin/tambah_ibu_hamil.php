<?= $this->extend('layout/main2') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Data Ibu Hamil</h2>

    <!-- Modal Popup -->
    <?php if (isset($success) && $success) : ?>
        <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg">
                <h3 class="text-lg font-semibold mb-2">Sukses</h3>
                <p>Data berhasil ditambahkan!</p>
                <div class="mt-4 flex justify-end">
                    <a href="<?= base_url('admin/data-ibu-hamil') ?>" class="bg-green-500 text-white px-4 py-2 rounded">OK</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($duplikat) && $duplikat) : ?>
        <div id="duplicateModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full text-center">
                <h3 class="text-lg font-semibold text-red-600 mb-2">NIK sudah terdaftar!</h3>
                <p class="text-gray-700 mb-4">Silakan gunakan NIK lain atau cek kembali data yang sudah ada.</p>
                <button onclick="document.getElementById('duplicateModal').classList.add('hidden')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('simpan-ibu-hamil') ?>" method="post" class="bg-white p-6 rounded shadow-lg">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>NIK Ibu</label>
                <input type="text" name="nik" class="border p-2 w-full" value="<?= esc($old['nik'] ?? '') ?>">
            </div>
            <div>
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu_hamil" class="border p-2 w-full" value="<?= esc($old['nama_ibu_hamil'] ?? '') ?>">
            </div>
            <div>
                <label>NIK Suami</label>
                <input type="text" name="nik_suami" class="border p-2 w-full" value="<?= esc($old['nik_suami'] ?? '') ?>">
            </div>
            <div>
                <label>Nama Suami</label>
                <input type="text" name="nama_suami" class="border p-2 w-full" value="<?= esc($old['nama_suami'] ?? '') ?>">
            </div>
            <div>
                <label>Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu_hamil" class="border p-2 w-full" value="<?= esc($old['pekerjaan_ibu_hamil'] ?? '') ?>">
            </div>
            <div>
                <label>Pekerjaan Suami</label>
                <input type="text" name="pekerjaan_suami" class="border p-2 w-full" value="<?= esc($old['pekerjaan_suami'] ?? '') ?>">
            </div>
            <div>
                <label>Tgl Mulai Hamil</label>
                <input type="date" name="tgl_mulai_hamil" class="border p-2 w-full" value="<?= esc($old['tgl_mulai_hamil'] ?? '') ?>">
            </div>
            <div>
                <label>Tgl Perkiraan Lahir</label>
                <input type="date" name="tgl_perkiraan_lahir" class="border p-2 w-full" value="<?= esc($old['tgl_perkiraan_lahir'] ?? '') ?>">
            </div>
            <div>
                <label>Usia Kehamilan</label>
                <input type="text" name="usia_kehamilan" class="border p-2 w-full" value="<?= esc($old['usia_kehamilan'] ?? '') ?>">
            </div>
            <div>
                <label>Gol. Darah Ibu</label>
                <input type="text" name="golDarah_ibu_hamil" class="border p-2 w-full" value="<?= esc($old['golDarah_ibu_hamil'] ?? '') ?>">
            </div>
            <div>
                <label>Gol. Darah Suami</label>
                <input type="text" name="golDarah_suami" class="border p-2 w-full" value="<?= esc($old['golDarah_suami'] ?? '') ?>">
            </div>
            <div>
                <label>Kadar HB</label>
                <input type="text" name="kadar_hb" class="border p-2 w-full" value="<?= esc($old['kadar_hb'] ?? '') ?>">
            </div>
            <div>
                <label>BB Sebelum Hamil</label>
                <input type="text" name="bb_sebelum_hamil" class="border p-2 w-full" value="<?= esc($old['bb_sebelum_hamil'] ?? '') ?>">
            </div>
            <div>
                <label>No Telepon</label>
                <input type="text" name="no_telepon" class="border p-2 w-full" value="<?= esc($old['no_telepon'] ?? '') ?>">
            </div>
            <div class="col-span-2">
                <label>Alamat</label>
                <textarea name="alamat" class="border p-2 w-full"><?= esc($old['alamat'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <a href="<?= base_url('admin/data-ibu-hamil') ?>" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded mr-2">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
