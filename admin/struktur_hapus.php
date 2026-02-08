<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "../public/koneksi.php";

$id = $_GET['id'] ?? 0;

// Ambil data dulu (buat ambil nama file gambar)
$query = mysqli_query($koneksi, "SELECT gambar FROM struktur_pemerintahan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $folder = "../uploads/struktur/";

    // Jika ada gambar & file-nya ada → hapus file
    if (!empty($data['gambar']) && file_exists($folder . $data['gambar'])) {
        unlink($folder . $data['gambar']);
    }

    // Hapus data dari database
    mysqli_query($koneksi, "DELETE FROM struktur_pemerintahan WHERE id='$id'");
}

// Kembali ke halaman profil
header("Location: profil.php");
exit;
