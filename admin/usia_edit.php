<?php
session_start();
require_once "../koneksi.php";

$id = $_GET['id'];
$q = mysqli_query($koneksi,"SELECT * FROM penduduk_usia WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) die("Data tidak ditemukan");

if (isset($_POST['simpan'])) {
    $umur = $_POST['umur'];
    $laki = $_POST['laki_laki'];
    $perempuan = $_POST['perempuan'];

    mysqli_query($koneksi,"
        UPDATE penduduk_usia SET
        umur='$umur',
        laki_laki='$laki',
        perempuan='$perempuan'
        WHERE id='$id'
    ");

    include "sync_penduduk.php";

    header("Location: infografis.php?tahun=".$data['tahun']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Usia</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

<h2 class="font-bold mb-4">Edit Kelompok Umur</h2>

<form method="post" class="space-y-4">
<div>
<label>Kelompok Umur</label>
<input name="umur"
value="<?= $data['umur'] ?>"
required class="w-full border p-2 rounded">
</div>

<div>
<label>Laki-laki</label>
<input type="number" name="laki"
value="<?= $data['laki'] ?>"
required class="w-full border p-2 rounded">
</div>

<div>
<label>Perempuan</label>
<input type="number" name="perempuan"
value="<?= $data['perempuan'] ?>"
required class="w-full border p-2 rounded">
</div>

<button name="simpan"
class="bg-yellow-500 text-white px-4 py-2 rounded">
Update
</button>

<a href="infografis.php?tahun=<?= $data['tahun'] ?>"
class="ml-2 text-gray-600">Batal</a>
</form>

</div>
</body>
</html>
