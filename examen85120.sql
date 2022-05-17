-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 07:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen85120`
--

-- --------------------------------------------------------

--
-- Table structure for table `docent`
--

CREATE TABLE `docent` (
  `Docent_ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docent`
--

INSERT INTO `docent` (`Docent_ID`, `Email`, `Wachtwoord`) VALUES
(1, 'admin@glr.nl', '$2y$10$jlnKI1oK8Egv33PVU0pOjOQS3bRBC1xDb4q.POK98fGy9uZyw0Trm');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `date_uploaded` varchar(20) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reis`
--

CREATE TABLE `reis` (
  `Reis_ID` int(11) NOT NULL,
  `Titel` varchar(255) NOT NULL,
  `Bestemming` varchar(100) NOT NULL,
  `Omschrijving` text NOT NULL,
  `Begindatum` date NOT NULL,
  `Einddatum` date NOT NULL,
  `Aantal_Plekken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reis`
--

INSERT INTO `reis` (`Reis_ID`, `Titel`, `Bestemming`, `Omschrijving`, `Begindatum`, `Einddatum`, `Aantal_Plekken`) VALUES
(17, 'test', 'test', 'test', '2022-05-20', '2022-05-13', 50);

-- --------------------------------------------------------

--
-- Table structure for table `reis_inschrijf`
--

CREATE TABLE `reis_inschrijf` (
  `Inschrijf_ID` int(11) NOT NULL,
  `Student_ID` int(11) NOT NULL,
  `Reis_ID` int(11) NOT NULL,
  `Studentnummer` int(11) NOT NULL,
  `Identiteitsbewijs_nummer` int(11) NOT NULL,
  `Opmerkingen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reis_inschrijf`
--

INSERT INTO `reis_inschrijf` (`Inschrijf_ID`, `Student_ID`, `Reis_ID`, `Studentnummer`, `Identiteitsbewijs_nummer`, `Opmerkingen`) VALUES
(15, 12, 16, 12345, 213123, '123123'),
(16, 12, 17, 12345, 123123123, '123123123'),
(17, 12, 17, 12345, 123123123, '123123213'),
(18, 12, 15, 12345, 123123123, 'sdafsdfds'),
(19, 12, 17, 12345, 2147483647, '123123123');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `Studentnummer` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `Studentnummer`, `Naam`, `Achternaam`, `Email`, `Wachtwoord`) VALUES
(12, 12345, '12345', '12345', '123@123.nl', '$2y$10$RKgLls72teZS2QuI3mbmSeTmFRg5MGW5wUx3R8/GGZIwIVaBkckIq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `docent`
--
ALTER TABLE `docent`
  ADD PRIMARY KEY (`Docent_ID`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `reis`
--
ALTER TABLE `reis`
  ADD PRIMARY KEY (`Reis_ID`);

--
-- Indexes for table `reis_inschrijf`
--
ALTER TABLE `reis_inschrijf`
  ADD PRIMARY KEY (`Inschrijf_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docent`
--
ALTER TABLE `docent`
  MODIFY `Docent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reis`
--
ALTER TABLE `reis`
  MODIFY `Reis_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reis_inschrijf`
--
ALTER TABLE `reis_inschrijf`
  MODIFY `Inschrijf_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
