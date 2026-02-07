<?php
session_start();

require_once '../koneksi.php';

$aksi = $_GET['aksi'];

if($aksi == 'tambah'){
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $produsen = $_POST['produsen'];
    $no_wa = $_POST['no_wa'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];
    

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../assets/img/produk/".$gambar);

    $query = mysqli_query($koneksi,"INSERT INTO produk 
        (nama_produk,harga,produsen,no_wa,lokasi,deskripsi,gambar)
        VALUES ('$nama','$harga','$produsen', '$no_wa', '$lokasi','$deskripsi','$gambar')");

    if($query){
        echo "<script>
                alert('Produk berhasil ditambahkan!');
                window.location='produk.php';
              </script>";
    }else{
        echo "<script>
                alert('Gagal menambahkan produk!');
                window.location='produk.php';
              </script>";
    }
}

if($aksi == 'edit'){
    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $produsen = $_POST['produsen'];
    $no_wa = $_POST['no_wa'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];

    if(!empty($_FILES['gambar']['name'])){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/img/produk/".$gambar);

        $query = mysqli_query($koneksi,"UPDATE produk SET
            nama_produk='$nama',
            harga='$harga',
            produsen='$produsen',
            no_wa= '$no_wa',
            lokasi='$lokasi',
            deskripsi='$deskripsi',
            gambar='$gambar'
            WHERE id_produk='$id'");
    }else{
        $query = mysqli_query($koneksi,"UPDATE produk SET
            nama_produk='$nama',
            harga='$harga',
            produsen='$produsen',
            no_wa= '$no_wa',
            lokasi='$lokasi',
            deskripsi='$deskripsi'
            WHERE id_produk='$id'");
    }

    if($query){
        echo "<script>
                alert('Produk berhasil diperbarui!');
                window.location='produk.php';
              </script>";
    }else{
        echo "<script>
                alert('Gagal memperbarui produk!');
                window.location='produk.php';
              </script>";
    }
}
?>
