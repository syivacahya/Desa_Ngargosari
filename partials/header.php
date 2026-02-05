<?php
if (!isset($halaman)) {
    $halaman = basename($_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Desa Ngargosari</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

<!-- ================= HEADER ================= -->
<header class="bg-green-800 text-white sticky top-0 z-50 shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3 font-semibold">
            <img src="assets/img/logo.png" class="w-10">
            Desa Ngargosari
        </div>

        <nav class="hidden md:flex gap-6 text-sm">
            <?php
            $menu = [
                'index.php' => 'Home',
                'profil-desa.php' => 'Profil Desa',
                'produk.php' => 'Produk Unggulan',
                'infografis.php' => 'Infografis',
                'berita.php' => 'Berita',
                'galeri.php' => 'Galeri'
            ];

            foreach ($menu as $file => $label):
            ?>
                <a href="<?= $file ?>"
                   class="<?= $halaman == $file ? 'underline font-semibold' : 'hover:underline' ?>">
                   <?= $label ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>
