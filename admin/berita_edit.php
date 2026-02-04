<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

// Ambil ID
if (!isset($_GET['id'])) {
    header("Location: berita.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data berita
$q = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = $id");
$berita = mysqli_fetch_assoc($q);

if (!$berita) {
    header("Location: berita.php");
    exit;
}

$error = "";

if (isset($_POST['update'])) {
    $judul   = htmlspecialchars($_POST['judul']);
    $isi     = htmlspecialchars($_POST['isi']);
    $tanggal = $_POST['tanggal'];

    $gambar_lama = $berita['gambar'];
    $gambar_baru = $gambar_lama;

    // Jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $ext   = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama  = uniqid() . "." . $ext;
        $tmp   = $_FILES['gambar']['tmp_name'];
        $dir   = "../assets/img/berita/";

        move_uploaded_file($tmp, $dir . $nama);

        // Hapus gambar lama jika ada
        if ($gambar_lama && file_exists($dir . $gambar_lama)) {
            unlink($dir . $gambar_lama);
        }

        $gambar_baru = $nama;
    }

    $update = mysqli_query($koneksi, "
        UPDATE berita SET
            judul   = '$judul',
            isi     = '$isi',
            gambar  = '$gambar_baru',
            tanggal = '$tanggal'
        WHERE id = $id
    ");

    if ($update) {
        header("Location: berita.php");
        exit;
    } else {
        $error = "Gagal mengupdate berita!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-black/40">

<!-- OVERLAY -->
<div class="fixed inset-0 flex items-center justify-center z-50">

    <!-- MODAL -->
    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Edit Berita</h2>
            <a href="berita.php" class="text-gray-400 hover:text-red-500 text-xl">&times;</a>
        </div>

        <!-- FORM -->
        <form method="POST" enctype="multipart/form-data" class="p-6 space-y-4">

            <?php if ($error): ?>
                <div class="bg-red-100 text-red-600 px-4 py-2 rounded text-sm">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium mb-1">Judul Berita</label>
                <input type="text" name="judul" required
                       value="<?= htmlspecialchars($berita['judul']) ?>"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-600">
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal</label>
                <input type="date" name="tanggal" required
                       value="<?= $berita['tanggal'] ?>"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-600">
            </div>

            <!-- Isi -->
            <div>
                <label class="block text-sm font-medium mb-1">Isi Berita</label>
                <textarea name="isi" rows="5" required
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-600"><?= htmlspecialchars($berita['isi']) ?></textarea>
            </div>

            <!-- Preview Gambar Lama -->
            <?php if ($berita['gambar']): ?>
            <div>
                <label class="block text-sm font-medium mb-1">Gambar Saat Ini</label>
                <img src="../assets/img/berita/<?= $berita['gambar'] ?>"
                     class="w-40 h-28 object-cover rounded border">
            </div>
            <?php endif; ?>

            <!-- Upload Baru -->
            <div>
                <label class="block text-sm font-medium mb-1">Ganti Gambar (Opsional)</label>
                <input type="file" name="gambar" accept="image/*"
                       class="w-full text-sm">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="berita.php"
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
