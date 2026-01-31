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
body{margin:0;font-family:Arial;background:#f4f6f4}
.sidebar{width:220px;height:100vh;background:#1b5e20;position:fixed;color:white}
.sidebar h2{text-align:center;padding:20px 0}
.sidebar a{display:block;color:white;padding:12px 20px;text-decoration:none}
.sidebar a:hover{background:#2e7d32}
.header{margin-left:220px;background:#2e7d32;color:white;padding:15px}
.content{margin-left:220px;padding:20px}
.cards{display:grid;grid-template-columns:repeat(4,1fr);gap:15px}
.card{background:#c8e6c9;padding:15px;border-radius:5px;text-align:center}
.menu-box{display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-top:20px}
.box{background:#e8f5e9;padding:20px;border-radius:5px;text-align:center}
.table{width:100%;border-collapse:collapse;margin-top:20px}
.table th,.table td{border:1px solid #ccc;padding:8px;text-align:center}
.btn{padding:6px 10px;border:none;border-radius:3px;cursor:pointer}
.btn-add{background:#2e7d32;color:white}
.btn-edit{background:#0277bd;color:white}
.btn-del{background:#c62828;color:white}
</style>
</head>
<body>

<div class="sidebar">
<h2>Admin Desa</h2>
<a href="dashboard.php">Dashboard</a>
<a href="profil.php">Profil Desa</a>
<a href="produk.php">Produk Unggulan</a>
<a href="infografis.php">Infografis</a>
<a href="logout.php">Logout</a>
</div>

<div class="header">
Dashboard Admin Desa Ngargosari
</div>

<div class="content">

<h3>Statistik Penduduk</h3>
<div class="cards">
<div class="card">Total Penduduk<br><b>700</b></div>
<div class="card">Kepala Keluarga<br><b>40</b></div>
<div class="card">Laki-laki<br><b>60</b></div>
<div class="card">Perempuan<br><b>40</b></div>
</div>

<div class="menu-box">
<div class="box">Profil Desa</div>
<div class="box">Infografis</div>
<div class="box">Produk Unggulan</div>
</div>

<h3>Produk Unggulan</h3>
<button class="btn btn-add">+ Tambah</button>
<table class="table">
<tr>
<th>No</th>
<th>Nama</th>
<th>Harga</th>
<th>Deskripsi</th>
<th>Aksi</th>
</tr>
<tr>
<td>1</td>
<td>Gula Aren</td>
<td>Rp 20.000</td>
<td>Gula asli desa</td>
<td>
<button class="btn btn-edit">Edit</button>
<button class="btn btn-del">Hapus</button>
</td>
</tr>
</table>

</div>

</body>
</html>