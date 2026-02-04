<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

// Validasi ID
if (!isset($_GET['id'])) {
    header("Location: profil.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM struktur_pemerintahan WHERE id = $id");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: profil.php");
    exit;
}

$error = "";

if (isset($_POST['update'])) {
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);

    $gambar_lama = $data['gambar'];
    $gambar_baru = $gambar_lama;

    // Jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $ext  = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama_file = uniqid() . "." . $ext;
        $tmp  = $_FILES['gambar']['tmp_name'];
        $dir  = "../uploads/";

        move_uploaded_file($tmp, $dir . $nama_file);

        // Hapus gambar lama
        if ($gambar_lama && file_exists($dir . $gambar_lama)) {
            unlink($dir . $gambar_lama);
        }

        $gambar_baru = $nama_file;
    }

    $update = mysqli_query($koneksi, "
        UPDATE struktur_pemerintahan SET
            nama    = '$nama',
            jabatan = '$jabatan',
            gambar  = '$gambar_baru'
        WHERE id = $id
    ");

    if ($update) {
        header("Location: profil.php");
        exit;
    } else {
        $error = "Gagal mengupdate data struktur!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<<head>
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
            <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin Desa Ngargosari</h2>
            <p class="text-gray-500 text-sm">Profil Desa</p>
        </header>

        <main class="p-8 space-y-10">

<body class="bg-black/40">

<!-- OVERLAY -->
<div class="fixed inset-0 flex items-center justify-center z-50">

    <!-- MODAL -->
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Edit Struktur Pemerintahan
            </h2>
            <a href="profil.php"
               class="text-gray-400 hover:text-red-500 text-xl">
               &times;
            </a>
        </div>

        <!-- FORM -->
        <form method="post" enctype="multipart/form-data" class="p-6 space-y-4">

            <?php if ($error): ?>
                <div class="bg-red-100 text-red-600 px-4 py-2 rounded text-sm">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="nama" required
                       value="<?= htmlspecialchars($data['nama']) ?>"
                       class="w-full border rounded px-3 py-2
                              focus:outline-none focus:ring-1 focus:ring-green-600">
            </div>

            <!-- Jabatan -->
            <div>
                <label class="block text-sm font-medium mb-1">Jabatan</label>
                <input type="text" name="jabatan" required
                       value="<?= htmlspecialchars($data['jabatan']) ?>"
                       class="w-full border rounded px-3 py-2
                              focus:outline-none focus:ring-1 focus:ring-green-600">
            </div>

            <!-- Gambar Lama -->
            <?php if ($data['gambar']): ?>
            <div>
                <label class="block text-sm font-medium mb-1">Foto Saat Ini</label>
                <img src="../uploads/<?= $data['gambar'] ?>"
                     class="w-28 h-28 object-cover rounded border">
            </div>
            <?php endif; ?>

            <!-- Upload Baru -->
            <div>
                <label class="block text-sm font-medium mb-1">
                    Ganti Foto (Opsional)
                </label>
                <input type="file" name="gambar" accept="image/*"
                       class="w-full text-sm">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="profil.php"
                   class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-sm">
                    Batal
                </a>

                <button type="submit" name="update"
                        class="px-4 py-2 rounded bg-yellow-500 hover:bg-yellow-600 text-black text-sm">
                    Update
                </button>
            </div>

        </form>

    </div>
</div>

</body>
</html>
