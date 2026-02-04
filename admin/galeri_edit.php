<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$id = $_GET['id'] ?? '';
if (!$id) {
    header("Location: galeri.php");
    exit;
}

/* Ambil data galeri */
$q = mysqli_query($koneksi,"SELECT * FROM galeri WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    die("Data tidak ditemukan");
}

/* ================== UPDATE DATA ================== */
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];

    // Jika ganti gambar
    if (!empty($_FILES['gambar']['name'])) {
        // Hapus gambar lama
        if(file_exists("../assets/galeri/".$data['gambar'])){
            unlink("../assets/galeri/".$data['gambar']);
        }

        $namaFile = $_FILES['gambar']['name'];
        $tmp      = $_FILES['gambar']['tmp_name'];
        $ext      = pathinfo($namaFile, PATHINFO_EXTENSION);
        $gambar   = uniqid().".".$ext;

        move_uploaded_file($tmp, "../assets/galeri/".$gambar);

        mysqli_query($koneksi,"
            UPDATE galeri SET
            judul='$judul',
            gambar='$gambar'
            WHERE id='$id'
        ");
    } else {
        // Hanya update judul
        mysqli_query($koneksi,"
            UPDATE galeri SET judul='$judul' WHERE id='$id'
        ");
    }

    header("Location: galeri.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Galeri</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>body { font-family: 'Poppins', sans-serif; }</style>
</head>

<body class="bg-gray-100 p-10">

<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow">

<h2 class="font-bold text-xl mb-4">Edit Gambar</h2>

<form method="post" enctype="multipart/form-data" class="space-y-4">
    <div>
        <label class="block mb-1">Judul</label>
        <input type="text" name="judul" value="<?= $data['judul'] ?>" required
        class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1">Gambar (kosongkan jika tidak diganti)</label>
        <input type="file" name="gambar">
        <img src="../assets/galeri/<?= $data['gambar'] ?>" class="w-32 mt-2 rounded">
    </div>

    <div class="flex justify-end space-x-2">
        <a href="galeri.php" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
        <button type="submit" name="update" class="bg-yellow-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </div>
</form>

</div>

</body>
</html>
