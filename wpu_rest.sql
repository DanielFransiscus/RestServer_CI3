-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 05:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpu_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'wpu123', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `limits`
--

INSERT INTO `limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(1, 'uri:api/mahasiswa/index:get', 1, 1684504773, 'wpu123'),
(2, 'uri:api/mahasiswa/1:get', 2, 1684326228, 'wpu123'),
(3, 'uri:api/mahasiswa/2:get', 2, 1684326226, 'wpu123'),
(4, 'uri:api/mahasiswa/5:get', 2, 1684213817, 'wpu123'),
(5, 'uri:api/mahasiswa/9:get', 2, 1684296608, 'wpu123'),
(6, 'uri:api/mahasiswa/3:get', 2, 1684296606, 'wpu123'),
(7, 'uri:api/mahasiswa/4:get', 5, 1684212744, 'wpu123'),
(8, 'uri:api/mahasiswa/7:get', 1, 1684213822, 'wpu123'),
(9, 'uri:api/mahasiswa/56:get', 1, 1684158412, 'wpu123'),
(10, 'uri:api/mahasiswa/5666666666:get', 1, 1684158423, 'wpu123'),
(11, 'uri:api/mahasiswa/90:get', 1, 1684199345, 'wpu123'),
(12, 'uri:api/mahasiswa/99:get', 1, 1684199946, 'wpu123'),
(13, 'uri:api/mahasiswa/888:get', 1, 1684159091, 'wpu123'),
(14, 'uri:api/mahasiswa/6:get', 1, 1684233075, 'wpu123'),
(15, 'uri:api/mahasiswa/h:get', 1, 1684209662, 'wpu123'),
(16, 'uri:api/mahasiswa/-9:get', 1, 1684199955, 'wpu123'),
(17, 'uri:api/mahasiswa/j:get', 1, 1684245368, 'wpu123'),
(18, 'uri:api/mahasiswa/-1:get', 1, 1684401871, 'wpu123'),
(19, 'uri:api/mahasiswa/b1:get', 1, 1684201719, 'wpu123'),
(20, 'uri:api/mahasiswa/g:get', 1, 1684326234, 'wpu123'),
(21, 'uri:api/mahasiswa/-:get', 1, 1684245461, 'wpu123'),
(22, 'uri:api/mahasiswa/8:get', 5, 1684209069, 'wpu123'),
(23, 'uri:api/mahasiswa/i:get', 1, 1684245365, 'wpu123'),
(24, 'uri:api/mahasiswa/k:get', 1, 1684204119, 'wpu123'),
(25, 'uri:api/mahasiswa/23:get', 1, 1684245469, 'wpu123'),
(26, 'uri:api/mahasiswa/%3C:get', 1, 1684205087, 'wpu123'),
(27, 'uri:api/mahasiswa/%3Cscript:get', 1, 1684205092, 'wpu123'),
(28, 'uri:api/mahasiswa/677:get', 2, 1684208439, 'wpu123'),
(29, 'uri:api/mahasiswa/SALAH:get', 2, 1684212756, 'wpu123'),
(30, 'uri:api/mahasiswa/10:get', 3, 1684209074, 'wpu123'),
(31, 'uri:api/mahasiswa/F:get', 1, 1684209156, 'wpu123'),
(32, 'uri:api/mahasiswa/---:get', 1, 1684210527, 'wpu123'),
(33, 'uri:api/mahasiswa/~:get', 1, 1684210540, 'wpu123'),
(34, 'uri:api/mahasiswa/1/2:get', 1, 1684211307, 'wpu123'),
(35, 'uri:api/mahasiswa/GG:get', 1, 1684297187, 'wpu123'),
(36, 'uri:api/mahasiswa/45:get', 1, 1684213834, 'wpu123'),
(37, 'uri:api/mahasiswa/22:get', 2, 1684245459, 'wpu123'),
(38, 'uri:api/mahasiswa/255:get', 2, 1684232144, 'wpu123'),
(39, 'uri:api/mahasiswa/25:get', 1, 1684232486, 'wpu123'),
(40, 'uri:api/mahasiswa/29:get', 1, 1684240429, 'wpu123'),
(41, 'uri:api/mahasiswa/26:get', 1, 1684245472, 'wpu123'),
(42, 'uri:api/mahasiswa/27:get', 1, 1684245473, 'wpu123'),
(43, 'uri:api/mahasiswa/28:get', 3, 1684232498, 'wpu123'),
(44, 'uri:api/mahasiswa/21:get', 1, 1684233091, 'wpu123'),
(45, 'uri:api/mahasiswa/33:get', 1, 1684296603, 'wpu123'),
(46, 'uri:api/mahasiswa/100:get', 1, 1684240439, 'wpu123'),
(47, 'uri:api/mahasiswa/88:get', 2, 1684244861, 'wpu123'),
(48, 'uri:api/mahasiswa/277:get', 2, 1684245475, 'wpu123'),
(49, 'uri:api/mahasiswa/222:get', 2, 1684245659, 'wpu123'),
(50, 'uri:api/mahasiswa/222G:get', 1, 1684289242, 'wpu123'),
(51, 'uri:api/mahasiswa/33jj:get', 1, 1684296595, 'wpu123'),
(52, 'uri:api/mahasiswa/hh:get', 1, 1684296959, 'wpu123'),
(53, 'uri:api/mahasiswa/hhh:get', 3, 1684296986, 'wpu123'),
(54, 'uri:api/mahasiswa/GGG:get', 1, 1684298376, 'wpu123'),
(55, 'uri:api/mahasiswa/55:get', 1, 1684326677, 'wpu123'),
(56, 'uri:api/mahasiswa/30:get', 1, 1684471265, 'wpu123'),
(57, 'uri:api/mahasiswa/47:get', 1, 1684472959, 'wpu123'),
(58, 'uri:api/mahasiswa/62:get', 2, 1684496890, 'wpu123'),
(59, 'uri:api/mahasiswa/61:get', 1, 1684496917, 'wpu123'),
(60, 'uri:api/mahasiswa/69:get', 1, 1684497930, 'wpu123'),
(61, 'uri:api/mahasiswa/70:get', 1, 1684497935, 'wpu123'),
(62, 'uri:api/mahasiswa/71:get', 1, 1684502979, 'wpu123'),
(63, 'uri:api/mahasiswa/772:get', 1, 1684497938, 'wpu123'),
(64, 'uri:api/mahasiswa/72:get', 2, 1684497940, 'wpu123'),
(65, 'uri:api/mahasiswa/73:get', 1, 1684497942, 'wpu123'),
(66, 'uri:api/mahasiswa/71HHH:get', 3, 1684499119, 'wpu123');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `jurusan` varchar(64) NOT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `email`, `jurusan`, `gambar`, `createdAt`, `updatedAt`) VALUES
(61, 'horas', 'horas@mail.comkkjuhhTy', 'Teknik Sipil', '5dc3b83f830dab43254cdb349e854dc6.png', '2023-05-19 10:37:24', '2023-05-19 11:35:00'),
(62, 'anambe', 'anambe@mail.com', 'Teknik Perencanaan', '27e92bb67594dbb0530a5984f86fd17c.png', '2023-05-19 11:41:09', '2023-05-19 11:45:38'),
(67, 'kodok', 'beluga@mail.com', 'Teknik Las', 'eb64bb86d54d5cac595ec954fc1e215b.png', '2023-05-19 11:58:39', NULL),
(68, 'julio', 'julio@mail.com', 'Psikologi', 'e2d7c7f17728c4ed71109f9a5cab9dbb.png', '2023-05-19 11:59:45', NULL),
(69, 'Monang', 'monang@mail.com', 'Psikologi Terbarukan', '5ed63c9ad842243f7dce84964bae4d76.png', '2023-05-19 12:00:29', NULL),
(70, 'Rocan', 'rocan@mail.com', 'Teknik Uap', '0fe509e4e0706cfe2a208f220b5d9136.png', '2023-05-19 12:02:25', NULL),
(71, 'Boreno', 'buzang@mail.com', 'Perhotelan', 'e58043377acbaba5d0e59dcc99999f88.jpg', '2023-05-19 12:03:58', '2023-05-19 12:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
