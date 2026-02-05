<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$error = "";

if (isset($_POST['simpan'])) {
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $gambar  = null;

    if (!empty($_FILES['gambar']['name'])) {
        $extValid = ['jpg','jpeg','png'];
        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $extValid)) {
            $error = "Format gambar harus JPG, JPEG, atau PNG";
        } else {
            $namaFile = uniqid() . "." . $ext;
            $folder = "../uploads/struktur/";

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $folder.$namaFile)) {
                $gambar = $namaFile;
            } else {
                $error = "Gagal upload gambar";
            }
        }
    }

    if (!$error) {
        $query = mysqli_query($koneksi, "
            INSERT INTO struktur_pemerintahan (nama, jabatan, gambar)
            VALUES ('$nama','$jabatan','$gambar')
        ");

        if ($query) {
            header("Location: profil.php");
            exit;
        } else {
            $error = "Gagal menyimpan data";
        }
    }
}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Desa – Infografis</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif}
</style>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

<!-- SIDEBAR -->
<aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white z-40">
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

<!-- CONTENT -->
<main class="ml-60 flex-1">
<header class="bg-white px-8 py-5 shadow flex justify-between items-center">
    <div>
         <h2 class="text-xl font-semibold text-gray-800">Profil Desa</h2>
        <p class="text-gray-500 text-sm">Kelola Profil Desa Ngargosari</p>
    </div>
</header>

<body class="bg-gray-100 font-poppins">

<div class="max-w-3xl mx-auto p-8">
<h2 class="text-2xl font-semibold mb-6">Tambah Struktur Pemerintahan</h2>

<?php if ($error): ?>
<div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $error ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">

<div>
<label class="block font-medium">Nama</label>
<input type="text" name="nama" required class="w-full border px-3 py-2 rounded">
</div>

<div>
<label class="block font-medium">Jabatan</label>
<input type="text" name="jabatan" required class="w-full border px-3 py-2 rounded">
</div>

<div>
<label class="block font-medium">Foto</label>
<input type="file" name="gambar" accept="image/*"
       onchange="previewFoto(this)"
       class="w-full border px-3 py-2 rounded">
<div class="mt-3 flex justify-center">
<img id="preview" class="hidden w-32 h-32 object-cover rounded border">
</div>
</div>

<div class="flex gap-3 pt-4">
<button name="simpan" class="bg-green-700 text-white px-6 py-2 rounded">Simpan</button>
<a href="profil.php" class="bg-gray-400 text-white px-6 py-2 rounded">Batal</a>
</div>

</form>
</div>

<script>
function previewFoto(input) {
    const img = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            img.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>
