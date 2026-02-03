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
    $sejarah = $_POST['sejarah'];

    mysqli_query($koneksi, "
        UPDATE profil_desa SET
        sejarah='$sejarah'
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

<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
<h2 class="text-lg font-semibold mb-4">Edit Profil Desa</h2>

<form method="post" class="space-y-4">

<textarea name="sejarah"
 class="w-full border p-3 rounded"
 rows="5"><?= htmlspecialchars($data['sejarah']) ?></textarea>

<div class="flex gap-3">
<button type="submit" name="update"
 class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
 Update
</button>

<a href="profil.php"
 class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">
 Batal
</a>
</div>

</form>
</div>

</body>
</html>
