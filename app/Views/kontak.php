<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-6 py-6">
    
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-600 mb-4">
        <a href="<?= base_url('/') ?>" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">
            Beranda
        </a>
        <span class="mx-2">/</span>
        <span class="text-gray-500">Hubungi Kami</span>
    </nav>

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Hubungi Kami</h1>
        <p class="text-lg text-gray-600">Tetap terhubung dengan kami dan sampaikan keluhan Anda</p>
    </div>

    <div class="flex flex-wrap md:flex-nowrap items-center justify-between">
        
        <!-- Form Kontak -->
        <div class="w-full md:w-1/2 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-pink-600 text-center">Kirim Pesan</h2>
            <p class="text-center text-gray-600 text-sm mb-4">Tentang keluhan Anda</p>

            <form id="contactForm" onsubmit="submitForm(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" placeholder="Tuliskan nama lengkap"
                        class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" placeholder="Tuliskan email Anda"
                        class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold">No Telepon <span class="text-red-500">*</span></label>
                    <input type="text" id="telepon" placeholder="Tuliskan no telepon Anda"
                        class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold">Pesan <span class="text-red-500">*</span></label>
                    <textarea id="pesan" placeholder="Tuliskan pesan Anda"
                        class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition h-32"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-green-400 text-white py-2 rounded-lg shadow-md hover:opacity-90 transition">
                    Kirim Pesan
                </button>
            </form>
        </div>

        <!-- Bagian Ilustrasi -->
        <div class="hidden md:block w-1/2 pl-8">
            <img src="/images/kontak.png" alt="Ilustrasi Posyandu" class="w-full">
        </div>

    </div>
</div>

<!-- Modal Sukses -->
<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Pesan Berhasil Dikirim!</h2>
        <p class="text-gray-600"> Kami akan menghubungi Anda untuk informasi lebih lanjut.</p>
        <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-600 transition">
            OK
        </button>
    </div>
</div>

<script>
    function submitForm(event) {
        event.preventDefault();

        let nama = document.getElementById("nama").value.trim();
        let email = document.getElementById("email").value.trim();
        let telepon = document.getElementById("telepon").value.trim();
        let pesan = document.getElementById("pesan").value.trim();

        // Validasi Formulir
        if (nama === "" || email === "" || telepon === "" || pesan === "") {
            alert("Semua kolom wajib diisi!");
            return;
        }

        // Simulasi pengiriman data
        document.getElementById("successModal").classList.remove("hidden");

        setTimeout(() => { 
            closeModal();
            window.location.reload();
        }, 2000);
    }

    function closeModal() {
        document.getElementById("successModal").classList.add("hidden");
    }
</script>

<?= $this->endSection() ?>
