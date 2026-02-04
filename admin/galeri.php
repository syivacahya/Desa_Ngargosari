<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

// Ambil semua data galeri
$query = mysqli_query($koneksi, "SELECT id, judul, gambar FROM galeri ORDER BY id DESC");
if (!$query) die("Query error: " . mysqli_error($koneksi));

// Handle update (dari modal Edit)
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);

    if (!empty($_FILES['gambar']['name'])) {
        // hapus gambar lama
        $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM galeri WHERE id=$id"));
        if ($old && file_exists("../assets/img/galeri/".$old['gambar'])) {
            unlink("../assets/img/galeri/".$old['gambar']);
        }

        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/galeri/".$gambar);

        mysqli_query($koneksi, "UPDATE galeri SET judul='$judul', gambar='$gambar' WHERE id=$id");
    } else {
        mysqli_query($koneksi, "UPDATE galeri SET judul='$judul' WHERE id=$id");
    }

    header("Location: galeri.php");
    exit;
}

// Handle tambah (dari modal Tambah)
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $gambar = null;

    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/galeri/".$gambar);
    }

    mysqli_query($koneksi, "INSERT INTO galeri (judul, gambar) VALUES ('$judul', '$gambar')");
    header("Location: galeri.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Desa – Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

<!-- SIDEBAR -->
<aside class="fixed top-0 left-0 w-60 h-screen bg-gradient-to-b from-green-900 to-green-700 text-white">
    <div class="flex flex-col items-center py-6 border-b border-white/20">
        <img src="../assets/img/logo.png" class="w-20 mb-3">
        <span class="tracking-wider font-semibold text-sm">ADMIN DESA</span>
    </div>
    <nav class="mt-4 text-sm">
        <a href="dashboard.php" class="block px-6 py-3 hover:bg-white/20">🏠 Dashboard</a>
        <a href="profil.php" class="block px-6 py-3 hover:bg-white/20">📌 Profil Desa</a>
        <a href="infografis.php" class="block px-6 py-3 hover:bg-white/20">📊 Infografis</a>
        <a href="produk.php" class="block px-6 py-3 hover:bg-white/20">🛒 Produk Unggulan</a>
        <a href="berita.php" class="block px-6 py-3 hover:bg-white/20">📰 Berita</a>
        <a href="galeri.php" class="block px-6 py-3 bg-white/20 font-semibold">🖼️ Galeri</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<!-- CONTENT -->
<main class="ml-60 flex-1">
    <header class="bg-white px-8 py-5 shadow flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Galeri Desa</h2>
            <p class="text-gray-500 text-sm">Kelola foto Desa Ngargosari</p>
        </div>
        <button onclick="showAddModal()" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
            ➕ Tambah Galeri
        </button>
    </header>

    <section class="p-8">
        <div class="bg-white rounded-lg shadow p-6 max-w-6xl mx-auto">
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 w-16 text-center">No</th>
                            <th class="border px-4 py-2 w-40 text-center">Gambar</th>
                            <th class="border px-4 py-2 text-left">Judul</th>
                            <th class="border px-4 py-2 w-36 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-center"><?= $no++ ?></td>
                            <td class="border px-4 py-2 text-center">
                                <?php if (!empty($row['gambar'])): ?>
                                    <img src="../assets/img/galeri/<?= htmlspecialchars($row['gambar']) ?>" class="w-24 h-16 object-cover mx-auto rounded">
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-4 py-2 font-medium"><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="border px-4 py-2">
                                <div class="flex justify-center items-center gap-2">
                                    <button onclick='editGaleri(<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>)' 
                                            class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-xs">
                                        ✏️ Edit
                                    </button>
                                    <a href="galeri_hapus.php?id=<?= $row['id'] ?>" 
                                       onclick="return confirm('Yakin ingin menghapus gambar ini?')" 
                                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-xs font-medium">
                                        🗑️ Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="border px-4 py-6 text-center text-gray-500">Belum ada data galeri</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
  <div class="bg-white p-6 rounded-xl w-96">
    <h2 class="font-bold text-lg mb-4">Edit Galeri</h2>
    <form method="post" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="id" id="editId">
      <div>
        <label>Judul</label>
        <input type="text" name="judul" id="editJudul" class="w-full border p-2 rounded">
      </div>
      <div>
        <label>Gambar</label>
        <input type="file" name="gambar" id="editGambar">
        <img id="previewGambar" class="w-32 mt-2 rounded border">
      </div>
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
        <button type="submit" name="update" class="bg-yellow-500 px-4 py-2 rounded text-white">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL TAMBAH -->
<div id="modalAdd" class="hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
  <div class="bg-white p-6 rounded-xl w-96">
    <h2 class="font-bold text-lg mb-4">Tambah Galeri</h2>
    <form method="post" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label>Judul</label>
        <input type="text" name="judul" class="w-full border p-2 rounded" required>
      </div>
      <div>
        <label>Gambar</label>
        <input type="file" name="gambar" class="w-full" required>
      </div>
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
        <button type="submit" name="simpan" class="bg-green-700 px-4 py-2 rounded text-white">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function editGaleri(data){
    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('editId').value = data.id;
    document.getElementById('editJudul').value = data.judul;
    if(data.gambar){
        document.getElementById('previewGambar').src = "../assets/img/galeri/" + data.gambar;
    } else {
        document.getElementById('previewGambar').src = "";
    }
}

function showAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeModal(){
    document.getElementById('modalEdit').classList.add('hidden');
    document.getElementById('modalAdd').classList.add('hidden');
}

// Preview gambar edit
document.getElementById('editGambar')?.addEventListener('change', function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('previewGambar').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
