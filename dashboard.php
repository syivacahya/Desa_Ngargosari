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

<style>
body{
    margin:0;
    font-family:Segoe UI, Arial;
    background:#f4f6f9;
}

/* Sidebar */
.sidebar{
    width:230px;
    height:100vh;
    background:#1b5e20;
    position:fixed;
    color:white;
}

.sidebar h2{
    text-align:center;
    padding:20px 0;
}

.sidebar a{
    display:block;
    padding:14px 20px;
    color:white;
    text-decoration:none;
}

.sidebar a:hover{
    background:#2e7d32;
}

/* Header */
.header{
    margin-left:230px;
    background:white;
    padding:15px 25px;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.header h2{
    margin:0;
}

/* Content */
.content{
    margin-left:230px;
    padding:25px;
}

/* Info Cards */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.card h3{
    margin:5px 0;
    color:#666;
}

.card p{
    font-size:26px;
    margin:0;
    color:#1b5e20;
    font-weight:bold;
}

/* Menu */
.menu-box{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.menu{
    background:#e8f5e9;
    padding:25px;
    border-radius:12px;
    text-align:center;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
}

.menu:hover{
    background:#2e7d32;
    color:white;
    transform:scale(1.05);
}

/* Map Image */
.map-box{
    background:white;
    padding:15px;
    border-radius:12px;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.map-box img{
    width:100%;
    border-radius:10px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

<h2>ADMIN DESA</h2>

<a href="dashboard.php">🏠 Dashboard</a>
<a href="profil.php">📌 Profil Desa</a>
<a href="infografis.php">📊 Infografis</a>
<a href="umkm.php">🏪 UMKM</a>
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

<div class="menu" onclick="location.href='profil.php'">
📌 Profil Desa
</div>

<div class="menu" onclick="location.href='infografis.php'">
📊 Infografis
</div>

<div class="menu" onclick="location.href='umkm.php'">
🏪 Data UMKM
</div>

<div class="menu" onclick="location.href='produk.php'">
🛒 Produk
</div>

</div>


<!-- Map Image -->
<h3>📍 Lokasi Desa Ngargosari</h3>

<div class="map-box">

<iframe
    src="https://www.google.com/maps?q=Desa+Ngargosari+Loano+Purworejo&output=embed"
    width="100%"
    height="300"
    style="border:0;border-radius:10px;"
    allowfullscreen=""
    loading="lazy">
</iframe>

</div>

</div>

</body>
</html>
