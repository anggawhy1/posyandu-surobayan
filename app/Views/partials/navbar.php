<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-primary font-bold text-xl flex items-center">
            <img src="images/logoo.png" alt="Logo" class="h-8 mr-2">
            Posyandu Nusa Indah
        </a>

        <!-- MENU NAVBAR (Tampil di Desktop) -->
        <ul class="hidden md:flex space-x-6">
            <li><a href="<?= base_url('/') ?>" class="text-primary font-semibold hover:text-green-600 transition">Beranda</a></li>
            <li><a href="dokumentasi" class="text-primary font-semibold hover:text-green-600 transition">Dokumentasi</a></li>
            <li><a href="jadwal" class="text-primary font-semibold hover:text-green-600 transition">Jadwal</a></li>
            <!-- DROPDOWN INPUT DATA -->
            <li class="relative group">
                <a href="#" class="text-primary font-semibold hover:text-green-600 transition">Input Data</a>
                <ul class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-lg opacity-0 scale-y-0 transform transition duration-300 ease-in-out group-hover:opacity-100 group-hover:scale-y-100 origin-top z-50">
                    <li><a href="data-balita" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Data Balita</a></li>
                    <!-- <li><a href="data-lansia" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Data Lansia</a></li> -->
                    <li><a href="data-remaja" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Data Remaja Putri</a></li>
                    <li><a href="data-ibu-hamil" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Data Ibu Hamil</a></li>
                    <!-- <li><a href="data-usia-produktif" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Data Usia Produktif</a></li> -->
                </ul>
            </li>

            <li><a href="kontak" class="text-primary font-semibold hover:text-green-600 transition">Hubungi Kami</a></li>
            <li><a href="login" class="text-primary font-semibold hover:text-green-600 transition">Masuk</a></li>
        </ul>

        <!-- TOMBOL HAMBURGER (Muncul di HP) -->
        <button id="menuToggle" class="md:hidden text-primary focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- MENU MOBILE (Slide dari kanan) -->
    <div id="navMenu" class="fixed top-0 right-[-100%] w-64 h-full bg-white shadow-lg transition-transform duration-300 ease-in-out md:hidden">
        <!-- Tombol Close -->
        <button id="closeMenu" class="absolute top-4 right-4 text-blue-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Daftar Menu -->
        <ul class="mt-16 text-lg">
            <li><a href="<?= base_url('/') ?>" class="block py-3 px-6 font-semibold text-black hover:bg-gray-100">Home</a></li>
            <li><a href="dokumentasi" class="block py-3 px-6 font-semibold text-black hover:bg-gray-100">Dokumentasi</a></li>
            <li><a href="jadwal" class="block py-3 px-6 font-semibold text-black hover:bg-gray-100">Jadwal</a></li>
            <!-- DROPDOWN MENU MOBILE -->
            <li>
                <button id="dropdownToggle" class="w-full text-left py-3 px-6 font-semibold text-black hover:bg-gray-100 flex justify-between items-center">
                    Input Data
                    <svg class="w-5 h-5 transition-transform" id="dropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul id="dropdownMenu" class="hidden bg-gray-100">
                    <li><a href="data-balita" class="block py-3 px-6 text-gray-700 hover:bg-gray-200">Data Balita</a></li>
                    <!-- <li><a href="data-lansia" class="block py-3 px-6 text-gray-700 hover:bg-gray-200">Data Lansia</a></li> -->
                    <li><a href="data-remaja" class="block py-3 px-6 text-gray-700 hover:bg-gray-200">Data Remaja Putri</a></li>
                    <li><a href="data-ibu-hamil" class="block py-3 px-6 text-gray-700 hover:bg-gray-200">Data Ibu Hamil</a></li>
                    <!-- <li><a href="data-usia-produktif" class="block py-3 px-6 text-gray-700 hover:bg-gray-200">Data Usia Produktif</a></li> -->
                </ul>
            </li>

            <li><a href="kontak" class="block py-3 px-6 font-semibold text-black hover:bg-gray-100">Hubungi Kami</a></li>

            <li><a href="login" class="block py-3 px-6 font-semibold text-black hover:bg-gray-100">Login</a></li>
        </ul>
    </div>
</nav>

<!-- SCRIPT UNTUK MENU -->
<script>
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    const closeMenu = document.getElementById('closeMenu');
    const dropdownToggle = document.getElementById('dropdownToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownIcon = document.getElementById('dropdownIcon');

    // Hamburger menu
    menuToggle.addEventListener('click', () => {
        navMenu.style.right = "0";
    });

    closeMenu.addEventListener('click', () => {
        navMenu.style.right = "-100%";
    });

    // Dropdown menu di HP
    dropdownToggle.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
        dropdownIcon.classList.toggle('rotate-180');
    });
</script>
