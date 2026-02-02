<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Produk</title>

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
    background:#2e7d32;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:8px;
    cursor:pointer
}
button:hover{background:#1b5e20}
a{display:inline-block;margin-top:15px;color:#555;text-decoration:none}
</style>
</head>

<body>

<div class="container">
    <h2>➕ Tambah Produk Unggulan</h2>

    <form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" required>

        <label>Harga</label>
        <input type="number" name="harga" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" required></textarea>

        <label>Produsen</label>
        <input type="text" name="produsen" required>

        <label>Lokasi</label>
        <input type="text" name="lokasi" required>

        <label>Gambar Produk</label>
        <input type="file" name="gambar" accept="image/*" required>

        <button type="submit">💾 Simpan Produk</button>
    </form>

    <a href="produk.php">← Kembali ke Produk</a>
</div>

</body>
</html>
