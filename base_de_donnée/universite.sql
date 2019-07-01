-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: universite
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `batiment`
--

DROP TABLE IF EXISTS `batiment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batiment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_batiment` char(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_batiment` (`nom_batiment`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batiment`
--

LOCK TABLES `batiment` WRITE;
/*!40000 ALTER TABLE `batiment` DISABLE KEYS */;
INSERT INTO `batiment` VALUES (1,'A'),(2,'B');
/*!40000 ALTER TABLE `batiment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bourse`
--

DROP TABLE IF EXISTS `bourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bourse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(10) COLLATE utf8_bin NOT NULL,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bourse`
--

LOCK TABLES `bourse` WRITE;
/*!40000 ALTER TABLE `bourse` DISABLE KEYS */;
INSERT INTO `bourse` VALUES (1,'Entiére',40000),(2,'Demi',20000);
/*!40000 ALTER TABLE `bourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boursier`
--

DROP TABLE IF EXISTS `boursier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boursier` (
  `matricule_etudiant` int(11) unsigned NOT NULL,
  `id_bourse` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`matricule_etudiant`),
  KEY `id_bourse` (`id_bourse`),
  KEY `matricule_etudiant` (`matricule_etudiant`),
  CONSTRAINT `boursier_ibfk_2` FOREIGN KEY (`id_bourse`) REFERENCES `bourse` (`id`),
  CONSTRAINT `boursier_ibfk_3` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiant` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boursier`
--

LOCK TABLES `boursier` WRITE;
/*!40000 ALTER TABLE `boursier` DISABLE KEYS */;
INSERT INTO `boursier` VALUES (1001,1),(1002,1),(1008,1),(1009,1),(1012,1),(1006,2),(1015,2),(1016,2),(1018,2),(1019,2);
/*!40000 ALTER TABLE `boursier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chambre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `id_batiment` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_batiment` (`id_batiment`),
  CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`id_batiment`) REFERENCES `batiment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambre`
--

LOCK TABLES `chambre` WRITE;
/*!40000 ALTER TABLE `chambre` DISABLE KEYS */;
INSERT INTO `chambre` VALUES (1,1,1),(2,2,1),(3,1,2),(5,3,1),(6,4,1),(7,5,1),(8,6,1),(10,2,2),(11,3,2),(12,4,2),(15,8,1),(17,7,1);
/*!40000 ALTER TABLE `chambre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `est_loge`
--

DROP TABLE IF EXISTS `est_loge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `est_loge` (
  `etu_boursier` int(10) unsigned NOT NULL,
  `id_chambre` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`etu_boursier`),
  KEY `id_chambre` (`id_chambre`),
  CONSTRAINT `est_loge_ibfk_2` FOREIGN KEY (`id_chambre`) REFERENCES `chambre` (`id`),
  CONSTRAINT `est_loge_ibfk_3` FOREIGN KEY (`etu_boursier`) REFERENCES `boursier` (`matricule_etudiant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `est_loge`
--

LOCK TABLES `est_loge` WRITE;
/*!40000 ALTER TABLE `est_loge` DISABLE KEYS */;
INSERT INTO `est_loge` VALUES (1001,1),(1002,3),(1009,6),(1008,11),(1012,12);
/*!40000 ALTER TABLE `est_loge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etudiant` (
  `matricule` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `prenom` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`matricule`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1021 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiant`
--

LOCK TABLES `etudiant` WRITE;
/*!40000 ALTER TABLE `etudiant` DISABLE KEYS */;
INSERT INTO `etudiant` VALUES (1001,'NDIAYE','EL Hadji','eldji22@hotmail.fr',784564181,'1993-08-22'),(1002,'Mbacké','Seynabou','ssmb@gmail.com',705696321,'1996-01-01'),(1003,'Sonko','Macky','ms@gmail.fr',775623147,'1996-08-22'),(1005,'Diouf','Fatou Kiné','kifa@orange.sn',775698562,'1993-03-15'),(1006,'Ndiaye','Leyty','lnd@yahoo.sn',701569663,'1992-05-10'),(1007,'Dia','Bass','dbass@orange.sn',762356952,'1993-09-20'),(1008,'Dibor','Bamba','bdib@orange.sn',775695231,'1996-12-30'),(1009,'Gaye','Nafi','nafg@orange.fr',778456321,'1994-05-16'),(1010,'Ka','Maguette','maka@hotmail.sn',774589612,'1993-04-04'),(1011,'Laye','Soukeye','lasouk@yahoo.fr',701236965,'1996-01-13'),(1012,'Dia','Yacine','yass@orange.fr',775896521,'1990-12-25'),(1013,'Kamara','Nabou','nabs@gmail.com',708954741,'1994-10-09'),(1014,'Dieye','Lamine','dlam@hotmail.sn',772369584,'1992-12-29'),(1015,'Fall','Matar','matfa@yahoo.sn',768951236,'1994-05-16'),(1016,'Ndiaye','Awa','awa@gamil.com',704896521,'1994-07-25'),(1017,'Laye','Ndoye','ndoyrl@gmail.fr',701235685,'1994-05-19'),(1018,'Gires','Cathérine','cat@yahoo.fr',704589612,'1994-11-09'),(1019,'Picasso','Morguane','pimor@orange.fr',782144512,'1990-12-09'),(1020,'Sow','Soukaye','souk@orange.sn',774856230,'1998-01-09');
/*!40000 ALTER TABLE `etudiant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `non_boursier`
--

DROP TABLE IF EXISTS `non_boursier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `non_boursier` (
  `matricule_etudiant` int(10) unsigned NOT NULL,
  `adresse` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`matricule_etudiant`),
  CONSTRAINT `non_boursier_ibfk_1` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiant` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `non_boursier`
--

LOCK TABLES `non_boursier` WRITE;
/*!40000 ALTER TABLE `non_boursier` DISABLE KEYS */;
INSERT INTO `non_boursier` VALUES (1003,'Thiés'),(1005,'Linguére'),(1007,'Kafrine'),(1010,'Backel'),(1013,'Tamba'),(1014,'Pikine');
/*!40000 ALTER TABLE `non_boursier` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-30 18:37:33
