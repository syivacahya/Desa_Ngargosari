<?php
session_start();
<<<<<<< HEAD
include "koneksi.php";
=======
require_once '../koneksi.php';
>>>>>>> 866081e9b201ded733559b8c119d9a7e7f40a8d4

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// ambil data gambar
$query = mysqli_query($koneksi,"SELECT gambar FROM produk WHERE id_produk='$id'");
$data = mysqli_fetch_assoc($query);

if($data){
    $file = "../assets/img/produk/".$data['gambar'];
    if(file_exists($file)){
        unlink($file);
    }

    mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk='$id'");
}

header("Location: produk.php");
exit;
