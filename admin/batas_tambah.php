<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";


// Cek apakah batas wilayah sudah ada
$cek = mysqli_query($koneksi, "SELECT id FROM batas_wilayah LIMIT 1");
if (mysqli_num_rows($cek) > 0) {
    header("Location: profil.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $utara   = mysqli_real_escape_string($koneksi, $_POST['utara']);
    $timur   = mysqli_real_escape_string($koneksi, $_POST['timur']);
    $selatan = mysqli_real_escape_string($koneksi, $_POST['selatan']);
    $barat   = mysqli_real_escape_string($koneksi, $_POST['barat']); // FIX

    mysqli_query($koneksi, "
        INSERT INTO batas_wilayah (utara, timur, selatan, barat)
        VALUES ('$utara', '$timur', '$selatan', '$barat')
    ");

    header("Location: profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Batas Wilayah</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 font-poppins">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white">
        <div class="flex flex-col items-center py-6 border-b border-white/20">
            <img src="../assets/img/logo.png" class="w-20 mb-3">
            <span class="text-sm font-semibold tracking-wider">ADMIN DESA</span>
        </div>

        <nav class="mt-4 text-sm">
            <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
            <a href="profil.php" class="block px-6 py-3 bg-white/20">📌 Profil Desa</a>
            <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
            <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
            <a href="berita.php" class="block px-6 py-3 hover:bg-white/20">📰 Berita</a>
            <a href="galeri.php" class="block px-6 py-3 hover:bg-white/20">🖼️ Galeri</a>
            <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <div class="flex-1 ml-60">

        <!-- HEADER -->
        <header class="bg-white px-8 py-5 shadow">
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Batas Wilayah Desa
            </h2>
            <p class="text-sm text-gray-500">Profil Desa</p>
        </header>

        <!-- MAIN -->
        <main class="p-8 flex justify-center">

            <form method="post"
                  class="bg-white w-full max-w-xl p-6 rounded-xl shadow space-y-4">

                <h3 class="text-lg font-semibold text-gray-800">
                    Form Batas Wilayah
                </h3>

                <input type="text" name="utara" placeholder="Batas Utara"
                       class="w-full border rounded px-3 py-2" required>

                <input type="text" name="timur" placeholder="Batas Timur"
                       class="w-full border rounded px-3 py-2" required>

                <input type="text" name="selatan" placeholder="Batas Selatan"
                       class="w-full border rounded px-3 py-2" required>

                <input type="text" name="barat" placeholder="Batas Barat"
                       class="w-full border rounded px-3 py-2" required>

                <div class="flex gap-3 pt-4">
                    <button type="submit" name="simpan"
                            class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded">
                        Simpan
                    </button>

                    <a href="profil.php"
                       class="px-5 py-2 rounded border text-gray-600 hover:bg-gray-100">
                        Kembali
                    </a>
                </div>
            </form>

        </main>

    </div>
</div>

</body>
</html>
