<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/partials/header.php";

// Ambil ID berita
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query berita
$qBerita = mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id' LIMIT 1");
$berita  = mysqli_fetch_assoc($qBerita);

// Jika tidak ada
if (!$berita) {
    echo "<script>alert('Berita tidak ditemukan'); window.location='berita.php';</script>";
    exit;
}

// Format tanggal
$tanggal = date('d F Y', strtotime($berita['tanggal']));

// Gambar
$imgBerita = !empty($berita['gambar'])
    ? "assets/img/berita/" . htmlspecialchars($berita['gambar'])
    : "assets/img/no-image.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($berita['judul']) ?> | Desa Ngargosari</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
</head>

<body class="bg-gray-100 text-gray-800">

<main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-3">
        <a href="index.php" class="hover:text-blue-600">Home</a>
        <span class="mx-1">›</span>
        <a href="berita.php" class="hover:text-blue-600">Berita</a>
    </nav>

    <!-- Card -->
    <article class="bg-white rounded-xl shadow-sm overflow-hidden">

        <!-- Gambar -->
        <div class="w-full aspect-[16/9] bg-gray-200">
            <img 
                src="<?= $imgBerita ?>" 
                alt="<?= htmlspecialchars($berita['judul']) ?>" 
                class="w-full h-full object-cover"
            >
        </div>

        <!-- Konten -->
        <div class="p-5 sm:p-7">

            <!-- Judul -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight mb-2">
                <?= htmlspecialchars($berita['judul']) ?>
            </h1>

            <!-- Meta -->
            <p class="text-sm text-gray-500 mb-5">
                Dipublikasikan pada <?= $tanggal ?>
            </p>

            <!-- Isi -->
            <div class="text-gray-700 text-base sm:text-lg leading-relaxed space-y-4">
                <?= nl2br(htmlspecialchars($berita['isi'])) ?>
            </div>

        </div>
    </article>

    <!-- Tombol Kembali -->
    <div class="mt-6">
        <a href="berita.php" 
           class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
            ← Kembali ke Berita
        </a>
    </div>

</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
</body>
</html>
