<?php
require_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Desa Ngargosari</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box}
body{
    margin:0;
    font-family:Poppins, sans-serif;
    background:#f5f5f5;
    color:#333;
}

/* ===== HEADER ===== */
header{
    background:#3f5f2e;
    color:white;
}
.nav{
    max-width:1200px;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 20px;
}
.nav .logo{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:600;
}
.nav img{width:40px}
.nav a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    font-size:14px;
}
.nav a:hover{text-decoration:underline}

/* ===== HERO ===== */
.hero{
    background:#cfe3c2;
    height:260px;
    display:flex;
    align-items:center;
}
.hero .hero-content{
    max-width:1200px;
    margin:auto;
    padding:0 20px;
}
.hero h1{
    margin:0;
    font-size:26px;
    font-weight:600;
}

/* ===== SECTION ===== */
.section{
    max-width:1200px;
    margin:auto;
    padding:50px 20px;
    background:white;
}
.section.center{text-align:center}
.section h2{
    color:#3f5f2e;
    margin-bottom:15px;
}

/* ===== PROFIL DESA ===== */
.logo-desa{
    width:120px;
    margin-bottom:15px;
}

/* ===== MAP ===== */
.map img{
    max-width:100%;
    border-radius:10px;
}

/* ===== PRODUK ===== */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
}
.card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
    overflow:hidden;
}
.card img{
    width:100%;
    height:150px;
    object-fit:cover;
}
.card-body{
    padding:15px;
    text-align:center;
}
.card-body h4{
    margin:5px 0;
}
.price{
    color:#e65100;
    font-weight:600;
}
.btn-wa{
    display:inline-block;
    margin-top:10px;
    background:#25D366;
    color:white;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
}

/* ===== INFOGRAFIS ===== */
.infografis{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}
.info-box{
    background:#e7f1e2;
    border-radius:12px;
    padding:20px;
    text-align:center;
}
.info-box h3{margin:0;color:#3f5f2e}
.info-box p{margin:5px 0 0}

/* ===== FOOTER ===== */
footer{
    background:#3f5f2e;
    color:white;
    text-align:center;
    padding:25px;
    margin-top:40px;
    font-size:14px;
}
</style>
</head>

<body>

<!-- ===== HEADER ===== -->
<header>
    <div class="nav">
        <div class="logo">
            <img src="assets/img/logo.png" alt="Logo Desa">
            Desa Ngargosari
        </div>
        <div>
            <a href="#home">Home</a>
            <a href="profil-desa.php">Profil Desa</a>
            <a href="produk.php">Produk Unggulan</a>
            <a href="#infografis">Infografis</a>
        </div>
    </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero" id="home">
    <div class="hero-content">
        <h1>Selamat Datang di<br>Website Resmi Desa Ngargosari</h1>
    </div>
</section>

<!-- ===== PROFIL ===== -->
<section class="section center" id="profil">
    <img src="assets/img/logo.png" class="logo-desa">
    <h2>Desa Ngargosari</h2>
    <p>
        Desa Ngargosari merupakan salah satu desa yang berada di Kecamatan Loano,
        Kabupaten Purworejo. Desa ini memiliki potensi UMKM dan sumber daya alam
        yang terus dikembangkan untuk kesejahteraan masyarakat.
    </p>
</section>

<!-- ===== MAP ===== -->
<section class="section">
    <h2>Peta Desa</h2>
    <div class="map">
        <img src="assets/img/peta-desa.png" alt="Peta Desa">
    </div>
</section>

<!-- ===== PRODUK ===== -->
<section class="section" id="produk">
    <h2>Produk Unggulan</h2>
    <div class="grid">
        <?php
        $q = mysqli_query($koneksi,"SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");
        while($p = mysqli_fetch_assoc($q)){
        ?>
        <div class="card">
            <img src="assets/img/produk/<?= $p['gambar'] ?>">
            <div class="card-body">
                <h4><?= htmlspecialchars($p['nama_produk']) ?></h4>
                <div class="price">Rp <?= number_format($p['harga']) ?></div>
                <a class="btn-wa" target="_blank"
                   href="https://wa.me/<?= $p['no_wa'] ?>?text=Halo%20saya%20tertarik%20produk%20<?= urlencode($p['nama_produk']) ?>">
                   💬 Pesan
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- ===== INFOGRAFIS ===== -->
<section class="section" id="infografis">
    <h2>Jumlah Penduduk</h2>
    <div class="infografis">
        <div class="info-box">
            <h3>Total Penduduk</h3>
            <p>3.200 Jiwa</p>
        </div>
        <div class="info-box">
            <h3>Kepala Keluarga</h3>
            <p>1.050 KK</p>
        </div>
        <div class="info-box">
            <h3>Laki-laki</h3>
            <p>1.600 Jiwa</p>
        </div>
        <div class="info-box">
            <h3>Perempuan</h3>
            <p>1.600 Jiwa</p>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer>
    © <?= date('Y') ?> Pemerintah Desa Ngargosari<br>
    Kecamatan Loano – Kabupaten Purworejo
</footer>

</body>
</html>
