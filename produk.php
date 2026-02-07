<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
include "partials/header.php";

/* AMBIL DATA PRODUK (TANPA PAGINATION) */
$data = mysqli_query($koneksi,"
    SELECT * FROM produk
    ORDER BY id_produk DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Produk Unggulan Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-white text-gray-800">

<!-- ===== CONTENT ===== -->
<main class="max-w-7xl mx-auto px-6 py-12">

    <!-- GRID PRODUK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">

        <?php while($p = mysqli_fetch_assoc($data)): ?>
        <a href="produk_detail.php?id=<?= $p['id_produk'] ?>"
           class="group w-full max-w-xs bg-white border rounded-lg overflow-hidden
                  hover:-translate-y-2 hover:shadow-xl transition">

            <img src="assets/img/produk/<?= htmlspecialchars($p['gambar']) ?>"
                 class="w-full h-48 object-cover">

            <div class="p-4">
                <p class="font-medium text-center group-hover:text-green-700 transition">
                    <?= htmlspecialchars($p['nama_produk']) ?>
                </p>
            </div>
        </a>
        <?php endwhile; ?>

    </div>

</main>

<?php include "partials/footer.php"; ?>
</body>
</html>
