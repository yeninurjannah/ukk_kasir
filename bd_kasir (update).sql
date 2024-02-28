-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2024 pada 08.19
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
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_detailpenjualan`
--

INSERT INTO `tbl_detailpenjualan` (`id_detail`, `id_penjualan`, `id_produk`, `qty`, `total_harga`) VALUES
(1, 1, 17, 4, 100000),
(2, 1, 17, 4, 100000),
(3, 1, 24, 2, 8000),
(4, 1, 18, 7, 84000),
(5, 2, 17, 1, 25000),
(6, 2, 23, 1, 6000),
(7, 3, 24, 3, 12000),
(8, 4, 26, 2, 42000),
(9, 5, 26, 1, 21000),
(10, 6, 17, 4, 100000),
(11, 7, 23, 4, 24000),
(12, 7, 25, 3, 13500),
(13, 8, 25, 1, 4500),
(14, 9, 26, 4, 84000),
(15, 10, 23, 2, 12000),
(16, 11, 18, 3, 36000),
(17, 13, 25, 5, 22500),
(18, 14, 26, 4, 84000),
(19, 15, 1, 6, 60000);

--
-- Trigger `tbl_detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangiStok` AFTER INSERT ON `tbl_detailpenjualan` FOR EACH ROW UPDATE tbl_produk SET tbl_produk.stok = tbl_produk.stok - NEW.qty
WHERE tbl_produk.id_produk = NEW.id_produk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nambahTotalHarga` AFTER INSERT ON `tbl_detailpenjualan` FOR EACH ROW UPDATE tbl_penjualan SET tbl_penjualan.total = tbl_penjualan.total + NEW.total_harga
WHERE tbl_penjualan.id_penjualan= NEW.id_penjualan
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
(13, 'Minuman'),
(22, 'Tepung'),
(23, 'mie'),
(26, 'sabun');

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
(1, 'SCDPS2402280001', '2024-02-28 09:04:19', 148, 0),
(2, 'SCDPS2402280002', '2024-02-28 09:09:01', 148, 0),
(3, 'SCDPS2402280003', '2024-02-28 09:45:35', 148, 12000),
(4, 'SCDPS2402280004', '2024-02-28 10:50:07', 148, 42000),
(5, 'SCDPS2402280005', '2024-02-28 11:04:10', 148, 21000),
(6, 'SCDPS2402280006', '2024-02-28 11:46:18', 148, 100000),
(7, 'SCDPS2402280007', '2024-02-28 11:56:24', 148, 37500),
(8, 'SCDPS2402280008', '2024-02-28 12:12:40', 148, 4500),
(9, 'SCDPS2402280009', '2024-02-28 12:18:23', 148, 84000),
(10, 'SCDPS2402280010', '2024-02-28 12:26:39', 148, 12000),
(11, 'SCDPS2402280011', '2024-02-28 12:31:34', 148, 36000),
(12, 'SCDPS2402280012', '2024-02-28 12:33:29', 148, 0),
(13, 'SCDPS2402280013', '2024-02-28 12:34:03', 148, 22500),
(14, 'SCDPS2402280014', '2024-02-28 12:43:25', 148, 84000),
(15, 'SCDPS2402280015', '2024-02-28 13:25:09', 148, 60000);

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
(1, 'PRD001', 'AQUA BOTOL 250ML', 5000, 10000, 5, 13, -1),
(2, 'PRD002', 'AQUA GELAS ', 13500, 15000, 18, 13, 8),
(3, 'PRD003', 'INDOMIE GORENG', 3250, 5000, 5, 23, 50),
(4, 'PRD004', 'TERIGU', 10000, 11000, 11, 22, 11),
(5, 'PRD005', 'ACI', 9500, 10000, 11, 22, 26),
(6, 'PRD006', 'INDOMIE GORENG ACEH', 3500, 4000, 18, 23, 12);

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
(16, 'box'),
(17, 'ball'),
(18, 'dus');

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
  MODIFY `id_detail` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
