<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../public/koneksi.php";

$data = mysqli_fetch_assoc(mysqli_query($koneksi,
        "SELECT * FROM profil_desa WHERE id='$_GET[id]'"));

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "UPDATE profil_desa SET
        visi='" . mysqli_real_escape_string($koneksi, $_POST['visi']) . "',
        misi='" . mysqli_real_escape_string($koneksi, $_POST['misi']) . "',
        sejarah='" . mysqli_real_escape_string($koneksi, $_POST['sejarah']) . "',
        luas_wilayah='" . mysqli_real_escape_string($koneksi, $_POST['luas_wilayah']) . "',
        jumlah_rt='" . intval($_POST['jumlah_rt']) . "',
        jumlah_dusun='" . intval($_POST['jumlah_dusun']) . "',
        nama_dusun='" . mysqli_real_escape_string($koneksi, $_POST['nama_dusun']) . "'
        WHERE id='" . intval($_GET['id']) . "'
    ");
    header("Location: profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil Desa</title>

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
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Profil Desa</h2>
        </header>

        <main class="p-8 space-y-10">

        <form method="post" class="space-y-30 max-w-3xl mx-auto">

            <!-- CARD: Visi -->
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold mb-2">Visi</h3>
                <textarea name="visi" class="w-full border p-2 rounded" rows="3"><?= htmlspecialchars($data['visi']) ?></textarea>
            </div>

            <!-- CARD: Misi -->
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold mb-2">Misi</h3>
                <textarea name="misi" class="w-full border p-2 rounded" rows="3"><?= htmlspecialchars($data['misi']) ?></textarea>
            </div>

            <!-- CARD: Sejarah -->
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold mb-2">Sejarah</h3>
                <textarea name="sejarah" class="w-full border p-2 rounded" rows="4"><?= htmlspecialchars($data['sejarah']) ?></textarea>
            </div>

            <!-- CARD: Data Wilayah -->
            <div class="bg-white rounded shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Luas Wilayah</label>
                    <input type="text" name="luas_wilayah" value="<?= htmlspecialchars($data['luas_wilayah']) ?>" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block font-medium mb-1">Jumlah RT</label>
                    <input type="number" name="jumlah_rt" value="<?= htmlspecialchars($data['jumlah_rt']) ?>" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block font-medium mb-1">Jumlah Dusun</label>
                    <input type="number" name="jumlah_dusun" value="<?= htmlspecialchars($data['jumlah_dusun']) ?>" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block font-medium mb-1">Nama Dusun</label>
                    <input type="text" name="nama_dusun" value="<?= htmlspecialchars($data['nama_dusun']) ?>" class="w-full border p-2 rounded">
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <button name="update" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Update</button>
                <a href="profil.php" class="text-gray-600 hover:underline">Kembali</a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
