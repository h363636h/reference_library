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
-- Table structure for table `img_tag`
--

DROP TABLE IF EXISTS `img_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_tag` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `img_id` int(11) DEFAULT NULL,
  `frame_id` int(11) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img_tag`
--

LOCK TABLES `img_tag` WRITE;
/*!40000 ALTER TABLE `img_tag` DISABLE KEYS */;
INSERT INTO `img_tag` VALUES (5,4564,5,'trail'),(6,4566,6,'trail'),(8,4572,8,'emp'),(9,4027,4,'emp'),(10,4604,7,'Teleportation'),(11,4613,9,'Sky lantern'),(12,4614,10,'Bombing'),(13,4620,11,'Steam'),(15,4620,11,'Bubble'),(16,4599,12,'laser beam'),(17,4600,13,'laser beam'),(18,4338,14,'protective film'),(19,4328,15,'Midair battle'),(20,4338,14,'Midair battle'),(21,4363,16,'Midair battle'),(23,4349,18,'Midair battle'),(24,4341,19,'Midair battle'),(25,4333,20,'Midair battle'),(26,4336,21,'Midair battle'),(27,4351,22,'Midair battle'),(28,4355,23,'Midair battle'),(29,4343,24,'Midair battle'),(30,4353,25,'Midair battle'),(31,4340,26,'Midair battle'),(32,4361,27,'Midair battle'),(33,4345,28,'Midair battle'),(34,4330,29,'Midair battle'),(35,4356,30,'Midair battle'),(36,4359,31,'Midair battle'),(37,4331,32,'Midair battle'),(38,4624,33,'trail'),(39,4621,34,'trail'),(40,4623,35,'trail'),(41,4626,36,'trail'),(42,4622,37,'trail'),(43,4625,38,'trail'),(44,4630,39,'Monitor'),(45,4636,40,'Monitor'),(46,4631,41,'Monitor'),(47,4627,42,'Monitor'),(48,4635,43,'Monitor'),(49,4634,44,'Monitor'),(50,4633,45,'Monitor'),(51,4629,46,'Monitor'),(52,4628,47,'Monitor'),(53,4632,48,'Monitor'),(54,4637,49,'Fire Ball'),(55,4638,50,'Fire Ball'),(56,4640,51,'emp'),(57,4639,52,'emp'),(58,4611,53,'age reduction'),(59,4612,54,'age reduction'),(60,4682,55,'Bombing'),(61,4664,56,'Car chase'),(62,5159,58,'Robot'),(63,5158,59,'Robot'),(64,4594,60,'Robot'),(66,5160,61,'Robot'),(67,4593,62,'Robot'),(68,4596,63,'Robot'),(69,5063,64,'Building collapse'),(70,5064,65,'Building collapse'),(71,5166,66,'Building collapse'),(72,5072,67,'plane crash'),(73,5073,68,'plane crash'),(74,5066,69,'plane crash'),(75,5065,70,'plane crash'),(76,5225,71,'emp'),(77,4390,73,'염산'),(78,4302,75,'염산'),(79,4390,73,'DEE'),(80,4302,75,'DEE'),(81,4114,76,'염산'),(82,4114,76,'DEE'),(83,4114,77,'DEE'),(84,4114,77,'염산'),(85,4114,78,'DEE'),(86,4114,78,'염산'),(87,4114,79,'DEE'),(88,4114,79,'염산'),(92,4283,81,'Stone Man'),(93,32009,82,'Stone Man'),(95,38882,84,'Stone Man'),(96,38881,85,'Stone Man'),(97,38885,86,'Stone Man'),(98,38884,87,'Stone Man'),(102,44812,90,'Transform'),(103,45792,NULL,'Transform'),(104,45792,91,'Transform'),(105,45800,92,'Transform'),(106,45804,93,'Transform'),(107,45796,94,'Transform'),(108,45794,95,'Transform'),(109,45799,96,'Transform'),(110,45803,97,'Transform'),(111,45810,98,'Transform'),(112,45809,99,'Transform'),(113,45793,100,'Transform');
/*!40000 ALTER TABLE `img_tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-22 16:35:57
