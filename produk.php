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
<title>Produk Unggulan Desa</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f2f5f3;
    display:flex;
}

/* SIDEBAR */
.sidebar{
    width:230px;
    background:#2f5e2b;
    min-height:100vh;
    color:white;
}

/* LOGO */
.logo-box{
    display:flex;
    flex-direction:column;
    align-items:center;
    padding:20px 10px;
    border-bottom:1px solid rgba(255,255,255,0.3);
}

.logo-box img{
    width:80px;
    margin-bottom:10px;
}

.logo-box span{
    font-size:14px;
    font-weight:bold;
    letter-spacing:1px;
}

/* MENU */
.menu{
    padding:20px;
}

.menu a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:8px 0;
    border-radius:6px;
    transition:0.3s;
}

.menu a:hover{
    background:#7fb56a;
}

.menu .active{
    background:#7fb56a;
}

/* MAIN */
.main{
    flex:1;
    padding:25px;
}

/* HEADER */
.header{
    background:white;
    padding:20px;
    border-radius:10px;
    margin-bottom:25px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.header h2{
    color:#2f5e2b;
}

/* FORM */
.form-box{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 3px 12px rgba(0,0,0,0.1);
}

label{
    font-weight:bold;
    color:#2f5e2b;
    display:block;
    margin-top:15px;
}

input, textarea, select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:6px;
    border:1px solid #ccc;
}

.grid-2{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

button{
    background:#2f5e2b;
    color:white;
    border:none;
    padding:12px;
    width:100%;
    border-radius:6px;
    margin-top:25px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#244a21;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo-box">
        <img src="assets/img/logo.png" alt="Logo Desa">
        <span>ADMIN DESA</span>
    </div>

    <div class="menu">
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="profil.php">📌 Profil Desa</a>
        <a href="infografis.php">📊 Infografis</a>
        <a href="produk.php" class="active">🛒 Produk Unggulan</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <h2>Produk Unggulan Desa</h2>
        <p>Kelola produk unggulan Desa Ngargosari</p>
    </div>

    <div class="form-box">
        <form method="post" enctype="multipart/form-data">

            <label>Nama Produk</label>
            <input type="text" name="nama_produk" required>

            <label>Kategori Produk</label>
            <select name="kategori">
                <option value="">-- Pilih Kategori --</option>
                <option value="Pertanian">Pertanian</option>
                <option value="UMKM">UMKM</option>
                <option value="Kerajinan">Kerajinan</option>
                <option value="Makanan">Makanan</option>
            </select>

            <label>Deskripsi Produk</label>
            <textarea name="deskripsi" rows="4"></textarea>

            <div class="grid-2">
                <div>
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga">
                </div>
                <div>
                    <label>Kontak Penjual</label>
                    <input type="text" name="kontak">
                </div>
            </div>

            <label>Foto Produk</label>
            <input type="file" name="foto">

            <button type="submit" name="simpan">
                💾 Simpan Produk
            </button>

        </form>
    </div>

</div>

</body>
</html>
