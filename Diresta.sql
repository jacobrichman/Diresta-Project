-- MySQL dump 10.13  Distrib 5.6.29-76.2, for Linux (x86_64)
--
-- Host: localhost    Database: jacobric_Diresta
-- ------------------------------------------------------
-- Server version	5.6.29-76.2

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
-- Table structure for table `Instances`
--

DROP TABLE IF EXISTS `Instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Instances` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Project_ID` int(11) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Start` int(11) NOT NULL,
  `End` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Instances`
--

LOCK TABLES `Instances` WRITE;
/*!40000 ALTER TABLE `Instances` DISABLE KEYS */;
INSERT INTO `Instances` (`ID`, `Project_ID`, `Type`, `Name`, `Start`, `End`) VALUES (1,1,'Tool','Bandsaw',4,31),(2,1,'Tool','Circular Saw',2,3),(3,1,'Tool','Planer',3,4),(4,1,'Material','Wood',0,31),(5,2,'Tool','Bandsaw',23,70),(6,2,'Tool','Lathe',71,93),(7,2,'Tool','Bandsaw',94,113),(8,2,'Tool','Blow Torch',119,135),(9,2,'Tool','File',147,158),(10,2,'Tool','Belt Sander',159,170),(11,2,'Material','Metal',11,175),(12,2,'Tool','Welder',119,146),(13,3,'Tool','Surface Grinder',4,30),(15,3,'Tool','Surface Grinder',56,80),(14,3,'Tool','Utility Knife',30,56),(16,3,'Tool','Miter Saw',86,95),(17,3,'Tool','Palm Router',106,112),(18,3,'Tool','Palm Router',128,135),(19,3,'Tool','Bandsaw',139,150),(20,3,'Technique','Epoxy',152,180),(28,3,'Technique','Leather Braiding',300,350),(23,3,'Tool','Bandsaw',183,216),(24,3,'Tool','File',220,265),(27,3,'Technique','Wood Finishing',283,295),(26,3,'Tool','Drill Press',276,282),(29,3,'Material','Metal',5,30),(30,3,'Material','Wood',30,297),(31,3,'Material','Leather',298,350),(32,4,'Tool','Bandsaw',43,67),(33,4,'Tool','Belt Sander',67,73),(34,4,'Tool','Dremel',78,118),(35,4,'Tool','Blow Torch',119,131),(36,4,'Tool','Welder',131,147),(37,4,'Tool','Blow Torch',147,159),(38,4,'Tool','Welder',160,178),(39,4,'Tool','Blow Torch',178,215),(40,4,'Tool','Belt Sander',222,238),(41,4,'Tool','Dremel',240,271),(42,4,'Tool','Surface Grinder',272,300),(43,4,'Tool','Welder',315,333),(44,4,'Tool','Circular Saw',333,342),(45,4,'Tool','Belt Sander',344,353),(46,4,'Tool','Circular Saw',368,375),(47,4,'Tool','Dremel',383,393),(48,4,'Tool','Welder',395,416),(49,4,'Tool','Surface Grinder',425,436),(50,4,'Tool','Bandsaw',461,468),(51,4,'Tool','CNC Router',468,485),(52,4,'Tool','Dremel',486,494),(53,4,'Tool','Anvil',494,538),(54,4,'Tool','Welder',542,566),(55,4,'Tool','Belt Sander',573,585),(56,4,'Tool','Dremel',587,600),(57,4,'Tool','Sandpaper',610,647),(58,4,'Tool','Welder',655,666),(59,4,'Tool','Belt Sander',668,684),(60,4,'Material','Metal',0,754),(61,5,'Tool','Drill',4,17),(62,5,'Tool','CNC Router',17,64),(63,5,'Tool','Bandsaw',65,86),(64,5,'Tool','Belt Sander',87,118),(65,5,'Tool','Anvil',119,128),(66,5,'Tool','Drill',128,166),(67,5,'Tool','Bandsaw',168,179),(68,5,'Tool','Belt Sander',179,205),(69,5,'Tool','Drill',217,240),(70,5,'Tool','Hammer',279,300),(71,5,'Tool','Drill',311,320),(72,5,'Tool','Hammer',335,359),(73,5,'Tool','Blow Torch',388,398),(74,5,'Tool','File',404,440),(75,5,'Material','Metal',1,477),(76,6,'Tool','Random Orbital Sander',3,26),(77,6,'Tool','Sanding Block',27,38),(78,6,'Tool','Belt Sander',39,45),(79,6,'Tool','Random Orbital Sander',45,51),(80,6,'Tool','Sandpaper',51,60),(81,6,'Technique','Wood Finishing',60,71),(82,6,'Tool','Miter Saw',71,96),(83,6,'Tool','Welder',96,117),(84,6,'Tool','Surface Grinder',117,129),(85,6,'Tool','Welder',130,149),(86,6,'Tool','Bandsaw',152,156),(87,6,'Tool','Welder',163,175),(88,6,'Tool','Drill',176,188),(89,6,'Material','Wood',0,70),(90,6,'Material','Metal',70,188),(91,7,'Tool','Bandsaw',25,50),(92,7,'Tool','Utility Knife',51,62),(93,7,'Tool','Bandsaw',63,109),(94,7,'Tool','Screwdriver',110,120),(95,7,'Tool','Bandsaw',127,174),(96,7,'Tool','Router',175,183),(97,7,'Technique','Luthier',190,200),(98,7,'Technique','Wood Glue',214,222),(99,7,'Tool','Bandsaw',236,245),(100,7,'Tool','Drill Press',251,256),(101,7,'Technique','Whittling',256,267),(102,7,'Tool','Screwdriver',272,288),(103,7,'Tool','Soldering Iron',288,296),(104,7,'Technique','Wood Finishing',318,326),(105,7,'Tool','Welder',326,334),(106,7,'Tool','Drill Press',335,342),(107,7,'Tool','Bandsaw',342,353),(108,7,'Tool','File',353,356),(109,7,'Technique','Spray Painting',378,394),(110,7,'Material','Wood',24,174),(111,7,'Material','Wood',250,325),(112,7,'Material','Metal',326,358);
/*!40000 ALTER TABLE `Instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Projects`
--

DROP TABLE IF EXISTS `Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Projects` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `YouTube_ID` varchar(30) NOT NULL,
  `Instagram_ID` varchar(30) NOT NULL,
  `Make_URL` varchar(80) NOT NULL,
  `Image_URL` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projects`
--

LOCK TABLES `Projects` WRITE;
/*!40000 ALTER TABLE `Projects` DISABLE KEYS */;
INSERT INTO `Projects` (`ID`, `YouTube_ID`, `Instagram_ID`, `Make_URL`, `Image_URL`) VALUES (1,'53S--kE53wo','','','http://img.youtube.com/vi/53S--kE53wo/0.jpg'),(2,'tbG8lzFgVio','','','http://img.youtube.com/vi/tbG8lzFgVio/0.jpg'),(3,'QLzCT9Fx8NM','','','http://img.youtube.com/vi/QLzCT9Fx8NM/0.jpg'),(4,'IuDm32pIDx8','','','http://img.youtube.com/vi/IuDm32pIDx8/0.jpg'),(5,'KX_SFa_IE2s','','','http://img.youtube.com/vi/KX_SFa_IE2s/0.jpg'),(6,'3ZyVeyWV59U','','','http://img.youtube.com/vi/3ZyVeyWV59U/0.jpg'),(7,'eLmKrXjTwIo','','','http://img.youtube.com/vi/eLmKrXjTwIo/0.jpg');
/*!40000 ALTER TABLE `Projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'jacobric_Diresta'
--

--
-- Dumping routines for database 'jacobric_Diresta'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-28  0:24:48
