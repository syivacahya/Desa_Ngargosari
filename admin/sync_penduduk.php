<?php
/**
 * Sinkronisasi data penduduk tahunan
 * berdasarkan total penduduk per kelompok umur
 */

require_once "../koneksi.php";

/* Ambil tahun dari data usia (paling aman) */
$qTahun = mysqli_query($koneksi,"
    SELECT DISTINCT tahun 
    FROM penduduk_usia
");

while ($t = mysqli_fetch_assoc($qTahun)) {

    $tahun = $t['tahun'];

    /* Hitung total laki-laki & perempuan */
    $qTotal = mysqli_query($koneksi,"
        SELECT 
            SUM(laki_laki) AS total_laki,
            SUM(perempuan) AS total_perempuan
        FROM penduduk_usia
        WHERE tahun='$tahun'
    ");

    $total = mysqli_fetch_assoc($qTotal);

    $laki = $total['total_laki'] ?? 0;
    $perempuan = $total['total_perempuan'] ?? 0;
    $jumlah = $laki + $perempuan;

    /* Update tabel penduduk tahunan */
    mysqli_query($koneksi,"
        UPDATE penduduk_tahunan SET
            laki_laki = '$laki',
            perempuan = '$perempuan',
            total_penduduk = '$jumlah'
        WHERE tahun = '$tahun'
    ");
}
