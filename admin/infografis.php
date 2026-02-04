<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require_once "../koneksi.php";

/* ==================================================
   ================= JUMLAH PENDUDUK =================
================================================== */
$penduduk = mysqli_query($koneksi, "SELECT * FROM infografis_penduduk ORDER BY tahun DESC");

/* TAMBAH */
if (isset($_POST['simpan_penduduk'])) {
    mysqli_query($koneksi, "INSERT INTO infografis_penduduk (tahun, total, kk, laki, perempuan)
        VALUES ('$_POST[tahun]','$_POST[total]','$_POST[kk]','$_POST[laki]','$_POST[perempuan]')");
    header("Location: infografis.php");
    exit;
}

/* UPDATE */
if (isset($_POST['update_penduduk'])) {
    mysqli_query($koneksi, "UPDATE infografis_penduduk SET
        tahun='$_POST[tahun]',
        total='$_POST[total]',
        kk='$_POST[kk]',
        laki='$_POST[laki]',
        perempuan='$_POST[perempuan]'
        WHERE id='$_POST[id]'");
    header("Location: infografis.php");
    exit;
}

/* HAPUS */
if (isset($_GET['hapus_penduduk'])) {
    mysqli_query($koneksi, "DELETE FROM infografis_penduduk WHERE id='$_GET[hapus_penduduk]'");
    header("Location: infografis.php");
    exit;
}

/* ==================================================
   ================= KELOMPOK UMUR ===================
================================================== */
$umur = mysqli_query($koneksi, "SELECT * FROM infografis_umur ORDER BY tahun DESC, id ASC");

/* TAMBAH */
if (isset($_POST['simpan_umur'])) {
    mysqli_query($koneksi, "INSERT INTO infografis_umur (tahun, kelompok_umur, laki, perempuan)
        VALUES ('$_POST[tahun]','$_POST[kelompok_umur]','$_POST[laki]','$_POST[perempuan]')");
    header("Location: infografis.php");
    exit;
}

/* UPDATE */
if (isset($_POST['update_umur'])) {
    mysqli_query($koneksi, "UPDATE infografis_umur SET
        tahun='$_POST[tahun]',
        kelompok_umur='$_POST[kelompok_umur]',
        laki='$_POST[laki]',
        perempuan='$_POST[perempuan]'
        WHERE id='$_POST[id]'");
    header("Location: infografis.php");
    exit;
}

/* HAPUS */
if (isset($_GET['hapus_umur'])) {
    mysqli_query($koneksi, "DELETE FROM infografis_umur WHERE id='$_GET[hapus_umur]'");
    header("Location: infografis.php");
    exit;
}

/* ==================================================
   ============ DATA GRAFIK KELOMPOK UMUR ============
================================================== */
$qGrafik = mysqli_query($koneksi, "
    SELECT kelompok_umur, SUM(laki + perempuan) AS total
    FROM infografis_umur
    GROUP BY kelompok_umur
    ORDER BY kelompok_umur ASC
");

$labelUmur = [];
$dataUmur  = [];

while ($g = mysqli_fetch_assoc($qGrafik)) {
    $labelUmur[] = $g['kelompok_umur'];
    $dataUmur[]  = $g['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Desa – Infografis</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>body{font-family:'Poppins',sans-serif}</style>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

<!-- SIDEBAR -->
<<aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white z-50">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="text-sm tracking-wider font-semibold">ADMIN DESA</span>
    </div>

    <nav class="mt-4 text-sm">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 hover:bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
        <a href="berita.php" class="block px-6 py-3 hover:bg-white/20">📰 Berita</a>
        <a href="galeri.php" class="block px-6 py-3 hover:bg-white/20">🖼️ Galeri</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<main class="ml-60 flex-1">
    <header class="bg-white px-8 py-5 shadow flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Infografis Desa</h2>
            <p class="text-gray-500 text-sm">Kelola Infografis Desa Ngargosari</p>
        </div>
    </header>



<section class="p-8 space-y-8 max-w-6xl mx-auto">

<!-- ================= JUMLAH PENDUDUK ================= -->
<div class="bg-white rounded-lg shadow p-6">
<div class="flex justify-between mb-4">
<h3 class="font-semibold text-lg">Jumlah Penduduk</h3>
<button onclick="openTambahPenduduk()" class="bg-green-700 text-white px-4 py-2 rounded text-sm">➕ Tambah</button>
</div>

<table class="w-full border text-sm">
<thead class="bg-gray-200">
<tr>
<th class="border px-3 py-2">Tahun</th>
<th class="border px-3 py-2">Total</th>
<th class="border px-3 py-2">KK</th>
<th class="border px-3 py-2">Laki</th>
<th class="border px-3 py-2">Perempuan</th>
<th class="border px-3 py-2">Aksi</th>
</tr>
</thead>
<tbody>
<?php while ($p = mysqli_fetch_assoc($penduduk)): ?>
<tr class="text-center">
<td class="border px-3 py-2"><?= $p['tahun'] ?></td>
<td class="border px-3 py-2"><?= $p['total'] ?></td>
<td class="border px-3 py-2"><?= $p['kk'] ?></td>
<td class="border px-3 py-2"><?= $p['laki'] ?></td>
<td class="border px-3 py-2"><?= $p['perempuan'] ?></td>
<td class="border px-3 py-2 space-x-1">
<button onclick='editPenduduk(<?= json_encode($p) ?>)' class="bg-yellow-400 px-3 py-1 rounded text-xs">Edit</button>
<a href="?hapus_penduduk=<?= $p['id'] ?>" onclick="return confirm('Hapus data ini?')" class="bg-red-500 text-white px-3 py-1 rounded text-xs inline-block">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!-- ================= KELOMPOK UMUR ================= -->
<div class="bg-white rounded-lg shadow p-6">
<div class="flex justify-between mb-4">
<h3 class="font-semibold text-lg">Penduduk Berdasarkan Kelompok Umur</h3>
<button onclick="openTambahUmur()" class="bg-green-700 text-white px-3 py-1 rounded text-sm">➕ Tambah</button>
</div>

<table class="w-full border text-sm">
<thead class="bg-gray-200">
<tr>
<th class="border px-3 py-2">Tahun</th>
<th class="border px-3 py-2">Kelompok Umur</th>
<th class="border px-3 py-2">Laki</th>
<th class="border px-3 py-2">Perempuan</th>
<th class="border px-3 py-2">Aksi</th>
</tr>
</thead>
<tbody>
<?php while ($u = mysqli_fetch_assoc($umur)): ?>
<tr class="text-center">
<td class="border px-3 py-2"><?= $u['tahun'] ?></td>
<td class="border px-3 py-2"><?= $u['kelompok_umur'] ?></td>
<td class="border px-3 py-2"><?= $u['laki'] ?></td>
<td class="border px-3 py-2"><?= $u['perempuan'] ?></td>
<td class="border px-3 py-2 space-x-1">
<button onclick='editUmur(<?= json_encode($u) ?>)' class="bg-yellow-400 px-3 py-1 rounded text-xs">Edit</button>
<a href="?hapus_umur=<?= $u['id'] ?>" onclick="return confirm('Hapus data ini?')" class="bg-red-500 text-white px-3 py-1 rounded text-xs inline-block">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!-- ================= GRAFIK ================= -->
<div class="bg-white rounded-lg shadow p-6">
<h3 class="font-semibold text-lg mb-4">Grafik Penduduk Berdasarkan Kelompok Umur</h3>
<canvas id="grafikUmur" height="120"></canvas>
</div>

</section>
</main>
</div>

<!-- ================= MODAL ================= -->
<div id="modalPenduduk" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
<form method="post" class="bg-white p-6 rounded-xl w-96 space-y-3">
<input type="hidden" name="id" id="pid">
<input name="tahun" id="ptahun" class="border w-full p-2 rounded" placeholder="Tahun">
<input name="total" id="ptotal" class="border w-full p-2 rounded" placeholder="Total">
<input name="kk" id="pkk" class="border w-full p-2 rounded" placeholder="KK">
<input name="laki" id="plaki" class="border w-full p-2 rounded" placeholder="Laki">
<input name="perempuan" id="pperempuan" class="border w-full p-2 rounded" placeholder="Perempuan">
<div class="flex justify-end gap-2">
<button type="button" onclick="closeAll()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
<button name="simpan_penduduk" id="btnPenduduk" class="bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
</div>
</form>
</div>

<div id="modalUmur" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
<form method="post" class="bg-white p-6 rounded-xl w-96 space-y-3">
<input type="hidden" name="id" id="uid">
<input name="tahun" id="utahun" class="border w-full p-2 rounded" placeholder="Tahun">
<input name="kelompok_umur" id="ukelompok_umur" class="border w-full p-2 rounded" placeholder="Kelompok Umur">
<input name="laki" id="ulaki" class="border w-full p-2 rounded" placeholder="Laki">
<input name="perempuan" id="uperempuan" class="border w-full p-2 rounded" placeholder="Perempuan">
<div class="flex justify-end gap-2">
<button type="button" onclick="closeAll()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
<button name="simpan_umur" id="btnUmur" class="bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
</div>
</form>
</div>

<script>
const ctx = document.getElementById('grafikUmur');
if (ctx) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labelUmur) ?>,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: <?= json_encode($dataUmur) ?>,
                backgroundColor: '#16a34a'
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
}
</script>

</body>
</html>
