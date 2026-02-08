<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";


if (isset($_POST['simpan'])) {

    $visi          = mysqli_real_escape_string($koneksi, $_POST['visi']);
    $misi          = mysqli_real_escape_string($koneksi, $_POST['misi']);
    $sejarah       = mysqli_real_escape_string($koneksi, $_POST['sejarah']);
    $luas_wilayah  = mysqli_real_escape_string($koneksi, $_POST['luas_wilayah']);
    $jumlah_rt     = (int) $_POST['jumlah_rt'];
    $jumlah_dusun  = (int) $_POST['jumlah_dusun'];
    $nama_dusun    = mysqli_real_escape_string($koneksi, $_POST['nama_dusun']);

    $query = "
        INSERT INTO profil_desa 
        (visi, misi, sejarah, luas_wilayah, jumlah_rt, jumlah_dusun, nama_dusun)
        VALUES
        ('$visi', '$misi', '$sejarah', '$luas_wilayah', '$jumlah_rt', '$jumlah_dusun', '$nama_dusun')
    ";

    mysqli_query($koneksi, $query);

    header("Location: profil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Desa</title>

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

    <!-- ================= SIDEBAR ================= -->
    <aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white z-50">
        <div class="flex flex-col items-center py-6 border-b border-white/20">
            <img src="../assets/img/logo.png" class="w-20 mb-3">
            <span class="text-sm tracking-wider font-semibold">ADMIN DESA</span>
        </div>

        <nav class="mt-4 text-sm">
            <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
            <a href="profil.php" class="block px-6 py-3 hover:bg-white/20">📌 Profil Desa</a>
            <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
            <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
            <a href="berita.php" class="block px-6 py-3 hover:bg-white/20">📰 Berita</a>
            <a href="galeri.php" class="block px-6 py-3 hover:bg-white/20">🖼️ Galeri</a>
            <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
        </nav>
    </aside>

    <!-- ================= CONTENT ================= -->
    <div class="flex-1 ml-60">

        <!-- HEADER -->
        <header class="bg-white px-8 py-5 shadow">
            <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin Desa Ngargosari</h2>
            <p class="text-gray-500 text-sm">Profil Desa</p>
        </header>

        <main class="p-8 space-y-10">

<body class="bg-gray-100 p-10">

<form method="post" class="bg-white p-6 rounded shadow max-w-2xl mx-auto space-y-4">
    <h2 class="text-xl font-semibold text-gray-800">Tambah Profil Desa</h2>

    <textarea name="visi" placeholder="Visi Desa" class="w-full border p-2 rounded" required></textarea>

    <textarea name="misi" placeholder="Misi Desa" class="w-full border p-2 rounded" required></textarea>

    <textarea name="sejarah" placeholder="Sejarah Desa" class="w-full border p-2 rounded" rows="4" required></textarea>

    <input type="text" name="luas_wilayah" placeholder="Luas Wilayah" class="w-full border p-2 rounded" required>

    <input type="number" name="jumlah_rt" placeholder="Jumlah RT" class="w-full border p-2 rounded" required>

    <input type="number" name="jumlah_dusun" placeholder="Jumlah Dusun" class="w-full border p-2 rounded" required>

    <input type="text" name="nama_dusun" placeholder="Nama Dusun (pisahkan dengan koma)" class="w-full border p-2 rounded" required>

    <div class="flex gap-3">
        <button type="submit" name="simpan"
            class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">
            💾 Simpan
        </button>

        <a href="profil.php"
           class="px-4 py-2 rounded border text-gray-600 hover:bg-gray-100">
           Kembali
        </a>
    </div>
</form>

</body>
</html>
