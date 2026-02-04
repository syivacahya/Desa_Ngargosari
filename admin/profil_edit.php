<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
require_once "../koneksi.php";

$data = mysqli_fetch_assoc(mysqli_query($koneksi,
        "SELECT * FROM profil_desa WHERE id='$_GET[id]'"));

if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE profil_desa SET
        visi='$_POST[visi]',
        misi='$_POST[misi]',
        sejarah='$_POST[sejarah]',
        luas_wilayah='$_POST[luas_wilayah]',
        jumlah_rt='$_POST[jumlah_rt]',
        jumlah_dusun='$_POST[jumlah_dusun]',
        nama_dusun='$_POST[nama_dusun]'
        WHERE id='$_GET[id]'
    ");
    header("Location: profil.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profil Desa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
<form method="post" class="bg-white p-6 rounded shadow max-w-2xl mx-auto space-y-4">
<h2 class="text-xl font-semibold">Edit Profil Desa</h2>

<textarea name="visi" class="w-full border p-2"><?= $data['visi'] ?></textarea>
<textarea name="misi" class="w-full border p-2"><?= $data['misi'] ?></textarea>
<textarea name="sejarah" class="w-full border p-2"><?= $data['sejarah'] ?></textarea>

<input type="text" name="luas_wilayah" value="<?= $data['luas_wilayah'] ?>" class="w-full border p-2">
<input type="number" name="jumlah_rt" value="<?= $data['jumlah_rt'] ?>" class="w-full border p-2">
<input type="number" name="jumlah_dusun" value="<?= $data['jumlah_dusun'] ?>" class="w-full border p-2">
<input type="text" name="nama_dusun" value="<?= $data['nama_dusun'] ?>" class="w-full border p-2">

<button name="update" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
<a href="profil.php" class="ml-2 text-gray-600">Kembali</a>
</form>
</body>
</html>
