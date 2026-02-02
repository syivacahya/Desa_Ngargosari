<?php
$koneksi = mysqli_connect("localhost","root","","desa_ngargosari");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>