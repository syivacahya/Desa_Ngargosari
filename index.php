<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/partials/header.php";
?>

<!-- ================= HERO ================= -->
<section class="relative min-h-[90vh] sm:min-h-screen flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="assets/img/bgindex.jpg"
             class="w-full h-full object-cover"
             alt="Background Desa Ngargosari">
    </div>
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 text-white text-center md:text-left">
        <img src="assets/img/logo.png"
             class="w-20 sm:w-28 mx-auto md:mx-0 mb-4"
             alt="Logo Desa Ngargosari">

        <h1 class="text-2xl sm:text-3xl md:text-5xl font-bold leading-tight">
            Selamat Datang di<br>Website Resmi Desa Ngargosari
        </h1>

        <p class="mt-4 max-w-xl mx-auto md:mx-0 text-sm sm:text-base text-white/90">
            Desa Ngargosari merupakan salah satu desa di Kecamatan Loano,
            Kabupaten Purworejo dengan potensi UMKM dan sumber daya alam
            yang terus berkembang.
        </p>
    </div>
</section>

<!-- ================= MAP ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-6 bg-white text-center mt-8 sm:mt-10 rounded-xl shadow">
    <h3 class="font-semibold py-3 sm:py-4 text-base sm:text-lg">
        📍 Lokasi Desa Ngargosari
    </h3>

    <iframe
        class="w-full h-60 sm:h-72 rounded-lg"
        src="https://www.google.com/maps?q=Desa+Ngargosari+Loano+Purworejo&output=embed"
        loading="lazy">
    </iframe>
</section>

<!-- ================= PRODUK ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-14 bg-white mt-8 sm:mt-10 rounded-xl shadow">
    <h2 class="text-xl sm:text-2xl font-semibold text-green-800 mb-6 sm:mb-8 text-center">
        Produk Unggulan
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-6">
        <?php
        $qProduk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 4");
        if ($qProduk && mysqli_num_rows($qProduk) > 0):
            while ($p = mysqli_fetch_assoc($qProduk)):
                $imgProduk = !empty($p['gambar'])
                    ? "assets/img/produk/".htmlspecialchars($p['gambar'])
                    : "assets/img/no-image.png";
                $noWA = !empty($p['no_wa']) ? htmlspecialchars($p['no_wa']) : '';
        ?>
        <div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden group">
            <img src="<?= $imgProduk ?>"
                 class="w-full h-36 sm:h-40 object-cover group-hover:scale-105 transition"
                 onerror="this.src='/assets/img/no-image.png'"
                 alt="<?= htmlspecialchars($p['nama_produk']); ?>">

            <div class="p-4 text-center">
                <h4 class="font-semibold text-sm sm:text-base">
                    <?= htmlspecialchars($p['nama_produk']); ?>
                </h4>

                <div class="text-orange-600 font-semibold mt-1 text-sm sm:text-base">
                    Rp <?= number_format($p['harga'] ?? 0); ?>
                </div>

                <?php if (!empty($noWA)): ?>
                <a target="_blank"
                   href="https://wa.me/<?= $noWA ?>"
                   class="inline-block mt-3 bg-green-600 hover:bg-green-700
                          text-white px-4 py-2 rounded-lg text-xs sm:text-sm">
                   💬 Pesan
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; else: ?>
            <p class="col-span-full text-center text-gray-500">
                Produk belum tersedia.
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- ================= BERITA TERBARU ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-14 bg-white mt-8 sm:mt-10 rounded-xl shadow">
    <h2 class="text-xl sm:text-2xl font-semibold text-green-800 mb-6 sm:mb-8 text-center">
        Berita Terbaru
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php
        $qBerita = mysqli_query($koneksi,"SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3");
        if ($qBerita && mysqli_num_rows($qBerita) > 0):
            while ($b = mysqli_fetch_assoc($qBerita)):
                $imgBerita = !empty($b['gambar'])
                    ? "assets/img/berita/".htmlspecialchars($b['gambar'])
                    : "assets/img/no-image.png";
        ?>
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="<?= $imgBerita ?>"
                 class="w-full h-36 sm:h-40 object-cover"
                 onerror="this.src='assets/img/no-image.png'"
                 alt="<?= htmlspecialchars($b['judul']); ?>">

            <div class="p-5">
                <h3 class="font-semibold text-base sm:text-lg">
                    <?= htmlspecialchars($b['judul']); ?>
                </h3>

                <p class="text-sm text-gray-600 mt-2">
                    <?= substr(strip_tags($b['isi']), 0, 120); ?>...
                </p>

                <?php if(!empty($b['id'])): ?>
                <a href="berita-detail.php?id=<?= (int)$b['id']; ?>"
                   class="inline-block mt-3 text-green-700
                          font-semibold text-sm hover:underline">
                   Baca Selengkapnya →
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; else: ?>
            <p class="col-span-full text-center text-gray-500">
                Belum ada berita.
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- ================= GALERI ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-14 bg-white mt-8 sm:mt-10 rounded-xl shadow">
    <h2 class="text-xl sm:text-2xl font-semibold text-green-800 mb-6 sm:mb-8 text-center">
        Galeri Desa
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php
        $qGaleri = mysqli_query(
            $koneksi,
            "SELECT id, judul, gambar FROM galeri ORDER BY id DESC LIMIT 8"
        );

        if ($qGaleri && mysqli_num_rows($qGaleri) > 0):
            while ($g = mysqli_fetch_assoc($qGaleri)):

                $gambarPath = "assets/img/galeri/".$g['gambar'];
                if (empty($g['gambar']) || !file_exists($gambarPath)) {
                    $gambarPath = "assets/img/no-image.png";
                }
        ?>
        <div class="relative overflow-hidden rounded-lg shadow cursor-pointer group"
             onclick="openGalleryModal(
                '<?= $gambarPath ?>',
                '<?= htmlspecialchars($g['judul'], ENT_QUOTES) ?>'
             )">

            <img src="<?= $gambarPath ?>"
                 class="w-full h-32 sm:h-40 object-cover
                        group-hover:scale-110 transition duration-300"
                 alt="<?= htmlspecialchars($g['judul']) ?>">

            <div class="absolute inset-0 bg-black/40 opacity-0
                        group-hover:opacity-100 transition flex items-end">
                <div class="p-3 text-white text-xs sm:text-sm font-medium">
                    <?= htmlspecialchars($g['judul']) ?>
                </div>
            </div>
        </div>
        <?php endwhile; else: ?>
            <p class="col-span-full text-center text-gray-500">
                Galeri belum tersedia.
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- ================= MODAL GALERI ================= -->
<div id="galleryModal"
     class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 px-4">

    <div class="absolute inset-0" onclick="closeGalleryModal()"></div>

    <div class="relative z-10 max-w-4xl w-full bg-white rounded-xl overflow-hidden shadow-xl">

        <button onclick="closeGalleryModal()"
                class="absolute top-3 right-3 bg-black/50 text-white
                       w-8 h-8 rounded-full flex items-center justify-center
                       hover:bg-black">
            ✕
        </button>

        <img id="galleryModalImg"
             src=""
             class="w-full max-h-[70vh] object-contain bg-black">

        <div class="p-4">
            <h3 id="galleryModalTitle"
                class="text-base sm:text-lg font-semibold text-gray-800">
            </h3>
        </div>
    </div>
</div>

<script>
function openGalleryModal(imgSrc, judul) {
    const modal = document.getElementById('galleryModal');
    document.getElementById('galleryModalImg').src = imgSrc;
    document.getElementById('galleryModalTitle').innerText = judul;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}
</script>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
