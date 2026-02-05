<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$qProfil    = mysqli_query($koneksi, "SELECT * FROM profil_desa LIMIT 1");
$profil     = mysqli_fetch_assoc($qProfil);

$qbatas      = mysqli_query($koneksi, "SELECT * FROM batas_wilayah LIMIT 1");
$batas       = mysqli_fetch_assoc($qbatas);

$qStruktur   = mysqli_query($koneksi, "SELECT * FROM struktur_pemerintahan ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Desa</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 font-poppins">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white z-50">
        <div class="flex flex-col items-center py-6 border-b border-white/20">
            <img src="../assets/img/logo.png" class="w-20 mb-3">
            <span class="text-sm tracking-wider font-semibold">ADMIN DESA</span>
        </div>

        <nav class="mt-4 text-sm">
            <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
            <a href="profil.php" class="block px-6 py-3 hover:bg-white/20">📌 Profil Desa</a>
            <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
            <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
            <a href="berita.php" class="block px-6 py-3 hover:bg-white/20">📰 Berita</a>
            <a href="galeri.php" class="block px-6 py-3 hover:bg-white/20">🖼️ Galeri</a>
            <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
        </nav>
    </aside>

    <!-- ================= CONTENT ================= -->
    <div class="flex-1 ml-60">

        <!-- HEADER -->
        <header class="bg-white px-8 py-5 shadow">
            <h2 class="text-xl font-semibold text-gray-800">Profil Desa Admin Desa Ngargosari</h2>
            <p class="text-gray-500 text-sm">Profil Desa</p>
        </header>

        <main class="p-8 space-y-10">

            <!-- ================= PROFIL DESA ================= -->
            <section class="bg-white rounded shadow">
                <div class="flex justify-between items-center px-6 py-4 border-b">
                    <h2 class="font-semibold text-lg">Profil Desa</h2>
                    <?php if (!$profil): ?>
                        <a href="profil_tambah.php"
                           class="bg-green-700 text-white px-4 py-2 rounded text-sm hover:bg-green-800">
                           + Tambah Profil
                        </a>
                    <?php endif; ?>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-[1200px] w-full text-sm">
                        <thead class="bg-green-200">
                            <tr>
                                <th class="p-3">Visi</th>
                                <th class="p-3">Misi</th>
                                <th class="p-3">Sejarah</th>
                                <th class="p-3">Luas</th>
                                <th class="p-3">RT</th>
                                <th class="p-3">Dusun</th>
                                <th class="p-3">Nama Dusun</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($profil): ?>
                            <tr class="border-t align-top">
                                <td class="p-3"><?= $profil['visi'] ?></td>
                                <td class="p-3"><?= $profil['misi'] ?></td>
                                <td class="p-3"><?= $profil['sejarah'] ?></td>
                                <td class="p-3"><?= $profil['luas_wilayah'] ?></td>
                                <td class="p-3"><?= $profil['jumlah_rt'] ?></td>
                                <td class="p-3"><?= $profil['jumlah_dusun'] ?></td>
                                <td class="p-3"><?= $profil['nama_dusun'] ?></td>
                                <td class="p-3 text-center">
                                    <!-- Ubah flex ke flex-col untuk vertikal -->
                                    <div class="flex flex-col items-center gap-2">
                                        <a href="profil_edit.php?id=<?= $profil['id'] ?>"
                                           class="bg-yellow-400 px-3 py-1 rounded text-sm w-full text-center">Edit</a>
                                        <a href="profil_hapus.php?id=<?= $profil['id'] ?>"
                                           class="bg-red-500 text-white px-3 py-1 rounded text-sm w-full text-center"
                                           onclick="return confirm('Yakin hapus data?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500 italic">
                                    Data profil desa belum tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- ================= BATAS WILAYAH ================= -->
<section class="bg-white rounded shadow">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h2 class="font-semibold text-lg">Batas Wilayah</h2>
        <?php if (!$batas): ?>
            <a href="batas_tambah.php"
               class="bg-green-700 text-white px-4 py-2 rounded text-sm hover:bg-green-800">
               + Tambah Batas
            </a>
        <?php endif; ?>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-[800px] w-full text-sm">
            <thead class="bg-green-200">
                <tr>
                    <th class="p-3">Utara</th>
                    <th class="p-3">Timur</th>
                    <th class="p-3">Selatan</th>
                    <th class="p-3">Barat</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($batas): ?>
                <tr class="border-t">
                    <td class="p-3"><?= $batas['utara'] ?></td>
                    <td class="p-3"><?= $batas['timur'] ?></td>
                    <td class="p-3"><?= $batas['selatan'] ?></td>
                    <td class="p-3"><?= $batas['barat'] ?></td>
                    <td class="p-3 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <a href="batas_edit.php?id=<?= $batas['id'] ?>"
                               class="bg-yellow-400 px-3 py-1 rounded text-sm w-full text-center">Edit</a>
                            <a href="batas_hapus.php?id=<?= $batas['id'] ?>"
                               class="bg-red-500 text-white px-3 py-1 rounded text-sm w-full text-center"
                               onclick="return confirm('Yakin hapus data?')">Hapus</a>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 italic">
                        Data batas wilayah belum tersedia
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- STRUKTUR PEMERINTAHAN -->
<section class="bg-white rounded shadow">
<div class="flex justify-between items-center px-6 py-4 border-b">
    <h2 class="font-semibold text-lg">Struktur Pemerintahan</h2>
    <a href="struktur_tambah.php"
       class="bg-green-700 text-white px-4 py-2 rounded text-sm hover:bg-green-800">
       + Tambah Struktur
    </a>
</div>

<div class="overflow-x-auto">
<table class="min-w-[900px] w-full text-sm">
<thead class="bg-green-200">
<tr>
    <th class="p-3 w-16 text-center">No</th>
    <th class="p-3">Nama</th>
    <th class="p-3">Jabatan</th>
    <th class="p-3 text-center">Gambar</th>
    <th class="p-3 w-32 text-center">Aksi</th>
</tr>
</thead>

<tbody>
<?php if (mysqli_num_rows($qStruktur) > 0): ?>
<?php $no = 1; while ($s = mysqli_fetch_assoc($qStruktur)): ?>

<?php
$gambarFile   = $s['gambar'];
$gambarServer = __DIR__ . '/../uploads/struktur/' . $gambarFile;
$gambarWeb    = '../uploads/struktur/' . $gambarFile;
?>

<tr class="border-t">
    <td class="p-3 text-center"><?= $no++ ?></td>
    <td class="p-3"><?= htmlspecialchars($s['nama']) ?></td>
    <td class="p-3"><?= htmlspecialchars($s['jabatan']) ?></td>

    <td class="p-3 text-center">
        <?php if (!empty($gambarFile) && file_exists($gambarServer)): ?>
            <img src="<?= $gambarWeb ?>"
                 class="w-16 h-16 object-cover rounded mx-auto border">
        <?php else: ?>
            <span class="text-gray-400 italic">Tidak ada</span>
        <?php endif; ?>
    </td>

    <td class="p-3 text-center">
        <div class="flex flex-col items-center gap-2">
            <a href="struktur_edit.php?id=<?= $s['id'] ?>"
               class="bg-yellow-400 px-3 py-1 rounded text-sm w-full text-center">
               Edit
            </a>
            <a href="struktur_hapus.php?id=<?= $s['id'] ?>"
               class="bg-red-500 text-white px-3 py-1 rounded text-sm w-full text-center"
               onclick="return confirm('Yakin hapus data?')">
               Hapus
            </a>
        </div>
    </td>
</tr>

<?php endwhile; ?>
<?php else: ?>
<tr>
<td colspan="5" class="p-4 text-center text-gray-500 italic">
    Belum ada data struktur pemerintahan
</td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>
</section>



        </main>
    </div>
</div>

</body>
</html>
