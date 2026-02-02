<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

// total produk unggulan
$qProduk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM produk");
$dProduk = mysqli_fetch_assoc($qProduk);
$totalProduk = $dProduk['total'] ?? 0;

// data statis sementara
$totalPenduduk = 700;
$totalKK = 180;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-100">

<!-- SIDEBAR -->
<aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="tracking-wider font-semibold text-sm">ADMIN DESA</span>
    </div>

    <nav class="mt-4">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20 transition">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 hover:bg-white/20 transition">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20 transition">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20 transition">🛒 Produk Unggulan</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30 transition">🚪 Logout</a>
    </nav>
</aside>

<!-- MAIN -->
<div class="ml-60 min-h-screen">

<!-- HEADER -->
<header class="bg-white px-8 py-5 shadow">
    <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin Desa Ngargosari</h2>
    <p class="text-gray-500 text-sm">Ringkasan Data Desa</p>
</header>

<!-- CONTENT -->
<main class="p-8">

<!-- STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-1 transition">
        <p class="text-gray-500 text-sm">Total Penduduk</p>
        <h3 class="text-3xl font-semibold text-green-700 mt-2"><?= $totalPenduduk ?></h3>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-1 transition">
        <p class="text-gray-500 text-sm">Kepala Keluarga</p>
        <h3 class="text-3xl font-semibold text-green-700 mt-2"><?= $totalKK ?></h3>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-1 transition">
        <p class="text-gray-500 text-sm">Produk Unggulan</p>
        <h3 class="text-3xl font-semibold text-green-700 mt-2"><?= $totalProduk ?></h3>
    </div>
</div>

<!-- MENU -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div onclick="location.href='profil.php'"
         class="cursor-pointer bg-white p-8 rounded-xl shadow text-center text-lg font-medium hover:bg-green-700 hover:text-white transition">
        📌 Profil Desa
    </div>

    <div onclick="location.href='infografis.php'"
         class="cursor-pointer bg-white p-8 rounded-xl shadow text-center text-lg font-medium hover:bg-green-700 hover:text-white transition">
        📊 Infografis
    </div>

    <div onclick="location.href='produk.php'"
         class="cursor-pointer bg-white p-8 rounded-xl shadow text-center text-lg font-medium hover:bg-green-700 hover:text-white transition">
        🛒 Produk Unggulan
    </div>
</div>

<!-- MAP -->
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="font-semibold mb-4">📍 Lokasi Desa Ngargosari</h3>
    <iframe
        class="w-full h-72 rounded-lg"
        src="https://www.google.com/maps?q=Desa+Ngargosari+Loano+Purworejo&output=embed"
        loading="lazy">
    </iframe>
</div>

</main>
</div>

</body>
</html>
