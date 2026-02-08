<?php
if (!isset($halaman)) {
    $halaman = basename($_SERVER['PHP_SELF']);
}

$menu = [
    'index.php' => 'Home',
    'profil-desa.php' => 'Profil Desa',
    'produk.php' => 'Produk Unggulan',
    'infografis.php' => 'Infografis',
    'berita.php' => 'Berita',
    'galeri.php' => 'Galeri'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <!-- 🔴 WAJIB UNTUK RESPONSIVE HP -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">

        <!-- LOGO -->
        <div class="flex items-center gap-3 font-semibold text-base sm:text-lg">
            <img src="assets/img/logo.png" alt="Logo Desa" class="w-9 h-9 object-contain">
            Desa Ngargosari
        </div>

        <!-- MENU DESKTOP -->
        <nav class="hidden md:flex gap-6 text-sm">
            <?php foreach ($menu as $file => $label): ?>
                <a href="<?= $file ?>"
                   class="<?= $halaman === $file ? 'underline font-semibold' : 'hover:underline' ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- BUTTON HAMBURGER (MOBILE) -->
        <button id="btnMenu"
            class="md:hidden text-2xl focus:outline-none">
            ☰
        </button>
    </div>

    <!-- MENU MOBILE -->
    <div id="mobileMenu"
         class="hidden md:hidden bg-green-700 px-6 pb-4 text-sm space-y-1">

        <?php foreach ($menu as $file => $label): ?>
            <a href="<?= $file ?>"
               class="block py-2 border-b border-green-600
                      <?= $halaman === $file ? 'font-semibold underline' : '' ?>">
                <?= $label ?>
            </a>
        <?php endforeach; ?>
    </div>

</header>

<!-- ================= SCRIPT TOGGLE ================= -->
<script>
    const btnMenu = document.getElementById('btnMenu');
    const mobileMenu = document.getElementById('mobileMenu');

    if (btnMenu && mobileMenu) {
        btnMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
</script>
