<?php

include "koneksi.php";

/* PAGINATION */
$batas = 4;
$hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$mulai = ($hal - 1) * $batas;

$total = mysqli_num_rows(mysqli_query($koneksi,"SELECT id_produk FROM produk"));
$pages = ceil($total / $batas);

$data = mysqli_query($koneksi,"
    SELECT * FROM produk
    ORDER BY id_produk DESC
    LIMIT $mulai, $batas
");
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Produk Unggulan Desa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box}
body{margin:0;font-family:Poppins;background:#fff}

/* HEADER */
header{
    background:#355e2b;color:white;
    padding:15px 40px;
    display:flex;justify-content:space-between;align-items:center
}
.logo{display:flex;gap:12px;align-items:center}
.logo img{width:45px}
nav a{
    color:white;text-decoration:none;margin:0 12px;font-size:14px
}
nav a.active{border-bottom:2px solid #fff;padding-bottom:4px}

/* CONTENT */
.container{max-width:1100px;margin:50px auto;padding:0 20px}
h1{font-weight:500;margin-bottom:40px}

.grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
    justify-items:center;
}

/* CARD */
.card{
    width:300px;
    border:1px solid #ddd;
    padding:15px;
    transition:.3s;
    cursor:pointer;
}
.card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
.card img{
    width:100%;height:200px;object-fit:cover
}
.card p{
    margin:10px 0 0;
    font-weight:500;
}

/* PAGINATION */
.pagination{text-align:center;margin:40px 0}
.pagination a{
    display:inline-block;
    padding:4px 8px;
    margin:0 4px;
    border:1px solid #ccc;
    text-decoration:none;
    color:#333;
}
.pagination a.active{
    background:#e0e7f5;
    font-weight:600;
}

/* FOOTER */
footer{
    background:#355e2b;color:white;
    padding:40px;
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:30px;
    font-size:13px;
}
footer img{width:55px;margin-bottom:10px}
.credit{
    background:#2b4a22;
    text-align:center;
    padding:8px;
    font-size:12px;
}

/* RESPONSIVE */
@media(max-width:768px){
    header{flex-direction:column;gap:10px}
    nav{margin-top:10px}
    .grid{grid-template-columns:1fr}
    footer{grid-template-columns:1fr;text-align:center}
}
</style>
</head>
<body>

<header>
    <div class="logo">
        <img src="assets/img/logo.png">
        <div>
            <strong>Desa Ngargosari</strong><br>
            <small>Kecamatan Loano, Kabupaten Purworejo</small>
        </div>
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="profil-desa.php">Profil Desa</a>
        <a href="produk.php" class="active">Produk Unggulan Desa</a>
        <a href="infografis.php">Infografis</a>
    </nav>
</header>

<div class="container">
    <h1>Produk Unggulan Desa</h1>

    <div class="grid">
    <?php while($p=mysqli_fetch_assoc($data)){ ?>
        <a href="produk_detail.php?id=<?= $p['id_produk'] ?>" style="color:inherit;text-decoration:none">
            <div class="card">
                <img src="assets/img/produk/<?= $p['gambar'] ?>">
                <p><?= htmlspecialchars($p['nama_produk']) ?></p>
            </div>
        </a>
    <?php } ?>
    </div>

    <div class="pagination">
        <?php for($i=1;$i<=$pages;$i++){ ?>
            <a class="<?= $i==$hal?'active':'' ?>" href="?hal=<?= $i ?>"><?= $i ?></a>
        <?php } ?>
    </div>
</div>

<footer>
    <div>
        <img src="assets/img/logo.png"><br>
        <strong>Pemerintah Desa Ngargosari</strong><br><br>
        Desa Ngargosari Kecamatan Loano, Kabupaten Purworejo<br>
        Provinsi Jawa Tengah
    </div>
    <div>
        <strong>Hubungi Kami</strong><br><br>
        📞 08888888<br>
        ✉️ email<br>
        📷 instagram
    </div>
</footer>

<div class="credit">credit 2026</div>

</body>
</html>
