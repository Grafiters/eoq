-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2020 at 03:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `description` tinytext COLLATE latin1_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `code`, `name`, `harga`, `total`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ITM001', 'baju bagus', 20000, 60, 'ini barang terbaru', '2020-04-10 12:21:08', '2020-04-26 13:10:00'),
(2, 'ITM002', 'celana bagus', 50000, 0, 'ini celana dari B&J', '2020-04-10 12:21:46', '2020-04-22 16:16:12'),
(3, 'ITM003', 'topi keren', 30000, 74, 'ini topi keren banget dah', '2020-04-11 04:21:03', '2020-04-26 13:10:44');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `upcated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `barang_id`, `kebutuhan_tahunan`, `biaya_sekali_pesan`, `biaya_simpan_barang`, `eoq`, `hasil_biasa_pesan`, `hasil_biaya_simpan`, `rop`, `created_at`, `upcated_at`) VALUES
(1, 2, 27540, 130000, 150, 6909, 518194, 518175, 275, '2020-04-13 11:59:36', '2020-04-13 11:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'KB + 3 digit id => KB001',
  `total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `supplier_id`, `code`, `total`, `created_at`, `updated_at`) VALUES
(24, 2, 'KB001', 3400000, '2020-04-14 14:21:02', '2020-04-14 16:27:48'),
(25, 1, 'KB025', 420000, '2020-04-14 14:21:35', '2020-04-14 14:21:35'),
(26, 2, 'KB026', 500000, '2020-04-14 14:22:09', '2020-04-14 14:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `pembeli` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `pembeli`, `code`, `total`, `created_at`, `updated_at`) VALUES
(25, 'alone', 'PJL001', 800012, '2020-04-18 12:37:57', '2020-04-26 13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `pivot`
--

CREATE TABLE `pivot` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pivot`
--

INSERT INTO `pivot` (`id`, `penjualan_id`, `barang_id`, `total`, `created_at`, `updated_at`) VALUES
(14, 25, 2, 4, '2020-04-18 12:40:38', '2020-04-22 16:16:12'),
(15, 25, 1, 5, '2020-04-26 13:10:00', '2020-04-26 13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `pivot_pembelian`
--

CREATE TABLE `pivot_pembelian` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `total` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pivot_pembelian`
--

INSERT INTO `pivot_pembelian` (`id`, `barang_id`, `pembelian_id`, `total`, `created_at`, `updated_at`) VALUES
(31, 1, 24, 45, '2020-04-14 14:21:02', '2020-04-14 14:21:22'),
(32, 3, 25, 14, '2020-04-14 14:21:35', '2020-04-14 14:21:35'),
(33, 2, 26, 10, '2020-04-14 14:22:09', '2020-04-14 14:22:09'),
(34, 2, 24, 50, '2020-04-14 16:27:48', '2020-04-14 16:27:48');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `phone` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `password` text COLLATE latin1_spanish_ci NOT NULL COMMENT 'password pake hash(sha512)',
  `role` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'generate dari inisial role + inisial name contoh ADMMSN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `phone`, `password`, `role`, `code`, `created_at`, `updated_at`) VALUES
(5, 'alone', 'bayu grafit', 'alone@gmail.com', '82322597622', 'daa67b90f64327797922e7a20c9d4b796669f55eef51b7e7c3ca6738889bf06c59d0406cd84f0c969e8c0f3139bc35f44d19f998983b4d3fab7dda1c1f03e709', 'admin', 'adal', '2020-04-18 14:23:03', '2020-04-18 14:23:03'),
(6, 'alone', 'bayu grafit', 'bayugrafit@gmail.com', '823225967622', '6a497431e3bb80a79e9b2d4d4a4ac1c7e7ef414563b1e0260b1491ebde37837a4439dcecbd2035b30b8642e5afff6c083639b81e6aa54602cafa2522ead2e93d', 'penjualan', 'peal', '2020-04-22 10:06:02', '2020-04-22 10:06:02'),
(10, 'bayu', 'alone grafit', 'bayu@gmail.com', '82322597652', 'e078fb2f9bcffc21714c61fcc0a513233037e7174ff421a61ae9f8eb61113c97788197490773a07cc310978695046ade4d7a70650d347a158227d80f9c300a07', 'pengadaan', 'peba', '2020-04-22 12:44:52', '2020-04-22 12:44:52');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pivot`
--
ALTER TABLE `pivot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pivot_pembelian`
--
ALTER TABLE `pivot_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
