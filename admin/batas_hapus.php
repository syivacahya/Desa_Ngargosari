<?php
session_start();
include "../public/koneksi.php";
if(!isset($_SESSION['login'])) exit;

$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM batas_wilayah WHERE id='$id'");
header("Location: profil.php");