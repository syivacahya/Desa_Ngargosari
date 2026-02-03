<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id         = $_POST['id_produk'];
$nama       = $_POST['nama_produk'];
$harga      = $_POST['harga'];
$deskripsi  = $_POST['deskripsi'];
$produsen   = $_POST['produsen'];
$lokasi     = $_POST['lokasi'];

// cek upload gambar baru
if(!empty($_FILES['gambar']['name'])){
    $gambar     = $_FILES['gambar']['name'];
    $tmp        = $_FILES['gambar']['tmp_name'];

    $folder     = "../assets/img/produk/";
    $namaFile   = time().'_'.$gambar;

    move_uploaded_file($tmp, $folder.$namaFile);

    // hapus gambar lama
    $old = mysqli_query($koneksi,"SELECT gambar FROM produk WHERE id_produk='$id'");
    $oldImg = mysqli_fetch_assoc($old);
    if(file_exists($folder.$oldImg['gambar'])){
        unlink($folder.$oldImg['gambar']);
    }

    $query = mysqli_query($koneksi,"UPDATE produk SET
        nama_produk='$nama',
        harga='$harga',
        deskripsi='$deskripsi',
        produsen='$produsen',
        lokasi='$lokasi',
        gambar='$namaFile'
        WHERE id_produk='$id'
    ");

}else{
    $query = mysqli_query($koneksi,"UPDATE produk SET
        nama_produk='$nama',
        harga='$harga',
        deskripsi='$deskripsi',
        produsen='$produsen',
        lokasi='$lokasi'
        WHERE id_produk='$id'
    ");
}

if($query){
    header("Location: produk.php");
}else{
    echo "Gagal update data";
}
