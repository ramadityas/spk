-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2016 at 09:25 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE IF NOT EXISTS `bobot` (
  `j1` int(11) NOT NULL,
  `j2` int(11) NOT NULL,
  `j3` int(11) NOT NULL,
  `j4` int(11) NOT NULL,
  `j5` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`j1`, `j2`, `j3`, `j4`, `j5`) VALUES
(10, 8, 5, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` varchar(11) NOT NULL DEFAULT '0',
  `nis` varchar(10) NOT NULL,
  `nama` varchar(122) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `semester` int(1) NOT NULL,
  `tahun` varchar(11) NOT NULL,
  `raport` varchar(10) NOT NULL,
  `kepribadian` varchar(10) NOT NULL,
  `saudara` int(2) NOT NULL,
  `ortu` varchar(50) NOT NULL,
  `penghasilan` int(11) NOT NULL,
  `preferensi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `siswa`
--
DROP TRIGGER IF EXISTS `spk`.`tg_siswa_insert`;
DELIMITER //
CREATE TRIGGER `spk`.`tg_siswa_insert` BEFORE INSERT ON `spk`.`siswa`
 FOR EACH ROW BEGIN
  INSERT INTO siswa_seq (id) VALUES (NULL);
  SET NEW.id_siswa = CONCAT('S', LPAD(LAST_INSERT_ID(), 3, '0'));
END
//
DELIMITER ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `kelas`, `semester`, `tahun`, `raport`, `kepribadian`, `saudara`, `ortu`, `penghasilan`, `preferensi`) VALUES
('S001', '9943777111', 'Farid Rachmanto', 'XI-IPA', 1, '2015 - 2016', '89.83', '92.50', 2, 'Kedua Ortu Masih Hidup', 3200000, '0.498168765321'),
('S002', '9943777112', 'Wahid Wahyono', 'XI-IPA', 1, '2015 - 2016', '91.67', '90.00', 2, 'Kedua Ortu Masih Hidup', 3000000, '0.501831234679'),
('S004', '9943777113', 'Arlianah', 'XI-IPA', 1, '2015 - 2016', '90.25', '89.00', 4, 'Kedua Ortu Masih Hidup', 2500000, '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_seq`
--

CREATE TABLE IF NOT EXISTS `siswa_seq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `siswa_seq`
--

INSERT INTO `siswa_seq` (`id`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status`) VALUES
(1, 'ramaditya', '1234', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vektor`
--

CREATE TABLE IF NOT EXISTS `vektor` (
  `id_vektor` varchar(2) NOT NULL,
  `vektor` decimal(20,10) NOT NULL,
  PRIMARY KEY (`id_vektor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vektor`
--

INSERT INTO `vektor` (`id_vektor`, `vektor`) VALUES
('1', 63.1887396994);
