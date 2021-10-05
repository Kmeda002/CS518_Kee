-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: snoops_dev
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Current Database: `snoops_dev`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `snoops_dev` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `snoops_dev`;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `verified_email` smallint(6) NOT NULL,
  `admin_approved` tinyint(4) NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('kay','bangalore','kavya.meda1@gmail.com','$2y$10$F/hSSTDgYT7V5B0gZ66CQe1AuBghm6YwbYL1lWdrqqqabBFb2vXai',0,1,1),('John','Jack','keerrmeda@gmail.com','$2y$10$pa4WoQ2u/ZtTcjpWCIhKjubZjAQ3P0AS95hl6pXiDxexowL.9ycb6',0,-1,1),('Keer','Meda','kmeda002@odu.edu','$2y$10$b9TFz5WJx1A1/wXghzhZ6eRP0/I6DRZgWrF2.bIX/8ClMeLu41GVS',1,1,0),('sharu','Darsha','oraclereadernextdoor@gmail.com','$2y$10$4yMLRFTURsekmChKV2GP2O7leS6X8qh4kSS.ZszX8D0MlgFiy8orG',0,0,1),('Ravi Teja','Majeti','raviyyaahhoo@gmail.com','$2y$10$CExcNxofdi7eAyVokO7PNew6uQZ8e3N1NYmtNoffWE50FJIMkiZ6S',1,1,1),('soumya','leka','soumyaleka3@gmail.com','$2y$10$id7bfSM/7lCpKvk/sJ5g6.S3FPmtDrWFNMsYGrgmNNhgeWXKphvay',0,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-05 10:28:41
