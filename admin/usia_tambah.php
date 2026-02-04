<?php
session_start();
require_once "../koneksi.php";

/* Tahun aktif */
$tahunAktif = $_GET['tahun'] ?? date('Y');

/* Data penduduk tahunan */
$qTahunan = mysqli_query($koneksi,"
    SELECT * FROM penduduk_tahunan WHERE tahun='$tahunAktif'
");
$tahunan = mysqli_fetch_assoc($qTahunan);

/* Data usia */
$qUsia = mysqli_query($koneksi,"
    SELECT * FROM penduduk_usia 
    WHERE tahun='$tahunAktif'
    ORDER BY id ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Infografis</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

<!-- SIDEBAR -->
<aside class="w-64 bg-green-900 text-white p-6">
    <div class="mb-8 font-bold text-lg">Admin Desa</div>
    <ul class="space-y-4">
        <li>🏠 Dashboard</li>
        <li>📌 Profil Desa</li>
        <li>📦 Produk Unggulan</li>
        <li class="bg-green-700 p-2 rounded">📊 Infografis</li>
        <li>🚪 Logout</li>
    </ul>
</aside>

<!-- CONTENT -->
<main class="flex-1 p-8">

<h1 class="text-xl font-bold mb-4">Jumlah Penduduk</h1>

<!-- FILTER TAHUN -->
<form method="get" class="mb-4">
    Tahun Data :
    <select name="tahun" onchange="this.form.submit()" class="border p-1">
        <?php
        $qt = mysqli_query($koneksi,"SELECT tahun FROM penduduk_tahunan ORDER BY tahun DESC");
        while ($t = mysqli_fetch_assoc($qt)) :
        ?>
        <option value="<?= $t['tahun'] ?>" <?= $t['tahun']==$tahunAktif?'selected':'' ?>>
            <?= $t['tahun'] ?>
        </option>
        <?php endwhile; ?>
    </select>
</form>

<!-- TABEL PENDUDUK -->
<div class="bg-white rounded shadow mb-6">
<table class="w-full text-sm">
<thead class="bg-gray-200">
<tr>
    <th>Total Penduduk</th>
    <th>Kepala Keluarga</th>
    <th>Laki-laki</th>
    <th>Perempuan</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody class="text-center">
<tr>
    <td><?= $tahunan['total_penduduk'] ?? '-' ?></td>
    <td><?= $tahunan['total_kk'] ?? '-' ?></td>
    <td><?= $tahunan['laki_laki'] ?? '-' ?></td>
    <td><?= $tahunan['perempuan'] ?? '-' ?></td>
    <td class="space-x-1">
        <span class="bg-yellow-400 px-2 py-1 rounded text-xs">Edit</span>
        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</span>
    </td>
</tr>
</tbody>
</table>
</div>

<!-- TABEL USIA -->
<h2 class="font-semibold mb-2">Kelompok Umur</h2>

<div class="bg-white rounded shadow">
<table class="w-full text-sm">
<thead class="bg-gray-200">
<tr>
    <th>Kelompok Umur</th>
    <th>Laki-laki</th>
    <th>Perempuan</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody class="text-center">
<?php while ($u = mysqli_fetch_assoc($qUsia)) : ?>
<tr class="border-t">
    <td><?= $u['umur'] ?></td>
    <td><?= $u['laki'] ?></td>
    <td><?= $u['perempuan'] ?></td>
    <td class="space-x-1">
        <a href="usia_edit.php?id=<?= $u['id'] ?>" class="bg-yellow-400 px-2 py-1 rounded text-xs">Edit</a>
        <a href="usia_hapus.php?id=<?= $u['id'] ?>" class="bg-red-500 text-white px-2 py-1 rounded text-xs"
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<a href="usia_tambah.php?tahun=<?= $tahunAktif ?>"
   class="inline-block mt-3 bg-green-700 text-white px-3 py-1 rounded text-sm">
+ Tambah Kelompok Umur
</a>

</main>
</div>

</body>
</html>
