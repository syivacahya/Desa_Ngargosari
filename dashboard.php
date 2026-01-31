<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
body{font-family:Arial;background:#f2f2f2}
.box{background:white;width:80%;margin:50px auto;padding:20px;border-radius:10px}
a{background:red;color:white;padding:8px 12px;text-decoration:none}
</style>
</head>
<body>

<div class="box">
<h2>Dashboard Admin</h2>

<p>Selamat datang di Sistem Desa</p>

<a href="produk.php">Kelola Produk</a>
<a href="logout.php">Logout</a>
</div>

</body>
</html>
