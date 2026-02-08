<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
require_once "../koneksi.php";

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Produk Unggulan Desa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-100">

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
        <a href="galeri.php" class="block px-6 py-3 hover:bg-white/20">🖼️ Galeri</a>
        <a href="logout.php" class="block px-6 py-3 text-red-200 hover:bg-red-500/30">🚪 Logout</a>
    </nav>
</aside>

<!-- MAIN -->
<div class="ml-60 min-h-screen">

<!-- HEADER -->
<!-- HEADER -->
<header class="bg-white px-8 py-5 shadow">
    <h2 class="text-xl font-semibold text-gray-800">Produk Unggulan Desa Ngargosari</h2>
    <p class="text-gray-500 text-sm">Produk Unggulan Desa </p>
</header>

<!-- CONTENT -->
<main class="p-8">

<div class="bg-white rounded-xl shadow p-6">

<button onclick="tambahProduk()"
class="mb-5 bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg transition">
+ Tambah Produk
</button>

<div class="overflow-x-auto">
<table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
<thead class="bg-green-100 text-green-800">
<tr>
    <th class="p-3 border">No</th>
    <th class="p-3 border">Nama</th>
    <th class="p-3 border">Harga</th>
    <th class="p-3 border">Produsen</th>
    <th class="p-3 border">WhatsApp</th>
    <th class="p-3 border">Deskripsi</th>
    <th class="p-3 border">Lokasi</th>
    <th class="p-3 border">Gambar</th>
    <th class="p-3 border">Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
$q=mysqli_query($koneksi,"SELECT * FROM produk ORDER BY id_produk DESC");
while($d=mysqli_fetch_assoc($q)){
?>
<tr class="hover:bg-gray-50">
<td class="p-3 border text-center"><?= $no++ ?></td>
<td class="p-3 border"><?= htmlspecialchars($d['nama_produk']) ?></td>
<td class="p-3 border">Rp <?= number_format($d['harga']) ?></td>
<td class="p-3 border"><?= htmlspecialchars($d['produsen']) ?></td>
<td class="p-3 border text-center">
    <a href="https://wa.me/<?= $d['no_wa'] ?>"
       target="_blank"
       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-xs">
       💬 Chat
    </a>
</td>
<td class="p-3 border"><?= htmlspecialchars($d['deskripsi']) ?></td>
<td class="p-3 border"><?= htmlspecialchars($d['lokasi']) ?></td>
<td class="p-3 border text-center">
    <img src="../assets/img/produk/<?= $d['gambar'] ?>"
         class="w-16 h-16 object-cover rounded-lg mx-auto">
</td>
<td class="p-3 border text-center space-x-1">
<button onclick='editProduk(<?= json_encode($d) ?>)'
class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-xs">
Edit
</button>
<a href="hapus_produk.php?id=<?= $d['id_produk'] ?>"
onclick="return confirm('Hapus produk ini?')"
class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white text-xs">
Hapus
</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

</div>
</main>
</div>

<script>
function tambahProduk(){
Swal.fire({
    title:'Tambah Produk',
    html:`
    <form id="formTambah" class="flex flex-col gap-3 text-left" enctype="multipart/form-data">

        <div>
            <label class="block font-semibold mb-1">Nama Produk</label>
            <input name="nama_produk" required class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Harga</label>
            <input type="number" name="harga" required class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Produsen</label>
            <input name="produsen" required class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Nomor WhatsApp</label>
            <input name="no_wa" placeholder="628xxxxxxxxxx" required class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Lokasi</label>
            <input name="lokasi" required class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="border p-2 rounded w-full"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Gambar Produk</label>
            <input type="file" name="gambar" required class="w-full">
        </div>

    </form>`,
    showCancelButton:true,
    confirmButtonText:'Simpan',
    preConfirm:()=>fetch('aksi_produk.php?aksi=tambah',{
        method:'POST',
        body:new FormData(document.getElementById('formTambah'))
    })
}).then(()=>location.reload());
}
</script>


<script>
function editProduk(d){
Swal.fire({
    title:'Edit Produk',
    html:`
    <form id="formEdit" class="flex flex-col gap-3 text-left" enctype="multipart/form-data">

        <input type="hidden" name="id_produk" value="${d.id_produk}">

        <div>
            <label class="block font-semibold mb-1">Nama Produk</label>
            <input name="nama_produk" value="${d.nama_produk}" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Harga</label>
            <input type="number" name="harga" value="${d.harga}" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Produsen</label>
            <input name="produsen" value="${d.produsen}" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Nomor WhatsApp</label>
            <input name="no_wa" value="${d.no_wa}" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Lokasi</label>
            <input name="lokasi" value="${d.lokasi}" class="border p-2 rounded w-full">
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="border p-2 rounded w-full">${d.deskripsi}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Gambar Produk (opsional)</label>
            <input type="file" name="gambar" class="w-full">
        </div>

    </form>`,
    showCancelButton:true,
    confirmButtonText:'Update',
    preConfirm:()=>fetch('aksi_produk.php?aksi=edit',{
        method:'POST',
        body:new FormData(document.getElementById('formEdit'))
    })
}).then(()=>location.reload());
}
</script>


</body>
</html>
