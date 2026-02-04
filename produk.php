<?php
include "koneksi.php";

/* PAGINATION */
$batas = 4;
$hal   = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$mulai = ($hal - 1) * $batas;

$total = mysqli_num_rows(mysqli_query($koneksi,"SELECT id_produk FROM produk"));
$pages = ceil($total / $batas);

$data = mysqli_query($koneksi,"
    SELECT * FROM produk
    ORDER BY id_produk DESC
    LIMIT $mulai, $batas
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Produk Unggulan Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-white text-gray-800">

<!-- ===== HEADER ===== -->
<header class="bg-green-800 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="flex items-center gap-3">
            <img src="assets/img/logo.png" class="w-12">
            <div class="leading-tight">
                <p class="font-semibold">Desa Ngargosari</p>
                <p class="text-xs opacity-90">Kecamatan Loano, Kabupaten Purworejo</p>
            </div>
        </div>

        <nav class="flex gap-5 text-sm">
            <a href="index.php" class="hover:underline">Home</a>
            <a href="profil-desa.php" class="hover:underline">Profil Desa</a>
            <a href="produk.php" class="border-b-2 border-white pb-1 font-medium">Produk Unggulan</a>
            <a href="infografis.php" class="hover:underline">Infografis</a>
        </nav>

    </div>
</header>

<!-- ===== CONTENT ===== -->
<main class="max-w-7xl mx-auto px-6 py-12">

    <h1 class="text-2xl font-semibold mb-10 text-center">
        Produk Unggulan Desa
    </h1>

    <!-- GRID PRODUK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">

        <?php while($p = mysqli_fetch_assoc($data)): ?>
        <a href="produk_detail.php?id=<?= $p['id_produk'] ?>"
           class="group w-full max-w-xs bg-white border rounded-lg overflow-hidden
                  hover:-translate-y-2 hover:shadow-xl transition">

            <img src="assets/img/produk/<?= htmlspecialchars($p['gambar']) ?>"
                 class="w-full h-48 object-cover">

            <div class="p-4">
                <p class="font-medium text-center group-hover:text-green-700 transition">
                    <?= htmlspecialchars($p['nama_produk']) ?>
                </p>
            </div>
        </a>
        <?php endwhile; ?>

    </div>

    <!-- PAGINATION -->
    <div class="flex justify-center mt-12 gap-2">
        <?php for($i=1;$i<=$pages;$i++): ?>
            <a href="?hal=<?= $i ?>"
               class="px-3 py-1 border rounded text-sm
               <?= $i==$hal
                    ? 'bg-green-700 text-white border-green-700'
                    : 'hover:bg-gray-100' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</main>

<!-- ===== FOOTER ===== -->
<footer class="bg-green-800 text-white mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8 text-sm">

        <div>
            <img src="assets/img/logo.png" class="w-14 mb-3">
            <p class="font-semibold">Pemerintah Desa Ngargosari</p>
            <p class="opacity-90 mt-2">
                Kecamatan Loano, Kabupaten Purworejo<br>
                Provinsi Jawa Tengah
            </p>
        </div>

        <div>
            <p class="font-semibold mb-2">Hubungi Kami</p>
            <p>📞 08888888</p>
            <p>✉️ email</p>
            <p>📷 instagram</p>
        </div>

    </div>

    <div class="bg-green-900 text-center text-xs py-2">
        © 2026 Desa Ngargosari
    </div>
</footer>

</body>
</html>
