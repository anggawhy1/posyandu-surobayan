<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Posyandu' ?></title>

    <!-- Tambahkan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        nunito: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        primary: '#002F66', // Warna teks utama
                        secondary: '#4DC1A1', // Warna aksen
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-white font-nunito">

    <!-- Navbar -->
    <?= view('partials/navbar') ?>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-6 pt-16">
        <?= $this->renderSection('content') ?>
    </main>


    <?= view('partials/footer') ?>
</body>

</html>