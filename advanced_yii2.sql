-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 07:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advanced_yii2`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `caseid` int(10) NOT NULL,
  `phonenum` varchar(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `tanggalwaktu` datetime NOT NULL,
  `description` varchar(100) NOT NULL,
  `casedue` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `supervisor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`caseid`, `phonenum`, `location`, `tanggalwaktu`, `description`, `casedue`, `email`, `status`, `supervisor`) VALUES
(92, '111', 'Rumah', '2020-05-01 12:17:03', 'Rumah', '2020-05-06 12:38:12', 'suryo@umn.ac.id', 'Proses', 'farica@umn.ac.id'),
(93, '22', 'asd', '2020-05-01 12:18:04', 'asd', '2020-05-06 12:33:02', 'suryo@umn.ac.id', 'Pemeriksaan', 'MAHTU IHSAN, S.Kom.'),
(94, '654', 'asd', '2020-05-01 12:18:55', 'asda', '0000-00-00 00:00:00', 'suryo@umn.ac.id', 'Pemeriksaan', 'None'),
(95, '33', 'asd', '2020-05-01 12:19:05', 'asd', '2020-05-06 12:33:27', 'suryo@umn.ac.id', 'Selesai', 'oqke.prawira@umn.ac.id'),
(96, '33', '33', '2020-05-01 12:19:31', '33', '2020-05-06 12:33:41', 'suryo@umn.ac.id', 'Proses', 'aryo.gurmilang@umn.ac.id'),
(97, '22', '22', '2020-05-01 12:20:04', '22', '2020-05-06 12:30:08', 'suryo@umn.ac.id', 'Pemeriksaan', 'None'),
(98, '99', '99', '2020-05-01 12:34:07', '99', '2020-05-06 12:35:45', 'admin@admin.com', 'Proses', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `caseId` varchar(10) NOT NULL,
  `imageFiles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`caseId`, `imageFiles`) VALUES
('1', '1_2020-03-06_15-07-26_1.png'),
('1', '1_2020-03-06_15-07-26_2.png'),
('1', '1_2020-03-06_15-07-26_3.png'),
('2', '2_2020-03-06_15-08-16_1.png'),
('2', '2_2020-03-06_15-08-16_2.png'),
('3', '3_2020-03-06_15-08-16_1.png'),
('3', '3_2020-03-06_15-08-16_2.png'),
('4', '4_2020-03-06_15-08-38_1.png'),
('4', '4_2020-03-06_15-08-38_2.png'),
('5', '5_2020-04-13_11-45-13_1.png'),
('6', '6_2020-04-24_15-20-22_1.jpg'),
('7', '7_2020-04-28_14-00-24_1.jpg'),
('8', '8_2020-04-28_16-35-03_1.png'),
('9', '9_2020-04-28_16-36-02_1.png'),
('10', '10_2020-04-28_16-39-18_1.png'),
('11', '11_2020-04-28_16-39-58_1.png'),
('12', '12_2020-04-28_16-40-52_1.png'),
('13', '13_2020-04-28_16-41-53_1.png'),
('13', '13_2020-04-28_16-41-53_2.png'),
('14', '14_2020-04-28_17-11-45_1.png'),
('15', '15_2020-04-28_17-15-45_1.png'),
('15', '15_2020-04-28_17-15-45_2.png'),
('16', '16_2020-04-28_17-48-22_1.png'),
('17', '17_2020-04-28_17-49-26_1.png'),
('18', '18_2020-04-28_17-50-11_1.png'),
('19', '19_2020-04-28_17-50-43_1.png'),
('20', '20_2020-04-28_18-13-55_1.png'),
('21', '21_2020-04-28_18-15-16_1.png'),
('22', '22_2020-04-28_18-52-17_1.png'),
('23', '23_2020-04-29_12-41-41_1.png'),
('24', '24_2020-04-29_12-54-32_1.png'),
('25', '25_2020-04-29_12-55-26_1.png'),
('26', '26_2020-04-29_12-58-00_1.png'),
('27', '27_2020-04-30_15-19-23_1.png'),
('29', '29_2020-04-30_15-47-24_1.png'),
('30', '30_2020-04-30_15-49-11_1.png'),
('31', '31_2020-04-30_15-52-43_1.png'),
('32', '32_2020-04-30_15-56-15_1.png'),
('35', '35_2020-05-05_16-01-19_1.png'),
('36', '36_2020-04-30_16-02-35_1.png'),
('37', '37_2020-04-30_16-07-31_1.png'),
('38', '38_2020-04-30_16-24-55_1.png'),
('39', '39_2020-05-01_11-04-00_1.png'),
('40', '40_2020-05-01_11-05-43_1.png'),
('41', '41_2020-05-01_11-06-43_1.png'),
('42', '42_2020-05-01_11-06-50_1.png'),
('43', '43_2020-05-01_11-07-09_1.png'),
('44', '44_2020-05-01_11-08-04_1.png'),
('45', '45_2020-05-01_11-08-30_1.png'),
('46', '46_2020-05-01_11-08-36_1.png'),
('47', '47_2020-05-01_11-08-40_1.png'),
('48', '48_2020-05-01_11-08-46_1.png'),
('49', '49_2020-05-01_11-09-32_1.png'),
('50', '50_2020-05-01_11-09-36_1.png'),
('51', '51_2020-05-01_11-10-04_1.png'),
('52', '52_2020-05-01_11-10-15_1.png'),
('53', '53_2020-05-01_11-10-26_1.png'),
('54', '54_2020-05-01_11-10-35_1.png'),
('55', '55_2020-05-01_11-10-48_1.png'),
('56', '56_2020-05-01_11-10-53_1.png'),
('57', '57_2020-05-01_11-10-58_1.png'),
('58', '58_2020-05-01_11-11-04_1.png'),
('59', '59_2020-05-01_11-11-13_1.png'),
('60', '60_2020-05-01_11-12-40_1.png'),
('61', '61_2020-05-01_11-12-45_1.png'),
('62', '62_2020-05-01_11-12-52_1.png'),
('63', '63_2020-05-01_11-13-01_1.png'),
('64', '64_2020-05-01_11-13-04_1.png'),
('65', '65_2020-05-01_11-13-11_1.png'),
('66', '66_2020-05-01_11-13-36_1.png'),
('67', '67_2020-05-01_11-13-49_1.png'),
('68', '68_2020-05-01_11-14-01_1.png'),
('69', '69_2020-05-01_11-14-20_1.png'),
('70', '70_2020-05-01_11-14-29_1.png'),
('71', '71_2020-05-01_11-14-32_1.png'),
('72', '72_2020-05-01_11-14-43_1.png'),
('73', '73_2020-05-01_11-14-51_1.png'),
('74', '74_2020-05-01_11-15-00_1.png'),
('75', '75_2020-05-01_11-15-06_1.png'),
('76', '76_2020-05-01_11-15-58_1.png'),
('77', '77_2020-05-01_11-16-04_1.png'),
('78', '78_2020-05-01_11-16-20_1.png'),
('79', '79_2020-05-01_11-16-25_1.png'),
('80', '80_2020-05-01_11-16-59_1.png'),
('81', '81_2020-05-01_11-17-27_1.png'),
('82', '82_2020-05-01_11-17-51_1.png'),
('83', '83_2020-05-01_11-21-06_1.png'),
('84', '84_2020-05-01_11-44-24_1.png'),
('85', '85_2020-05-01_11-51-24_1.png'),
('86', '86_2020-05-01_12-00-12_1.png'),
('87', '87_2020-05-01_12-00-41_1.png'),
('88', '88_2020-05-01_12-08-29_1.png'),
('89', '89_2020-05-01_12-09-42_1.png'),
('90', '90_2020-05-01_12-11-40_1.png'),
('91', '91_2020-05-01_12-14-55_1.png'),
('92', '92_2020-05-01_12-17-03_1.png'),
('93', '93_2020-05-01_12-18-04_1.png'),
('94', '94_2020-05-01_12-18-55_1.png'),
('95', '95_2020-05-01_12-19-05_1.png'),
('96', '96_2020-05-01_12-19-31_1.png'),
('97', '97_2020-05-01_12-20-04_1.png'),
('98', '98_2020-05-01_12-34-07_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `formid` varchar(50) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `source` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `formid`, `notes`, `source`) VALUES
(1, '92', 'kerjain yaks', '1'),
(2, '92', 'zzssadee', '2'),
(3, '93', 'okey', '1'),
(4, '93', 'sdsd', '2'),
(5, '94', 'masih ada waktu', '1'),
(6, '94', '', '2'),
(7, '95', '', '1'),
(8, '95', 'asddd', '2'),
(9, '96', 'siap kan', '1'),
(10, '96', 'd', '2'),
(11, '97', 'kerjain', '1'),
(12, '97', 'ddd', '2'),
(13, '98', 'kerjain ya', '1'),
(14, '98', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password`, `email`, `status`, `status_detail`) VALUES
(3, 'muzaki', 'hL_UzmU2Lo65k3EYR5QlIgHNxzoksomz', '76ee59a71c612fb0ae3d0e12b5ce409c8ea7e46b', 'muzaki@student.umn.ac.id', 'Guest', 'Mahasiswa'),
(4, 'alexander', 'LZ95RJSaYTs6AuCpJ2kkl6AhE7qUPlZF', 'e46fc836cca3acec03944314d1457c2ae6c68ef3', 'axander90@yahoo.com', 'Admin', 'Admin'),
(10, 'admin', 'yYAwtG0KrzoUvOIj7nQMgmBpHsG8eJLW', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 'Admin', 'Admin'),
(11, 'userbaru', 'ILtjQ1OS1z0JzCX9KpZDF3gqkHjcd6qY', 'a111a99437b44a45fd81deab87125ad34d5bb7b1', 'userbaru@user.com', 'Guest', 'Mahasiswa'),
(15, 'test', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@gmail.com', 'Guest', 'Mahasiswa'),
(16, 'SUDARMAN SUTANTO', 'random', '09e60797a7c2a03c4d73a3d70e3cdaa3d32a7172', 'sudarman_sutanto@umn.ac.id', 'Supervisor', 'BM Manager'),
(17, 'ANTONIUS SURYADI, S.T.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'suryo@umn.ac.id', 'Supervisor', 'BM Superintendent'),
(18, 'C. ERVIN SETYO CAHYADI, S.Pd.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'ervin@umn.ac.id', 'Supervisor', 'ME Superintendent'),
(19, 'DWI KRISTIAWAN MS, S.Kom., M.MSI', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'dwikris@umn.ac.id', 'Supervisor', 'IT Manager'),
(20, 'ANTONIUS GUNAWAN, S.Kom.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'antonius@umn.ac.id ', 'Supervisor', 'IT Technician'),
(21, 'MAHTU IHSAN, S.Kom.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'MAHTU IHSAN, S.Kom.', 'Supervisor', 'IT Technician'),
(22, 'DARFI RIZKAVIRWAN, S.Sn., M.Ds.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'darfi@umn.ac.id', 'Supervisor', 'Koord.Lab FSD'),
(23, 'FARICA PERDANA PUTRI, S.Kom., M.Sc.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'farica@umn.ac.id', 'Supervisor', 'Koord. Lab FTI'),
(24, 'ALBERTUS MAGNUS PRESTIANTA, S.I.Kom., M.A.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'albertus.prestianta@umn.ac.id', 'Supervisor', 'Koord. Lab FIKOM'),
(25, 'OQKE PRAWIRA TRIUTAMA, SST.Par., M.Si.Par', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'oqke.prawira@umn.ac.id', 'Supervisor', 'Koord. Lab Perhotelan'),
(26, 'HENDRICO FIRZANDY, M.Ars.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'hendrico.firzandy@umn.ac.id', 'Supervisor', 'Kaprodi Arsitek'),
(27, 'IRMA DESIYANA, S.Ars., M.Ars.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'irma.desiyana@umn.ac.id', 'Supervisor', 'Sekprodi Arsitek'),
(28, 'CITRANDIKA KRISANDUA OKTA SELAROSA, S.Pd., M.A.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'citra.selarosa@umn.ac.id', 'Supervisor', 'Manager Int.Student Affair'),
(29, 'IGNATIUS DE LOYOLA ARYO GURMILANG, S.S.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'aryo.gurmilang@umn.ac.id', 'Supervisor', 'Int.Student Affair'),
(30, 'ANDRI SETO BASKORO, S.Pd.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'seto.baskoro@umn.ac.id', 'Supervisor', 'Int.Student Affair'),
(31, 'NUR SAYIDATUNNISA, S.Si.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'nur.sayidatunnisa@umn.ac.id', 'Admin', 'K3L Officer'),
(32, 'STEFANUS BAMBANG WIDIATNOLO, S.T.', 'random', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'b.widiatnolo@umn.ac.id', 'Guest', 'BPMI MANAGER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`caseid`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `caseid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
