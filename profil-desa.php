<?php
include "config/koneksi.php";

/* Ambil profil desa */
$profil = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM profil_desa WHERE id=1")
);

/* Ambil struktur pemerintahan */
$struktur = mysqli_query($conn,"SELECT * FROM struktur_desa ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Desa Ngargosari</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f4f6f9;
}
.container{
    max-width:1100px;
    margin:auto;
    padding:40px 20px;
}
h2{
    color:#1b5e20;
    margin-bottom:10px;
}
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
</style>
</head>

<body>

<!-- ================= PROFIL DESA ================= -->
<div class="container">

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
            <?php while($s = mysqli_fetch_assoc($struktur)): ?>
                <div class="card">
                    <img src="assets/img/struktur/<?= $s['foto']; ?>">
                    <h4><?= $s['nama']; ?></h4>
                    <span><?= $s['jabatan']; ?></span>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

</div>

</body>
</html>
