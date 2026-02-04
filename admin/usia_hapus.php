<?php
require_once "../koneksi.php";

$id = $_GET['id'];

$q = mysqli_query($koneksi,"SELECT tahun FROM penduduk_usia WHERE id='$id'");
$d = mysqli_fetch_assoc($q);

mysqli_query($koneksi,"DELETE FROM penduduk_usia WHERE id='$id'");

include "sync_penduduk.php";

header("Location: infografis.php?tahun=".$d['tahun']);
exit;
