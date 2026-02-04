<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Infografis Penduduk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<div class="flex min-h-screen">

<!-- SIDEBAR -->
<aside class="w-64 bg-green-800 text-white p-6">
<h1 class="font-bold text-xl mb-8">Admin Desa</h1>
<ul class="space-y-4">
<li>Dashboard</li>
<li>Profil Desa</li>
<li>Produk Unggulan</li>
<li class="bg-green-700 px-3 py-2 rounded">Infografis</li>
<li>Logout</li>
</ul>
</aside>

<!-- CONTENT -->
<main class="flex-1 p-8">
<h2 class="text-2xl font-bold mb-6">Jumlah Penduduk</h2>

<!-- FORM TOTAL -->
<form action="total_simpan.php" method="POST" class="mb-6 flex gap-2">
<input name="tahun" placeholder="Tahun" class="border px-2 py-1" required>
<input name="total" placeholder="Total" class="border px-2 py-1">
<input name="kk" placeholder="KK" class="border px-2 py-1">
<input name="laki" placeholder="Laki" class="border px-2 py-1">
<input name="perempuan" placeholder="Perempuan" class="border px-2 py-1">
<button class="bg-green-700 text-white px-4">Tambah</button>
</form>

<table class="w-full border mb-10">
<tr class="bg-gray-200">
<th class="border p-2">Total</th>
<th class="border p-2">KK</th>
<th class="border p-2">Laki</th>
<th class="border p-2">Perempuan</th>
<th class="border p-2">Aksi</th>
</tr>

<?php
require 'koneksi.php';
$q = mysqli_query($conn,"SELECT * FROM penduduk_total");
while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td class="border p-2"><?= $d['total_penduduk'] ?></td>
<td class="border p-2"><?= $d['kepala_keluarga'] ?></td>
<td class="border p-2"><?= $d['laki_laki'] ?></td>
<td class="border p-2"><?= $d['perempuan'] ?></td>
<td class="border p-2">
<a href="total_hapus.php?id=<?= $d['id'] ?>" class="bg-red-600 text-white px-2 py-1">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

<!-- FORM UMUR -->
<form action="umur_simpan.php" method="POST" class="mb-4 flex gap-2">
<input name="tahun" placeholder="Tahun" class="border px-2 py-1">
<input name="umur" placeholder="0-4" class="border px-2 py-1">
<input name="laki" placeholder="Laki" class="border px-2 py-1">
<input name="perempuan" placeholder="Perempuan" class="border px-2 py-1">
<button class="bg-green-700 text-white px-4">Tambah</button>
</form>

<table class="w-full border">
<tr class="bg-gray-200">
<th class="border p-2">Umur</th>
<th class="border p-2">Laki</th>
<th class="border p-2">Perempuan</th>
<th class="border p-2">Aksi</th>
</tr>

<?php
$q = mysqli_query($conn,"SELECT * FROM penduduk_umur");
while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td class="border p-2"><?= $d['kelompok_umur'] ?></td>
<td class="border p-2"><?= $d['laki_laki'] ?></td>
<td class="border p-2"><?= $d['perempuan'] ?></td>
<td class="border p-2">
<a href="umur_hapus.php?id=<?= $d['id'] ?>" class="bg-red-600 text-white px-2 py-1">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

</main>
</div>
</body>
</html>
