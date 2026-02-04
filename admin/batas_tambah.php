<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

// Cek apakah batas wilayah sudah ada (karena hanya 1 data)
$cek = mysqli_query($koneksi, "SELECT id FROM batas_wilayah LIMIT 1");
if (mysqli_num_rows($cek) > 0) {
    header("Location: profil.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $utara   = mysqli_real_escape_string($koneksi, $_POST['utara']);
    $timur   = mysqli_real_escape_string($koneksi, $_POST['timur']);
    $selatan = mysqli_real_escape_string($koneksi, $_POST['selatan']);
    $barat   = mysqli_real_escape_string($koneksi, $_POST[' barat']);

    $query = "
        INSERT INTO batas_wilayah (utara,timur,selatan,barat)
        VALUES ('$utara', '$timur','$selatan', '$barat')
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
<title>Tambah Batas Wilayah</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<form method="post" class="bg-white p-6 rounded shadow w-full max-w-xl space-y-4">
    <h2 class="text-xl font-semibold text-gray-800">
        Tambah Batas Wilayah Desa
    </h2>

    <input type="text" name="utara" placeholder="Batas Utara"
           class="w-full border p-2 rounded" required>

    <input type="text" name="timur" placeholder="Batas Timur"
           class="w-full border p-2 rounded" required>
    
     <input type="text" name="selatan" placeholder="Batas Selatan"
           class="w-full border p-2 rounded" required>

    <input type="text" name="barat" placeholder="Batas Barat"
           class="w-full border p-2 rounded" required>

    <div class="flex gap-3 pt-2">
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
