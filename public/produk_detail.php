<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/../partials/header.php";

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
<body class="bg-white font-sans">

<main class="max-w-6xl mx-auto p-5 mt-10">
    <div class="grid md:grid-cols-2 gap-10 items-start">
        <!-- Gambar -->
        <div>
            <img src="../assets/img/produk/<?= $data['gambar'] ?>" alt="<?= htmlspecialchars($data['nama_produk']) ?>" class="w-full h-[350px] object-cover rounded-lg shadow-lg">
        </div>

        <!-- Detail Produk -->
        <div>
            <h1 class="text-3xl font-semibold mb-4"><?= htmlspecialchars($data['nama_produk']) ?></h1>

            <p class="text-gray-700 mb-3"><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
            <p class="text-gray-700 mb-3"><strong>Lokasi:</strong> <?= nl2br(htmlspecialchars($data['lokasi'])) ?></p>

            <?php if(!empty($data['harga'])){ ?>
                <p class="text-gray-800 font-medium mb-4"><strong>Harga :</strong> Rp <?= number_format($data['harga'],0,',','.') ?></p>
            <?php } ?>

            <div class="flex flex-wrap gap-3 mt-5">
                <a href="<?= $link_wa ?>" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md inline-flex items-center gap-2">
                    💬 Pesan via WhatsApp
                </a>
                <a href="produk.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">← Kembali</a>
            </div>
        </div>
    </div>
</main>

</body>
</html>
<?php require_once __DIR__ . "/../partials/footer.php"; ?>