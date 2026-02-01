<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Infografis</title>

<style>
*{
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body{
    margin:0;
    background:#f2f2f2;
}

/* Layout */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* Sidebar */
.sidebar{
    width:230px;
    background:#3f5f2f;
    color:white;
    padding:20px;
}

.sidebar img{
    width:100px;
    display:block;
    margin:0 auto 30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px 15px;
    margin-bottom:10px;
    border-radius:6px;
}

.sidebar a:hover,
.sidebar a.active{
    background:#6d8f57;
}

/* Main */
.main{
    flex:1;
}

/* Header */
.header{
    background:#3f5f2f;
    color:white;
    padding:20px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.content{
    padding:30px;
}

/* Card */
.card{
    background:white;
    border-radius:8px;
    padding:20px;
    margin-bottom:25px;
    border:1px solid #ccc;
}

.card h2{
    margin-top:0;
}

/* Form */
.form-row{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:15px;
    margin-top:15px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group label{
    font-size:14px;
    margin-bottom:5px;
}

.form-group input,
.form-group select{
    padding:8px;
    border:1px solid #aaa;
    border-radius:4px;
}

.note{
    font-size:13px;
    margin-top:10px;
}

.btn{
    background:#3f5f2f;
    color:white;
    border:none;
    padding:8px 18px;
    border-radius:5px;
    cursor:pointer;
}

.btn:hover{
    background:#2e4723;
}

.btn-right{
    display:flex;
    justify-content:flex-end;
    margin-top:15px;
}

/* Tabel umur */
.age-table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

.age-table th,
.age-table td{
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="assets/img/logo.png" alt="Logo">

        <a href="dashboard.php">Dashboard</a>
        <a href="profil_desa.php">Profil Desa</a>
        <a href="produk.php">Produk Unggulan Desa</a>
        <a href="infografis.php" class="active">Infografis</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main -->
    <div class="main">

        <!-- Header -->
        <div class="header">
            <h2>Infografis</h2>
            <span>Admin Desa</span>
        </div>

        <!-- Content -->
        <div class="content">

            <!-- Jumlah Penduduk -->
            <div class="card">
                <h2>Jumlah Penduduk</h2>

                <label>Tahun Data:
                    <select>
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </label>

                <div class="form-row">
                    <div class="form-group">
                        <label>Total Penduduk</label>
                        <input type="number">
                    </div>

                    <div class="form-group">
                        <label>Kepala Keluarga</label>
                        <input type="number">
                    </div>

                    <div class="form-group">
                        <label>Laki-laki</label>
                        <input type="number">
                    </div>

                    <div class="form-group">
                        <label>Perempuan</label>
                        <input type="number">
                    </div>
                </div>

                <div class="note">
                    Catatan: Laki-laki + Perempuan = Total Penduduk
                </div>

                <div class="btn-right">
                    <button class="btn">Simpan</button>
                </div>
            </div>

            <!-- Kelompok Umur -->
            <div class="card">
                <label>Tahun Data:
                    <select>
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </label>

                <table class="age-table">
                    <tr>
                        <th>Kelompok Umur</th>
                        <th>Laki-laki</th>
                        <th>Perempuan</th>
                    </tr>
                    <tr>
                        <td>0 - 4</td>
                        <td><input type="number" value="19"></td>
                        <td><input type="number" value="21"></td>
                    </tr>
                    <tr>
                        <td>5 - 9</td>
                        <td><input type="number" value="50"></td>
                        <td><input type="number" value="48"></td>
                    </tr>
                    <tr>
                        <td>10 - 14</td>
                        <td><input type="number" value="74"></td>
                        <td><input type="number" value="57"></td>
                    </tr>
                    <tr>
                        <td>15 - 19</td>
                        <td><input type="number" value="85"></td>
                        <td><input type="number" value="49"></td>
                    </tr>
                    <tr>
                        <td>20 - 24</td>
                        <td><input type="number" value="112"></td>
                        <td><input type="number" value="92"></td>
                    </tr>
                    <tr>
                        <td>25 - 29</td>
                        <td><input type="number" value="66"></td>
                        <td><input type="number" value="60"></td>
                    </tr>
                </table>

                <div class="btn-right">
                    <button class="btn">Simpan</button>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>
