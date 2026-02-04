<?php
session_start();
include "../koneksi.php";
if(!isset($_SESSION['login'])) exit;

$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM struktur_pemerintahan WHERE id='$id'");
header("Location: profil.php");