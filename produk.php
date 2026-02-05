<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
include "partials/header.php";

/* PAGINATION */
$batas = 4;
$hal   = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$mulai = ($hal - 1) * $batas;

$total = mysqli_num_rows(mysqli_query($koneksi,"SELECT id_produk FROM produk"));
$pages = ceil($total / $batas);

$data = mysqli_query($koneksi,"
    SELECT * FROM produk
    ORDER BY id_produk DESC
    LIMIT $mulai, $batas
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

    <!-- PAGINATION -->
    <div class="flex justify-center mt-12 gap-2">
        <?php for($i=1;$i<=$pages;$i++): ?>
            <a href="?hal=<?= $i ?>"
               class="px-3 py-1 border rounded text-sm
               <?= $i==$hal
                    ? 'bg-green-700 text-white border-green-700'
                    : 'hover:bg-gray-100' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</main>



</body>
</html>
<?php include "partials/footer.php"; ?>
