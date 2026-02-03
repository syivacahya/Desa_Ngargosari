<?php $page = basename($_SERVER['PHP_SELF']); ?>

<div class="sidebar">
    <h2>ADMIN DESA</h2>

    <a href="dashboard.php" class="<?= $page=='dashboard.php'?'active':'' ?>">🏠 Dashboard</a>
    <a href="profil.php" class="<?= $page=='profil.php'?'active':'' ?>">📌 Profil Desa</a>
    <a href="infografis.php" class="<?= $page=='infografis.php'?'active':'' ?>">📊 Infografis</a>
    <a href="produk.php" class="<?= $page=='produk.php'?'active':'' ?>">🛒 Produk Unggulan</a>
    <a href="logout.php">🚪 Logout</a>
</div>
