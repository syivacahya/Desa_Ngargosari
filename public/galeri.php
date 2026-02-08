<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/../partials/header.php";

// Ambil data galeri
$data = mysqli_query($koneksi, "SELECT id, judul, gambar FROM galeri ORDER BY id DESC");
?>

<!-- WRAPPER UTAMA -->
<div class="flex flex-col min-h-screen bg-gray-100">

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-7xl mx-auto px-6 py-12 w-full">

        <!-- TITLE -->
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-10">
            Galeri Desa
        </h1>

        <?php if (mysqli_num_rows($data) == 0): ?>

            <div class="flex items-center justify-center h-64">
                <p class="text-gray-500 text-lg text-center">
                    Belum ada data galeri.
                </p>
            </div>

        <?php else: ?>

            <!-- GRID GALERI -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

                <?php while ($g = mysqli_fetch_assoc($data)): ?>

                <?php
                    $gambarFile = $g['gambar'];
                    $gambarPath = "assets/img/galeri/" . $gambarFile;

                    if (empty($gambarFile) || !file_exists($gambarPath)) {
                        $gambarPath = "assets/img/no-image.png";
                    }
                ?>

                <div class="relative overflow-hidden rounded-lg shadow cursor-pointer group aspect-square"
                     onclick="openGalleryModal(
                        '<?= $gambarPath ?>',
                        '<?= htmlspecialchars($g['judul'], ENT_QUOTES) ?>'
                     )">

                    <img src="<?= $gambarPath ?>"
                         alt="<?= htmlspecialchars($g['judul']) ?>"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end">
                        <div class="p-3 text-white text-sm font-medium">
                            <?= htmlspecialchars($g['judul']) ?>
                        </div>
                    </div>

                </div>

                <?php endwhile; ?>

            </div>

        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . "/../partials/footer.php"; ?>

</div>

<!-- MODAL GALERI -->
<div id="galleryModal"
     class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 px-4">

    <div class="absolute inset-0" onclick="closeGalleryModal()"></div>

    <div class="relative z-10 bg-white rounded-xl max-w-4xl w-full overflow-hidden shadow-xl">

        <button onclick="closeGalleryModal()"
                class="absolute top-3 right-3 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black">
            ✕
        </button>

        <img id="modalImage"
             src=""
             class="w-full max-h-[70vh] object-contain bg-black">

        <div class="p-4">
            <h3 id="modalTitle"
                class="text-lg font-semibold text-gray-800"></h3>
        </div>

    </div>
</div>

<script>
function openGalleryModal(gambar, judul) {
    document.getElementById('modalImage').src = gambar;
    document.getElementById('modalTitle').innerText = judul;

    const modal = document.getElementById('galleryModal');
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
