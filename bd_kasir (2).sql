-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2024 pada 01.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_kasir`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_laporan` ()   SELECT tbl_produk.nama_produk, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.stok
FROM tbl_produk
ORDER BY tbl_produk.stok ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_produk` ()   SELECT tbl_produk.id_produk,tbl_produk.kode_produk,tbl_produk.nama_produk,tbl_kategori.nama_kategori,tbl_satuan.nama_satuan,
tbl_produk.harga_beli,tbl_produk.harga_jual,
tbl_produk.stok
FROM tbl_produk
JOIN tbl_satuan on tbl_satuan.id_satuan=tbl_produk.id_satuan
join tbl_kategori on tbl_kategori.id_kategori=tbl_produk.id_kategori
WHERE tbl_produk.stok > 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lihat_produk` ()   SELECT produk.id_produk,produk.kode_produk,produk.nama_produk,kategori.nama_kategori,satuan.nama_satuan,
produk.harga_beli,produk.harga_jual,
produk.stok
FROM produk
JOIN satuan on satuan.id_satuan=produk.id_satuan
join kategori on kategori.id_kategori=produk.id_kategori
WHERE stok > 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tampil_kategori` ()   BEGIN
SELECT tbl_kategori.nama_kategori
FROM tbl_kategori 
ORDER BY tbl_kategori.id_kategori DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detailpenjualan`
--

CREATE TABLE `tbl_detailpenjualan` (
  `id_detail` int(30) NOT NULL,
  `id_penjualan` int(25) NOT NULL,
  `id_produk` int(30) NOT NULL,
  `harga_jual` int(50) NOT NULL,
  `qty` int(100) NOT NULL,
  `total_harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_detailpenjualan`
--

INSERT INTO `tbl_detailpenjualan` (`id_detail`, `id_penjualan`, `id_produk`, `harga_jual`, `qty`, `total_harga`) VALUES
(1, 1, 0, 0, 3, 18000),
(2, 1, 0, 0, 3, 18000),
(3, 1, 0, 0, 4, 24000),
(4, 1, 0, 0, 3, 18000),
(5, 1, 0, 0, 3, 18000),
(6, 1, 0, 0, 4, 24000),
(7, 2, 0, 0, 3, 75000),
(8, 2, 0, 0, 3, 18000),
(9, 2, 0, 0, 1, 25000),
(10, 3, 0, 0, 3, 18000),
(11, 4, 0, 0, 3, 18000),
(12, 5, 0, 0, 3, 18000),
(13, 6, 0, 0, 3, 18000),
(14, 7, 0, 0, 23, 138000),
(15, 7, 0, 0, 5, 30000),
(16, 7, 0, 0, 3, 18000),
(17, 7, 0, 0, 2, 12000),
(18, 7, 0, 0, 1, 6000),
(26, 40, 0, 0, 9, 54000),
(27, 40, 0, 0, 1, 25000),
(28, 40, 24, 0, 6, 24000);

--
-- Trigger `tbl_detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `nambahTotalHarga` AFTER INSERT ON `tbl_detailpenjualan` FOR EACH ROW UPDATE tbl_penjualan SET tbl_penjualan.total =
tbl_penjualan.total + NEW.total_harga WHERE
tbl_penjualan.id_penjualan = NEW.id_penjualan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(7, 'makanan'),
(13, 'minuman'),
(22, 'Tepung'),
(23, 'mie');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(25) NOT NULL,
  `no_faktur` varchar(30) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `id_user` int(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `no_faktur`, `tgl_penjualan`, `id_user`, `total`) VALUES
(32, 'SCDPS2402270022', '2024-02-27 21:17:29', 148, 0),
(33, 'SCDPS2402280023', '2024-02-28 07:02:32', 148, 0),
(34, 'SCDPS2402280024', '2024-02-28 07:04:51', 148, 0),
(35, 'SCDPS2402280024', '2024-02-28 07:06:15', 148, 0),
(36, 'SCDPS2402280025', '2024-02-28 07:07:18', 148, 0),
(37, 'SCDPS2402280026', '2024-02-28 07:11:02', 148, 0),
(38, 'SCDPS2402280026', '2024-02-28 07:17:52', 148, 0),
(39, 'SCDPS2402280027', '2024-02-28 07:18:40', 148, 0),
(40, 'SCDPS2402280027', '2024-02-28 07:21:38', 148, 103000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(30) NOT NULL,
  `kode_produk` varchar(25) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_beli` int(50) NOT NULL,
  `harga_jual` int(50) NOT NULL,
  `id_satuan` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `stok` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `id_satuan`, `id_kategori`, `stok`) VALUES
(17, 'PRD003', 'TELOR', 23500, 25000, 11, 7, 1),
(18, 'PRD004', 'TERIGU', 10000, 12000, 11, 22, 3),
(23, 'PRD006', 'INDOME AYAM BAWANG', 4500, 6000, 5, 7, 40),
(24, 'PRD007', 'MIE GORENG', 3250, 4000, 5, 23, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(10) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES
(5, 'pcss'),
(10, 'pak'),
(11, 'kg'),
(16, 'box');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(10) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(145, 'Yeniy', 'yeniy 123', '1111', 'admin'),
(148, 'arif', 'arif333', '1234', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_detailpenjualan`
--
ALTER TABLE `tbl_detailpenjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_detailpenjualan`
--
ALTER TABLE `tbl_detailpenjualan`
  MODIFY `id_detail` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`),
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `tbl_satuan` (`id_satuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
