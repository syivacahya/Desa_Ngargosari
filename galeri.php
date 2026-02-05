<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
include "partials/header.php";

// Ambil data galeri
$data = mysqli_query($koneksi, "SELECT id, judul, gambar FROM galeri ORDER BY id DESC");
?>

<main class="flex-1 max-w-7xl mx-auto px-6 py-12 bg-gray-100">

<?php if (mysqli_num_rows($data) == 0): ?>

    <p class="text-gray-500 text-center text-lg">Belum ada data galeri.</p>

<?php else: ?>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

<?php while ($g = mysqli_fetch_assoc($data)): ?>

<?php
$gambarFile = $g['gambar'];
$gambarPath = "assets/img/galeri/" . $gambarFile;

if (empty($gambarFile) || !file_exists($gambarPath)) {
    $gambarPath = "assets/img/no-image.png";
}
?>

<div class="relative overflow-hidden rounded-lg cursor-pointer group aspect-square shadow-sm"
     onclick="openGalleryModal(
        '<?= $gambarPath ?>',
        '<?= htmlspecialchars($g['judul'], ENT_QUOTES) ?>'
     )">

    <img src="<?= $gambarPath ?>"
         alt="<?= htmlspecialchars($g['judul']) ?>"
         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

    <!-- Overlay Judul -->
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

<!-- MODAL DETAIL GALERI -->
<div id="galleryModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center px-4">
    <div class="bg-white rounded-xl max-w-3xl w-full overflow-hidden relative">
        <button onclick="closeGalleryModal()"
                class="absolute top-3 right-3 text-white bg-black/50 rounded-full w-8 h-8 flex items-center justify-center">
            ✕
        </button>

        <img id="modalImage" src="" class="w-full max-h-[70vh] object-contain bg-black">

        <div class="p-4">
            <h3 id="modalTitle" class="text-lg font-semibold text-gray-800"></h3>
        </div>
    </div>
</div>

<script>
function openGalleryModal(gambar, judul){
    document.getElementById('modalImage').src = gambar;
    document.getElementById('modalTitle').innerText = judul;
    document.getElementById('galleryModal').classList.remove('hidden');
}

function closeGalleryModal(){
    document.getElementById('galleryModal').classList.add('hidden');
}
</script>

<?php include "partials/footer.php"; ?>
