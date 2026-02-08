<?php
session_start();
include "../public/koneksi.php";
if(!isset($_SESSION['login'])) exit;

$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM galeri WHERE id='$id'");
header("Location: galeri.php");