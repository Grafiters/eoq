-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 172.18.0.2
-- Generation Time: Apr 26, 2020 at 11:49 AM
-- Server version: 5.7.29
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eoq2`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ITM001\r\nITM002',
  `name` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `harga` int(11) UNSIGNED NOT NULL,
  `total` int(10) UNSIGNED NOT NULL COMMENT 'total akan berubah sesuai dengan transaksi yang dilakukan',
  `keterangan` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `code`, `name`, `harga`, `total`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'ITM001', 'baju bagus', 20000, 4, 'ini barang terbaru', '2020-04-10 12:21:08', '2020-04-23 00:38:30'),
(2, 'ITM002', 'celana bagus', 50000, 9, 'ini celana dari B&J', '2020-04-10 12:21:46', '2020-04-23 00:31:06'),
(3, 'ITM003', 'topi keren', 30000, 9, 'ini topi keren banget dah', '2020-04-11 04:21:03', '2020-04-23 00:31:06'),
(4, 'ITM004', 'kerang ajaib', 18000, 9, 'ini kerang ajaib banget dah', '2020-04-13 12:46:26', '2020-04-23 00:37:48'),
(5, 'ITM005', 'sendok', 888888, 9, 'sendok besi dari bambu', '2020-04-13 12:50:02', '2020-04-23 00:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `kebutuhan_tahunan` int(11) NOT NULL,
  `biaya_sekali_pesan` int(11) NOT NULL,
  `biaya_simpan_barang` int(11) NOT NULL,
  `eoq` int(11) NOT NULL,
  `hasil_biasa_pesan` int(11) NOT NULL,
  `hasil_biaya_simpan` int(11) NOT NULL,
  `rop` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upcated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `barang_id`, `kebutuhan_tahunan`, `biaya_sekali_pesan`, `biaya_simpan_barang`, `eoq`, `hasil_biasa_pesan`, `hasil_biaya_simpan`, `rop`, `created_at`, `upcated_at`) VALUES
(2, 1, 27540, 130000, 150, 6909, 518194, 518175, 275, '2020-04-13 14:12:15', '2020-04-13 14:12:15'),
(3, 5, 27540, 130000, 150, 6909, 518194, 518175, 275, '2020-04-13 14:13:01', '2020-04-13 14:13:01'),
(6, 4, 1000, 80000, 50, 1788, 44743, 44700, 10, '2020-04-13 14:41:58', '2020-04-13 14:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'KB + 3 digit id => KB001',
  `total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `supplier_id`, `code`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 'KB001', 4400000, '2020-04-14 14:10:37', '2020-04-14 14:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `pembeli` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pivot`
--

CREATE TABLE `pivot` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_pembelian`
--

CREATE TABLE `pivot_pembelian` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `total` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pivot_pembelian`
--

INSERT INTO `pivot_pembelian` (`id`, `barang_id`, `pembelian_id`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 70, '2020-04-14 14:10:37', '2020-04-14 14:10:37'),
(2, 3, 1, 30, '2020-04-14 14:10:46', '2020-04-14 14:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'RES + 2 digit id >> RES01',
  `name` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `phone` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `branch` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `address` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `code`, `name`, `phone`, `branch`, `address`, `created_at`, `updated_at`) VALUES
(1, 'RES01', 'JYB Group', '0171051', 'pusat', 'uhu', '2020-04-10 13:30:13', '2020-04-13 12:54:42'),
(2, 'RES02', 'foo bar', '01285401754', 'batam', 'lakfjaljfdlajgdoahg', '2020-04-10 13:42:03', '2020-04-10 13:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `phone` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `password` text COLLATE latin1_spanish_ci NOT NULL COMMENT 'password pake hash(sha512)',
  `role` enum('admin','pengadaan','penjualan') COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'generate dari inisial role + inisial name contoh ADMMSN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `phone`, `password`, `role`, `code`, `created_at`, `updated_at`) VALUES
(1, 'saipul', 'saipul', 'saipul@mail.co', '018740174', '7fcf4ba391c48784edde599889d6e3f1e47a27db36ecc050cc92f259bfac38afad2c68a1ae804d77075e8fb722503f3eca2b2c1006ee6f6c7b7628cb45fffd1d', 'admin', 'adsa', '2020-04-13 13:55:31', '2020-04-26 04:12:15'),
(2, 'mambo', 'jumbo tron', 'jumbo@tron.com', '018401274', '6f37ffea6b3217ad335e38f6025c09cc26dcc92b942c024c5b972bad8f00c53a96ab62cfb41abdcb1df177b6914a691165479c77eeea4208751e99e40b815c05', 'admin', 'adma', '2020-04-14 14:25:25', '2020-04-14 14:25:25'),
(4, 'loremipsum', 'foo bar', 'lorem@ipsum.com', '02357175', '7fcf4ba391c48784edde599889d6e3f1e47a27db36ecc050cc92f259bfac38afad2c68a1ae804d77075e8fb722503f3eca2b2c1006ee6f6c7b7628cb45fffd1d', 'pengadaan', 'pelo', '2020-04-26 04:15:54', '2020-04-26 04:15:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot`
--
ALTER TABLE `pivot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `pivot_pembelian`
--
ALTER TABLE `pivot_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `pivot_pembelian_ibfk_2` (`pembelian_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pivot`
--
ALTER TABLE `pivot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pivot_pembelian`
--
ALTER TABLE `pivot_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pivot`
--
ALTER TABLE `pivot`
  ADD CONSTRAINT `pivot_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `pivot_ibfk_2` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`);

--
-- Constraints for table `pivot_pembelian`
--
ALTER TABLE `pivot_pembelian`
  ADD CONSTRAINT `pivot_pembelian_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `pivot_pembelian_ibfk_2` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
