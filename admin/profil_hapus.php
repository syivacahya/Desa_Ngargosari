<?php
session_start();
require_once "../koneksi.php";

if(!isset($_SESSION['login'])) exit;

$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM profil_desa WHERE id='$id'");
header("Location: profil.php");
