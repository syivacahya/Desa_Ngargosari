<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
include "partials/header.php";

// Ambil ID berita dari query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data berita dari database
$qBerita = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = '$id' LIMIT 1");
$berita = mysqli_fetch_assoc($qBerita);

// Jika berita tidak ditemukan, redirect ke halaman utama atau tampilkan pesan
if (!$berita) {
    echo "<script>alert('Berita tidak ditemukan'); window.location='index.php';</script>";
    exit;
}

// Format tanggal
$tanggal = date('d F Y', strtotime($berita['tanggal']));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($berita['judul']) ?> - Desa Ngargosari</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
</style>
</head>

<body class="bg-gray-100 text-gray-800">

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    <!-- Breadcrumb / Navigasi -->
    <div class="text-sm text-gray-500 mb-2">
        <a href="index.php" class="hover:underline">Home</a> &gt;
        <a href="berita.php" class="hover:underline">Berita</a> &gt;
    </div>

    <!-- Judul Berita -->
    <h1 class="text-3xl sm:text-4xl font-bold leading-tight text-gray-900 mb-1">
        <?= htmlspecialchars($berita['judul']) ?>
    </h1>

    <!-- Tanggal -->
    <p class="text-gray-500 text-sm mb-4"><?= $tanggal ?></p>

    <!-- Gambar Utama -->
    <?php
    $imgBerita = !empty($berita['gambar']) ? "assets/img/berita/".htmlspecialchars($berita['gambar']) : 'assets/img/no-image.png';
    ?>
    <div class="w-full h-64 sm:h-80 bg-gray-200 rounded-lg overflow-hidden mb-6 shadow">
        <img src="<?= $imgBerita ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="w-full h-full object-cover">
    </div>

    <!-- Isi Berita -->
    <div class="prose max-w-none text-gray-700">
        <?= nl2br($berita['isi']) ?>
    </div>

</main>

<?php include "partials/footer.php"; ?>
</body>
</html>
