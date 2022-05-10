-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: restiloc
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carosserie`
--

DROP TABLE IF EXISTS `carosserie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carosserie` (
  `id_carosserie` int NOT NULL,
  `nom_piece` varchar(32) DEFAULT NULL,
  `libelle_piece` varchar(32) DEFAULT NULL,
  `id_piece` int NOT NULL,
  PRIMARY KEY (`id_carosserie`),
  KEY `id_piece` (`id_piece`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carosserie`
--

LOCK TABLES `carosserie` WRITE;
/*!40000 ALTER TABLE `carosserie` DISABLE KEYS */;
INSERT INTO `carosserie` VALUES (1,'Aile Avant','ZRI02',1),(2,'Pare Brise','POE80',2),(3,'Porte avant droit','EBK43',3),(4,'Porte avant gauche','EBK44',4),(5,'Porte arrière droit','EBK41',5),(6,'Porte arrière gauche','EBK42',6),(7,'Aile arrière','ZRI01',7);
/*!40000 ALTER TABLE `carosserie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(30) DEFAULT NULL,
  `prenom_client` varchar(30) DEFAULT NULL,
  `rue_client` varchar(50) DEFAULT NULL,
  `ville_client` varchar(50) DEFAULT NULL,
  `cp_client` varchar(5) DEFAULT NULL,
  `tel_client` varchar(15) DEFAULT NULL,
  `tel_port_client` varchar(15) DEFAULT NULL,
  `email_client` varchar(100) DEFAULT NULL,
  `date_naissance_client` date DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Doe','John','123 Avenue...','Paris','10000','0000000000','0000000000','jhon.doe@example.com','2022-02-10'),(2,'Dupond','Bob','123 rue A','A','12345','1234567890','0123456789','bob-dupond@example.com','2022-02-12'),(3,'boc','John','123 Avenue...','Paris','10000','7894561230','4561237890','jhon.boc@example.com','2022-02-03');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dossier` (
  `id_dossier` int NOT NULL AUTO_INCREMENT,
  `ref_dossier` varchar(10) DEFAULT NULL,
  `date_creation_dossier` date DEFAULT NULL,
  `nom_fichier_expertise` varchar(64) DEFAULT NULL,
  `indisponibilite` varchar(25) DEFAULT NULL,
  `id_vehicule` int NOT NULL,
  `id_expert` int DEFAULT NULL,
  `id_client` int NOT NULL,
  PRIMARY KEY (`id_dossier`),
  UNIQUE KEY `id_vehicule` (`id_vehicule`),
  KEY `id_expert` (`id_expert`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dossier`
--

LOCK TABLES `dossier` WRITE;
/*!40000 ALTER TABLE `dossier` DISABLE KEYS */;
INSERT INTO `dossier` VALUES (4,'John1',NULL,'John1',NULL,1,NULL,3);
/*!40000 ALTER TABLE `dossier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expert`
--

DROP TABLE IF EXISTS `expert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expert` (
  `id_expert` int NOT NULL AUTO_INCREMENT,
  `prenom_expert` varchar(30) DEFAULT NULL,
  `ville_expert` varchar(64) NOT NULL,
  `nom_expert` varchar(30) DEFAULT NULL,
  `tel_port_expert` varchar(15) DEFAULT NULL,
  `email_expert` varchar(100) DEFAULT NULL,
  `mdp` varchar(128) NOT NULL,
  PRIMARY KEY (`id_expert`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expert`
--

LOCK TABLES `expert` WRITE;
/*!40000 ALTER TABLE `expert` DISABLE KEYS */;
INSERT INTO `expert` VALUES (1,'Dara','Limousin','Chandler','01 37 20 25 87','elit.pede@google.couk','1835953063/9f335561a921a4e93991ef8e3e0abb66478f116d8bed554f1edaeed33ec65228'),(2,'Fitzgerald','Languedoc-Roussillon','Quail','05 39 92 52 71','at.egestas.a@protonmail.edu',''),(3,'Vivien','Picardie','Warren','02 28 28 15 44','volutpat@hotmail.couk',''),(4,'Damon','Aquitaine','Callum','06 06 51 02 42','ipsum.dolor@hotmail.couk',''),(5,'Lisandra','Centre','Juliet','02 57 70 75 91','justo@icloud.net',''),(6,'Elvis','Champagne-Ardenne','Garth','07 17 55 13 83','erat.etiam.vestibulum@outlook.couk',''),(7,'Ursula','Haute-Normandie','Hall','01 78 45 73 16','vivamus.non@aol.ca',''),(8,'Melyssa','Languedoc-Roussillon','Jenna','08 26 75 22 97','ac@aol.couk',''),(9,'Georgia','Lorraine','John','03 16 54 99 14','vehicula.et@outlook.net',''),(10,'Melvin','Haute-Normandie','Giacomo','07 76 77 56 07','sem@protonmail.com',''),(11,'Dexter','Haute-Normandie','Zeus','04 36 75 16 77','nonummy.ut@aol.couk',''),(12,'Judith','Poitou-Charentes','Maggie','08 34 83 36 37','egestas.duis@yahoo.org',''),(13,'Venus','Nord-Pas-de-Calais','Madonna','03 67 43 25 07','ac.urna@google.net',''),(14,'Jessamine','Auvergne','Veronica','07 15 66 53 72','neque.morbi.quis@outlook.couk',''),(15,'Guinevere','Basse-Normandie','Daniel','02 50 81 16 37','elit@aol.couk','');
/*!40000 ALTER TABLE `expert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garage`
--

DROP TABLE IF EXISTS `garage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `garage` (
  `id_garage` int NOT NULL AUTO_INCREMENT,
  `nom_garage` varchar(64) DEFAULT NULL,
  `ville_garage` varchar(64) DEFAULT NULL,
  `tel_garage` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_garage`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garage`
--

LOCK TABLES `garage` WRITE;
/*!40000 ALTER TABLE `garage` DISABLE KEYS */;
INSERT INTO `garage` VALUES (1,'Alpha','Paris','1234657891'),(2,'Beta','Strasbourg','4567891234'),(3,'Gamma','Lyon','7894652131'),(4,'Epsilon','Lille','6543219878'),(5,'Nec Ante Maecenas LLC','Haute-Normandie','0678858532'),(6,'Semper Auctor Corporation','Poitou-Charentes','0804411471'),(7,'At Pretium Ltd','Nord-Pas-de-Calais','0555524784'),(8,'Auctor Associates','Auvergne','0713668859'),(9,'In Tincidunt LLC','Basse-Normandie','0697378477'),(10,'Sociis Natoque LLP','Champagne-Ardenne','0236770644'),(11,'Viverra Donec Tempus Corporation','Bretagne','0496126174'),(12,'Id Ante LLP','Auvergne','0603668164'),(13,'Ipsum Leo Elementum Institute','Bretagne','0301505218'),(14,'Nunc Mauris Elit Incorporated','Bourgogne','0521517656');
/*!40000 ALTER TABLE `garage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `necessite`
--

DROP TABLE IF EXISTS `necessite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `necessite` (
  `id_vehicule` int NOT NULL,
  `id_prestation` int NOT NULL,
  PRIMARY KEY (`id_vehicule`,`id_prestation`),
  KEY `id_prestation` (`id_prestation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `necessite`
--

LOCK TABLES `necessite` WRITE;
/*!40000 ALTER TABLE `necessite` DISABLE KEYS */;
/*!40000 ALTER TABLE `necessite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `piece`
--

DROP TABLE IF EXISTS `piece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `piece` (
  `id_piece` int NOT NULL,
  `nom_piece` varchar(32) DEFAULT NULL,
  `libelle_piece` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_piece`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `piece`
--

LOCK TABLES `piece` WRITE;
/*!40000 ALTER TABLE `piece` DISABLE KEYS */;
INSERT INTO `piece` VALUES (1,'Aile Avant','ZRI02'),(2,'Pare Brise','POE80'),(3,'Porte avant droit','EBK43'),(4,'Porte avant gauche','EBK44'),(5,'Porte arrière droit','EBK41'),(6,'Porte arrière gauche','EBK42'),(7,'Aile arrière','ZRI01'),(8,'Roue','HCC54');
/*!40000 ALTER TABLE `piece` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestation` (
  `id_prestation` int NOT NULL,
  `libelle_prestation` varchar(64) DEFAULT NULL,
  `description_prestation` varchar(2048) DEFAULT NULL,
  `nom_photo` varchar(24) DEFAULT NULL,
  `chemin_photo` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_prestation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation`
--

LOCK TABLES `prestation` WRITE;
/*!40000 ALTER TABLE `prestation` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation_carosserie`
--

DROP TABLE IF EXISTS `prestation_carosserie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestation_carosserie` (
  `id_prestation` int NOT NULL AUTO_INCREMENT,
  `libelle_prestation` varchar(64) DEFAULT NULL,
  `description_prestation` varchar(2048) DEFAULT NULL,
  `nom_photo` varchar(64) DEFAULT NULL,
  `chemin_photo` varchar(64) DEFAULT NULL,
  `id_vehicule` int NOT NULL,
  PRIMARY KEY (`id_prestation`),
  KEY `id_vehicule` (`id_vehicule`),
  CONSTRAINT `prestation_carosserie_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation_carosserie`
--

LOCK TABLES `prestation_carosserie` WRITE;
/*!40000 ALTER TABLE `prestation_carosserie` DISABLE KEYS */;
INSERT INTO `prestation_carosserie` VALUES (34,'Porte','La porte doit être remplacée','carosserie-porte.png','/images/3/4/2022-04-18/',1),(35,'Porte','La porte doit être remplacée','carosserie-porte.png','/images/3/4/2022-04-18/',1),(36,'Porte','La porte doit être remplacée','carosserie-porte.png','/images/3/4/2022-04-18/',1),(37,'Porte','La porte doit être remplacée','carosserie-porte.png','/images/3/4/2022-04-18/',1),(38,'Porte','La porte doit être remplacée','carosserie-porte.png','/images/3/4/2022-04-18/',1);
/*!40000 ALTER TABLE `prestation_carosserie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation_piece`
--

DROP TABLE IF EXISTS `prestation_piece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestation_piece` (
  `id_prestation` int NOT NULL AUTO_INCREMENT,
  `libelle_prestation` varchar(64) DEFAULT NULL,
  `description_prestation` varchar(2048) DEFAULT NULL,
  `nom_photo` varchar(64) DEFAULT NULL,
  `chemin_photo` varchar(64) DEFAULT NULL,
  `id_vehicule` int NOT NULL,
  PRIMARY KEY (`id_prestation`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation_piece`
--

LOCK TABLES `prestation_piece` WRITE;
/*!40000 ALTER TABLE `prestation_piece` DISABLE KEYS */;
INSERT INTO `prestation_piece` VALUES (1,'Porte','La porte doit être remplacée','piece-porte.png','images/3/4/2022-05-04/',1),(2,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(3,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(4,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(5,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(6,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(7,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(8,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(9,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(10,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(11,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(12,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(13,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1),(14,'Porte','La porte doit être remplacée','piece-porte.png','/images/3/4/2022-05-04/',1);
/*!40000 ALTER TABLE `prestation_piece` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantite`
--

DROP TABLE IF EXISTS `quantite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quantite` (
  `id_piece` int NOT NULL,
  `id_prestation` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`id_piece`,`id_prestation`),
  KEY `id_prestation` (`id_prestation`),
  CONSTRAINT `quantite_ibfk_1` FOREIGN KEY (`id_piece`) REFERENCES `piece` (`id_piece`),
  CONSTRAINT `quantite_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `prestation_piece` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantite`
--

LOCK TABLES `quantite` WRITE;
/*!40000 ALTER TABLE `quantite` DISABLE KEYS */;
/*!40000 ALTER TABLE `quantite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rdv` (
  `id_rdv` int NOT NULL AUTO_INCREMENT,
  `date_rdv` date DEFAULT NULL,
  `id_expert` int NOT NULL,
  `id_garage` int NOT NULL,
  `id_dossier` int NOT NULL,
  PRIMARY KEY (`id_rdv`),
  KEY `id_expert` (`id_expert`),
  KEY `id_garage` (`id_garage`),
  KEY `id_dossier` (`id_dossier`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rdv`
--

LOCK TABLES `rdv` WRITE;
/*!40000 ALTER TABLE `rdv` DISABLE KEYS */;
INSERT INTO `rdv` VALUES (1,'2022-03-18',14,12,4),(7,'2022-05-03',15,9,4),(6,'2022-04-30',7,5,4);
/*!40000 ALTER TABLE `rdv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traitement`
--

DROP TABLE IF EXISTS `traitement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `traitement` (
  `id_carosserie` int NOT NULL,
  `nom_traitement` varchar(20) DEFAULT NULL,
  `id_prestation` int NOT NULL,
  PRIMARY KEY (`id_carosserie`),
  KEY `id_prestation` (`id_prestation`),
  CONSTRAINT `traitement_ibfk_1` FOREIGN KEY (`id_carosserie`) REFERENCES `Carosserie` (`id_carosserie`),
  CONSTRAINT `traitement_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `Prestation_carosserie` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traitement`
--

LOCK TABLES `traitement` WRITE;
/*!40000 ALTER TABLE `traitement` DISABLE KEYS */;
/*!40000 ALTER TABLE `traitement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicule` (
  `id_vehicule` int NOT NULL,
  `date_mec` date DEFAULT NULL,
  `couleur` varchar(10) DEFAULT NULL,
  `nom_modele` varchar(10) DEFAULT NULL,
  `immatriculation` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_vehicule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
INSERT INTO `vehicule` VALUES (1,'2021-09-07','noire','alpha','xan-123'),(2,'2002-02-07','noire','alpha','dac-485'),(3,'2003-02-26','blanche','beta','htd-852'),(4,'2007-10-21','#8329ad','Rylee','B4M 4H2'),(5,'2011-02-07','#f4e0b2','Britanni','V2W 2H2'),(6,'2013-10-17','#cc5c02','Jaden','I2S 6C7'),(7,'2007-07-21','#7ccccc','Kaitlin','O7V 8E2'),(8,'2011-06-16','#83e01f','Tatiana','R9A 3Q1'),(9,'1998-06-01','#24ad54','Karyn','J2A 8V3'),(10,'2012-12-10','#5ae2bc','Jayme','M6G 6R6'),(11,'2018-06-27','#d870ef','Tana','B8I 8F4'),(12,'2010-01-23','#9276cc','Diana','P8R 8E8'),(13,'2011-03-28','#45cca8','Shana','I6C 3H7');
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10 14:35:30
