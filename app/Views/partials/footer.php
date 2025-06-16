<footer class="bg-gray-900 text-white py-10">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-12">
        <!-- Logo & Deskripsi -->
        <div class="md:ml-6">
            <a href="/" class="text-white font-bold text-2xl flex items-center">
                <img src="images/logoo.png" alt="Logo" class="h-10 mr-2">
                Posyandu Nusa Indah
            </a>
            <p class="text-gray-400 mt-3">
                Posyandu Nusa Indah berkomitmen memberikan layanan kesehatan terbaik bagi masyarakat.
            </p>
        </div>

        <!-- Navigasi Cepat -->
        <div class="md:ml-6">
            <h3 class="text-lg font-semibold">Navigasi</h3>
            <ul class="mt-4 space-y-2">
                <li><a href="beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                <li><a href="dokumentasi" class="text-gray-400 hover:text-white transition">Dokumentasi</a></li>
                <li><a href="beranda" class="text-gray-400 hover:text-white transition">Input Data</a></li>
                <li><a href="jadwal" class="text-gray-400 hover:text-white transition">Jadwal</a></li>
                <li><a href="kontak" class="text-gray-400 hover:text-white transition">Hubungi Kami</a></li>
            </ul>
        </div>

        <!-- Kontak -->
        <div class="md:ml-6">
            <h3 class="text-lg font-semibold">Hubungi Kami</h3>
            <p class="text-gray-400 mt-4">
                <i class="fas fa-map-marker-alt mr-2"></i> Pedukuhan Surobayan, Argomulyo
            </p>
            <p class="text-gray-400 mt-2">
                <i class="fas fa-envelope mr-2"></i> posyandusurobayan@gmail.com
            </p>
            <p class="text-gray-400 mt-2">
                <i class="fas fa-phone mr-2"></i> +62 858-0604-2201
            </p>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center mt-10 text-gray-500 border-t border-gray-700 pt-6">
        &copy; 2025 Posyandu Nusa Indah. Semua Hak Dilindungi.
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const homeLink = document.getElementById("home-link");

        homeLink.addEventListener("click", function(event) {
            if (window.location.pathname === "/") {
                event.preventDefault(); // Mencegah reload
                window.scrollTo({ top: 0, behavior: "smooth" }); // Scroll ke atas
            }
        });
    });
</script>

</footer>
