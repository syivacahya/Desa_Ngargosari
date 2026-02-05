-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2026 pada 19.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desa_ngargosari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `batas_wilayah`
--

CREATE TABLE `batas_wilayah` (
  `id` int(11) NOT NULL,
  `utara` varchar(255) NOT NULL,
  `selatan` varchar(255) NOT NULL,
  `barat` varchar(255) NOT NULL,
  `timur` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, 'asdfghjk', 'asdfghjkl', '6983690f0337d.png', '2026-02-04', '2026-02-04 15:42:55', '2026-02-04 15:43:11'),
(3, 'hjgsdh', 'qwertyuiop', '698372f9c71b4.png', '2026-02-04', '2026-02-04 16:25:29', '2026-02-04 16:25:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `gambar` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`, `created_at`) VALUES
(9, 'ggggg', '6983596b4b5c7.png', '2026-02-04 14:17:23'),
(11, 'adbajwgdawjgdqwu', '698357a503e86.png', '2026-02-04 14:28:37'),
(12, 'pppp', '69836044eb5a7.png', '2026-02-04 14:40:42'),
(14, 'poi', '698381a03cf30.png', '2026-02-04 17:28:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `infografis_penduduk`
--

CREATE TABLE `infografis_penduduk` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `total` int(11) NOT NULL,
  `kk` int(11) NOT NULL,
  `laki` int(11) NOT NULL,
  `perempuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `infografis_penduduk`
--

INSERT INTO `infografis_penduduk` (`id`, `tahun`, `total`, `kk`, `laki`, `perempuan`) VALUES
(4, '2026', 34567, 34567, 223456, 345);

-- --------------------------------------------------------

--
-- Struktur dari tabel `infografis_umur`
--

CREATE TABLE `infografis_umur` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kelompok_umur` varchar(20) DEFAULT NULL,
  `laki` int(11) NOT NULL,
  `perempuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `infografis_umur`
--

INSERT INTO `infografis_umur` (`id`, `tahun`, `kelompok_umur`, `laki`, `perempuan`) VALUES
(1, '2026', '5-9', 98, 76),
(2, '2026', '6-90', 234, 456);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `produsen` varchar(100) DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `deskripsi`, `produsen`, `no_wa`, `lokasi`, `gambar`) VALUES
(6, 'gula', 12345, 'fggryr', 'skfnfjf', '6281328507418', 'asdf', '697f16d81a11e.png'),
(7, 'aren', 1000, 'sfnksjfdsa', 'skdkn', '628901974198', 'smflaksnf', '697f17a8017eb.png'),
(8, 'besek', 13568, 'guyg', 'vhgvh', '623874298719', 'kjjbvchhvf', '697f249aee572.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_desa`
--

CREATE TABLE `profil_desa` (
  `id` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `sejarah` text DEFAULT NULL,
  `luas_wilayah` varchar(100) DEFAULT NULL,
  `jumlah_rt` int(11) DEFAULT NULL,
  `jumlah_dusun` int(11) DEFAULT NULL,
  `nama_dusun` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_pemerintahan`
--

CREATE TABLE `struktur_pemerintahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(150) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `struktur_pemerintahan`
--

INSERT INTO `struktur_pemerintahan` (`id`, `nama`, `jabatan`, `gambar`, `created_at`) VALUES
(1, 'ss', 'wwff', '6982cac2a231d.png', '2026-02-04 04:27:11'),
(2, 'ss', 'ww', '6982cadf6b686.png', '2026-02-04 04:28:03'),
(3, 'ttt', 'wrerw', '69831b6ea39b0.png', '2026-02-04 10:11:40'),
(5, 'jwertyui', 'sdfghj', '69836b7f582c2.png', '2026-02-04 15:53:35'),
(6, 'zxcbnm,', 'wertyuio', '69836d8ab7f16.png', '2026-02-04 16:02:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `batas_wilayah`
--
ALTER TABLE `batas_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `infografis_penduduk`
--
ALTER TABLE `infografis_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `infografis_umur`
--
ALTER TABLE `infografis_umur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `struktur_pemerintahan`
--
ALTER TABLE `struktur_pemerintahan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `batas_wilayah`
--
ALTER TABLE `batas_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `infografis_penduduk`
--
ALTER TABLE `infografis_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `infografis_umur`
--
ALTER TABLE `infografis_umur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `profil_desa`
--
ALTER TABLE `profil_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `struktur_pemerintahan`
--
ALTER TABLE `struktur_pemerintahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
