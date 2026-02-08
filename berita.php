<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/partials/header.php";

/* Ambil semua berita */
$query = mysqli_query($koneksi, "
    SELECT id, judul, isi, gambar, tanggal
    FROM berita
    ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Berita Desa | Desa Ngargosari</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

<main class="flex-1">

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">

    <!-- Judul -->
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-center mb-10">
      Berita Desa
    </h1>

    <!-- Grid Berita -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <?php if (mysqli_num_rows($query) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>

          <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">

            <!-- Gambar -->
            <div class="w-full aspect-[16/9] bg-gray-200">
              <img
                src="assets/img/berita/<?= htmlspecialchars($row['gambar']) ?>"
                alt="<?= htmlspecialchars($row['judul']) ?>"
                class="w-full h-full object-cover"
                onerror="this.src='assets/img/no-image.png'"
              >
            </div>

            <!-- Konten -->
            <div class="p-5 flex flex-col flex-1">

              <p class="text-xs text-gray-500 mb-1">
                <?= date('d F Y', strtotime($row['tanggal'])) ?>
              </p>

              <h2 class="text-base sm:text-lg font-semibold text-gray-900 line-clamp-2 mb-2">
                <?= htmlspecialchars($row['judul']) ?>
              </h2>

              <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                <?= substr(strip_tags($row['isi']), 0, 100) ?>...
              </p>

              <a href="berita-detail.php?id=<?= $row['id'] ?>"
                 class="mt-auto inline-flex items-center text-sm font-semibold text-green-700 hover:text-green-800">
                Baca Selengkapnya →
              </a>

            </div>

          </article>

        <?php endwhile; ?>
      <?php else: ?>

        <div class="col-span-full text-center text-gray-500 py-24">
          Belum ada berita.
        </div>

      <?php endif; ?>

    </div>

  </section>

</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>

</body>
</html>
