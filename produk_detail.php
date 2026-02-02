<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = (int)$_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Produk tidak ditemukan";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($data['nama_produk']) ?></title>

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
.container{max-width:1000px;margin:50px auto;padding:0 20px}

.detail{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;
    align-items:start;
}

.detail img{
    width:100%;
    height:350px;
    object-fit:cover;
    border-radius:6px;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}

.detail h1{
    margin-top:0;
    font-weight:600;
}

.detail p{
    line-height:1.7;
    color:#444;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 18px;
    background:#355e2b;
    color:white;
    text-decoration:none;
    border-radius:5px;
    margin-right:10px;
}

.btn.wa{
    background:#25D366;
}
.btn.wa:hover{
    background:#1ebe5d;
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
    .detail{grid-template-columns:1fr}
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

    <div class="detail">
        <div>
            <img src="assets/img/produk/<?= $data['gambar'] ?>">
        </div>

        <div>
            <h1><?= htmlspecialchars($data['nama_produk']) ?></h1>

            <p><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
            <p><?= nl2br(htmlspecialchars($data['lokasi'])) ?></p>

            <?php if(!empty($data['harga'])){ ?>
                <p><strong>Harga :</strong> Rp <?= number_format($data['harga'],0,',','.') ?></p>
            <?php } ?>

            <?php
               $no_wa = $data['no_wa'];
                $pesan = urlencode(
                   "Halo, saya tertarik dengan produk:\n".
                    "Nama : ".$data['nama_produk']."\n".
                    "Harga : Rp ".number_format($data['harga'],0,',','.')." / 1 pcs\n".
                    "Apakah masih tersedia"
                );
                $link_wa = "https://wa.me/$no_wa?text=$pesan";
            ?>

            <a href="<?= $link_wa ?>" target="_blank" class="btn wa">💬 Pesan via WhatsApp</a>
            <a href="produk.php" class="btn">← Kembali</a>
        </div>
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
