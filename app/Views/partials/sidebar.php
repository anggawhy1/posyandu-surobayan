<!-- Font Awesome --> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Tombol Hamburger -->
<button id="toggleSidebar" class="fixed top-4 left-4 z-50 text-white bg-gray-900 p-2 rounded-md md:hidden">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="w-64 min-h-screen bg-gray-900 text-white flex flex-col fixed transition-transform transform md:translate-x-0 -translate-x-full md:static">

    <!-- Header Sidebar -->
    <div class="p-4 text-center font-bold text-lg border-b border-gray-700">
        Admin Posyandu
    </div>

    <!-- Profil Admin -->
    <div class="flex items-center p-4 border-b border-gray-700">
        <?php
        $username = session()->get('nama');
        $firstLetter = strtoupper(substr($username, 0, 1));
        ?>
        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center mr-3">
            <?= $firstLetter ?>
        </div>
        <span><?= $username ?></span>
    </div>

    <!-- Navigasi Sidebar -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
            </li>

            <!-- Dropdown Kelola Data -->
            <li>
                <button onclick="toggleDropdown('kelolaData')" class="w-full flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-layer-group mr-3"></i> Kelola Data
                    <i id="icon-kelolaData" class="fas fa-chevron-down ml-auto transition-transform duration-300"></i>
                </button>
                <ul id="dropdown-kelolaData" class="hidden pl-6 space-y-2">
                    <li>
                        <a href="<?= base_url('admin/data-balita') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-baby text-blue-400 mr-3"></i> Data Balita
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/pemantauan-balita') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-notes-medical text-blue-400 mr-3"></i> Pemantauan Balita
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/data-ibu-hamil') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-user-nurse text-green-400 mr-3"></i> Data Ibu Hamil
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/data-remaja-putri') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-user-friends text-purple-400 mr-3"></i> Data Remaja Putri
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/data-lansia') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-blind text-red-400 mr-3"></i> Data Lansia
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/data-usia-produktif') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-briefcase text-yellow-400 mr-3"></i> Data Usia Produktif
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/data-jumlah-hadir') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-user-check text-yellow-400 mr-3"></i> Jumlah Hadir
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Dropdown Data Arsip -->
            <li>
                <button onclick="toggleDropdown('dataArsip')" class="w-full flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-archive mr-3"></i> Data Arsip
                    <i id="icon-dataArsip" class="fas fa-chevron-down ml-auto transition-transform duration-300"></i>
                </button>
                <ul id="dropdown-dataArsip" class="hidden pl-6 space-y-2">
                    <li>
                        <a href="<?= base_url('admin/data-baru') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-plus-square text-blue-400 mr-3"></i> Data Baru
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/riwayat-data') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-clock text-green-400 mr-3"></i> Riwayat Data
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?= base_url('admin/dokumentasi') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-images mr-3"></i> Dokumentasi
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/jadwal') ?>" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-calendar-alt mr-3"></i> Jadwal
                </a>
            </li>
            <li>
                <a href="#" id="logoutButton" class="flex items-center px-4 py-2 rounded-lg hover:bg-red-600">
                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Modal Konfirmasi Logout -->
<div id="modalLogout" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4 text-black">Konfirmasi Logout</h2>
        <p class="mb-4 text-black">Apakah Anda yakin ingin keluar?</p>
        <div class="flex justify-end mt-4">
            <button id="closeModal" class="bg-gray-500 text-white px-3 py-1 rounded mr-2">Batal</button>
            <a href="<?= base_url('logout') ?>" id="confirmLogout" class="bg-red-500 text-white px-3 py-1 rounded">Keluar</a>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Toggle Sidebar Mobile
    const toggleSidebarButton = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");

    toggleSidebarButton.addEventListener("click", function() {
        sidebar.classList.toggle("-translate-x-full");
    });

    // Toggle Dropdown Menu
    function toggleDropdown(id) {
        const dropdown = document.getElementById("dropdown-" + id);
        const icon = document.getElementById("icon-" + id);
        dropdown.classList.toggle("hidden");
        icon.classList.toggle("rotate-180");
    }

    // Modal Logout
    const modal = document.getElementById("modalLogout");
    const closeModalButton = document.getElementById("closeModal");
    const logoutButton = document.getElementById("logoutButton");

    logoutButton.addEventListener("click", function(event) {
        event.preventDefault();
        modal.classList.remove("hidden");
    });

    closeModalButton.addEventListener("click", function() {
        modal.classList.add("hidden");
    });
</script>

<!-- Tambahan CSS untuk Rotate -->
<style>
    .rotate-180 {
        transform: rotate(180deg);
    }
</style>
