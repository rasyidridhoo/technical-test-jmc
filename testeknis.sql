-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2023 at 09:37 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testeknis`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int NOT NULL,
  `nama_kabupaten` varchar(255) NOT NULL,
  `id_provinsi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nama_kabupaten`, `id_provinsi`) VALUES
(1, 'Karawang', 1),
(4, 'Surabaya', 2),
(5, 'Bandung', 1),
(6, 'Subang', 1),
(7, 'Pontianak', 10),
(8, 'Sleman', 5),
(9, 'Tasikmalaya', 1),
(10, 'Samarinda', 11),
(11, 'Palembang', 6),
(12, 'Padang', 7),
(13, 'Medan', 8),
(14, 'Malang', 2),
(15, 'Kulonprogo', 5),
(16, 'Makassar', 14);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_provinsi` int NOT NULL,
  `id_kabupaten` int NOT NULL,
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama`, `nik`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `id_provinsi`, `id_kabupaten`, `ts`) VALUES
(1, 'Mohamad Rasyid Ridho', '3215051105010012', 'Laki-laki', '2001-05-11', 'Perumahan Citra Jaya Blok A4 No. 4, Bandung, Jawa Barat', 1, 5, '2023-10-21 07:33:59'),
(2, 'Winda Arvia', '3215654542565546', 'Perempuan', '2023-10-19', 'Jalan Wonokromo 2, Kulonprogo, DIY', 5, 15, '2023-10-21 07:10:24'),
(4, 'Mugi Mabruroh', '321', 'Perempuan', '1972-12-24', 'Perumahan Graha Jaya, RT 39/RW 16, Desa Gintungkerta, Surabaya, Jawa Timur', 2, 4, '2023-10-21 07:10:11'),
(8, 'Mohamad Wildan', '3245051423811881', 'Laki-laki', '2023-10-18', 'Perumahan Kartika Residence Blok A5 No. 3, Desa Klari, Subang, Jawa Barat', 1, 6, '2023-10-20 11:23:40'),
(9, 'Arhan', '123', 'Laki-laki', '2023-10-19', 'Jalan Damar no 11, Palembang, Sumatera Selatan', 6, 11, '2023-10-21 07:09:53'),
(10, 'Muslihat', '325xxx', 'Laki-laki', '2023-10-13', 'Jalan Kenanga no 4, Makassar, Sulawesi Tenggara', 14, 16, '2023-10-21 07:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` int NOT NULL,
  `nama_provinsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama_provinsi`) VALUES
(1, 'Jawa Barat'),
(2, 'Jawa Timur'),
(4, 'Jawa Tengah'),
(5, 'DIY'),
(6, 'Sumatera Selatan'),
(7, 'Sumatera Barat'),
(8, 'Sumatera Utara'),
(9, 'Kalimantan Selatan'),
(10, 'Kalimantan Barat'),
(11, 'Kalimantan Timur'),
(12, 'Kalimantan Utara'),
(13, 'Papua Barat'),
(14, 'Sulawesi Tenggara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `id_provinsi` (`id_provinsi`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_provinsi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`);

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`),
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
