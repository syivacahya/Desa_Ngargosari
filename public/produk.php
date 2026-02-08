<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/../partials/header.php";

/* AMBIL DATA PRODUK */
$data = mysqli_query($koneksi,"
    SELECT * FROM produk
    ORDER BY id_produk DESC
");
?>

<!-- WRAPPER UTAMA -->
<div class="flex flex-col min-h-screen bg-white text-gray-800">

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-7xl mx-auto px-6 py-12 w-full">

        <!-- TITLE KONTEN -->
        <h1 class="text-3xl font-semibold text-center mb-10">
            Produk Unggulan Desa
        </h1>

        <!-- GRID PRODUK -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">

            <?php if (mysqli_num_rows($data) > 0): ?>

                <?php while($p = mysqli_fetch_assoc($data)): ?>

                <a href="produk_detail.php?id=<?= $p['id_produk'] ?>"
                   class="group w-full max-w-xs bg-white border rounded-lg overflow-hidden
                          hover:-translate-y-2 hover:shadow-xl transition">

                    <img src="../assets/img/produk/<?= htmlspecialchars($p['gambar']) ?>"
                         class="w-full h-48 object-cover"
                         onerror="this.src='../assets/img/no-image.png'">

                    <div class="p-4">
                        <p class="font-medium text-center group-hover:text-green-700 transition">
                            <?= htmlspecialchars($p['nama_produk']) ?>
                        </p>
                    </div>
                </a>

                <?php endwhile; ?>

            <?php else: ?>

                <!-- KONDISI KOSONG -->
                <div class="col-span-full flex items-center justify-center h-64">
                    <p class="text-gray-500 text-lg text-center">
                        Belum ada produk unggulan.
                    </p>
                </div>

            <?php endif; ?>

        </div>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . "/../partials/footer.php"; ?>

</div>
