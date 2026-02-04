<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$error = "";
$sukses = "";

if (isset($_POST['simpan'])) {
    $nama    = htmlspecialchars($_POST['nama']);
    $jabatan = htmlspecialchars($_POST['jabatan']);

    // ================= UPLOAD GAMBAR =================
    $gambar = null;

    if (!empty($_FILES['gambar']['name'])) {
        $extValid = ['jpg', 'jpeg', 'png'];
        $ext      = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $extValid)) {
            $error = "Format gambar harus JPG / JPEG / PNG";
        } else {
            $namaFile = uniqid() . "." . $ext;
            $folder   = "../uploads/struktur/";

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $namaFile);
            $gambar = $namaFile;
        }
    }

    // ================= SIMPAN DATA =================
    if (!$error) {
        $query = mysqli_query($koneksi, "
            INSERT INTO struktur_pemerintahan (nama, jabatan, gambar)
            VALUES ('$nama', '$jabatan', '$gambar')
        ");

        if ($query) {
            $sukses = "Data struktur pemerintahan berhasil ditambahkan";
        } else {
            $error = "Gagal menyimpan data";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Struktur Pemerintahan</title>

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
<aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="text-sm font-semibold tracking-wider">ADMIN DESA</span>
    </div>

    <nav class="mt-4 text-sm">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 bg-white/20">📌 Profil Desa</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<!-- ================= CONTENT ================= -->
<div class="flex-1 ml-60">

<header class="bg-green-800 text-white px-10 py-6 sticky top-0">
    <h1 class="text-2xl font-semibold">Tambah Struktur Pemerintahan</h1>
</header>

<main class="p-10 max-w-3xl">

<!-- ALERT -->
<?php if ($error): ?>
<div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
    <?= $error ?>
</div>
<?php endif; ?>

<?php if ($sukses): ?>
<div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
    <?= $sukses ?>
</div>
<?php endif; ?>

<!-- FORM -->
<div class="bg-white rounded shadow p-8">
    <form method="POST" enctype="multipart/form-data" class="space-y-6">

        <div>
            <label class="block font-medium mb-1">Nama</label>
            <input type="text" name="nama" required
                   class="w-full border rounded px-4 py-2 focus:ring focus:ring-green-300">
        </div>

        <div>
            <label class="block font-medium mb-1">Jabatan</label>
            <input type="text" name="jabatan" required
                   class="w-full border rounded px-4 py-2 focus:ring focus:ring-green-300">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto (opsional)</label>
            <input type="file" name="gambar"
                   class="w-full border rounded px-4 py-2">
            <small class="text-gray-500">Format: JPG, JPEG, PNG</small>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" name="simpan"
                    class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                💾 Simpan
            </button>
            <a href="profil.php"
               class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                ↩ Kembali
            </a>
        </div>

    </form>
</div>

</main>
</div>
</div>

</body>
</html>
