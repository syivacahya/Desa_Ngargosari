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
    <title>Tambah Profil Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

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
