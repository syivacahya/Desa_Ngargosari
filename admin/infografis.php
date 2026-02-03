<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Infografis Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{font-family:'Poppins',sans-serif}
</style>
</head>

<body class="bg-gray-100">

<div class="flex">

<!-- ================= SIDEBAR ================= -->
<aside class="w-64 min-h-screen bg-gradient-to-b from-green-900 to-green-700 text-white fixed">
    <div class="text-center p-6 border-b border-white/30">
        <img src="../assets/img/logo.png" class="w-20 mx-auto mb-2">
        <span class="font-semibold tracking-wide">ADMIN DESA</span>
    </div>

    <nav class="mt-4">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 hover:bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-white/20">🚪 Logout</a>
    </nav>
</aside>

<!-- ================= MAIN ================= -->
<main class="ml-64 w-full">

<!-- HEADER -->
<header class="bg-white shadow px-8 py-5">
    <h2 class="text-xl font-semibold text-gray-800">Infografis Desa</h2>
    <p class="text-sm text-gray-500">Kelola data kependudukan desa</p>
</header>

<section class="p-8 space-y-8">

<!-- ================= JUMLAH PENDUDUK ================= -->
<div class="bg-white rounded-xl shadow p-6">
<h3 class="text-lg font-semibold text-green-800 mb-4">Jumlah Penduduk</h3>

<form method="POST" action="infografis_aksi.php" class="space-y-5">
<input type="hidden" name="simpan_penduduk">

<div>
    <label class="font-medium text-green-800">Tahun Data</label>
    <select name="tahun" required class="w-full mt-1 p-2 border rounded-lg">
        <option value="2024">2024</option>
        <option value="2023">2023</option>
    </select>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
        <label>Total Penduduk</label>
        <input type="number" name="total" required class="input">
    </div>
    <div>
        <label>Kepala Keluarga</label>
        <input type="number" name="kk" required class="input">
    </div>
    <div>
        <label>Laki-laki</label>
        <input type="number" name="laki" required class="input">
    </div>
    <div>
        <label>Perempuan</label>
        <input type="number" name="perempuan" required class="input">
    </div>
</div>

<p class="text-sm text-gray-500">
    Laki-laki + Perempuan = Total Penduduk
</p>

<div class="text-right">
    <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
        💾 Simpan
    </button>
</div>
</form>
</div>

<!-- ================= KELOMPOK UMUR ================= -->
<div class="bg-white rounded-xl shadow p-6">
<h3 class="text-lg font-semibold text-green-800 mb-4">Kelompok Umur Penduduk</h3>

<form method="POST" action="infografis_aksi.php" class="space-y-5">
<input type="hidden" name="simpan_umur">

<div>
    <label class="font-medium text-green-800">Tahun Data</label>
    <select name="tahun" class="w-full mt-1 p-2 border rounded-lg">
        <option value="2024">2024</option>
        <option value="2023">2023</option>
    </select>
</div>

<div class="overflow-x-auto">
<table class="w-full border mt-4">
<thead class="bg-green-100">
<tr>
    <th class="border p-2">Kelompok Umur</th>
    <th class="border p-2">Laki-laki</th>
    <th class="border p-2">Perempuan</th>
</tr>
</thead>
<tbody>
<?php
$umur = ['0-4','5-9','10-14','15-19','20-24','25-29'];
foreach($umur as $u){
?>
<tr class="text-center">
    <td class="border p-2">
        <?= $u ?>
        <input type="hidden" name="umur[]" value="<?= $u ?>">
    </td>
    <td class="border p-2">
        <input type="number" name="laki[]" required class="input text-center">
    </td>
    <td class="border p-2">
        <input type="number" name="perempuan[]" required class="input text-center">
    </td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<div class="text-right">
    <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
        💾 Simpan
    </button>
</div>
</form>
</div>

</section>
</main>
</div>

<!-- helper input -->
<style>
.input{
    width:100%;
    padding:8px;
    border:1px solid #d1d5db;
    border-radius:0.5rem;
}
</style>

</body>
</html>
