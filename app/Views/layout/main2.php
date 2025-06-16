<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        #successModal {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Mobile adjustments */
        @media (max-width: 500px) {
            .sidebar {
                /* position: relative; */
                width: 100%;
                height: auto;
                background-color: #edf2f7; /* bg-gray-100 for mobile */
            }
            .main-content {
                margin-left: 0;  /* Remove left margin for full width */
                padding: 1.5rem;
                overflow: visible;
                background-color: #edf2f7; /* bg-gray-100 for mobile */
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-100 text-white h-screen fixed sidebar">
            <?= $this->include('partials/sidebar') ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-6 overflow-auto main-content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</body>

</html>
