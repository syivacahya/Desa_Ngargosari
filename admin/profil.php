<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: admin/login.php");
    exit;
}

// PROSES UPLOAD STRUKTUR
if(isset($_POST['upload_struktur'])){
    $jabatan = $_POST['jabatan'];
    $nama    = $_POST['nama_pejabat'];

    $folder = "../assets/img/struktur/";
    if(!is_dir($folder)){
        mkdir($folder, 0777, true);
    }

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $ext  = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    $allowed = ['jpg','jpeg','png','webp'];
    if(!in_array($ext, $allowed)){
        die("Format file tidak didukung!");
    }

    $namaFile = time().".".$ext;
    move_uploaded_file($tmp, $folder.$namaFile);

    $success = "Struktur pemerintahan berhasil diupload";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{font-family:'Poppins',sans-serif}
</style>
</head>

<body class="bg-gray-100">

<div class="flex">

<!-- ================= SIDEBAR ================= -->
<aside class="w-64 min-h-screen bg-gradient-to-b from-green-900 to-green-700 text-white fixed">
    <div class="flex flex-col items-center p-6 border-b border-white/30">
        <img src="../assets/img/logo.png" class="w-20 mb-2">
        <span class="text-sm font-semibold tracking-wide">ADMIN DESA</span>
    </div>

    <nav class="mt-4">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-white/20">🚪 Logout</a>
    </nav>
</aside>

<!-- ================= MAIN ================= -->
<main class="ml-64 w-full">

<!-- HEADER -->
<header class="bg-white shadow px-8 py-5">
    <h2 class="text-xl font-semibold text-gray-800">Profil Desa</h2>
    <p class="text-sm text-gray-500">Kelola informasi & struktur pemerintahan desa</p>
</header>

<section class="p-8">

<div class="bg-white rounded-xl shadow p-6 max-w-4xl">

<?php if(isset($success)): ?>
    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800">
        <?= $success ?>
    </div>
<?php endif; ?>

<!-- ================= PROFIL DESA ================= -->
<div class="space-y-4">
    <div>
        <label class="font-medium text-green-800">Sejarah Singkat</label>
        <textarea rows="4" class="w-full mt-1 p-3 border rounded-lg"></textarea>
    </div>

    <div>
        <label class="font-medium text-green-800">Visi & Misi</label>
        <textarea rows="4" class="w-full mt-1 p-3 border rounded-lg"></textarea>
    </div>
</div>

<hr class="my-8">

<!-- ================= STRUKTUR ================= -->
<h3 class="text-lg font-semibold text-green-800 mb-4">
    Struktur Pemerintahan Desa
</h3>

<form method="post" enctype="multipart/form-data" class="space-y-4">

    <div>
        <label class="font-medium text-green-800">Jabatan</label>
        <input type="text" name="jabatan" required
               class="w-full mt-1 p-3 border rounded-lg"
               placeholder="Contoh: Kepala Desa">
    </div>

    <div>
        <label class="font-medium text-green-800">Nama Pejabat</label>
        <input type="text" name="nama_pejabat" required
               class="w-full mt-1 p-3 border rounded-lg">
    </div>

    <div>
        <label class="font-medium text-green-800">Foto</label>
        <input type="file" name="foto" accept="image/*" required
               class="w-full mt-1 p-2 border rounded-lg bg-white">
    </div>

    <div class="text-right">
        <button type="submit" name="upload_struktur"
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
            📤 Upload Struktur
        </button>
    </div>

</form>

</div>
</section>

</main>
</div>

</body>
</html>
