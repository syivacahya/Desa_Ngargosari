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

</body>
</html>
