<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-green-400 to-blue-500 px-6 md:px-0">

    <div class="bg-white shadow-2xl rounded-2xl flex flex-col md:flex-row w-full max-w-[700px] overflow-hidden">

        <!-- Bagian Kiri: Form Login -->
        <div class="w-full md:w-1/2 p-8">

            <nav class="text-sm text-gray-600 mb-4">
                <a href="/" class="text-primary font-semibold hover:text-green-600 transition duration-300 ease-in-out">
                    Beranda
                </a>
                <span class="mx-2">/</span>
                <span class="text-gray-500">Masuk</span>
            </nav>

            <h2 class="text-2xl font-bold text-gray-700 text-center">Masuk</h2>

            <!-- Pesan error -->
            <?php if (session()->getFlashdata('error')): ?>
                <p class="text-red-500 text-sm text-center mt-2"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>

            <form action="<?= base_url('/login') ?>" method="POST" class="mt-6">
                <div class="mb-4">
                    <label class="block text-gray-600 text-sm font-semibold">Nama User</label>
                    <input type="text" name="username" placeholder="Masukkan username"
                        class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required>
                </div>

                <div class="mb-4 relative">
    <label class="block text-gray-600 text-sm font-semibold">Password</label>
    <div class="flex items-center">
        <input type="password" name="password" id="password" placeholder="Masukkan password"
            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required>

        <!-- Ikon Mata -->
        <button type="button" id="togglePassword" class="absolute right-4">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12m-3 0a3 3 0 1 1 6 0 3 3 0 1 1 -6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-8 10-8 10 8 10 8-3 8-10 8-10-8-10-8Z" />
            </svg>
        </button>
    </div>
</div>


                <div class="flex justify-between items-center text-sm text-gray-600">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        Ingat saya
                    </label>
                </div>

                <button type="submit"
                    class="w-full mt-4 bg-gradient-to-r from-blue-500 to-green-400 text-white py-2 rounded-lg shadow-md hover:opacity-90 transition">
                    Masuk
                </button>
            </form>

        </div>

        <!-- Bagian Kanan: Gambar Lokal (Hilang di HP) -->
        <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('/images/login.png');">
        </div>

    </div>

</body>




<script>
    // Menambahkan fungsi untuk toggle password visibility
    const togglePasswordButton = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    togglePasswordButton.addEventListener("click", function() {
        // Toggle type antara 'password' dan 'text'
        if (passwordField.type === "password") {
            passwordField.type = "text";
            // Ganti ikon dengan mata terbuka
            eyeIcon.setAttribute("d", "M12 12m-3 0a3 3 0 1 1 6 0 3 3 0 1 1 -6 0Z"); // Mata terbuka
        } else {
            passwordField.type = "password";
            // Ganti ikon dengan mata tertutup
            eyeIcon.setAttribute("d", "M2 12s3-8 10-8 10 8 10 8-3 8-10 8-10-8-10-8Z"); // Mata tertutup
        }
    });
</script>

</html>