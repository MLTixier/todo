-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: todo
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

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
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `liste` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `liste` (`liste`),
  CONSTRAINT `Categories_ibfk_3` FOREIGN KEY (`liste`) REFERENCES `Listes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES (1,'entretien maison',1),(2,'fruits et légumes',1),(3,'laitages',1),(4,'viande',1),(5,'poisson',1),(6,'boissons',1),(7,'surgelés',1),(8,'très urgent',3),(9,'moyen urgent',3),(10,'pas urgent',3),(19,'produits secs',1),(20,'bricolage',2),(21,'piscine',2),(22,'sport',2),(23,'ameublement et décoration',2),(24,'vêtements',2),(26,'hygiene',1),(27,'Boulangerie',1),(28,'Apero',1),(29,'autre',2),(30,'jardin',2);
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Listes`
--

DROP TABLE IF EXISTS `Listes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Listes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Produits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `categorie` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie` (`categorie`),
  CONSTRAINT `Produits_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `Categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produits`
--

LOCK TABLES `Produits` WRITE;
/*!40000 ALTER TABLE `Produits` DISABLE KEYS */;
INSERT INTO `Produits` VALUES (1,'papier toilette',1),(2,'jambon',4),(3,'pavé de saumon',5),(4,'haricots verts',2),(5,'crème fraiche (pot)',3),(6,'crème fraiche (briquette)',3),(7,'banane',2),(8,'epinards',7),(9,'kiwis',2),(10,'ananas',2),(12,'tomates',2),(13,'carton',1),(14,'poisson pané',5),(38,'levure chimique',19),(43,'Yaourts nature',3),(45,'Fresque chambre',9),(48,'Grand escabeau',20),(50,'Accrocher Luminaires chambres',10),(53,'Rechercher camping gites',9),(54,'Organiser evjf',10),(56,'Faire joint faïence et miroir',10),(57,'Crépine d\'injection à commander',21),(58,'Bache a bulle piscine',21),(59,'Intex kit réparation bouee',21),(62,'Site auriane',10),(63,'Site papa',10),(66,'Boites pour ranger jeux',23),(67,'Ranger vetements pantalons chaussettes culottes',9),(69,'Trier jouets',9),(70,'Ranger drive et sauvegarder campus',9),(71,'Ranger papiers persos',9),(72,'Vidéo compil mathis et photos 1mois 12moi',9),(81,'Pommes dauphine',7),(82,'Jus',6),(86,'Organiser we evol',9),(88,'Disques de coton',26),(89,'Blé',19),(91,'Mettre patins aux chaises',9),(92,'Ranger pots de fleurs',10),(93,'Enlever papuches pulls manteaux',10),(94,'Mettre a la ressourcerie les poignees de cuisine',9),(102,'Parmesan',3),(103,'Marrons',19),(104,'Disques pain foie gras',27),(107,'Moutarde',19),(109,'Vin blanc cuisine',6),(110,'Kellogg\'s',19),(112,'Houmous',28),(113,'Vin rouge pour vin chaud',6),(116,'Pastille ronde butte porte',20),(117,'Farine',19),(118,'Fleur de sel',19),(119,'Fauteuils chambre',23),(120,'Tasses a café',29),(122,'Facture amsterdamair subvention',8),(123,'Armoire inhifugee batterie velo',29),(126,'Sel himalaya',19),(129,'Fourchette mathis',22),(130,'Lait coco',19),(132,'Lingettes anti decoloration',1),(133,'Savon bébé',26),(134,'Champignons secs',19),(135,'Pates alphabet',19),(136,'Elastiques a cheveux',26),(137,'Traitement ou engrais vigne ?',30),(138,'Beche',30),(139,'Mirabellier et tuteur terreau ?',30),(140,'Lait epaississant gaetan',19),(141,'Film étirable',1),(142,'Limoncello',6),(143,'Tampons & serviettes',26),(144,'Papier cuisson',1),(145,'Petits sacs congelo',1),(146,'Livret A',8),(147,'Lait',6),(148,'Lentilles',19),(150,'Organiser we ski parents ?',9);
/*!40000 ALTER TABLE `Produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liste_produit`
--

DROP TABLE IF EXISTS `liste_produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `liste_produit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `liste_id` bigint unsigned NOT NULL,
  `produit_id` bigint unsigned NOT NULL,
  `quantite` varchar(100) DEFAULT NULL,
  `est_coche` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `liste_id` (`liste_id`),
  KEY `produit_id` (`produit_id`),
  CONSTRAINT `liste_produit_ibfk_3` FOREIGN KEY (`liste_id`) REFERENCES `Listes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_produit_ibfk_4` FOREIGN KEY (`produit_id`) REFERENCES `Produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liste_produit`
--

LOCK TABLES `liste_produit` WRITE;
/*!40000 ALTER TABLE `liste_produit` DISABLE KEYS */;
INSERT INTO `liste_produit` VALUES (89,3,45,NULL,_binary '\0'),(92,2,48,NULL,_binary '\0'),(94,3,50,NULL,_binary '\0'),(97,3,53,NULL,_binary '\0'),(98,3,54,NULL,_binary '\0'),(100,3,56,NULL,_binary '\0'),(101,2,57,NULL,_binary '\0'),(102,2,58,NULL,_binary '\0'),(103,2,59,NULL,_binary '\0'),(106,3,62,NULL,_binary '\0'),(107,3,63,NULL,_binary '\0'),(110,2,66,NULL,_binary '\0'),(111,3,67,NULL,_binary '\0'),(113,3,69,NULL,_binary '\0'),(114,3,70,NULL,_binary '\0'),(115,3,71,NULL,_binary '\0'),(116,3,72,NULL,_binary '\0'),(131,3,86,NULL,_binary '\0'),(136,3,91,NULL,_binary '\0'),(137,3,92,NULL,_binary '\0'),(138,3,93,NULL,_binary '\0'),(139,3,94,NULL,_binary '\0'),(161,2,116,NULL,_binary '\0'),(164,2,119,NULL,_binary '\0'),(165,2,120,NULL,_binary '\0'),(167,3,122,NULL,_binary '\0'),(168,2,123,NULL,_binary '\0'),(174,2,129,NULL,_binary '\0'),(182,2,137,NULL,_binary '\0'),(183,2,138,NULL,_binary '\0'),(184,2,139,NULL,_binary '\0'),(193,1,140,NULL,_binary '\0'),(195,1,113,NULL,_binary '\0'),(196,1,126,NULL,_binary '\0'),(201,3,146,NULL,_binary '\0'),(203,1,148,NULL,_binary '\0'),(205,3,150,NULL,_binary '\0');
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

-- Dump completed on 2024-01-20 14:36:20
