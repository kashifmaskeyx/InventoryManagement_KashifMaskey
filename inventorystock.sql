-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: inventory_db
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `supplier_id` int NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'Sugar',1,'',10,100.00,'2026-01-28 03:38:37',0),(4,'phone',1,'electronics',10,1000000.00,'2026-01-31 14:05:44',0),(5,'books',1,'stationary',100,400.00,'2026-01-31 14:17:50',0),(6,'pillow',1,'essentials',1,400.00,'2026-01-31 14:18:19',0),(7,'bottle',1,'appliances',10,1000.00,'2026-01-31 21:21:45',0),(8,'Coffee',2,'',10,50.00,'2026-01-31 22:12:52',0),(9,'sanitizer',1,'',2,200.00,'2026-02-01 04:26:55',0),(10,'oven',1,'appliances',5,50.00,'2026-02-01 09:50:27',0),(11,'lamp',1,'electronics',1,10.00,'2026-02-01 10:19:26',0),(12,'phone',3,'electronics',1,1000000.00,'2026-02-01 10:55:44',2),(13,'oven',4,'electronics',10,60000.00,'2026-02-01 10:58:23',2),(15,'purple haze',5,'tope',100,10000.00,'2026-02-01 11:05:17',5),(18,'Wheels',6,'Vehicle',10,50000.00,'2026-02-01 19:06:29',7),(19,'Cars',7,'Vehicle',2,1000000.00,'2026-02-01 19:06:55',7),(20,'Engine',7,'Automotive',1,70000.00,'2026-02-01 19:22:22',7),(21,'Brakes',7,'Automotive',10,50000.00,'2026-02-01 19:22:44',7),(22,'Bumpers',7,'Automotive',10,10000.00,'2026-02-01 19:23:17',7),(23,'Fenders',7,'Automotive',4,20000.00,'2026-02-01 19:23:45',7),(24,'Hoods',7,'Automotive',4,20000.00,'2026-02-01 19:24:04',7);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Sugar Sup','Sugar@example.com'),(2,'Coffee Sup','coffee@example.com'),(3,'phone supplier',NULL),(4,'electronic supplier',NULL),(5,'kashif maskey',NULL),(6,'bugatti',NULL),(7,'Kashif',NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@example.com','$2y$10$rIsciTY74U8tRk22/70eCeB4sxI1mpBoYRUKbKBAjllRtQIDzlqoq','2026-02-01 08:54:56'),(2,'kashifff','kashif2@gmail.com','$2y$10$26RNqZfWj62QU3Q9vfPEpOYmEWUrYCaNifOcr5gxIVuTBR5kCiBvm','2026-02-01 10:00:53'),(3,'Noob123','bnnnvv@gmail.com','$2y$10$qVvnprLQRlHIueBOJFDsTepCL3d.vA0Gr045MOmytDlOccW3xcbsq','2026-02-01 10:45:39'),(4,'abc','abc@gmail.com','$2y$10$WyUJUaSmKPUDYjiS/XPuuuLSOTzGSLcOucfHfaPLlIip0kn7jp4Hy','2026-02-01 10:48:30'),(5,'Mansi','mp123@gamil.com','$2y$10$.LEKzSNMHcGtxKwePRwao.mcIl3Qykx8XK5vLBmjtTvV1OQM/GQKO','2026-02-01 10:59:32'),(6,'aaa','aaa@gmail.com','$2y$10$srUTpnjOUh.gghMlbNZ1JeiQ3C/OGrLeLlJVxoVluLaM6squro0QS','2026-02-01 17:47:29'),(7,'kashif','kashif@gmal.com','$2y$10$LAclipCe5wwJ7evpF71uVu7Uy44b40uV7XgvQaXAz8V.nq9BmDyCa','2026-02-01 19:05:40');
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

-- Dump completed on 2026-02-02  1:17:17
