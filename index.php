<?php
require_once "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Desa Ngargosari</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

<!-- ===== HEADER ===== -->
<header class="bg-green-800 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3 font-semibold">
            <img src="assets/img/logo.png" alt="Logo Desa" class="w-10">
            Desa Ngargosari
        </div>
        <nav class="hidden md:flex gap-6 text-sm">
            <a href="index.php"
               class="<?= $halaman=='index.php' ? 'underline font-semibold' : 'hover:underline' ?>">
               Home
            </a>
            <a href="profil-desa.php"
               class="<?= $halaman=='profil-desa.php' ? 'underline font-semibold' : 'hover:underline' ?>">
               Profil Desa
            </a>
            <a href="produk.php"
               class="<?= $halaman=='produk.php' ? 'underline font-semibold' : 'hover:underline' ?>">
               Produk Unggulan
            </a>
            <a href="infografis.php"
               class="<?= $halaman=='infografis.php' ? 'underline font-semibold' : 'hover:underline' ?>">
               Infografis
            </a>
            <a href="berita.php"
               class="<?= $halaman=='berita.php' ? 'underline font-semibold' : 'hover:underline' ?>">
               Berita
            </a>
            <a href="galeri.php"
               class="<?= $halaman=='galeri.php' ? 'underline font-semibold' : 'hover:underline' ?>">
               Galeri
            </a>
        </nav>
    </div>
</header>

<!-- ===== HERO ===== -->
<section class="bg-green-200 h-64 flex items-center">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-2xl md:text-3xl font-semibold text-green-900">
            Selamat Datang di<br>Website Resmi Desa Ngargosari
        </h1>
    </div>
</section>

<!-- ===== PROFIL ===== -->
<section class="max-w-7xl mx-auto px-6 py-12 bg-white text-center">
    <img src="assets/img/logo.png" class="w-28 mx-auto mb-4">
    <h2 class="text-xl font-semibold text-green-800 mb-3">Desa Ngargosari</h2>
    <p class="max-w-3xl mx-auto text-gray-600">
        Desa Ngargosari merupakan salah satu desa yang berada di Kecamatan Loano,
        Kabupaten Purworejo. Desa ini memiliki potensi UMKM dan sumber daya alam
        yang terus dikembangkan untuk kesejahteraan masyarakat.
    </p>
</section>

<!-- ===== MAP ===== -->
<section class="max-w-7xl mx-auto px-6 py-12 bg-white mt-10">
    <h2 class="text-xl font-semibold text-green-800 mb-5">Peta Desa</h2>
    <img src="assets/img/peta-desa.png" class="rounded-xl w-full">
</section>

<!-- ===== PRODUK ===== -->
<section class="max-w-7xl mx-auto px-6 py-12 bg-white mt-10">
    <h2 class="text-xl font-semibold text-green-800 mb-6">Produk Unggulan</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        $q = mysqli_query($koneksi,"SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");
        while($p = mysqli_fetch_assoc($q)){
        ?>
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="assets/img/produk/<?= $p['gambar'] ?>" class="w-full h-40 object-cover">
            <div class="p-4 text-center">
                <h4 class="font-semibold"><?= htmlspecialchars($p['nama_produk']) ?></h4>
                <div class="text-orange-600 font-semibold mt-1">
                    Rp <?= number_format($p['harga']) ?>
                </div>
                <a target="_blank"
                   href="https://wa.me/<?= $p['no_wa'] ?>?text=Halo%20saya%20tertarik%20produk%20<?= urlencode($p['nama_produk']) ?>"
                   class="inline-block mt-3 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                   💬 Pesan
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="bg-green-800 text-white text-center py-6 mt-12 text-sm">
    © <?= date('Y') ?> Pemerintah Desa Ngargosari<br>
    Kecamatan Loano – Kabupaten Purworejo
</footer>

</body>
</html>
