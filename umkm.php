<?php
// koneksi database
$conn = mysqli_connect("localhost","root","","desa_ngargosari");
if(!$conn){ die("Koneksi gagal"); }

// TAMBAH DATA
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"INSERT INTO produk VALUES(NULL,'$nama','$harga','$deskripsi')");
    header("Location: produk.php");
}

// HAPUS DATA
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn,"DELETE FROM produk WHERE id='$id'");
    header("Location: produk.php");
}

// EDIT DATA
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"UPDATE produk SET nama='$nama', harga='$harga', deskripsi='$deskripsi' WHERE id='$id'");
    header("Location: produk.php");
}

$dataEdit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $q = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
    $dataEdit = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>CRUD Produk Desa</title>
<style>
body{font-family:Arial;background:#f4f6f4}
.container{width:90%;margin:30px auto}
.box{background:#c8e6c9;padding:20px;border-radius:5px}
input,textarea{width:100%;padding:8px;margin:5px 0}
button{padding:8px 15px;border:none;background:#1b5e20;color:white;cursor:pointer}
.btn-del{background:#c62828}
.btn-edit{background:#0277bd}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{border:1px solid #ccc;padding:8px;text-align:center}
</style>
</head>
<body>

<div class="container">
<h2>CRUD Produk Unggulan Desa</h2>

<div class="box">
<h3><?php echo $dataEdit?"Edit Produk":"Tambah Produk"; ?></h3>

<form method="post">
<input type="hidden" name="id" value="<?= $dataEdit['id'] ?? '' ?>">

<input type="text" name="nama" placeholder="Nama Produk" required value="<?= $dataEdit['nama'] ?? '' ?>">

<input type="number" name="harga" placeholder="Harga" required value="<?= $dataEdit['harga'] ?? '' ?>">

<textarea name="deskripsi" placeholder="Deskripsi" required><?= $dataEdit['deskripsi'] ?? '' ?></textarea>

<?php if($dataEdit){ ?>
<button name="update">Update</button>
<?php } else { ?>
<button name="tambah">Tambah</button>
<?php } ?>
</form>
</div>

<table>
<tr>
<th>No</th>
<th>Nama</th>
<th>Harga</th>
<th>Deskripsi</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
$q = mysqli_query($conn,"SELECT * FROM produk");
while($d = mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td>Rp <?= number_format($d['harga']) ?></td>
<td><?= $d['deskripsi'] ?></td>
<td>
<a href="?edit=<?= $d['id'] ?>"><button class="btn-edit">Edit</button></a>
<a href="?hapus=<?= $d['id'] ?>" onclick="return confirm('Hapus data?')"><button class="btn-del">Hapus</button></a>
</td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>
