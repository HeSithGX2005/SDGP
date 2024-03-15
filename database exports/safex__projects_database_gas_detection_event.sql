-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: safex__projects_database
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gas_detection_event`
--

DROP TABLE IF EXISTS `gas_detection_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gas_detection_event` (
  `Gas_Detection_Event_ID` int NOT NULL AUTO_INCREMENT,
  `Location` varchar(255) DEFAULT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Helmet_ID` int DEFAULT NULL,
  PRIMARY KEY (`Gas_Detection_Event_ID`),
  KEY `Helmet_ID` (`Helmet_ID`),
  CONSTRAINT `gas_detection_event_ibfk_1` FOREIGN KEY (`Helmet_ID`) REFERENCES `helmet` (`Helmet_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gas_detection_event`
--

LOCK TABLES `gas_detection_event` WRITE;
/*!40000 ALTER TABLE `gas_detection_event` DISABLE KEYS */;
INSERT INTO `gas_detection_event` VALUES (1,'Site A','2023-01-01 14:00:00','2023-01-01',1),(2,'Site B','2023-02-15 16:30:00','2023-02-15',2),(3,'Site C','2023-03-20 13:45:00','2023-03-20',3),(4,'Site D','2023-04-10 15:10:00','2023-04-10',4),(5,'Site E','2023-05-05 14:20:00','2023-05-05',5);
/*!40000 ALTER TABLE `gas_detection_event` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-15 20:53:58
