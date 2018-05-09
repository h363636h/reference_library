-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: mgpipe.mg.com    Database: reference_library
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `tag_dept`
--

DROP TABLE IF EXISTS `tag_dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_dept` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(45) DEFAULT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_dept`
--

LOCK TABLES `tag_dept` WRITE;
/*!40000 ALTER TABLE `tag_dept` DISABLE KEYS */;
INSERT INTO `tag_dept` VALUES (46,'17','trail',15),(47,'17','emp',16),(48,'0-10','fx',17),(49,'17','laser beam',18),(51,'17','Teleportation',19),(52,'0-11','Sky lantern',20),(53,'35','Bombing',21),(54,'0-12','Steam',22),(55,'17','Bubble',23),(56,'0-13','Hologram',24),(57,'0-14','Fire Ball',25),(58,'0-15','Car chase',26),(59,'0-16','protective film',27),(60,'0-17','Midair battle',28),(62,'0-18','Monitor',29),(64,'0-19','age reduction',30),(65,'0-20','Robot',31),(66,'0-21','Building collapse',32),(67,'0-22','plane crash',33),(68,'32','',34),(69,'17','fire',35),(70,'0-23','염산',36),(71,'38','DEE',37),(72,'0-25','project',38),(76,'0-27','Stone Man',42),(77,'0-28','Transform',43);
/*!40000 ALTER TABLE `tag_dept` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-22 16:35:56
