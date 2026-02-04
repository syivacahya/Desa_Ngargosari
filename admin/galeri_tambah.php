<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$error = "";

if (isset($_POST['simpan'])) {
    $judul = htmlspecialchars($_POST['judul']);

    // Upload gambar
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $ext    = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = uniqid() . "." . $ext;
        $tmp    = $_FILES['gambar']['tmp_name'];
        $folder = "../assets/img/galeri/";

        move_uploaded_file($tmp, $folder . $gambar);
    } else {
        $error = "Gambar wajib diisi!";
    }

    if (!$error) {
        $simpan = mysqli_query($koneksi, "
            INSERT INTO galeri (judul, gambar)
            VALUES ('$judul', '$gambar')
        ");

        if ($simpan) {
            header("Location: galeri.php");
            exit;
        } else {
            $error = "Gagal menambahkan galeri!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri</title>

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
            <h2 class="text-lg font-semibold text-gray-800">Tambah Galeri</h2>
            <a href="galeri.php" class="text-gray-400 hover:text-red-500 text-xl">&times;</a>
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
                <label class="block text-sm font-medium mb-1">Judul Galeri</label>
                <input type="text" name="judul" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-600">
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium mb-1">Foto Galeri</label>
                <input type="file" name="gambar" accept="image/*" required
                       class="w-full text-sm">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="galeri.php"
                   class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-sm">
                    Batal
                </a>

                <button type="submit" name="simpan"
                        class="px-4 py-2 rounded bg-green-700 hover:bg-green-800 text-white text-sm">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
