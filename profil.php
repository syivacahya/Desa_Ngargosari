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
<title>Profil Desa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box}
body{margin:0;font-family:'Poppins',sans-serif;background:#f4f6f9}

/* SIDEBAR */
.sidebar{
    width:230px;height:100vh;position:fixed;color:white;
    background:linear-gradient(180deg,#1b5e20,#2e7d32);
}
.logo-box{
    display:flex;flex-direction:column;align-items:center;
    padding:20px;border-bottom:1px solid rgba(255,255,255,.25)
}
.logo-box img{width:80px;margin-bottom:10px}
.logo-box span{font-size:14px;font-weight:600;letter-spacing:1px}
.sidebar a{
    display:block;padding:14px 22px;color:white;text-decoration:none;
    transition:.3s
}
.sidebar a:hover,.sidebar a.active{
    background:rgba(255,255,255,.2);padding-left:30px
}

/* HEADER */
.header{
    margin-left:230px;background:white;padding:18px 30px;
    box-shadow:0 2px 10px rgba(0,0,0,.08)
}

/* CONTENT */
.content{margin-left:230px;padding:30px}

/* CARD */
.card{
    background:white;padding:25px;border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.08)
}
label{display:block;margin-top:15px;color:#1b5e20;font-weight:500}
input,textarea{
    width:100%;padding:10px;margin-top:6px;
    border-radius:8px;border:1px solid #ccc
}
textarea{resize:vertical}
button{
    margin-top:20px;background:#2e7d32;color:white;
    border:none;padding:10px 22px;border-radius:8px;cursor:pointer
}
button:hover{background:#1b5e20}
</style>
</head>

<body>

<div class="sidebar">
    <div class="logo-box">
        <img src="assets/img/logo.png">
        <span>ADMIN DESA</span>
    </div>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="profil.php" class="active">📌 Profil Desa</a>
    <a href="infografis.php">📊 Infografis</a>
    <a href="produk.php">🛒 Produk Unggulan</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="header">
    <h2>Profil Desa</h2>
    <p>Kelola informasi profil desa</p>
</div>

<div class="content">
    <div class="card">
        <label>Nama Desa</label>
        <input type="text">

        <label>Alamat Desa</label>
        <textarea rows="3"></textarea>

        <label>Sejarah Singkat</label>
        <textarea rows="4"></textarea>

        <label>Visi & Misi</label>
        <textarea rows="4"></textarea>

        <button>💾 Simpan</button>
    </div>
</div>

</body>
</html>
