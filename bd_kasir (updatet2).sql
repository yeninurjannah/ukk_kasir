-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2024 pada 02.04
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_produk` ()   SELECT tbl_produk.id_produk,tbl_produk.kode_produk,tbl_produk.nama_produk,tbl_kategori.nama_kategori,tbl_satuan.nama_satuan,
tbl_produk.harga_beli,tbl_produk.harga_jual,
tbl_produk.stok
FROM tbl_produk
JOIN tbl_satuan on tbl_satuan.id_satuan=tbl_produk.id_satuan
join tbl_kategori on tbl_kategori.id_kategori=tbl_produk.id_kategori
WHERE tbl_produk.stok > 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lihat_laporan` ()   BEGIN 
SELECT tbl_produk.nama_produk, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.stok
FROM tbl_produk
ORDER BY tbl_produk.stok ASC;
END$$

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
(19, 15, 1, 6, 60000),
(20, 16, 6, 10, 40000),
(21, 17, 6, 9, 36000),
(22, 18, 2, 4, 60000),
(23, 19, 8, 2, 20000),
(24, 20, 7, 3, 60000),
(25, 20, 7, 3, 60000),
(26, 21, 3, 4, 20000),
(27, 22, 6, 2, 8000),
(28, 23, 2, 2, 30000),
(29, 24, 2, 1, 15000),
(30, 24, 4, 3, 33000),
(31, 24, 9, 3, 31500),
(32, 25, 7, 1, 20000),
(33, 26, 2, 6, 90000),
(34, 28, 6, 1, 4000),
(35, 30, 4, 1, 11000),
(36, 31, 3, 1, 5000),
(37, 32, 3, 8, 40000),
(38, 33, 5, 10, 100000),
(39, 36, 9, 8, 84000),
(40, 36, 4, 7, 77000),
(41, 39, 6, 2, 8000),
(42, 39, 3, 2, 10000),
(43, 40, 3, 2, 10000),
(44, 41, 6, 4, 16000),
(45, 42, 3, 7, 35000),
(46, 43, 5, 2, 20000),
(47, 44, 12, 3, 31500),
(48, 44, 15, 6, 240000),
(49, 44, 14, 2, 20000),
(50, 45, 12, 5, 52500),
(51, 45, 15, 3, 120000),
(52, 46, 8, 11, 110000),
(53, 46, 11, 7, 98000);

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
(7, 'Makanan'),
(13, 'Minuman'),
(22, 'Tepung'),
(23, 'Mie Instan'),
(27, 'Sabun'),
(28, 'Snack'),
(29, 'Botol'),
(30, 'Rokok');

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
(15, 'SCDPS2402280015', '2024-02-28 13:25:09', 148, 60000),
(16, 'SCDPS2402280016', '2024-02-28 17:46:18', 148, 40000),
(17, 'SCDPS2402280017', '2024-02-28 18:26:49', 148, 36000),
(18, 'SCDPS2402290018', '2024-02-29 08:24:10', 148, 60000),
(19, 'SCDPS2402290019', '2024-02-29 10:51:03', 148, 20000),
(20, 'SCDPS2402290020', '2024-02-29 11:19:44', 148, 120000),
(21, 'SCDPS2402290021', '2024-02-29 11:20:26', 148, 20000),
(22, 'SCDPS2402290022', '2024-02-29 11:32:15', 148, 8000),
(23, 'SCDPS2402290023', '2024-02-29 15:31:56', 148, 30000),
(24, 'SCDPS2402290024', '2024-02-29 15:58:06', 148, 79500),
(25, 'SCDPS2402290025', '2024-02-29 16:15:09', 148, 20000),
(26, 'SCDPS2402290026', '2024-02-29 16:21:21', 148, 90000),
(27, 'SCDPS2402290027', '2024-02-29 16:23:01', 148, 0),
(28, 'SCDPS2402290028', '2024-02-29 20:28:53', 148, 4000),
(29, 'SCDPS2402290029', '2024-02-29 20:36:53', 148, 0),
(30, 'SCDPS2402290030', '2024-02-29 20:50:24', 148, 11000),
(31, 'SCDPS2402290031', '2024-02-29 20:52:20', 148, 5000),
(32, 'SCDPS2403010032', '2024-03-01 10:47:50', 148, 40000),
(33, 'SCDPS2403010033', '2024-03-01 11:01:19', 148, 100000),
(34, 'SCDPS2403010034', '2024-03-01 11:07:09', 148, 0),
(35, 'SCDPS2403010034', '2024-03-01 11:07:11', 148, 0),
(36, 'SCDPS2403010035', '2024-03-01 11:21:25', 148, 161000),
(37, 'SCDPS2403010036', '2024-03-01 11:23:08', 148, 0),
(38, 'SCDPS2403010036', '2024-03-01 11:24:06', 148, 0),
(39, 'SCDPS2403010037', '2024-03-01 11:24:23', 148, 18000),
(40, 'SCDPS2403010038', '2024-03-01 11:34:44', 148, 10000),
(41, 'SCDPS2403010039', '2024-03-01 15:21:27', 148, 16000),
(42, 'SCDPS2403010040', '2024-03-01 17:40:24', 148, 35000),
(43, 'SCDPS2403010041', '2024-03-01 17:57:26', 148, 20000),
(44, 'SCDPS2403010042', '2024-03-01 18:50:59', 148, 291500),
(45, 'SCDPS2403020043', '2024-03-02 07:28:08', 148, 172500),
(46, 'SCDPS2403020044', '2024-03-02 07:30:04', 148, 208000);

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
(3, 'PRD003', 'INDOMIE GORENG', 3250, 5000, 5, 23, 26),
(4, 'PRD004', 'TERIGU', 10000, 11000, 11, 22, 0),
(5, 'PRD005', 'ACI', 9500, 10000, 11, 22, 14),
(6, 'PRD006', 'INDOMIE GORENG ACEH', 3500, 4000, 18, 23, 0),
(7, 'PRD007', 'SILVER QUEEN', 15000, 20000, 5, 7, 0),
(10, 'PRD010', 'SUNLIGHT 755ML', 23000, 24500, 5, 27, 40),
(11, 'PRD011', 'SUNLIGHT 650ML', 13200, 14000, 5, 27, 16),
(12, 'PRD012', 'CHITATO SAPI PANGGANG 68GRAM', 9900, 10500, 5, 7, 11),
(13, 'PRD013', 'CHITATO MIE GORENG 68GRAM', 9900, 10000, 5, 28, 20),
(14, 'PRD014', 'LAYS RUMPUT LAUT 68GRAM', 9900, 10000, 5, 28, 32),
(15, 'PRD015', 'LIFEBUOY BODY WASH 900ML', 38500, 40000, 5, 27, 6),
(16, 'PRD016', 'LIFEBUOY BODY WASH 900ML', 426000, 450000, 18, 27, 40);

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
(5, 'Pcss'),
(10, 'Pak'),
(11, 'Kg'),
(16, 'Box'),
(18, 'Dus'),
(20, 'Kodi'),
(21, 'Lusin');

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
  MODIFY `id_detail` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

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
