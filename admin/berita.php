<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$query = mysqli_query(
    $koneksi,
    "SELECT id, judul, isi, gambar, tanggal 
     FROM berita 
     ORDER BY tanggal DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Desa – Berita</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

<!-- ===== SIDEBAR ===== -->
<aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="tracking-wider font-semibold text-sm">ADMIN DESA</span>
    </div>

    <nav class="mt-4 text-sm">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 hover:bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
        <a href="berita.php" class="block px-6 py-3 bg-white/20 font-semibold">📰 Berita</a>
        <a href="galeri.php" class="block px-6 py-3 hover:bg-white/20">🖼️ Galeri</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<!-- ===== CONTENT ===== -->
<main class="ml-60 flex-1">

    <!-- HEADER -->
    <header class="bg-white px-8 py-5 shadow flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Berita Desa</h2>
            <p class="text-gray-500 text-sm">Kelola berita Desa Ngargosari</p>
        </div>
    </header>

    <!-- CONTENT -->
    <section class="p-8">
        <div class="bg-white rounded-lg shadow p-6 max-w-6xl mx-auto">

            <!-- BUTTON TAMBAH -->
            <div class="flex justify-end mb-4">
                <a href="berita_tambah.php"
                   class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                    ➕ Tambah Berita
                </a>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 w-32 text-center">Tanggal</th>
                            <th class="border px-4 py-2 text-left">Judul</th>
                            <th class="border px-4 py-2 text-left">Isi</th>
                            <th class="border px-4 py-2 w-32 text-center">Gambar</th>
                            <th class="border px-4 py-2 w-36 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-center">
                                <?= date('d-m-Y', strtotime($row['tanggal'])) ?>
                            </td>

                            <td class="border px-4 py-2 font-medium">
                                <?= htmlspecialchars($row['judul']) ?>
                            </td>

                            <td class="border px-4 py-2 max-w-sm">
                                <?= htmlspecialchars(mb_strimwidth($row['isi'], 0, 80, '…')) ?>
                            </td>

                            <td class="border px-4 py-2 text-center">
                                <?php if (!empty($row['gambar'])): ?>
                                    <img src="../assets/img/berita/<?= htmlspecialchars($row['gambar']) ?>"
                                         class="w-20 h-14 object-cover mx-auto rounded">
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td class="border px-4 py-2">
                                <div class="flex justify-center items-center gap-2">

                                    <a href="berita_edit.php?id=<?= $row['id'] ?>"
                                       class="inline-flex items-center justify-center
                                              bg-yellow-400 hover:bg-yellow-500
                                              text-black px-3 py-1.5
                                              rounded-md text-xs font-medium
                                              transition whitespace-nowrap">
                                        ✏️ Edit
                                    </a>

                                    <a href="berita_hapus.php?id=<?= $row['id'] ?>"
                                       onclick="return confirm('Yakin ingin menghapus berita ini?')"
                                       class="inline-flex items-center justify-center
                                              bg-red-500 hover:bg-red-600
                                              text-white px-3 py-1.5
                                              rounded-md text-xs font-medium
                                              transition whitespace-nowrap">
                                        🗑️ Hapus
                                    </a>

                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="border px-4 py-6 text-center text-gray-500">
                                Belum ada data berita
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </section>

</main>
</div>

</body>
</html>
