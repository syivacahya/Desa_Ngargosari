<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . "/../partials/header.php";

/* Ambil semua berita */
$query = mysqli_query($koneksi, "
    SELECT id, judul, isi, gambar, tanggal
    FROM berita
    ORDER BY tanggal DESC
");
?>

<div class="bg-gray-100 flex flex-col min-h-screen">

  <main class="flex-1">

    <section class="max-w-7xl mx-auto px-6 py-16">
      <h1 class="text-3xl font-semibold text-center mb-12">Berita Desa</h1>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php if (mysqli_num_rows($query) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($query)): ?>

            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">

              <img
                src="../assets/img/berita/<?= htmlspecialchars($row['gambar']) ?>"
                class="w-full h-40 object-cover"
                onerror="this.src='../assets/img/no-image.png'"
              >

              <div class="p-4 space-y-2">
                <p class="text-xs text-gray-500">
                  <?= date('d F Y', strtotime($row['tanggal'])) ?>
                </p>

                <h2 class="text-base font-semibold line-clamp-2">
                  <?= htmlspecialchars($row['judul']) ?>
                </h2>

                <p class="text-gray-600 text-sm line-clamp-3">
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

          <div class="col-span-full text-center text-gray-500 py-24">
            Belum ada berita.
          </div>

        <?php endif; ?>

      </div>
    </section>

  </main>

  <?php require_once __DIR__ . "/../partials/footer.php"; ?>
</div>
