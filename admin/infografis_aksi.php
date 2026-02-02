<?php
require_once '../koneksi.php';

/* ======================
   SIMPAN JUMLAH PENDUDUK
====================== */
if(isset($_POST['simpan_penduduk'])){
    $tahun = $_POST['tahun'];
    $total = $_POST['total'];
    $kk = $_POST['kk'];
    $laki = $_POST['laki'];
    $perempuan = $_POST['perempuan'];

    $cek = mysqli_query($koneksi,"SELECT * FROM penduduk WHERE tahun='$tahun'");

    if(mysqli_num_rows($cek) > 0){
        mysqli_query($koneksi,"UPDATE penduduk SET
            total='$total',
            kk='$kk',
            laki='$laki',
            perempuan='$perempuan'
            WHERE tahun='$tahun'
        ");
    }else{
        mysqli_query($koneksi,"INSERT INTO penduduk VALUES(
            NULL,'$tahun','$total','$kk','$laki','$perempuan'
        )");
    }

    header("Location: infografis.php");
}

/* ======================
   SIMPAN KELOMPOK UMUR
====================== */
if(isset($_POST['simpan_umur'])){
    $tahun = $_POST['tahun'];

    // hapus dulu biar update bersih
    mysqli_query($conn,"DELETE FROM penduduk_umur WHERE tahun='$tahun'");

    for($i=0;$i<count($_POST['umur']);$i++){
        $umur = $_POST['umur'][$i];
        $laki = $_POST['laki'][$i];
        $perempuan = $_POST['perempuan'][$i];

        mysqli_query($conn,"INSERT INTO penduduk_umur VALUES(
            NULL,'$tahun','$umur','$laki','$perempuan'
        )");
    }

    header("Location: infografis.php");
}
