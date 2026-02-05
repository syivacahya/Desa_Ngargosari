<?php
session_start();

require_once '../koneksi.php';


if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$nama       = $_POST['nama_produk'];
$harga      = $_POST['harga'];
$deskripsi  = $_POST['deskripsi'];
$produsen   = $_POST['produsen'];
$lokasi     = $_POST['lokasi'];

$gambar     = $_FILES['gambar']['name'];
$tmp        = $_FILES['gambar']['tmp_name'];

$folder     = "../assets/img/produk/";
$namaFile   = time().'_'.$gambar;

// upload gambar
move_uploaded_file($tmp, $folder.$namaFile);

// simpan ke database
$query = mysqli_query($koneksi,"INSERT INTO produk 
(nama_produk, harga, deskripsi, produsen, lokasi, gambar)
VALUES
('$nama','$harga','$deskripsi','$produsen','$lokasi','$namaFile')");

if($query){
    header("Location: produk.php");
}else{
    echo "Gagal menyimpan data";
}
