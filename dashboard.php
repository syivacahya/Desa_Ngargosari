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
<title>Dashboard Admin Desa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:'Poppins', sans-serif;
    background:#f4f6f9;
}

/* Sidebar */
.sidebar{
    width:230px;
    height:100vh;
    background:linear-gradient(180deg,#1b5e20,#2e7d32);
    position:fixed;
    color:white;
}

.sidebar h2{
    text-align:center;
    padding:25px 0;
    margin:0;
    font-weight:600;
    letter-spacing:1px;
}

.sidebar a{
    display:block;
    padding:14px 22px;
    color:white;
    text-decoration:none;
    font-size:15px;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.15);
    padding-left:30px;
}
/* Logo Sidebar */
.logo-box{
    display:flex;
    flex-direction:column;
    align-items:center;
    padding:20px 10px;
    border-bottom:1px solid rgba(255,255,255,0.25);
}

.logo-box img{
    width:80px;
    height:auto;
    margin-bottom:10px;
}

.logo-box span{
    font-size:14px;
    font-weight:600;
    letter-spacing:1px;
}


/* Header */
.header{
    margin-left:230px;
    background:white;
    padding:18px 30px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

.header h2{
    margin:0;
    font-weight:600;
}

.header p{
    margin:5px 0 0;
    color:#777;
}

/* Content */
.content{
    margin-left:230px;
    padding:30px;
}

/* Cards */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:35px;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    margin:0;
    font-size:15px;
    color:#777;
}

.card p{
    font-size:30px;
    margin-top:8px;
    color:#1b5e20;
    font-weight:600;
}

/* Menu */
.menu-box{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:35px;
}

.menu{
    background:white;
    padding:28px;
    border-radius:15px;
    text-align:center;
    font-size:18px;
    cursor:pointer;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
    transition:0.3s;
}

.menu:hover{
    background:#2e7d32;
    color:white;
    transform:scale(1.05);
}

/* Map */
.map-box{
    background:white;
    padding:18px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

.map-box h3{
    margin-top:0;
}

iframe{
    width:100%;
    height:300px;
    border:0;
    border-radius:12px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

    <div class="logo-box">
        <img src="assets/img/logo.png" alt="Logo Desa Ngargosari">
        <span>ADMIN DESA</span>
    </div>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="profil.php">📌 Profil Desa</a>
    <a href="infografis.php">📊 Infografis</a>
    <a href="produk.php">🛒 Produk Unggulan</a>
    <a href="logout.php">🚪 Logout</a>

</div>


<!-- Header -->
<div class="header">
    <h2>Dashboard Admin Desa Ngargosari</h2>
    <p>Ringkasan Data Desa</p>
</div>

<!-- Content -->
<div class="content">

<!-- Statistik -->
<div class="cards">
    <div class="card">
        <h3>Total Penduduk</h3>
        <p>700</p>
    </div>
    <div class="card">
        <h3>Kepala Keluarga</h3>
        <p>180</p>
    </div>
    <div class="card">
        <h3>Total UMKM</h3>
        <p>35</p>
    </div>
    <div class="card">
        <h3>Produk Unggulan</h3>
        <p>120</p>
    </div>
</div>

<!-- Menu -->
<div class="menu-box">
    <div class="menu" onclick="location.href='profil.php'">📌 Profil Desa</div>
    <div class="menu" onclick="location.href='infografis.php'">📊 Infografis</div>
    <div class="menu" onclick="location.href='produk.php'">🛒 Produk</div>
</div>

<!-- Map -->
<div class="map-box">
    <h3>📍 Lokasi Desa Ngargosari</h3>
    <iframe 
        src="https://www.google.com/maps?q=Desa+Ngargosari+Loano+Purworejo&output=embed"
        loading="lazy">
    </iframe>
</div>

</div>

</body>
</html>
