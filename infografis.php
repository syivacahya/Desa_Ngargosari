<?php
include "koneksi.php";

$data = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM penduduk ORDER BY tahun DESC LIMIT 1")
);

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
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
</head>

<body>

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

</body>
</html>
