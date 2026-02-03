<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: admin/login.php");
    exit;
}
<<<<<<< HEAD
=======

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
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4
?>
<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
  <meta charset="UTF-8">
  <title>Admin Desa | Profil Desa</title>
  <script src="https://cdn.tailwindcss.com"></script>
=======
<meta charset="UTF-8">
<title>Profil Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{font-family:'Poppins',sans-serif}
</style>
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4
</head>

<body class="bg-gray-100">

<<<<<<< HEAD
<div class="flex min-h-screen">

<!-- ===== SIDEBAR ===== -->
<aside class="w-60 min-h-screen bg-gradient-to-b from-green-900 to-green-700 text-white flex-shrink-0 relative z-20">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="tracking-wider font-semibold text-sm">ADMIN DESA</span>
=======
<div class="flex">

<!-- ================= SIDEBAR ================= -->
<aside class="w-64 min-h-screen bg-gradient-to-b from-green-900 to-green-700 text-white fixed">
    <div class="flex flex-col items-center p-6 border-b border-white/30">
        <img src="../assets/img/logo.png" class="w-20 mb-2">
        <span class="text-sm font-semibold tracking-wide">ADMIN DESA</span>
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4
    </div>

    <nav class="mt-4">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
<<<<<<< HEAD
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<!-- ===== MAIN CONTENT ===== -->
<main class="flex-1 flex flex-col relative z-10">

<!-- HEADER -->
<header class="bg-white px-8 py-5 border-b">
    <h2 class="text-xl font-semibold text-gray-800">Profil Desa</h2>
    <p class="text-gray-500 text-sm">Ringkasan Data Desa</p>
</header>

<!-- CONTENT -->
<section class="p-8 flex flex-col gap-8 relative z-10">

<!-- TOMBOL TAMBAH -->
<div>
    <a href="profil_tambah.php"
       class="inline-block bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800">
        + Tambah
    </a>
</div>

<!-- PROFIL DESA -->
<div class="bg-white rounded-lg shadow overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-4">Sejarah Desa</th>
    <th>Luas Wilayah</th>
    <th>Jumlah RT</th>
    <th>Jumlah Dusun</th>
    <th>Nama Dusun</th>
    <th class="text-center w-32">Aksi</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
    <td class="p-4">-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td class="p-4">
        <div class="flex justify-center gap-2">
            <a href="profil_edit.php?id=1"
               class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500">
                Edit
            </a>
            <a href="profil_hapus.php?id=1"
               onclick="return confirm('Yakin ingin menghapus data ini?')"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                Hapus
            </a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>

<!-- BATAS WILAYAH -->
<div class="bg-white rounded-lg shadow overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-4">Utara</th>
    <th>Timur</th>
    <th>Selatan</th>
    <th class="text-center w-32">Aksi</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
    <td class="p-4">-</td>
    <td>-</td>
    <td>-</td>
    <td class="p-4">
        <div class="flex justify-center gap-2">
            <a href="batas_edit.php?id=1"
               class="bg-yellow-400 px-3 py-1 rounded text-sm">
                Edit
            </a>
            <a href="batas_hapus.php?id=1"
               onclick="return confirm('Yakin ingin menghapus data ini?')"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                Hapus
            </a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>

<!-- STRUKTUR PEMERINTAHAN -->
<div class="bg-white rounded-lg shadow overflow-hidden">
<table class="w-full text-sm text-center">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-4">Nama</th>
    <th>Jabatan</th>
    <th>Gambar</th>
    <th class="w-32">Aksi</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
    <td class="p-4">-</td>
    <td>-</td>
    <td>-</td>
    <td class="p-4">
        <div class="flex justify-center gap-2">
            <a href="struktur_edit.php?id=1"
               class="bg-yellow-400 px-3 py-1 rounded text-sm">
                Edit
            </a>
            <a href="struktur_hapus.php?id=1"
               onclick="return confirm('Yakin ingin menghapus data ini?')"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                Hapus
            </a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>

=======
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
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4
</section>

</main>
</div>

</body>
</html>
