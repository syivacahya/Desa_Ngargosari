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
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    margin:0;
    background:#f3f6f4;
    display:flex;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    background:#2f5e2b;
    min-height:100vh;
    color:white;
    padding:20px;
}

.sidebar h3{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px;
    margin:8px 0;
    border-radius:5px;
}

.sidebar a:hover,
.sidebar .active{
    background:#7fb56a;
}

/* CONTENT */
.main{
    flex:1;
    padding:30px;
}

/* CARD */
.container{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:2px solid #7fb56a;
    padding-bottom:15px;
    margin-bottom:25px;
}

.top h2{
    color:#2f5e2b;
}

/* FORM */
label{
    display:block;
    margin-top:15px;
    font-weight:bold;
    color:#2f5e2b;
}

input, textarea{
    width:100%;
    padding:10px;
    margin-top:6px;
    border:1px solid #ccc;
    border-radius:6px;
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
    margin-top:25px;
    padding:12px;
    width:100%;
    border:none;
    background:#2f5e2b;
    color:white;
    font-size:16px;
    border-radius:6px;
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

    <h3>Admin Desa</h3>

    <a href="dashboard.php">Dashboard</a>
    <a href="profil_desa.php" class="active">Profil Desa</a>
    <a href="produk.php">Produk UMKM</a>
    <a href="logout.php">Logout</a>

</div>


<!-- MAIN CONTENT -->
<div class="main">

    <div class="container">

        <div class="top">
            <h2>Profil Desa</h2>
        </div>

        <form method="post">

            <label>Visi</label>
            <input type="text" name="visi">

            <label>Misi</label>
            <textarea name="misi" rows="3"></textarea>

            <label>Sejarah</label>
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
                    <input type="number" name="jumlah_dusun">
                </div>
                <div>
                    <label>Nama Dusun</label>
                    <textarea name="nama_dusun" rows="3"></textarea>
                </div>
            </div>

            <button>Simpan Profil</button>

        </form>

    </div>

</div>

</body>
</html>
