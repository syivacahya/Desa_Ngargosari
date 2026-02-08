<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/../partials/header.php";

/* AMBIL DATA */
$qProfil   = mysqli_query($koneksi, "SELECT * FROM profil_desa LIMIT 1");
$profil    = mysqli_fetch_assoc($qProfil);

$qBatas    = mysqli_query($koneksi, "SELECT * FROM batas_wilayah LIMIT 1");
$batas     = mysqli_fetch_assoc($qBatas);

$qStruktur = mysqli_query($koneksi, "SELECT * FROM struktur_pemerintahan ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Desa Ngargosari</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-[#F3F4F6]">

<main class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-12 space-y-12 sm:space-y-16">

<!-- ================= VISI ================= -->
<section>
  <div class="bg-white p-6 sm:p-8 rounded-xl text-gray-700 text-center leading-relaxed text-sm sm:text-base">
    <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">VISI</h2>
    <?= nl2br($profil['visi'] ?? '-') ?>
  </div>
</section>

<!-- ================= MISI ================= -->
<section>
  <div class="bg-white p-6 sm:p-8 rounded-xl text-gray-700 text-center leading-relaxed text-sm sm:text-base">
    <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">MISI</h2>
    <?= nl2br($profil['misi'] ?? '-') ?>
  </div>
</section>

<!-- ================= SEJARAH ================= -->
<section>
  <div class="bg-white p-6 sm:p-8 rounded-xl text-gray-700 text-center leading-relaxed text-sm sm:text-base">
    <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Sejarah Desa</h2>
    <?= nl2br($profil['sejarah'] ?? '-') ?>
  </div>
</section>

<!-- ================= PEMERINTAHAN ================= -->
<section>
<h2 class="text-xl sm:text-2xl font-semibold mb-6 sm:mb-8 text-center sm:text-left">
  Pemerintahan Desa
</h2>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
<?php if (mysqli_num_rows($qStruktur) > 0): ?>
<?php while ($s = mysqli_fetch_assoc($qStruktur)): ?>

<?php
$gambarFile = $s['gambar'];
$gambarPath = "uploads/struktur/" . $gambarFile;
?>

<div class="border rounded-xl p-3 sm:p-4 text-center shadow-sm bg-white">
  <?php if (!empty($gambarFile) && file_exists($gambarPath)): ?>
    <img src="<?= $gambarPath ?>"
         class="w-16 h-16 sm:w-20 sm:h-20 mx-auto object-cover rounded-lg mb-2 sm:mb-3">
  <?php else: ?>
    <img src="assets/img/no-image.png"
         class="w-16 h-16 sm:w-20 sm:h-20 mx-auto object-cover rounded-lg mb-2 sm:mb-3">
  <?php endif; ?>

  <p class="font-semibold text-xs sm:text-sm leading-tight">
    <?= htmlspecialchars($s['jabatan']) ?>
  </p>
  <p class="text-[11px] sm:text-xs text-gray-500">
    <?= htmlspecialchars($s['nama']) ?>
  </p>
</div>

<?php endwhile; ?>
<?php endif; ?>
</div>
</section>

<!-- ================= BATAS & PETA ================= -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10 items-start">

  <!-- CARD INFO DESA -->
  <div class="bg-white p-6 sm:p-8 rounded-xl shadow space-y-6">

    <!-- BATAS WILAYAH -->
    <div>
      <h3 class="font-semibold text-lg mb-4">Batas Wilayah Desa</h3>

      <?php if ($batas): ?>
      <ul class="text-sm text-gray-700 divide-y">
        <li class="py-2 flex justify-between">
          <span class="font-medium">Utara</span>
          <span><?= $batas['utara'] ?></span>
        </li>
        <li class="py-2 flex justify-between">
          <span class="font-medium">Barat</span>
          <span><?= $batas['barat'] ?></span>
        </li>
        <li class="py-2 flex justify-between">
          <span class="font-medium">Timur</span>
          <span><?= $batas['timur'] ?></span>
        </li>
        <li class="py-2 flex justify-between">
          <span class="font-medium">Selatan</span>
          <span><?= $batas['selatan'] ?></span>
        </li>
      </ul>
      <?php endif; ?>
    </div>

    <!-- INFORMASI WILAYAH -->
    <div>
      <h3 class="font-semibold text-lg mb-4">Informasi Wilayah</h3>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
        <div class="border rounded-lg p-4">
          <p class="text-gray-500">Luas Wilayah</p>
          <p class="font-semibold"><?= $profil['luas_wilayah'] ?? '-' ?></p>
        </div>

        <div class="border rounded-lg p-4">
          <p class="text-gray-500">Jumlah Dusun</p>
          <p class="font-semibold"><?= $profil['jumlah_dusun'] ?? '-' ?></p>
        </div>

        <div class="border rounded-lg p-4">
          <p class="text-gray-500">Jumlah RT</p>
          <p class="font-semibold"><?= $profil['jumlah_rt'] ?? '-' ?></p>
        </div>

        <div class="border rounded-lg p-4 sm:col-span-2">
          <p class="text-gray-500">Nama Dusun</p>
          <p class="font-semibold"><?= $profil['nama_dusun'] ?? '-' ?></p>
        </div>
      </div>
    </div>

  </div>

  <!-- CARD PETA -->
  <div class="bg-white p-5 sm:p-6 rounded-xl shadow">
    <h3 class="font-semibold text-lg mb-4">Peta Desa Ngargosari</h3>

    <div class="rounded-xl overflow-hidden border">
      <iframe
        class="w-full h-60 sm:h-72 md:h-80"
        src="https://www.google.com/maps?q=Desa+Ngargosari+Loano+Purworejo&output=embed"
        loading="lazy">
      </iframe>
    </div>
  </div>

</section>

</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
</body>
</html>
