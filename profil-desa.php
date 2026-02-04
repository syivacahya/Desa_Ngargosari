<?php
include "koneksi.php";

/* Ambil profil desa dengan pengecekan */
$result = mysqli_query($koneksi,"SELECT * FROM profil_desa WHERE id=1");

if($result && mysqli_num_rows($result) > 0){
    $profil = mysqli_fetch_assoc($result);
} else {
    $profil = [
        'sejarah' => 'Belum ada sejarah yang diinput.',
        'visi_misi' => 'Belum ada visi & misi yang diinput.'
    ];
}

/* Ambil struktur pemerintahan desa */
$struktur_result = mysqli_query($koneksi,"SELECT * FROM struktur_desa ORDER BY id ASC");
$struktur = [];
if($struktur_result && mysqli_num_rows($struktur_result) > 0){
    while($row = mysqli_fetch_assoc($struktur_result)){
        $struktur[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Desa Ngargosari</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
/* ========== BASIC STYLES ========== */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f4f6f9;
    display:flex;
}
/* ========== SIDEBAR ========== */
.sidebar{
    width:220px;
    background:#3a562e;
    min-height:100vh;
    padding:20px;
    color:white;
    display:flex;
    flex-direction:column;
}
.sidebar .logo-box{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:30px;
}
.sidebar .logo-box img{
    width:40px;
}
.sidebar a{
    display:block;
    color:white;
    padding:10px 15px;
    margin-bottom:5px;
    border-radius:8px;
    text-decoration:none;
}
.sidebar a.active, .sidebar a:hover{
    background:#4a6b3c;
}
/* ========== MAIN CONTENT ========== */
.main{
    flex:1;
    padding:30px;
}
/* ========== HEADER ========== */
.header h2{
    margin:0;
    color:#1b5e20;
}
.header p{
    margin:5px 0 20px 0;
    color:#555;
}
/* ========== SECTIONS ========== */
.section{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    margin-bottom:35px;
}
.struktur{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:25px;
    margin-top:25px;
}
.card{
    text-align:center;
}
.card img{
    width:100%;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}
.card h4{
    margin:12px 0 5px;
    color:#1b5e20;
}
.card span{
    font-size:14px;
    color:#555;
}
/* ========== FOOTER ========== */
footer{
    margin-top:40px;
}
footer .bg-footer{
    background:#4a6b3c;
    color:white;
}
footer .bg-footer a{
    color:white;
}
footer .bottom{
    background:#3a562e;
    color:white;
    text-align:center;
    font-size:12px;
    padding:5px 0;
}
</style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">

    <div class="logo-box">
        <img src="assets/img/logo.png" alt="Logo Desa Ngargosari">
        <span>ADMIN DESA</span>
    </div>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="profil.php" class="active">📌 Profil Desa</a>
    <a href="infografis.php">📊 Infografis</a>
    <a href="produk.php">🛒 Produk Unggulan</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<!-- ================= MAIN CONTENT ================= -->
<div class="main">

    <!-- HEADER -->
    <div class="header">
        <h2>Profil Desa</h2>
        <p>Kelola informasi desa dan struktur pemerintahan</p>
    </div>

    <!-- ================= PROFIL DESA ================= -->
    <div class="section">
        <h2>Sejarah Singkat Desa</h2>
        <p><?= nl2br($profil['sejarah']); ?></p>
    </div>

    <div class="section">
        <h2>Visi & Misi</h2>
        <p><?= nl2br($profil['visi_misi']); ?></p>
    </div>

    <div class="section">
        <h2>Struktur Pemerintahan Desa</h2>

        <div class="struktur">
            <?php if(!empty($struktur)): ?>
                <?php foreach($struktur as $s): ?>
                    <div class="card">
                        <img src="assets/img/struktur/<?= $s['foto']; ?>" alt="<?= $s['nama']; ?>">
                        <h4><?= $s['nama']; ?></h4>
                        <span><?= $s['jabatan']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada data struktur pemerintahan desa.</p>
            <?php endif; ?>
        </div>

    </div>

    <!-- ================= FOOTER ================= -->
    <footer>
        <div class="bg-footer max-w-6xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-6 text-sm">
            <div>
                <img src="assets/img/logo.png" class="w-12 mb-3">
                <p class="font-semibold">Pemerintah Desa Ngargosari</p>
                <p>Kecamatan Loano, Kabupaten Purworejo</p>
            </div>
            <div>
                <p class="font-semibold mb-2">Hubungi Kami</p>
                <p>📞 08888888</p>
                <p>📷 Instagram</p>
            </div>
        </div>
        <div class="bottom">
            © 2026 Desa Ngargosari
        </div>
    </footer>

</div> <!-- END MAIN -->

</body>
</html>
