<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

/* VALIDASI ID */
if(!isset($_GET['id'])){
    header("Location: profil.php");
    exit;
}

$id = $_GET['id'];

/* AMBIL DATA */
$query = mysqli_query($koneksi, "SELECT * FROM profil_desa WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(!$data){
    header("Location: profil.php");
    exit;
}

/* PROSES UPDATE */
if(isset($_POST['update'])){
    $sejarah     = $_POST['sejarah'];
    $luas        = $_POST['luas'];
    $rt          = $_POST['rt'];
    $dusun       = $_POST['dusun'];
    $nama_dusun  = $_POST['nama_dusun'];

    mysqli_query($koneksi, "
        UPDATE profil_desa SET
            sejarah='$sejarah',
            luas_wilayah='$luas',
            jumlah_rt='$rt',
            jumlah_dusun='$dusun',
            nama_dusun='$nama_dusun'
        WHERE id='$id'
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
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<form method="post" class="bg-white max-w-xl mx-auto p-6 rounded shadow space-y-4">
<h2 class="text-xl font-semibold">Edit Profil Desa</h2>

<textarea name="sejarah" class="w-full border p-2 rounded" rows="4"><?= htmlspecialchars($data['sejarah']) ?></textarea>

<input type="text" name="luas"
 value="<?= htmlspecialchars($data['luas_wilayah']) ?>"
 class="w-full border p-2 rounded">

<input type="number" name="rt"
 value="<?= htmlspecialchars($data['jumlah_rt']) ?>"
 class="w-full border p-2 rounded">

<input type="number" name="dusun"
 value="<?= htmlspecialchars($data['jumlah_dusun']) ?>"
 class="w-full border p-2 rounded">

<input type="text" name="nama_dusun"
 value="<?= htmlspecialchars($data['nama_dusun']) ?>"
 class="w-full border p-2 rounded">

<div class="flex gap-3">
<button name="update"
 class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
 Update
</button>

<a href="profil.php"
 class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">
 Kembali
</a>
</div>

</form>

</body>
</html>
