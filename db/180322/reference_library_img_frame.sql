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
-- Table structure for table `img_frame`
--

DROP TABLE IF EXISTS `img_frame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_frame` (
  `frame_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(500) DEFAULT NULL,
  `start_frame` varchar(100) DEFAULT NULL,
  `end_frame` varchar(100) DEFAULT NULL,
  `interval_time` varchar(100) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`frame_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img_frame`
--

LOCK TABLES `img_frame` WRITE;
/*!40000 ALTER TABLE `img_frame` DISABLE KEYS */;
INSERT INTO `img_frame` VALUES (3,'A.Better.Tomorrow.1986.DVDrip.XviD.AC3.5.1CH.CD2-WAF.avi','','','0,0',NULL),(4,'The.Matrix.1999.BluRay.720p.DTS.2Audio.x264-CHD.mkv','183250','183532','7635.4166666667,7647.1666666667',NULL),(5,'Palata Ball ref_7.mp4','0','4599','0,191.625',NULL),(6,'Palata Ball ref_8.mp4','0','6022','0,250.91666666667',NULL),(7,'퇴.마.령.2015.1080p.WEB-DL.x264.AAC-SeeHD.mov','0','2958','0,123.25',NULL),(8,'EMP Scene  The Fate of the Furious 2017 (4K UHD).mov','0','3315','0,138.125',NULL),(9,'폴란드 랜턴축제 - YouTube (360p).mp4','0','3006','0,125.25',NULL),(10,'Back.To.1942.2012.BluRay.03.제로센.폭격.mkv','0','2451','0,102.125',NULL),(11,'036-斗汤.mov','0','28426','0,1184.4166666667',NULL),(12,'롯데월드 레이저쇼.mp4','451','2715','18.791666666667,113.125',NULL),(13,'예천 백두대간예술제 led 레이저쇼.mp4','0','5529','0,230.375',NULL),(14,'가디언즈.10.mkv','411','1311','17.125,54.625',NULL),(15,'가디언즈.15.mkv','275','2130','11.458333333333,88.75',NULL),(16,'가디언즈.18.mkv','0','1311','0,54.625',NULL),(17,'가디언즈.18.mkv','32','159','1.3333333333333,6.625',NULL),(18,'가디언즈.1.mkv','0','707','0,29.458333333333',NULL),(19,'가디언즈.12.mkv','0','583','0,24.291666666667',NULL),(20,'가디언즈.14.mkv','0','258','0,10.75',NULL),(21,'가디언즈.13.mkv','0','232','0,9.6666666666667',NULL),(22,'가디언즈.16.mkv','0','425','0,17.708333333333',NULL),(23,'가디언즈.9.mkv','0','745','0,31.041666666667',NULL),(24,'가디언즈.17.mkv','0','523','0,21.791666666667',NULL),(25,'가디언즈.4..mkv','0','129','0,5.375',NULL),(26,'가디언즈.7.mkv','0','168','0,7',NULL),(27,'가디언즈.5.mkv','0','710','0,29.583333333333',NULL),(28,'가디언즈.3.mkv','0','1077','0,44.875',NULL),(29,'가디언즈.6.mkv','0','692','0,28.833333333333',NULL),(30,'가디언즈.2..mkv','0','501','0,20.875',NULL),(31,'가디언즈.8.mkv','0','1066','0,44.416666666667',NULL),(32,'가디언즈.11.mkv','0','551','0,22.958333333333',NULL),(33,'Palata Ball ref_1.mp4','0','196','0,8.1666666666667',NULL),(34,'Palata Ball ref_2.mp4','0','127','0,5.2916666666667',NULL),(35,'Palata Ball ref_3.mp4','0','1146','0,47.75',NULL),(36,'Palata Ball ref_4.mp4','0','229','0,9.5416666666667',NULL),(37,'Palata Ball ref_5.mp4','0','299','0,12.458333333333',NULL),(38,'Palata Ball ref_6.mp4','0','575','0,23.958333333333',NULL),(39,'Monitor ref_1.mp4','0','107','0,4.4583333333333',NULL),(40,'Monitor ref_10.mp4','0','916','0,38.166666666667',NULL),(41,'Monitor ref_2.mp4','0','393','0,16.375',NULL),(42,'Monitor ref_3.mp4','0','511','0,21.291666666667',NULL),(43,'Monitor ref_4.mp4','0','939','0,39.125',NULL),(44,'Monitor ref_5.mp4','0','419','0,17.458333333333',NULL),(45,'Monitor ref_6.mp4','0','1046','0,43.583333333333',NULL),(46,'Monitor ref_7.mp4','0','330','0,13.75',NULL),(47,'Monitor ref_8.mp4','0','252','0,10.5',NULL),(48,'Monitor ref_9.mp4','0','175','0,7.2916666666667',NULL),(49,'Being Human Season 3 (Fire Simulation, 사람 몸에 불).mp4','0','748','0,31.166666666667',NULL),(50,'Fire_flower_h.mov','0','1920','0,80',NULL),(51,'Spiderman.mp4','0','469','0,19.541666666667',NULL),(52,'Transformers.mp4','0','78','0,3.25',NULL),(53,'282326926.mov','0','15802','0,658.41666666667',NULL),(54,'Age Reduction VFX   2012 version (1080p).mp4','0','3020','0,125.83333333333',NULL),(55,'폭파ref.mov','0','1466','0,61.083333333333',NULL),(56,'세이프하우스_스타일.mov','0','1273','0,53.041666666667',NULL),(57,'파일_000.mp4','0','484','0,20.166666666667',NULL),(58,'2017 Motion Graphics Reel.mp4','0','2363','0,98.458333333333',NULL),(59,'Cyborg - Kara.mov','0','1795','0,74.791666666667',NULL),(60,'Glassworks 로봇여인 페이셜은 코스듐후 디지털과 섞어서 표현한 메이킹.mp4','0','4838','0,201.58333333333',NULL),(61,'Making of Kia Super Bowl Spot Hotbots-관절 미녀 인조인간 미래의 로봇컨셉 메이킹.mp4','0','903','0,37.625',NULL),(62,'VW Nutzfahrzeuge - Making of Zukunft 미래도시에 조수석 로봇.mp4','0','3424','0,142.66666666667',NULL),(63,'reference.mp4','0','2724','0,113.5',NULL),(64,'네팔지진 건물 붕괴 모습.mp4','0','3359','0,139.95833333333',NULL),(65,'미국 미네소타 가스폭발로 학교건물 붕괴…1명 사망   연합뉴스TV (YonhapnewsTV).mp4','0','774','0,32.25',NULL),(66,'순식간에 일어난 건물 붕괴.mp4','0','1651','0,68.791666666667',NULL),(67,'4년 전 아시아나항공 사고 당시  아찔한 상황  공개 (480p).mp4','0','2174','0,90.583333333333',NULL),(68,'무섭다! 카메라에 잡힌 끔찍한 비행기 추락 P2 (480p).mp4','0','15253','0,635.54166666667',NULL),(69,'영화역사상 가장 끔찍한 비행기 추락장면 (한글자막) - 영화 노잉중에서.mp4','0','3415','0,142.29166666667',NULL),(70,'아시아나(Asiana) 214 사고 복원 애니메이션.mp4','0','1529','0,63.708333333333',NULL),(71,'Avengers Reel.mp4','0','1210','0,50.416666666667',NULL),(73,'Pacific Rim 2013 720p WEB-DL x264 AC3-JYK.mkv','103754','103972','4323.0833333333,4332.1666666667',NULL),(75,'Prometheus.2012.1080p.BluRay.x264.DTS.3AUDIO-Zoom.mkv','92036','92308','3834.8333333333,3846.1666666667',NULL),(76,'Constantine.2005.BluRay.1080p.DTS.x264-CHD.mkv','8276','8895','344.83333333333,370.625',NULL),(77,'Constantine.2005.BluRay.1080p.DTS.x264-CHD.mkv','66298','66897','2762.4166666667,2787.375',NULL),(78,'Constantine.2005.BluRay.1080p.DTS.x264-CHD.mkv','104905','105117','4371.0416666667,4379.875',NULL),(79,'Constantine.2005.BluRay.1080p.DTS.x264-CHD.mkv','110414','111151','4600.5833333333,4631.2916666667',NULL),(81,'Thor.The.Dark.World.2013.1080p.BluRay.DTS-HD.MA.7.1.x264-PublicHD.mkv','11588','12324','482.83333333333,513.5',NULL),(82,'Guardians.of.the.Galaxy.2014.IMAX.1080p.BluRay.DTS.AAC.2XAUDIO.x264-KAGA.mkv','51962','52340','2165.0833333333,2180.8333333333',NULL),(84,'sandman.mp4_20180319_165128.mp4','0','3251','0,135.45833333333',NULL),(85,'Spider-Man 3- Birth of Sandman.mp4_20180319_165422.mp4','0','4056','0,169',NULL),(86,'Spider-Man 3- Sandman Transformation.mp4_20180319_165750.mp4','0','2295','0,95.625',NULL),(87,'stone man.mp4_20180319_165937.mp4','0','2342','0,97.583333333333',NULL),(89,'','0','','',NULL),(90,'20180214_140802.mp4','0','274','0,11.416666666667',NULL),(91,'Transformers.3.Dark.Of.The.Moon.2011_Transform_1.mp4','','391','0,16.291666666667',NULL),(92,'Transformers.3.Dark.Of.The.Moon.2011_Transform_10.mp4','','82','0,3.4166666666667',NULL),(93,'Transformers.3.Dark.Of.The.Moon.2011_Transform_11.mp4','','267','0,11.125',NULL),(94,'Transformers.3.Dark.Of.The.Moon.2011_Transform_12.mp4','','322','0,13.416666666667',NULL),(95,'Transformers.3.Dark.Of.The.Moon.2011_Transform_13.mp4','','274','0,11.416666666667',NULL),(96,'Transformers.3.Dark.Of.The.Moon.2011_Transform_14.mp4','','2473','0,103.04166666667',NULL),(97,'Transformers.3.Dark.Of.The.Moon.2011_Transform_15.mp4','','144','0,6',NULL),(98,'Transformers.3.Dark.Of.The.Moon.2011_Transform_16.mp4','','135','0,5.625',NULL),(99,'Transformers.3.Dark.Of.The.Moon.2011_Transform_17.mp4','','404','0,16.833333333333',NULL),(100,'Transformers.3.Dark.Of.The.Moon.2011_Transform_18.mp4','','242','0,10.083333333333',NULL);
/*!40000 ALTER TABLE `img_frame` ENABLE KEYS */;
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
