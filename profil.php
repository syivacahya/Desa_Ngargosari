<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Profil Desa</title>

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
    padding:20px;
    color:white;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:8px 0;
    border-radius:6px;
    transition:0.3s;
}

.sidebar a:hover{
    background:#7fb56a;
}

.sidebar .active{
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

input, textarea{
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

.grid-4{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
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

<h2>ADMIN DESA</h2>

<a href="dashboard.php">🏠 Dashboard</a>
<a href="profil.php" class="active">📌 Profil Desa</a>
<a href="infografis.php">📊 Infografis</a>
<a href="umkm.php">🏪 UMKM</a>
<a href="logout.php">🚪 Logout</a>

</div>


<!-- MAIN -->
<div class="main">

<!-- HEADER -->
<div class="header">
    <h2>Profil Desa</h2>
    <p>Kelola informasi profil Desa Ngargosari</p>
</div>


<!-- FORM -->
<div class="form-box">

<form method="post">

    <label>Visi Desa</label>
    <input type="text" name="visi">

    <label>Misi Desa</label>
    <textarea name="misi" rows="3"></textarea>

    <label>Sejarah Desa</label>
    <textarea name="sejarah" rows="3"></textarea>


    <div class="grid-2">

        <div>
            <label>Luas Wilayah</label>
            <input type="text" name="luas">
        </div>

        <div>
            <label>Jumlah RT</label>
            <input type="number" name="rt">
        </div>

    </div>


    <label>Batas Wilayah</label>

    <div class="grid-4">

        <input type="text" name="utara" placeholder="Utara">
        <input type="text" name="barat" placeholder="Barat">
        <input type="text" name="timur" placeholder="Timur">
        <input type="text" name="selatan" placeholder="Selatan">

    </div>


    <div class="grid-2">

        <div>
            <label>Jumlah Dusun</label>
            <input type="number" name="dusun">
        </div>

        <div>
            <label>Nama Dusun</label>
            <textarea name="nama_dusun" rows="3"></textarea>
        </div>

    </div>


    <button type="submit" name="simpan">
        💾 Simpan Profil
    </button>

</form>

</div>

</div>

</body>
</html>
