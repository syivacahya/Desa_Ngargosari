<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: admin/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Desa | Profil Desa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

<!-- ===== SIDEBAR ===== -->
<aside class="w-60 min-h-screen bg-gradient-to-b from-green-900 to-green-700 text-white flex-shrink-0 relative z-20">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="tracking-wider font-semibold text-sm">ADMIN DESA</span>
    </div>

    <nav class="mt-4">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<!-- ===== MAIN CONTENT ===== -->
<main class="flex-1 flex flex-col relative z-10">

<!-- HEADER -->
<header class="bg-white px-8 py-5 border-b">
    <h2 class="text-xl font-semibold text-gray-800">Profil Desa</h2>
    <p class="text-gray-500 text-sm">Ringkasan Data Desa</p>
</header>

<!-- CONTENT -->
<section class="p-8 flex flex-col gap-8 relative z-10">

<!-- TOMBOL TAMBAH -->
<div>
    <a href="profil_tambah.php"
       class="inline-block bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
        + Tambah
    </a>
</div>

<!-- PROFIL DESA -->
<div class="bg-white rounded-lg shadow overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-4">Sejarah Desa</th>
    <th>Luas Wilayah</th>
    <th>Jumlah RT</th>
    <th>Jumlah Dusun</th>
    <th>Nama Dusun</th>
    <th class="text-center w-32">Aksi</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
    <td class="p-4">-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td class="p-4">
        <div class="flex justify-center gap-2">
            <a href="profil_edit.php?id=1"
               class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500">
                Edit
            </a>
            <a href="profil_hapus.php?id=1"
               onclick="return confirm('Yakin ingin menghapus data ini?')"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                Hapus
            </a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>

<!-- BATAS WILAYAH -->
<div class="bg-white rounded-lg shadow overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-4">Utara</th>
    <th>Timur</th>
    <th>Selatan</th>
    <th class="text-center w-32">Aksi</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
    <td class="p-4">-</td>
    <td>-</td>
    <td>-</td>
    <td class="p-4">
        <div class="flex justify-center gap-2">
            <a href="batas_edit.php?id=1"
               class="bg-yellow-400 px-3 py-1 rounded text-sm">
                Edit
            </a>
            <a href="batas_hapus.php?id=1"
               onclick="return confirm('Yakin ingin menghapus data ini?')"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                Hapus
            </a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>

<!-- STRUKTUR PEMERINTAHAN -->
<div class="bg-white rounded-lg shadow overflow-hidden">
<table class="w-full text-sm text-center">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-4">Nama</th>
    <th>Jabatan</th>
    <th>Gambar</th>
    <th class="w-32">Aksi</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
    <td class="p-4">-</td>
    <td>-</td>
    <td>-</td>
    <td class="p-4">
        <div class="flex justify-center gap-2">
            <a href="struktur_edit.php?id=1"
               class="bg-yellow-400 px-3 py-1 rounded text-sm">
                Edit
            </a>
            <a href="struktur_hapus.php?id=1"
               onclick="return confirm('Yakin ingin menghapus data ini?')"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                Hapus
            </a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>

</section>

</main>
</div>

</body>
</html>
