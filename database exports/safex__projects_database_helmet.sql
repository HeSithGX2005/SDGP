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
-- Table structure for table `helmet`
--

DROP TABLE IF EXISTS `helmet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helmet` (
  `Helmet_ID` int NOT NULL AUTO_INCREMENT,
  `Location` varchar(255) DEFAULT NULL,
  `Start_Time` datetime DEFAULT NULL,
  `End_Time` datetime DEFAULT NULL,
  `Total_Hours` int DEFAULT NULL,
  `Helmet_Unique_Code` varchar(255) DEFAULT NULL,
  `Company_ID` int DEFAULT NULL,
  PRIMARY KEY (`Helmet_ID`),
  UNIQUE KEY `Helmet_Unique_Code` (`Helmet_Unique_Code`),
  KEY `Company_ID` (`Company_ID`),
  CONSTRAINT `helmet_ibfk_1` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helmet`
--

LOCK TABLES `helmet` WRITE;
/*!40000 ALTER TABLE `helmet` DISABLE KEYS */;
INSERT INTO `helmet` VALUES (1,'Site A','2023-01-01 08:00:00','2023-01-01 16:00:00',8,'H001',1),(2,'Site B','2023-02-15 09:00:00','2023-02-15 17:00:00',8,'H002',2),(3,'Site C','2023-03-20 07:30:00','2023-03-20 15:30:00',8,'H003',3),(4,'Site D','2023-04-10 08:30:00','2023-04-10 16:30:00',8,'H004',4),(5,'Site E','2023-05-05 07:00:00','2023-05-05 15:00:00',8,'H005',5);
/*!40000 ALTER TABLE `helmet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-15 20:53:57
