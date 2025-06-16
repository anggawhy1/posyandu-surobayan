<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="flex flex-col lg:flex-row items-center lg:justify-between px-6 lg:px-20 py-3">
    <!-- Text Section -->
    <div class="lg:w-1/2 opacity-0 transform -translate-x-10 animate-fadeInLeft">
        <h2 class="hidden lg:block text-secondary text-lg font-semibold">Posyandu Pedukuhan Surobayan</h2>
        <h1 class="text-5xl lg:text-6xl font-extrabold text-primary leading-tight mt-2">
            Selamat Datang di Website Informasi Posyandu Nusa Indah
        </h1>
        <p class="text-gray-600 text-lg mt-4">
            Website Untuk Informasi Data Posyandu
        </p>
    </div>

    <!-- Image Section -->
    <div class="lg:w-1/2 mt-8 lg:mt-0 opacity-0 transform translate-x-10 animate-fadeInRight">
        <img src="images/landing.png" alt="Ilustrasi Posyandu" class="w-full floating">
    </div>
</div>

<style>
    /* Animasi Floating (Naik-Turun) */
    @keyframes floating {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    /* Animasi Fade In dari Kiri dan Kanan */
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fadeInLeft {
        animation: fadeInLeft 1s ease-out forwards;
    }

    .animate-fadeInRight {
        animation: fadeInRight 1s ease-out forwards;
    }
</style>
</div>

<section class="bg-blue-50 py-16 px-6 md:px-12 lg:px-24">
    <div class="container mx-auto">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Konten Kiri -->
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Posyandu NUSA INDAH
                </h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Posyandu Nusa Indah (Pedukuhan Surobayan) menyediakan layanan kesehatan yang lengkap,
                    termasuk pemeriksaan rutin untuk ibu hamil dan balita, program imunisasi,
                    konsultasi gizi, penyuluhan kesehatan, serta pemantauan pertumbuhan balita.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                        <span class="text-gray-700">Fasilitas yang nyaman dan bersih</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                        <span class="text-gray-700">Tenaga kesehatan yang sigap dan cekatan</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                        <span class="text-gray-700">Pelayanan yang ramah</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                        <span class="text-gray-700">Terjangkau serta mudah diakses</span>
                    </li>
                </ul>
            </div>

            <!-- Konten Kanan (Gambar) -->
            <div class="flex justify-center">
                <img src="images/two.png" alt="Ilustrasi Posyandu" class="w-3/4 md:w-2/3 drop-shadow-lg">
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-r from-blue-500 to-blue-400 py-16">
    <div class="container mx-auto px-6 text-center text-white">
        <h3 class="text-lg font-semibold uppercase tracking-wider">Statistik Tahun 2025</h3>
        <h2 class="text-3xl font-bold mt-2">Data Posyandu Nusa Indah</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6 mt-12">
            <!-- Data Balita -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <div class="bg-green-200 text-green-600 p-5 rounded-full shadow-md">
                    <i class="fas fa-child text-4xl"></i>
                </div>
                <p class="text-4xl font-bold text-gray-800 mt-4"><?= esc($balita) ?></p>
                <p class="text-gray-600 text-lg">Data Balita</p>
            </div>

            <!-- Data Lansia -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <div class="bg-yellow-200 text-yellow-600 p-5 rounded-full shadow-md">
                    <i class="fas fa-user-friends text-4xl"></i>
                </div>
                <p class="text-4xl font-bold text-gray-800 mt-4"><?= esc($lansia) ?></p>
                <p class="text-gray-600 text-lg">Data Lansia</p>
            </div>

            <!-- Data Ibu Hamil -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <div class="bg-pink-200 text-pink-600 p-5 rounded-full shadow-md">
                    <i class="fas fa-user-nurse text-4xl"></i>
                </div>
                <p class="text-4xl font-bold text-gray-800 mt-4"><?= esc($ibu_hamil) ?></p>
                <p class="text-gray-600 text-lg">Data Ibu Hamil</p>
            </div>

            <!-- Data Remaja Putri -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <div class="bg-purple-200 text-purple-600 p-5 rounded-full shadow-md">
                    <i class="fas fa-female text-4xl"></i>
                </div>
                <p class="text-4xl font-bold text-gray-800 mt-4"><?= esc($remaja_putri) ?></p>
                <p class="text-gray-600 text-lg">Data Remaja Putri</p>
            </div>

            <!-- Data Usia Produktif -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <div class="bg-blue-200 text-blue-600 p-5 rounded-full shadow-md">
                    <i class="fas fa-briefcase text-4xl"></i>
                </div>
                <p class="text-4xl font-bold text-gray-800 mt-4"><?= esc($usia_produktif) ?></p>
                <p class="text-gray-600 text-lg">Data Usia Produktif</p>
            </div>
        </div>
    </div>
</section>


<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <h3 class="text-lg font-semibold uppercase tracking-wider text-gray-700 text-center">Grafik Pengunjung Posyandu</h3>
        <h2 class="text-3xl font-bold text-gray-800 text-center mt-2">Tahun 2025</h2>

        <!-- <div class="flex justify-center mt-6">
            <label for="yearFilter" class="mr-2 text-gray-700">Pilih Tahun:</label>
            <select id="yearFilter" class="border rounded px-3 py-1" onchange="updateChart()">
                <option value="2025" selected>2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div> -->

        <div class="mt-8">
            <canvas id="posyanduChart"></canvas>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="posyanduChart" height="100"></canvas>

<script>
    const ctx = document.getElementById('posyanduChart').getContext('2d');
    ctx.canvas.height = 380;
    const posyanduChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartLabels) ?>,
            datasets: [{
                    
                label: 'Balita',
                    data: <?= json_encode($dataBalita) ?>,
                    backgroundColor: '#BFDBFE',
                    borderColor: '#60A5FA',
                    borderWidth: 1
                },
                {
                    label: 'Remaja Putri',
                    data: <?= json_encode($dataRemaja) ?>,
                    backgroundColor: '#D8B4FE',
                    borderColor: '#C084FC',
                    borderWidth: 1
                },
                {
                    label: 'Lansia',
                    data: <?= json_encode($dataLansia) ?>,
                    backgroundColor: '#FDE68A',
                    borderColor: '#FACC15',
                    borderWidth: 1
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10 // Biar garis bantu lebih banyak, misal 10-10-10...
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 12,
                            weight: 'normal'
                        }
                    }
                }
            }
        }

    });
</script>


<?= $this->endSection() ?>