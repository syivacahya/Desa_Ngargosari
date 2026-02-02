<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id'");
$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "Data tidak ditemukan";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Produk</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f4f6f9
}
.container{
    max-width:700px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.08)
}
h2{margin-top:0;color:#1b5e20}
label{display:block;margin-top:15px;font-weight:500}
input,textarea{
    width:100%;
    padding:10px;
    margin-top:6px;
    border-radius:8px;
    border:1px solid #ccc
}
button{
    margin-top:20px;
    background:#ff9800;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:8px;
    cursor:pointer
}
button:hover{background:#f57c00}
img{
    margin-top:10px;
    width:120px;
    border-radius:10px
}
a{display:inline-block;margin-top:15px;color:#555;text-decoration:none}
</style>
</head>

<body>

<div class="container">
    <h2>✏️ Edit Produk</h2>

    <form action="update_produk.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">

        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required>

        <label>Harga</label>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" required><?= $data['deskripsi'] ?></textarea>

        <label>Produsen</label>
        <input type="text" name="produsen" value="<?= $data['produsen'] ?>" required>

        <label>Lokasi</label>
        <input type="text" name="lokasi" value="<?= $data['lokasi'] ?>" required>

        <label>Gambar Saat Ini</label><br>
        <img src="../assets/img/produk/<?= $data['gambar'] ?>">

        <label>Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/*">

        <button type="submit">💾 Update Produk</button>
    </form>

    <a href="produk.php">← Kembali</a>
</div>

</body>
</html>
