<?php
include 'config/koneksi.php';

// ambil data terbaru
$queryLatest = mysqli_query(
    $koneksi,
    "SELECT * FROM statistik_penduduk ORDER BY tahun DESC LIMIT 1"
);
$latest = mysqli_fetch_assoc($queryLatest);

// ambil semua data
$queryAll = mysqli_query(
    $koneksi,
    "SELECT * FROM statistik_penduduk ORDER BY tahun DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Infografis Desa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
        }
        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px;
        }
        h1 {
            text-align: center;
            margin-bottom: 5px;
        }
        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .card h3 {
            font-size: 15px;
            color: #6b7280;
        }
        .card .number {
            font-size: 32px;
            font-weight: bold;
            color: #0f766e;
        }
        table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 14px;
            text-align: center;
        }
        th {
            background: #0f766e;
            color: white;
        }
        tr:nth-child(even) {
            background: #f0fdfa;
        }
        .btn {
            padding: 6px 14px;
            border-radius: 20px;
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Infografis Data Kependudukan Desa</h1>
    <p class="subtitle">Tahun <?= $latest['tahun']; ?> • Administrasi Desa</p>

    <!-- KARTU UTAMA -->
    <div class="cards">
        <div class="card">
            <h3>Total Penduduk</h3>
            <div class="number"><?= $latest['total_penduduk']; ?></div>
        </div>
        <div class="card">
            <h3>Kepala Keluarga</h3>
            <div class="number"><?= $latest['kepala_keluarga']; ?></div>
        </div>
        <div class="card">
            <h3>Laki-laki</h3>
            <div class="number"><?= $latest['laki_laki']; ?></div>
        </div>
        <div class="card">
            <h3>Perempuan</h3>
            <div class="number"><?= $latest['perempuan']; ?></div>
        </div>
    </div>

    <!-- TABEL DATA -->
    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Total Penduduk</th>
                <th>Kepala Keluarga</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($queryAll)) { ?>
            <tr>
                <td><?= $row['tahun']; ?></td>
                <td><?= $row['total_penduduk']; ?></td>
                <td><?= $row['kepala_keluarga']; ?></td>
                <td><?= $row['laki_laki']; ?></td>
                <td><?= $row['perempuan']; ?></td>
                <td><button class="btn">Detail</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="footer">
        © <?= date('Y'); ?> Sistem Informasi Desa
    </div>
</div>

</body>
</html>
