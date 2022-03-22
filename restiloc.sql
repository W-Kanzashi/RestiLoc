-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2022 at 12:18 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
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
-- Database: `restiloc`
--

-- --------------------------------------------------------

--
-- Table structure for table `carosserie`
--

CREATE TABLE `carosserie` (
  `id_piece` int NOT NULL,
  `element_carosserie` varchar(24) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int NOT NULL,
  `nom_client` varchar(30) DEFAULT NULL,
  `prenom_client` varchar(30) DEFAULT NULL,
  `rue_client` varchar(50) DEFAULT NULL,
  `ville_client` varchar(50) DEFAULT NULL,
  `cp_client` varchar(5) DEFAULT NULL,
  `tel_client` varchar(15) DEFAULT NULL,
  `tel_port_client` varchar(15) DEFAULT NULL,
  `email_client` varchar(100) DEFAULT NULL,
  `date_naissance_client` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `rue_client`, `ville_client`, `cp_client`, `tel_client`, `tel_port_client`, `email_client`, `date_naissance_client`) VALUES
(1, 'Doe', 'John', '123 Avenue...', 'Paris', '10000', '0000000000', '0000000000', 'jhon.doe@example.com', '2022-02-10'),
(2, 'Dupond', 'Bob', '123 rue A', 'A', '12345', '1234567890', '0123456789', 'bob-dupond@example.com', '2022-02-12'),
(3, 'boc', 'John', '123 Avenue...', 'Paris', '10000', '7894561230', '4561237890', 'jhon.boc@example.com', '2022-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `dossier`
--

CREATE TABLE `dossier` (
  `id_dossier` int NOT NULL,
  `ref_dossier` varchar(10) DEFAULT NULL,
  `date_creation_dossier` date DEFAULT NULL,
  `nom_fichier_expertise` varchar(64) DEFAULT NULL,
  `indisponibilite` varchar(25) DEFAULT NULL,
  `id_vehicule` int NOT NULL,
  `id_expert` int DEFAULT NULL,
  `id_client` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `dossier`
--

INSERT INTO `dossier` (`id_dossier`, `ref_dossier`, `date_creation_dossier`, `nom_fichier_expertise`, `indisponibilite`, `id_vehicule`, `id_expert`, `id_client`) VALUES
(4, 'John1', NULL, 'John1', NULL, 1, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `id_expert` int NOT NULL,
  `prenom_expert` varchar(30) DEFAULT NULL,
  `ville_expert` varchar(64) NOT NULL,
  `nom_expert` varchar(30) DEFAULT NULL,
  `tel_port_expert` varchar(15) DEFAULT NULL,
  `email_expert` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`id_expert`, `prenom_expert`, `ville_expert`, `nom_expert`, `tel_port_expert`, `email_expert`) VALUES
(1, 'Dara', 'Limousin', 'Chandler', '01 37 20 25 87', 'elit.pede@google.couk'),
(2, 'Fitzgerald', 'Languedoc-Roussillon', 'Quail', '05 39 92 52 71', 'at.egestas.a@protonmail.edu'),
(3, 'Vivien', 'Picardie', 'Warren', '02 28 28 15 44', 'volutpat@hotmail.couk'),
(4, 'Damon', 'Aquitaine', 'Callum', '06 06 51 02 42', 'ipsum.dolor@hotmail.couk'),
(5, 'Lisandra', 'Centre', 'Juliet', '02 57 70 75 91', 'justo@icloud.net'),
(6, 'Elvis', 'Champagne-Ardenne', 'Garth', '07 17 55 13 83', 'erat.etiam.vestibulum@outlook.couk'),
(7, 'Ursula', 'Haute-Normandie', 'Hall', '01 78 45 73 16', 'vivamus.non@aol.ca'),
(8, 'Melyssa', 'Languedoc-Roussillon', 'Jenna', '08 26 75 22 97', 'ac@aol.couk'),
(9, 'Georgia', 'Lorraine', 'John', '03 16 54 99 14', 'vehicula.et@outlook.net'),
(10, 'Melvin', 'Haute-Normandie', 'Giacomo', '07 76 77 56 07', 'sem@protonmail.com'),
(11, 'Dexter', 'Haute-Normandie', 'Zeus', '04 36 75 16 77', 'nonummy.ut@aol.couk'),
(12, 'Judith', 'Poitou-Charentes', 'Maggie', '08 34 83 36 37', 'egestas.duis@yahoo.org'),
(13, 'Venus', 'Nord-Pas-de-Calais', 'Madonna', '03 67 43 25 07', 'ac.urna@google.net'),
(14, 'Jessamine', 'Auvergne', 'Veronica', '07 15 66 53 72', 'neque.morbi.quis@outlook.couk'),
(15, 'Guinevere', 'Basse-Normandie', 'Daniel', '02 50 81 16 37', 'elit@aol.couk');

-- --------------------------------------------------------

--
-- Table structure for table `garage`
--

CREATE TABLE `garage` (
  `id_garage` int NOT NULL,
  `nom_garage` varchar(64) DEFAULT NULL,
  `ville_garage` varchar(64) DEFAULT NULL,
  `tel_garage` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `garage`
--

INSERT INTO `garage` (`id_garage`, `nom_garage`, `ville_garage`, `tel_garage`) VALUES
(1, 'Alpha', 'Paris', '1234657891'),
(2, 'Beta', 'Strasbourg', '4567891234'),
(3, 'Gamma', 'Lyon', '7894652131'),
(4, 'Epsilon', 'Lille', '6543219878'),
(5, 'Nec Ante Maecenas LLC', 'Haute-Normandie', '0678858532'),
(6, 'Semper Auctor Corporation', 'Poitou-Charentes', '0804411471'),
(7, 'At Pretium Ltd', 'Nord-Pas-de-Calais', '0555524784'),
(8, 'Auctor Associates', 'Auvergne', '0713668859'),
(9, 'In Tincidunt LLC', 'Basse-Normandie', '0697378477'),
(10, 'Sociis Natoque LLP', 'Champagne-Ardenne', '0236770644'),
(11, 'Viverra Donec Tempus Corporation', 'Bretagne', '0496126174'),
(12, 'Id Ante LLP', 'Auvergne', '0603668164'),
(13, 'Ipsum Leo Elementum Institute', 'Bretagne', '0301505218'),
(14, 'Nunc Mauris Elit Incorporated', 'Bourgogne', '0521517656');

-- --------------------------------------------------------

--
-- Table structure for table `necessite`
--

CREATE TABLE `necessite` (
  `id_vehicule` int NOT NULL,
  `id_prestation` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `piece`
--

CREATE TABLE `piece` (
  `id_piece` int NOT NULL,
  `nom_piece` varchar(32) DEFAULT NULL,
  `libelle_piece` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `prestation`
--

CREATE TABLE `prestation` (
  `id_prestation` int NOT NULL,
  `libelle_prestation` varchar(64) DEFAULT NULL,
  `description_prestation` varchar(2048) DEFAULT NULL,
  `nom_photo` varchar(24) DEFAULT NULL,
  `chemin_photo` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `prestation_carosserie`
--

CREATE TABLE `prestation_carosserie` (
  `id_prestation` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `prestation_piece`
--

CREATE TABLE `prestation_piece` (
  `id_prestation` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `quantite`
--

CREATE TABLE `quantite` (
  `id_piece` int NOT NULL,
  `quantite` tinyint DEFAULT NULL,
  `id_prestation` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE `rdv` (
  `id_rdv` int NOT NULL,
  `date_rdv` date DEFAULT NULL,
  `id_expert` int NOT NULL,
  `id_garage` int NOT NULL,
  `id_dossier` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `rdv`
--

INSERT INTO `rdv` (`id_rdv`, `date_rdv`, `id_expert`, `id_garage`, `id_dossier`) VALUES
(1, '2022-03-18', 14, 12, 4),
(2, '2022-03-18', 14, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `traitement`
--

CREATE TABLE `traitement` (
  `id_piece` int NOT NULL,
  `nom_traitement` varchar(20) DEFAULT NULL,
  `id_prestation` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int NOT NULL,
  `date_mec` date DEFAULT NULL,
  `couleur` varchar(10) DEFAULT NULL,
  `nom_modele` varchar(10) DEFAULT NULL,
  `immatriculation` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `date_mec`, `couleur`, `nom_modele`, `immatriculation`) VALUES
(1, '2021-09-07', 'noire', 'alpha', 'xan-123'),
(2, '2002-02-07', 'noire', 'alpha', 'dac-485'),
(3, '2003-02-26', 'blanche', 'beta', 'htd-852'),
(4, '2007-10-21', '#8329ad', 'Rylee', 'B4M 4H2'),
(5, '2011-02-07', '#f4e0b2', 'Britanni', 'V2W 2H2'),
(6, '2013-10-17', '#cc5c02', 'Jaden', 'I2S 6C7'),
(7, '2007-07-21', '#7ccccc', 'Kaitlin', 'O7V 8E2'),
(8, '2011-06-16', '#83e01f', 'Tatiana', 'R9A 3Q1'),
(9, '1998-06-01', '#24ad54', 'Karyn', 'J2A 8V3'),
(10, '2012-12-10', '#5ae2bc', 'Jayme', 'M6G 6R6'),
(11, '2018-06-27', '#d870ef', 'Tana', 'B8I 8F4'),
(12, '2010-01-23', '#9276cc', 'Diana', 'P8R 8E8'),
(13, '2011-03-28', '#45cca8', 'Shana', 'I6C 3H7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carosserie`
--
ALTER TABLE `carosserie`
  ADD PRIMARY KEY (`id_piece`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id_dossier`),
  ADD UNIQUE KEY `id_vehicule` (`id_vehicule`),
  ADD KEY `id_expert` (`id_expert`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`id_expert`);

--
-- Indexes for table `garage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`id_garage`);

--
-- Indexes for table `necessite`
--
ALTER TABLE `necessite`
  ADD PRIMARY KEY (`id_vehicule`,`id_prestation`),
  ADD KEY `id_prestation` (`id_prestation`);

--
-- Indexes for table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id_piece`);

--
-- Indexes for table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id_prestation`);

--
-- Indexes for table `prestation_carosserie`
--
ALTER TABLE `prestation_carosserie`
  ADD PRIMARY KEY (`id_prestation`);

--
-- Indexes for table `prestation_piece`
--
ALTER TABLE `prestation_piece`
  ADD PRIMARY KEY (`id_prestation`);

--
-- Indexes for table `quantite`
--
ALTER TABLE `quantite`
  ADD PRIMARY KEY (`id_piece`),
  ADD KEY `id_prestation` (`id_prestation`);

--
-- Indexes for table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `id_expert` (`id_expert`),
  ADD KEY `id_garage` (`id_garage`),
  ADD KEY `id_dossier` (`id_dossier`);

--
-- Indexes for table `traitement`
--
ALTER TABLE `traitement`
  ADD PRIMARY KEY (`id_piece`),
  ADD KEY `id_prestation` (`id_prestation`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id_dossier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `id_expert` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `garage`
--
ALTER TABLE `garage`
  MODIFY `id_garage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `id_rdv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
