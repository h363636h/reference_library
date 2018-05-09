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
-- Table structure for table `img_interval`
--

DROP TABLE IF EXISTS `img_interval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_interval` (
  `interval_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(500) DEFAULT NULL,
  `start_time` varchar(200) DEFAULT NULL,
  `end_time` varchar(200) DEFAULT NULL,
  `interval_time` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`interval_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img_interval`
--

LOCK TABLES `img_interval` WRITE;
/*!40000 ALTER TABLE `img_interval` DISABLE KEYS */;
INSERT INTO `img_interval` VALUES (19,'Tron.Legacy.2010.iNTERNAL.720p.BluRay.x264-MOOVEE.mkv','00:25:54','00:26:07','00:25:54~00:26:07'),(25,'your name 2016 hdrip 720p HC eng sub AAC x264.mp4','00:11:40','00:12:38','00:11:40~00:12:38'),(30,'The.Matrix.1999.BluRay.720p.DTS.2Audio.x264-CHD.mkv','02:07:13','02:07:28','02:07:13~02:07:28'),(81,'The.Amazing.Spider-Man.2012.1080p.BluRay.X264-AMIABLE.mkv','01:55:12','01:55:51','01:55:12~01:55:51'),(84,'The.Amazing.Spider-Man.2.2014.1080p.Mastered.In.4k.BluRay.AC3.x264-nelly45.mkv','00:53:20','00:53:35','00:53:20~00:53:35'),(86,'The.Amazing.Spider-Man.2.2014.1080p.Mastered.In.4k.BluRay.AC3.x264-nelly45.mkv','00:58:12','00:58:28','00:58:12~00:58:28'),(87,'Godzilla.2014.1080p.BluRay.x264.YIFY.mp4','00:35:14','00:35:30','00:35:14~00:35:30'),(91,'Godzilla.2014.1080p.BluRay.x264.YIFY.mp4','00:53:22','00:53:44','00:53:22~00:53:44'),(99,'Pacific Rim 2013 720p WEB-DL x264 AC3-JYK.mkv','01:13:49','01:14:34','01:13:49~01:14:34'),(112,'2.신세기 에반게리온 신극장판 파 2.0 (Neon Genesis Evangelion 破 2.0) You Can [Not] Advance .mkv','00:04:12','00:04:14','00:04:12~00:04:14'),(113,'2.신세기 에반게리온 신극장판 파 2.0 (Neon Genesis Evangelion 破 2.0) You Can [Not] Advance .mkv','00:33:10','00:33:19','00:33:10~00:33:19'),(114,'2.신세기 에반게리온 신극장판 파 2.0 (Neon Genesis Evangelion 破 2.0) You Can [Not] Advance .mkv','00:36:01','00:36:03','00:36:01~00:36:03'),(116,'Guardians.of.the.Galaxy.Vol.2.2017.1080p.HDrip.X264.AC3.MutzNutz.mkv','00:11:51','00:28:53','00:11:51~00:28:53'),(118,'Guardians.of.the.Galaxy.Vol.2.2017.1080p.HDrip.X264.AC3.MutzNutz.mkv','01:20:13','01:20:16','01:20:13~01:20:16'),(119,'토이 스토리1 Toy Story1 1995.x264.DTS.5AUDIO-WAF.mkv','00:00:00','00:00:00','00:00:00~00:00:00');
/*!40000 ALTER TABLE `img_interval` ENABLE KEYS */;
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
