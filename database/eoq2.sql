-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 172.18.0.2
-- Generation Time: Apr 11, 2020 at 06:06 AM
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
CREATE DATABASE IF NOT EXISTS `eoq2` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `eoq2`;

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
  `description` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `code`, `name`, `harga`, `total`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ITM001', 'baju bagus', 20000, 140, 'ini barang terbaru', '2020-04-10 12:21:08', '2020-04-11 05:57:17'),
(2, 'ITM002', 'celana bagus', 50000, 122, 'ini celana dari B&J', '2020-04-10 12:21:46', '2020-04-11 05:58:52'),
(3, 'ITM003', 'topi keren', 30000, 138, 'ini topi keren banget dah', '2020-04-11 04:21:03', '2020-04-11 05:57:17');

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

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `pembeli` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
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
  `jumlah` int(11) NOT NULL,
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
(1, 'RES01', 'JYB Group', '0171051', 'pusat', 'lkajdfl;ajflajfolafgda', '2020-04-10 13:30:13', '2020-04-10 13:30:13'),
(2, 'RES02', 'foo bar', '01285401754', 'batam', 'lakfjaljfdlajgdoahg', '2020-04-10 13:42:03', '2020-04-10 13:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `phone` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `password` text COLLATE latin1_spanish_ci NOT NULL COMMENT 'password pake hash(sha512)',
  `role` enum('admin, pengadaan, penjualan') COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'generate dari inisial role + inisial name contoh ADMMSN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
