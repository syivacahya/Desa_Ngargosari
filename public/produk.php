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
<div class="flex flex-col min-h-screen bg-[#F9FAFB] text-gray-800">

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12 w-full">

        <!-- TITLE KONTEN -->
        <h1 class="text-2xl sm:text-3xl font-semibold text-center mb-8 sm:mb-10">
            Produk Unggulan Desa
        </h1>

        <!-- GRID PRODUK -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 
                    gap-5 sm:gap-6 justify-items-center">

            <?php if (mysqli_num_rows($data) > 0): ?>
                <?php while($p = mysqli_fetch_assoc($data)): ?>

                <a href="produk_detail.php?id=<?= $p['id_produk'] ?>"
                   class="group w-full max-w-xs bg-white border rounded-xl overflow-hidden
                          transition duration-300
                          hover:-translate-y-2 hover:shadow-xl">

                    <!-- GAMBAR -->
                    <div class="overflow-hidden">
                        <img src="../assets/img/produk/<?= htmlspecialchars($p['gambar']) ?>"
                             class="w-full h-44 sm:h-48 object-cover
                                    group-hover:scale-105 transition duration-300"
                             onerror="this.src='../assets/img/no-image.png'">
                    </div>

                    <!-- INFO -->
                    <div class="p-4">
                        <p class="font-medium text-center text-sm sm:text-base
                                  group-hover:text-green-700 transition">
                            <?= htmlspecialchars($p['nama_produk']) ?>
                        </p>
                    </div>
                </a>

                <?php endwhile; ?>
            <?php else: ?>

                <!-- KONDISI KOSONG -->
                <div class="col-span-full flex items-center justify-center h-64">
                    <p class="text-gray-500 text-base sm:text-lg text-center">
                        Belum ada produk unggulan.
                    </p>
                </div>

            <?php endif; ?>

        </div>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . "/../partials/footer.php"; ?>

</div>
