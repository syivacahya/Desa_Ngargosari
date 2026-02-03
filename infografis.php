<<<<<<< HEAD
=======
<?php
include "koneksi.php";

$data = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM penduduk ORDER BY tahun DESC LIMIT 1")
);

?>
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<<<<<<< HEAD
<title>Infografis Desa Ngargosari</title>
<script src="https://cdn.tailwindcss.com"></script>
=======
<title>Infografis Desa</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{font-family:Poppins;background:#f4f6f9;padding:30px}
.card{background:white;padding:25px;border-radius:15px}
</style>
</head>
<body>

<h2>📊 Infografis Penduduk Tahun <?= $data['tahun'] ?></h2>

<div class="card">
<canvas id="pendudukChart"></canvas>
</div>

<script>
const ctx = document.getElementById('pendudukChart');

new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Laki-laki','Perempuan'],
    datasets: [{
      data: [<?= $data['laki'] ?>, <?= $data['perempuan'] ?>],
      backgroundColor: ['#2e7d32','#81c784']
    }]
  }
});
</script>
=======

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:'Poppins', sans-serif;
    background:#f4f6f9;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:230px;
    height:100vh;
    background:linear-gradient(180deg,#1b5e20,#2e7d32);
    position:fixed;
    color:white;
}

.logo-box{
    display:flex;
    flex-direction:column;
    align-items:center;
    padding:20px 10px;
    border-bottom:1px solid rgba(255,255,255,0.25);
}

.logo-box img{
    width:80px;
    margin-bottom:10px;
}

.logo-box span{
    font-size:14px;
    font-weight:600;
    letter-spacing:1px;
}

.sidebar a{
    display:block;
    padding:14px 22px;
    color:white;
    text-decoration:none;
    font-size:15px;
    transition:0.3s;
}

.sidebar a:hover,
.sidebar a.active{
    background:rgba(255,255,255,0.2);
    padding-left:30px;
}

/* ===== HEADER ===== */
.header{
    margin-left:230px;
    background:white;
    padding:18px 30px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

.header h2{
    margin:0;
    font-weight:600;
}

.header p{
    margin-top:5px;
    color:#777;
}

/* ===== CONTENT ===== */
.content{
    margin-left:230px;
    padding:30px;
}

/* CARD */
.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
    margin-bottom:30px;
}

.card h3{
    margin-top:0;
    color:#1b5e20;
}

/* FORM */
label{
    font-weight:500;
    color:#1b5e20;
    display:block;
    margin-top:15px;
}

input, select{
    width:100%;
    padding:10px;
    margin-top:6px;
    border-radius:8px;
    border:1px solid #ccc;
}

.grid-4{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:20px;
    margin-top:10px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

table th, table td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}

table th{
    background:#e8f5e9;
}

/* BUTTON */
.btn-right{
    display:flex;
    justify-content:flex-end;
    margin-top:20px;
}

button{
    background:#2e7d32;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
}

button:hover{
    background:#1b5e20;
}

.note{
    font-size:13px;
    margin-top:10px;
    color:#555;
}
</style>
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4
</head>

<body class="bg-gray-100">

<<<<<<< HEAD
<!-- ================= HEADER ================= -->
<header class="bg-[#4a6b3c] text-white">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="assets/img/logo.png" class="w-10">
            <div>
                <h1 class="font-semibold text-sm">Desa Ngargosari</h1>
                <p class="text-xs opacity-80">Kecamatan Loano, Kabupaten Purworejo</p>
            </div>
        </div>
        <nav class="flex gap-6 text-sm">
            <a href="index.php">Home</a>
            <a href="profil-desa.php">Profil Desa</a>
            <a href="produk.php">Produk Unggulan Desa</a>
            <a href="infografis.php" class="font-semibold underline">Infografis</a>
        </nav>
    </div>
</header>

<!-- ================= CONTENT ================= -->
<main class="max-w-6xl mx-auto px-6 py-10 space-y-12">

<!-- ===== JUDUL ===== -->
<h2 class="text-xl font-semibold text-gray-800">Jumlah Penduduk</h2>

<!-- ===== KARTU DATA ===== -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<?php
// DATA CONTOH (NANTI BISA DIGANTI DATABASE)
$data = [
    ["Total Penduduk", "1.300 Jiwa"],
    ["Kepala Keluarga", "540 Jiwa"],
    ["Perempuan", "540 Jiwa"],
    ["Laki-Laki", "540 Jiwa"]
];

foreach($data as $d):
?>
<div class="bg-[#d8e4c9] rounded-lg p-5 flex items-center gap-4">
    <div class="w-12 h-12 bg-white rounded-full"></div>
    <div>
        <p class="text-sm text-gray-700"><?= $d[0] ?></p>
        <p class="font-semibold"><?= $d[1] ?></p>
    </div>
</div>
<?php endforeach; ?>

</div>

<!-- ===== GRAFIK UMUR ===== -->
<section class="space-y-6">

<h2 class="text-xl font-semibold text-gray-800">Berdasarkan Kelompok Umur</h2>

<!-- BAR CHART -->
<div class="bg-white p-6 rounded shadow">
    <div class="flex items-end gap-3 h-56">

        <?php
        // DATA GRAFIK (CONTOH)
        $umur = [70,90,60,100,80,50,70,110,40,85,120,95,60,80];
        foreach($umur as $i => $v):
        ?>
        <div class="flex-1 flex items-end gap-1">
            <div class="w-3 bg-[#b7cf9d]" style="height:<?= $v ?>%"></div>
            <div class="w-3 bg-[#3e5c2f]" style="height:<?= $v-20 ?>%"></div>
        </div>
        <?php endforeach; ?>

    </div>

    <div class="mt-6 space-y-2">
        <div class="bg-[#d8e4c9] p-2 rounded text-sm">total kelompok tertinggi</div>
        <div class="bg-[#3e5c2f] text-white p-2 rounded text-sm">total kelompok terendah</div>
    </div>
</div>

</section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-[#4a6b3c] text-white mt-16">
    <div class="max-w-6xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-6 text-sm">
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
    <div class="text-center text-xs py-3 bg-[#3a562e]">
        © 2026 Desa Ngargosari
    </div>
</footer>
=======
<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo-box">
        <img src="assets/img/logo.png" alt="Logo Desa Ngargosari">
        <span>ADMIN DESA</span>
    </div>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="profil.php">📌 Profil Desa</a>
    <a href="infografis.php" class="active">📊 Infografis</a>
    <a href="produk.php">🛒 Produk Unggulan</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<!-- HEADER -->
<div class="header">
    <h2>Infografis Desa</h2>
    <p>Kelola data kependudukan desa</p>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- JUMLAH PENDUDUK -->
    <div class="card">
        <h3>Jumlah Penduduk</h3>

        <label>Tahun Data</label>
        <select>
            <option>2024</option>
            <option>2023</option>
        </select>

        <div class="grid-4">
            <div>
                <label>Total Penduduk</label>
                <input type="number">
            </div>
            <div>
                <label>Kepala Keluarga</label>
                <input type="number">
            </div>
            <div>
                <label>Laki-laki</label>
                <input type="number">
            </div>
            <div>
                <label>Perempuan</label>
                <input type="number">
            </div>
        </div>

        <div class="note">
            Catatan: Laki-laki + Perempuan = Total Penduduk
        </div>

        <div class="btn-right">
            <button>💾 Simpan</button>
        </div>
    </div>

    <!-- KELOMPOK UMUR -->
    <div class="card">
        <h3>Kelompok Umur Penduduk</h3>

        <label>Tahun Data</label>
        <select>
            <option>2024</option>
            <option>2023</option>
        </select>

        <table>
            <tr>
                <th>Kelompok Umur</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
            <tr>
                <td>0 - 4</td>
                <td><input type="number"></td>
                <td><input type="number"></td>
            </tr>
            <tr>
                <td>5 - 9</td>
                <td><input type="number"></td>
                <td><input type="number"></td>
            </tr>
            <tr>
                <td>10 - 14</td>
                <td><input type="number"></td>
                <td><input type="number"></td>
            </tr>
            <tr>
                <td>15 - 19</td>
                <td><input type="number"></td>
                <td><input type="number"></td>
            </tr>
            <tr>
                <td>20 - 24</td>
                <td><input type="number"></td>
                <td><input type="number"></td>
            </tr>
            <tr>
                <td>25 - 29</td>
                <td><input type="number"></td>
                <td><input type="number"></td>
            </tr>
        </table>

        <div class="btn-right">
            <button>💾 Simpan</button>
        </div>
    </div>

</div>
>>>>>>> 3f8026b8ea5024ac020ba803bc15cd2d64f4691e
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4

</body>
</html>
