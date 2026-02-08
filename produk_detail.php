<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/partials/header.php";

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = (int)$_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Produk tidak ditemukan";
    exit;
}

// Siapkan link WA
$no_wa = $data['no_wa'];
$pesan = urlencode(
    "Halo, saya tertarik dengan produk:\n".
    "Nama : ".$data['nama_produk']."\n".
    "Harga : Rp ".number_format($data['harga'],0,',','.')." / 1 pcs\n".
    "Apakah masih tersedia"
);
$link_wa = "https://wa.me/$no_wa?text=$pesan";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['nama_produk']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F9FAFB] font-sans text-gray-800">

<main class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-12">

    <!-- GRID UTAMA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10 items-start">

        <!-- GAMBAR PRODUK -->
        <div class="w-full">
            <div class="rounded-xl overflow-hidden shadow-lg bg-white">
                <img src="assets/img/produk/<?= htmlspecialchars($data['gambar']) ?>"
                     alt="<?= htmlspecialchars($data['nama_produk']) ?>"
                     class="w-full h-64 sm:h-80 md:h-[380px] object-cover"
                     onerror="this.src='assets/img/no-image.png'">
            </div>
        </div>

        <!-- DETAIL PRODUK -->
        <div class="bg-white rounded-xl shadow p-5 sm:p-6">

            <h1 class="text-2xl sm:text-3xl font-semibold mb-4">
                <?= htmlspecialchars($data['nama_produk']) ?>
            </h1>

            <!-- DESKRIPSI -->
            <?php if (!empty($data['deskripsi'])): ?>
            <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-4">
                <?= nl2br(htmlspecialchars($data['deskripsi'])) ?>
            </p>
            <?php endif; ?>

            <!-- LOKASI -->
            <?php if (!empty($data['lokasi'])): ?>
            <p class="text-gray-700 text-sm sm:text-base mb-3">
                <span class="font-medium">Lokasi:</span>
                <?= nl2br(htmlspecialchars($data['lokasi'])) ?>
            </p>
            <?php endif; ?>

            <!-- HARGA -->
            <?php if (!empty($data['harga'])): ?>
            <p class="text-gray-900 font-semibold text-base sm:text-lg mb-5">
                Harga: Rp <?= number_format($data['harga'],0,',','.') ?>
            </p>
            <?php endif; ?>

            <!-- TOMBOL AKSI -->
            <div class="flex flex-col sm:flex-row gap-3 mt-6">
                <a href="<?= $link_wa ?>" target="_blank"
                   class="bg-green-500 hover:bg-green-600 text-white
                          px-5 py-3 rounded-lg text-center
                          inline-flex items-center justify-center gap-2
                          transition">
                    💬 Pesan via WhatsApp
                </a>

                <a href="produk.php"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800
                          px-5 py-3 rounded-lg text-center transition">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>

</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
</body>
</html>
