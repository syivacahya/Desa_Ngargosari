<?php
session_start();
require_once '../koneksi.php';

$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $produsen = $_POST['produsen'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../assets/img/produk/".$gambar);

    mysqli_query($koneksi,"INSERT INTO produk 
        (nama_produk,harga,produsen,lokasi,deskripsi,gambar)
        VALUES ('$nama','$harga','$produsen','$lokasi','$deskripsi','$gambar')");
}

if($aksi == 'edit'){
    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $produsen = $_POST['produsen'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];

    if(!empty($_FILES['gambar']['name'])){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/img/produk/".$gambar);

        mysqli_query($koneksi,"UPDATE produk SET
            nama_produk='$nama',
            harga='$harga',
            produsen='$produsen',
            lokasi='$lokasi',
            deskripsi='$deskripsi',
            gambar='$gambar'
            WHERE id_produk='$id'");
    }else{
        mysqli_query($koneksi,"UPDATE produk SET
            nama_produk='$nama',
            harga='$harga',
            produsen='$produsen',
            lokasi='$lokasi',
            deskripsi='$deskripsi'
            WHERE id_produk='$id'");
    }
}
