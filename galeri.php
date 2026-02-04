<?php
include "koneksi.php";

// Cek koneksi database
if (!isset($koneksi) || !$koneksi) {
    die("Koneksi database tidak tersedia.");
}

// Query data galeri
$data = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");

// Cek query
if (!$data) {
    die("Query galeri gagal: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Galeri Desa Ngargosari</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<!-- ===== HEADER ===== -->
<header class="bg-green-800 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3 font-semibold">
            <img src="assets/img/logo.png" alt="Logo Desa" class="w-10">
            Desa Ngargosari
        </div>
        <nav class="hidden md:flex gap-6 text-sm">
            <a href="#home" class="hover:underline">Home</a>
            <a href="profil-desa.php" class="hover:underline">Profil Desa</a>
            <a href="produk.php" class="hover:underline">Produk Unggulan</a>
            <a href="#infografis" class="hover:underline">Infografis</a>
            <a href="#berita" class="hover:underline">Berita</a>
            <a href="#galeri" class="hover:underline">Galeri</a>
        </nav>
    </div>
</header>

<!-- CONTENT -->
<main class="max-w-6xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-semibold text-green-800 mb-6">📸 Galeri Desa</h2>

    <?php if (mysqli_num_rows($data) == 0): ?>
        <p class="text-gray-500">Belum ada data galeri.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php while ($g = mysqli_fetch_assoc($data)): ?>

                <?php
                $gambarPath = "assets/img/galeri/" . $g['gambar'];
                if (!file_exists($gambarPath) || empty($g['gambar'])) {
                    $gambarPath = "assets/img/no-image.png";
                }
                ?>

                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    <img 
                        src="<?= $gambarPath ?>"
                        alt="<?= htmlspecialchars($g['judul']) ?>"
                        class="w-full h-44 object-cover"
                    >
                    <div class="p-4">
                        <h4 class="text-sm font-semibold text-green-800">
                            <?= htmlspecialchars($g['judul']) ?>
                        </h4>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</main>

</body>
</html>
