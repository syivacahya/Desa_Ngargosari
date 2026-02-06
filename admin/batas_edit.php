<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$id = (int) $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM batas_wilayah WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $utara   = mysqli_real_escape_string($koneksi, $_POST['utara']);
    $selatan = mysqli_real_escape_string($koneksi, $_POST['selatan']);
    $barat   = mysqli_real_escape_string($koneksi, $_POST['barat']);
    $timur   = mysqli_real_escape_string($koneksi, $_POST['timur']);

    $query = "UPDATE batas_wilayah SET
                utara='$utara',
                selatan='$selatan',
                barat='$barat',
                timur='$timur'
              WHERE id=$id";

    mysqli_query($koneksi, $query);

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

<body class="bg-gray-100 p-10">

<form method="post" class="bg-white p-6 rounded shadow max-w-xl mx-auto space-y-4">
    <h2 class="text-xl font-semibold text-gray-800">Edit Batas Wilayah Desa</h2>

        <label class="block font-bold mb-1">Utara</label>
        <input type="text" name="utara"
            value="<?= htmlspecialchars($row['utara']) ?>"
            required
            class="w-full border p-2 rounded mb-3">

        <label class="block font-bold mb-1">Timur</label>
        <input type="text" name="timur"
            value="<?= htmlspecialchars($row['timur']) ?>"
            required
            class="w-full border p-2 rounded mb-3">

        <label class="block font-bold mb-1">Selatan</label>
        <input type="text" name="selatan"
            value="<?= htmlspecialchars($row['selatan']) ?>"
            required
            class="w-full border p-2 rounded mb-3">

        <label class="block font-bold mb-1">Barat</label>
        <input type="text" name="barat"
            value="<?= htmlspecialchars($row['barat']) ?>"
            required
            class="w-full border p-2 rounded">


    <div class="flex gap-3">
        <button type="submit" name="update"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
             Update
        </button>

        <a href="profil.php"
           class="px-4 py-2 rounded border text-gray-600 hover:bg-gray-100">
           Kembali
        </a>
    </div>
</form>

</body>
</html>
