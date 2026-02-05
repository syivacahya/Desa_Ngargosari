<?php
include "koneksi.php";
$halaman = basename($_SERVER['PHP_SELF']);
include "partials/header.php";

/* ================= Ambil tahun terbaru ================= */
$queryLatestYear = mysqli_query($koneksi, "SELECT tahun FROM infografis_umur ORDER BY tahun DESC LIMIT 1");
$latestYearRow = mysqli_fetch_assoc($queryLatestYear);
$latestYear = $latestYearRow['tahun'] ?? date('Y');

/* ================= Ambil data terbaru untuk kartu statistik ================= */
$queryLatestPenduduk = mysqli_query($koneksi, "SELECT * FROM infografis_penduduk WHERE tahun='$latestYear' LIMIT 1");
$latest = mysqli_fetch_assoc($queryLatestPenduduk);

/* ================= Ambil semua data penduduk untuk tabel ================= */
$queryAllTabel = mysqli_query($koneksi, "SELECT * FROM infografis_penduduk ORDER BY tahun DESC");

/* ================= Ambil semua data kelompok umur ================= */
$queryAllUmur = mysqli_query($koneksi, "SELECT * FROM infografis_umur ORDER BY tahun DESC, id ASC");

/* ================= Ambil data grafik kelompok umur tahun terbaru ================= */
$qGrafik = mysqli_query($koneksi, "
    SELECT kelompok_umur, laki, perempuan
    FROM infografis_umur
    WHERE tahun='$latestYear'
    ORDER BY id ASC
");

$labelUmur = [];
$lakiData = [];
$perempuanData = [];
while ($row = mysqli_fetch_assoc($qGrafik)) {
    $labelUmur[] = $row['kelompok_umur'];
    $lakiData[] = (int)$row['laki'];
    $perempuanData[] = (int)$row['perempuan'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Infografis Desa Ngargosari</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-50 text-gray-800">

<!-- ================= MAIN ================= -->
<main class="max-w-6xl mx-auto px-6 py-12 space-y-12">

    <!-- ================= JUDUL ================= -->
    <div class="text-center">
        <h1 class="text-3xl font-semibold mb-2">Infografis Data Kependudukan Desa</h1>
        <p class="text-gray-500">Tahun <?= $latestYear ?></p>
    </div>

    <!-- ================= TABEL JUMLAH PENDUDUK ================= -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <h3 class="font-semibold text-lg p-4">Jumlah Penduduk</h3>
        <table class="w-full text-sm text-center border-collapse">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 border">Tahun</th>
                    <th class="p-3 border">Total</th>
                    <th class="p-3 border">KK</th>
                    <th class="p-3 border">Laki-laki</th>
                    <th class="p-3 border">Perempuan</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($queryAllTabel && mysqli_num_rows($queryAllTabel) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($queryAllTabel)): ?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 border"><?= $row['tahun'] ?></td>
                            <td class="border"><?= $row['total'] ?></td>
                            <td class="border"><?= $row['kk'] ?></td>
                            <td class="border"><?= $row['laki'] ?></td>
                            <td class="border"><?= $row['perempuan'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-4 text-gray-500">
                            Data belum tersedia
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ================= TABEL KELOMPOK UMUR ================= -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <h3 class="font-semibold text-lg p-4">Penduduk Berdasarkan Kelompok Umur</h3>
        <table class="w-full text-sm text-center border-collapse">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 border">Tahun</th>
                    <th class="p-3 border">Kelompok Umur</th>
                    <th class="p-3 border">Laki-laki</th>
                    <th class="p-3 border">Perempuan</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($queryAllUmur && mysqli_num_rows($queryAllUmur) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($queryAllUmur)): ?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 border"><?= $row['tahun'] ?></td>
                            <td class="border"><?= $row['kelompok_umur'] ?></td>
                            <td class="border"><?= $row['laki'] ?></td>
                            <td class="border"><?= $row['perempuan'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="p-4 text-gray-500">
                            Data belum tersedia
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ================= GRAFIK UMUR ================= -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold text-lg mb-6 text-center">Penduduk Berdasarkan Kelompok Umur (Tahun <?= $latestYear ?>)</h3>
        <canvas id="grafikUmur" height="120"></canvas>
    </div>

</main>

<?php include "partials/footer.php"; ?>

<!-- ================= SCRIPT GRAFIK ================= -->
<script>
const ctx = document.getElementById('grafikUmur');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($labelUmur) ?>,
        datasets: [
            {
                label: 'Laki-laki',
                data: <?= json_encode($lakiData) ?>,
                backgroundColor: '#3b82f6'
            },
            {
                label: 'Perempuan',
                data: <?= json_encode($perempuanData) ?>,
                backgroundColor: '#ec4899'
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

</body>
</html>
