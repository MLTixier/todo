-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: courses
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB-0ubuntu0.21.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES (1,'entretien_maison'),(2,'fruits_legumes'),(3,'laitages'),(4,'viande'),(5,'poisson'),(6,'boissons'),(7,'surgeles');
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Listes`
--

DROP TABLE IF EXISTS `Listes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Listes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Listes`
--

LOCK TABLES `Listes` WRITE;
/*!40000 ALTER TABLE `Listes` DISABLE KEYS */;
INSERT INTO `Listes` VALUES (1,'courses'),(2,'achats'),(3,'todo');
/*!40000 ALTER TABLE `Listes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Produits`
--

DROP TABLE IF EXISTS `Produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Produits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `unite` varchar(20) DEFAULT NULL,
  `categorie` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie` (`categorie`),
  CONSTRAINT `Produits_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `Categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produits`
--

LOCK TABLES `Produits` WRITE;
/*!40000 ALTER TABLE `Produits` DISABLE KEYS */;
INSERT INTO `Produits` VALUES (1,'papier toilette',NULL,1),(2,'jambon',NULL,4),(3,'pavé de saumon',NULL,5),(4,'haricots verts',NULL,2),(5,'crème fraiche (pot)',NULL,3),(6,'crème fraiche (briquette)',NULL,3),(7,'banane',NULL,2),(8,'epinards',NULL,7),(9,'kiwis',NULL,2),(10,'ananas',NULL,2),(12,'tomates',NULL,2),(13,'carton',NULL,1);
/*!40000 ALTER TABLE `Produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liste_produit`
--

DROP TABLE IF EXISTS `liste_produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `liste_produit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `liste_id` bigint(20) unsigned NOT NULL,
  `produit_id` bigint(20) unsigned NOT NULL,
  `quantite` varchar(100) DEFAULT NULL,
  `est_coche` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `liste_id` (`liste_id`),
  KEY `produit_id` (`produit_id`),
  CONSTRAINT `liste_produit_ibfk_3` FOREIGN KEY (`liste_id`) REFERENCES `Listes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_produit_ibfk_4` FOREIGN KEY (`produit_id`) REFERENCES `Produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liste_produit`
--

LOCK TABLES `liste_produit` WRITE;
/*!40000 ALTER TABLE `liste_produit` DISABLE KEYS */;
INSERT INTO `liste_produit` VALUES (48,1,2,'4','\0'),(49,1,3,'200g',''),(53,2,13,NULL,'\0');
/*!40000 ALTER TABLE `liste_produit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-01 10:49:31
