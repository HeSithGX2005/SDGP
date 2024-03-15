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
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `Employee_ID` int NOT NULL AUTO_INCREMENT,
  `Employee_Name` varchar(255) DEFAULT NULL,
  `Hourly_Rate` decimal(10,2) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Telephone_No` varchar(20) DEFAULT NULL,
  `Join_Date` datetime DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Helmet_ID` int DEFAULT NULL,
  `Company_ID` int DEFAULT NULL,
  PRIMARY KEY (`Employee_ID`),
  KEY `Helmet_ID` (`Helmet_ID`),
  KEY `Company_ID` (`Company_ID`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Helmet_ID`) REFERENCES `helmet` (`Helmet_ID`),
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Saman Perera',15.00,'Foreman','saman@example.com','0712345678','2023-01-01 00:00:00','saman_photo.jpg',1,1),(2,'Nimal Silva',12.50,'Laborer','nimal@example.com','0776543210','2023-02-15 00:00:00','nimal_photo.jpg',2,2),(3,'Kamal Fernando',14.00,'Engineer','kamal@example.com','0765432109','2023-03-20 00:00:00','kamal_photo.jpg',3,3),(4,'Sunil Rathnayake',13.00,'Carpenter','sunil@example.com','0754321098','2023-04-10 00:00:00','sunil_photo.jpg',4,4),(5,'Anil Bandara',11.50,'Welder','anil@example.com','0723456789','2023-05-05 00:00:00','anil_photo.jpg',5,5);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
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
