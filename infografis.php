<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Infografis Desa Ngargosari</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- ================= HEADER ================= -->
<header class="bg-[#4a6b3c] text-white">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="assets/img/logo.png" class="w-10">
            <div>
                <h1 class="font-semibold text-sm">Desa Ngargosari</h1>
                <p class="text-xs opacity-80">Kecamatan Loano, Kabupaten Purworejo</p>
            </div>
        </div>
        <nav class="flex gap-6 text-sm">
            <a href="index.php">Home</a>
            <a href="profil-desa.php">Profil Desa</a>
            <a href="produk.php">Produk Unggulan Desa</a>
            <a href="infografis.php" class="font-semibold underline">Infografis</a>
        </nav>
    </div>
</header>

<!-- ================= CONTENT ================= -->
<main class="max-w-6xl mx-auto px-6 py-10 space-y-12">

<!-- ===== JUDUL ===== -->
<h2 class="text-xl font-semibold text-gray-800">Jumlah Penduduk</h2>

<!-- ===== KARTU DATA ===== -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<?php
// DATA CONTOH (NANTI BISA DIGANTI DATABASE)
$data = [
    ["Total Penduduk", "1.300 Jiwa"],
    ["Kepala Keluarga", "540 Jiwa"],
    ["Perempuan", "540 Jiwa"],
    ["Laki-Laki", "540 Jiwa"]
];

foreach($data as $d):
?>
<div class="bg-[#d8e4c9] rounded-lg p-5 flex items-center gap-4">
    <div class="w-12 h-12 bg-white rounded-full"></div>
    <div>
        <p class="text-sm text-gray-700"><?= $d[0] ?></p>
        <p class="font-semibold"><?= $d[1] ?></p>
    </div>
</div>
<?php endforeach; ?>

</div>

<!-- ===== GRAFIK UMUR ===== -->
<section class="space-y-6">

<h2 class="text-xl font-semibold text-gray-800">Berdasarkan Kelompok Umur</h2>

<!-- BAR CHART -->
<div class="bg-white p-6 rounded shadow">
    <div class="flex items-end gap-3 h-56">

        <?php
        // DATA GRAFIK (CONTOH)
        $umur = [70,90,60,100,80,50,70,110,40,85,120,95,60,80];
        foreach($umur as $i => $v):
        ?>
        <div class="flex-1 flex items-end gap-1">
            <div class="w-3 bg-[#b7cf9d]" style="height:<?= $v ?>%"></div>
            <div class="w-3 bg-[#3e5c2f]" style="height:<?= $v-20 ?>%"></div>
        </div>
        <?php endforeach; ?>

    </div>

    <div class="mt-6 space-y-2">
        <div class="bg-[#d8e4c9] p-2 rounded text-sm">total kelompok tertinggi</div>
        <div class="bg-[#3e5c2f] text-white p-2 rounded text-sm">total kelompok terendah</div>
    </div>
</div>

</section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-[#4a6b3c] text-white mt-16">
    <div class="max-w-6xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-6 text-sm">
        <div>
            <img src="assets/img/logo.png" class="w-12 mb-3">
            <p class="font-semibold">Pemerintah Desa Ngargosari</p>
            <p>Kecamatan Loano, Kabupaten Purworejo</p>
        </div>
        <div>
            <p class="font-semibold mb-2">Hubungi Kami</p>
            <p>📞 08888888</p>
            <p>📷 Instagram</p>
        </div>
    </div>
    <div class="text-center text-xs py-3 bg-[#3a562e]">
        © 2026 Desa Ngargosari
    </div>
</footer>

</body>
</html>
