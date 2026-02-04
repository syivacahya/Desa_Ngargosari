<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$id = (int) $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM batas_wilayah WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $utara   = mysqli_real_escape_string($koneksi, $_POST['utara']);
    $selatan = mysqli_real_escape_string($koneksi, $_POST['selatan']);
    $barat   = mysqli_real_escape_string($koneksi, $_POST['barat']);
    $timur   = mysqli_real_escape_string($koneksi, $_POST['timur']);

    $query = "UPDATE batas_wilayah SET
                utara='$utara',
                selatan='$selatan',
                barat='$barat',
                timur='$timur'
              WHERE id=$id";

    mysqli_query($koneksi, $query);

    header("Location: profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Batas Wilayah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<form method="post" class="bg-white p-6 rounded shadow max-w-xl mx-auto space-y-4">
    <h2 class="text-xl font-semibold text-gray-800">Edit Batas Wilayah Desa</h2>

    <input type="text" name="utara" value="<?= htmlspecialchars($row['utara']) ?>"
           required class="w-full border p-2 rounded">

    <input type="text" name="timur" value="<?= htmlspecialchars($row['timur']) ?>"
           required class="w-full border p-2 rounded">
           
     <input type="text" name="selatan" value="<?= htmlspecialchars($row['selatan']) ?>"
           required class="w-full border p-2 rounded">

    <input type="text" name="barat" value="<?= htmlspecialchars($row['barat']) ?>"
           required class="w-full border p-2 rounded">

    <div class="flex gap-3">
        <button type="submit" name="update"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
            ✏️ Update
        </button>

        <a href="profil.php"
           class="px-4 py-2 rounded border text-gray-600 hover:bg-gray-100">
           Kembali
        </a>
    </div>
</form>

</body>
</html>
