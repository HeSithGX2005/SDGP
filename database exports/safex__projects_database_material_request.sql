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
-- Table structure for table `material_request`
--

DROP TABLE IF EXISTS `material_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_request` (
  `Request_ID` int NOT NULL AUTO_INCREMENT,
  `Quantity_Requested` int DEFAULT NULL,
  `Receiving_Date` date DEFAULT NULL,
  `Supervisor_Name` varchar(255) DEFAULT NULL,
  `Material_ID` int DEFAULT NULL,
  `Company_ID` int DEFAULT NULL,
  PRIMARY KEY (`Request_ID`),
  KEY `Material_ID` (`Material_ID`),
  KEY `Company_ID` (`Company_ID`),
  CONSTRAINT `material_request_ibfk_1` FOREIGN KEY (`Material_ID`) REFERENCES `materials` (`Material_ID`),
  CONSTRAINT `material_request_ibfk_2` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_request`
--

LOCK TABLES `material_request` WRITE;
/*!40000 ALTER TABLE `material_request` DISABLE KEYS */;
INSERT INTO `material_request` VALUES (1,50,'2023-01-05','Supervisor A',1,1),(2,1000,'2023-02-20','Supervisor B',2,2),(3,20,'2023-03-25','Supervisor C',3,3),(4,10,'2023-04-15','Supervisor D',4,4),(5,200,'2023-05-10','Supervisor E',5,5);
/*!40000 ALTER TABLE `material_request` ENABLE KEYS */;
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
