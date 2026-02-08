<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
include "partials/header.php";

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
  <title>Berita Desa | Ngargosari</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- WRAPPER UTAMA -->
<div class="flex flex-col min-h-screen">

  <!-- MAIN CONTENT -->
  <main class="flex-1">

    <section class="max-w-7xl mx-auto px-6 py-16">
      <h1 class="text-3xl font-semibold text-center mb-12">Berita Desa</h1>

      <!-- GRID -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php if (mysqli_num_rows($query) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($query)): ?>

            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">

              <!-- Gambar -->
              <img
                src="assets/img/berita/<?= htmlspecialchars($row['gambar']) ?>"
                class="w-full h-40 object-cover"
                onerror="this.src='assets/img/no-image.png'"
              >

              <!-- Konten -->
              <div class="p-4 space-y-2">
                <p class="text-xs text-gray-500">
                  <?= date('d F Y', strtotime($row['tanggal'])) ?>
                </p>

                <h2 class="text-base font-semibold leading-snug line-clamp-2">
                  <?= htmlspecialchars($row['judul']) ?>
                </h2>

                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                  <?= substr(strip_tags($row['isi']), 0, 90) ?>...
                </p>

                <a href="berita-detail.php?id=<?= $row['id'] ?>"
                   class="inline-block mt-2 text-green-700 text-sm font-semibold hover:underline">
                  Baca Selengkapnya →
                </a>
              </div>

            </article>

          <?php endwhile; ?>
        <?php else: ?>

          <!-- KONDISI KOSONG -->
          <div class="col-span-full flex items-center justify-center h-64">
            <p class="text-center text-gray-500 text-lg">
              Belum ada berita.
            </p>
          </div>

        <?php endif; ?>

      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <?php include "partials/footer.php"; ?>

</div>

</body>
</html>
