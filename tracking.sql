-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: output
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `alternatives`
--

DROP TABLE IF EXISTS `alternatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alternatives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `synonyms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatives`
--

LOCK TABLES `alternatives` WRITE;
/*!40000 ALTER TABLE `alternatives` DISABLE KEYS */;
INSERT INTO `alternatives` VALUES (1,'no comment',NULL,NULL),(2,'for consideration',NULL,NULL),(3,'for inclusion',NULL,NULL),(4,'requesting suggestions',NULL,NULL),(5,'for approval',NULL,NULL),(6,'approved for excecution',NULL,NULL),(7,'Dismissed and not to be followed through',NULL,NULL),(8,'Incomplete attachment',NULL,NULL),(9,'Attach Supplemental PPMP',NULL,NULL),(10,'For immediate action',NULL,NULL);
/*!40000 ALTER TABLE `alternatives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filetype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_user_id_foreign` (`user_id`),
  CONSTRAINT `attachments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (1,'FOR PR','ATT-2025-09-00001','FOR PR.xlsx','xlsx',1,NULL,'2025-09-09 14:07:05','2025-09-09 14:07:05');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'OFFICE OF THE REGIONAL DIRECTOR','ORD',NULL,NULL),(2,'FINANCE AND ADMINISTRATIVE DIVISION','FAD',NULL,NULL),(3,'CLEARANCE AND PERMITTING DIVISION','CPD',NULL,NULL),(4,'ENVIRONMENTAL MONITORING AND ENFORCEMENT DIVISION','EMED',NULL,NULL);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `added_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `members_purchase_request_id_foreign` (`purchase_request_id`),
  KEY `members_user_id_foreign` (`user_id`),
  KEY `members_added_by_foreign` (`added_by`),
  CONSTRAINT `members_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  CONSTRAINT `members_purchase_request_id_foreign` FOREIGN KEY (`purchase_request_id`) REFERENCES `purchase_requests` (`id`),
  CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,13,1,'admin',1,'2025-08-09 13:02:56','2025-08-09 13:02:56'),(2,14,1,'admin',1,'2025-08-09 13:09:11','2025-08-09 13:09:11'),(3,15,1,'admin',1,'2025-08-11 09:46:54','2025-08-11 09:46:54'),(4,16,1,'admin',1,'2025-08-12 09:14:53','2025-08-12 09:14:53'),(5,18,1,'admin',1,'2025-08-13 08:45:54','2025-08-13 08:45:54'),(6,19,1,'admin',1,'2025-08-13 09:05:13','2025-08-13 09:05:13'),(7,20,102,'admin',102,'2025-08-13 13:15:08','2025-08-13 13:15:08'),(8,21,102,'admin',102,'2025-08-13 13:15:22','2025-08-13 13:15:22'),(9,22,102,'admin',102,'2025-08-13 13:20:46','2025-08-13 13:20:46'),(10,16,102,'member',1,'2025-08-13 14:23:58','2025-08-13 14:23:58'),(11,20,1,'admin',102,'2025-08-13 14:55:20','2025-08-13 14:55:20'),(12,20,16,'member',1,'2025-08-13 15:18:07','2025-08-13 15:18:07'),(13,20,54,'member',102,'2025-08-13 16:24:53','2025-08-13 16:24:53'),(14,23,1,'admin',1,'2025-08-14 07:53:45','2025-08-14 07:53:45'),(15,24,1,'admin',1,'2025-08-14 07:54:06','2025-08-14 07:54:06'),(16,24,102,'admin',1,'2025-08-14 10:32:32','2025-08-14 10:32:32'),(17,24,103,'admin',1,'2025-08-14 11:55:13','2025-08-14 11:55:13'),(18,24,44,'member',1,'2025-08-14 13:06:57','2025-08-14 13:06:57'),(19,24,47,'member',1,'2025-08-14 13:07:22','2025-08-14 13:07:22'),(20,24,87,'member',1,'2025-08-14 13:07:54','2025-08-14 13:07:54'),(21,24,96,'member',1,'2025-08-14 13:13:59','2025-08-14 13:13:59'),(22,25,104,'admin',104,'2025-08-14 13:15:45','2025-08-14 13:15:45'),(23,25,1,'member',104,'2025-08-14 13:16:16','2025-08-14 13:16:16'),(24,25,103,'member',104,'2025-08-14 13:16:50','2025-08-14 13:16:50'),(25,25,105,'admin',1,'2025-08-15 07:45:21','2025-08-15 07:45:21'),(26,25,90,'member',1,'2025-08-15 08:08:19','2025-08-15 08:08:19'),(27,25,102,'admin',1,'2025-08-15 08:08:44','2025-08-15 08:08:44'),(28,25,6,'member',1,'2025-08-15 14:52:10','2025-08-15 14:52:10'),(29,26,106,'admin',106,'2025-08-20 10:46:36','2025-08-20 10:46:36'),(30,26,107,'admin',106,'2025-08-20 10:48:28','2025-08-20 10:48:28'),(31,27,1,'admin',1,'2025-08-28 07:23:19','2025-08-28 07:23:19'),(32,27,102,'admin',1,'2025-08-28 11:30:36','2025-08-28 11:30:36'),(33,27,103,'admin',1,'2025-08-28 11:35:29','2025-08-28 11:35:29'),(34,27,54,'member',1,'2025-08-28 11:44:57','2025-08-28 11:44:57'),(35,27,48,'member',1,'2025-08-28 11:47:05','2025-08-28 11:47:05'),(36,28,102,'admin',102,'2025-08-29 07:54:49','2025-08-29 07:54:49'),(37,28,1,'admin',102,'2025-08-29 08:09:03','2025-08-29 08:09:03'),(38,29,104,'admin',104,'2025-08-29 09:22:11','2025-08-29 09:22:11'),(39,30,1,'admin',1,'2025-09-02 11:26:14','2025-09-02 11:26:14');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_02_26_084909_create_divisions_table',1),(6,'2025_02_26_084926_create_sections_table',1),(7,'2025_03_12_134217_create_profiles_table',1),(8,'2025_03_12_161409_add_permission_column_to_users_table',1),(9,'2025_03_14_123728_create_positions_table',1),(10,'2025_07_25_143710_create_purchase_requests_table',1),(11,'2025_07_25_144151_create_p_r_signatories_table',1),(12,'2025_07_25_144928_add_bac_column_to_profiles_table',1),(13,'2025_07_31_070136_add_selector_column_to_password_resets_table',1),(14,'2025_07_31_070440_add_expires_at_column_to_password_resets_table',1),(15,'2025_08_06_110227_create_members_table',1),(16,'2025_08_06_110244_create_transactions_table',1),(17,'2025_08_06_110303_create_recepients_table',1),(18,'2025_08_06_145552_create_p_r_items_table',1),(19,'2025_08_14_072419_create_alternatives_table',2),(20,'2025_08_16_125401_create_units_table',3),(21,'2025_08_16_132351_add_unit_column_to_profiles_table',4),(22,'2025_08_29_111014_create_supplementaries_table',5),(23,'2025_09_09_130441_create_attachments_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_r_items`
--

DROP TABLE IF EXISTS `p_r_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `p_r_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint unsigned NOT NULL,
  `property_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_r_items_purchase_request_id_foreign` (`purchase_request_id`),
  CONSTRAINT `p_r_items_purchase_request_id_foreign` FOREIGN KEY (`purchase_request_id`) REFERENCES `purchase_requests` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_r_items`
--

LOCK TABLES `p_r_items` WRITE;
/*!40000 ALTER TABLE `p_r_items` DISABLE KEYS */;
INSERT INTO `p_r_items` VALUES (1,9,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:50:57','2025-08-09 12:50:57'),(2,10,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:51:13','2025-08-09 12:51:13'),(3,11,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:51:45','2025-08-09 12:51:45'),(4,12,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:52:11','2025-08-09 12:52:11'),(5,12,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:52:11','2025-08-09 12:52:11'),(6,12,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:52:11','2025-08-09 12:52:11'),(7,12,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:52:11','2025-08-09 12:52:11'),(8,12,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 12:52:11','2025-08-09 12:52:11'),(9,13,NULL,'BOX','BALLPEN','10','100','100','2025-08-09 13:02:56','2025-08-09 13:02:56'),(10,14,NULL,'BOX','TOYOTA','10','10','100','2025-08-09 13:09:11','2025-08-09 13:09:11'),(11,15,NULL,'BOX','BALL-BALL','10','100','100','2025-08-11 09:46:54','2025-08-11 09:46:54'),(12,16,NULL,'BOX','PEN','10','100','100','2025-08-12 09:14:53','2025-08-12 09:14:53'),(13,17,NULL,'BOX','SHOE LACE','10','120','120000','2025-08-13 08:45:19','2025-08-13 08:45:19'),(14,18,NULL,'BOX','SHOE LACE','10','120','120000','2025-08-13 08:45:54','2025-08-13 08:45:54'),(15,19,NULL,'BOX','SHOE TANGINA','10','100','1000','2025-08-13 09:05:13','2025-08-13 09:05:13'),(16,16,NULL,'BOX','BROOM','10','100','1000','2025-08-13 09:54:21','2025-08-13 09:54:21'),(17,16,NULL,'BOX','BROOM','10','100','1000','2025-08-13 09:54:38','2025-08-13 09:54:38'),(18,20,NULL,'BOX','BALLPEN','10','100','1000','2025-08-13 13:15:08','2025-08-13 13:15:08'),(19,21,NULL,'BOX','BALLPEN','10','100','1000','2025-08-13 13:15:22','2025-08-13 13:15:22'),(20,22,NULL,'BOX','BALLPEN','10','100','1000','2025-08-13 13:20:46','2025-08-13 13:20:46'),(21,23,NULL,'BOX','BALLPEN','10','100','100','2025-08-14 07:53:45','2025-08-14 07:53:45'),(22,24,NULL,'BOX','BALLPEN','10','100','100','2025-08-14 07:54:06','2025-08-14 07:54:06'),(23,25,NULL,'BOX','BROWN ENVELOPE','10','100','10000','2025-08-14 13:15:45','2025-08-14 13:15:45'),(24,25,NULL,'BOX','PHONE CASE','1','100','100','2025-08-14 14:38:49','2025-08-14 14:38:49'),(25,25,NULL,'BOX','BROWN ENVELOPE','10','100','1000','2025-08-15 14:05:02','2025-08-15 14:05:02'),(26,26,NULL,'BOX','BALLPEN','100','100','10000','2025-08-20 10:46:36','2025-08-20 10:46:36'),(27,27,NULL,'BOX','BOXING GLOVES','100','1000','100000','2025-08-28 07:23:19','2025-08-28 07:23:19'),(28,28,NULL,'BOX','PEN','10','100','1000','2025-08-29 07:54:49','2025-08-29 07:54:49'),(29,29,NULL,'BOX','ENVELOPE','100','25','2500','2025-08-29 09:22:11','2025-08-29 09:22:11'),(30,30,NULL,'METER','HANGER','10','100','1000','2025-09-02 11:26:14','2025-09-02 11:26:14');
/*!40000 ALTER TABLE `p_r_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_r_signatories`
--

DROP TABLE IF EXISTS `p_r_signatories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `p_r_signatories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint unsigned NOT NULL,
  `approver_id` bigint unsigned NOT NULL,
  `requester_id` bigint unsigned NOT NULL,
  `for_approver_id` bigint unsigned NOT NULL,
  `for_requester_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_r_signatories_purchase_request_id_foreign` (`purchase_request_id`),
  KEY `p_r_signatories_approver_id_foreign` (`approver_id`),
  KEY `p_r_signatories_requester_id_foreign` (`requester_id`),
  KEY `p_r_signatories_for_approver_id_foreign` (`for_approver_id`),
  KEY `p_r_signatories_for_requester_id_foreign` (`for_requester_id`),
  CONSTRAINT `p_r_signatories_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `p_r_signatories_for_approver_id_foreign` FOREIGN KEY (`for_approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `p_r_signatories_for_requester_id_foreign` FOREIGN KEY (`for_requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `p_r_signatories_purchase_request_id_foreign` FOREIGN KEY (`purchase_request_id`) REFERENCES `purchase_requests` (`id`),
  CONSTRAINT `p_r_signatories_requester_id_foreign` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_r_signatories`
--

LOCK TABLES `p_r_signatories` WRITE;
/*!40000 ALTER TABLE `p_r_signatories` DISABLE KEYS */;
/*!40000 ALTER TABLE `p_r_signatories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `selector` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',1,'web-app-token','0a74043c7997eeb102965e4ff2c262e445aaaddeeae11fe846e47e25a0df91b0','[\"*\"]','2025-08-09 13:39:30',NULL,'2025-08-09 12:33:22','2025-08-09 13:39:30'),(2,'App\\Models\\User',1,'web-app-token','34ab5e7ec9e846410c84add249985a358226ab33b16e5d96cff787ab075d5bbc','[\"*\"]','2025-08-11 10:03:22',NULL,'2025-08-11 09:46:10','2025-08-11 10:03:22'),(6,'App\\Models\\User',1,'web-app-token','98bf35827160969566aafb2c200b260569da672a830c80f078e06387e89e51e2','[\"*\"]','2025-08-12 14:44:18',NULL,'2025-08-12 13:52:04','2025-08-12 14:44:18'),(9,'App\\Models\\User',1,'web-app-token','76a18f67dc9fe7d69c6413e19579b8a6cc1cd86804868c398c2651a71d631f86','[\"*\"]','2025-08-13 11:48:39',NULL,'2025-08-13 10:45:38','2025-08-13 11:48:39'),(15,'App\\Models\\User',102,'web-app-token','0dc501ccb9baac1feffa05074bd8b70818880e25d39dc9d559b55b913c28987e','[\"*\"]','2025-08-13 16:26:51',NULL,'2025-08-13 15:39:33','2025-08-13 16:26:51'),(29,'App\\Models\\User',1,'web-app-token','1ee68e39bbf027b7bb07cb85655e79ca7eef3e4f7f2a22f66205392e044cca79','[\"*\"]','2025-08-14 15:10:21',NULL,'2025-08-14 14:24:57','2025-08-14 15:10:21'),(35,'App\\Models\\User',1,'web-app-token','645f041ccc5f5cfa1d5bc12eab72f9d36e209e3352cf98ed601e673e94b8febd','[\"*\"]','2025-08-15 08:44:50',NULL,'2025-08-15 08:15:27','2025-08-15 08:44:50'),(37,'App\\Models\\User',1,'web-app-token','91b4081f19854fe370178c8df8e72860c99caf2a19c52014c49d01d0130f7830','[\"*\"]','2025-08-15 14:58:35',NULL,'2025-08-15 13:14:50','2025-08-15 14:58:35'),(40,'App\\Models\\User',1,'web-app-token','88db795776fcebe70356dad12a903e28b8f6ac3595902a167884e26edbb5a162','[\"*\"]','2025-08-16 13:58:32',NULL,'2025-08-16 13:34:33','2025-08-16 13:58:32'),(45,'App\\Models\\User',1,'web-app-token','996b984bfb7351a45d89296dcb812044378e70d3dc165ec263b5092ec3c7fb3f','[\"*\"]','2025-08-18 15:38:45',NULL,'2025-08-18 15:12:08','2025-08-18 15:38:45'),(51,'App\\Models\\User',106,'web-app-token','29c55f03de4f93bcc3428d81991d23e60ba1b742f4c265abec620fc3adf7865b','[\"*\"]','2025-08-20 12:17:15',NULL,'2025-08-20 10:50:06','2025-08-20 12:17:15'),(78,'App\\Models\\User',106,'web-app-token','5cb33c2b536b78dc758ea25a02045a376134b3e5815f63f9670e3660b15cead2','[\"*\"]','2025-08-27 14:53:59',NULL,'2025-08-27 13:14:33','2025-08-27 14:53:59'),(90,'App\\Models\\User',106,'web-app-token','a9ecf8849db1b4b82a6d3bee6d02d3bb012625dd32e7072d33cee48464e31e9a','[\"*\"]','2025-08-28 14:50:35',NULL,'2025-08-28 13:27:54','2025-08-28 14:50:35'),(108,'App\\Models\\User',1,'web-app-token','2e10d40df65d793352cc594252d8c342ec356df5375705c358fc29de7f74acf8','[\"*\"]','2025-08-29 14:21:47',NULL,'2025-08-29 13:22:10','2025-08-29 14:21:47'),(109,'App\\Models\\User',1,'web-app-token','3c31d6c642e5fc4a4ca5213771c756278a1ea5da4fa3ee0a7fdf8cee27b6bf9c','[\"*\"]',NULL,NULL,'2025-09-01 07:28:07','2025-09-01 07:28:07'),(111,'App\\Models\\User',1,'web-app-token','e4cc1c6292298107908de932a9f4442f03a1a7c0447b40dbb97d63322b3c9bb0','[\"*\"]','2025-09-01 14:07:07',NULL,'2025-09-01 12:59:57','2025-09-01 14:07:07'),(126,'App\\Models\\User',106,'web-app-token','ec92d55da335357551a022686593e23dc2bd8b5147983b361d0aae17ccc4b96c','[\"*\"]','2025-09-02 14:42:33',NULL,'2025-09-02 13:08:40','2025-09-02 14:42:33'),(133,'App\\Models\\User',106,'web-app-token','71925837330f86a522f8e854077faaacc372c4926964037b2d773bdf208f17e7','[\"*\"]','2025-09-03 14:37:46',NULL,'2025-09-03 13:38:26','2025-09-03 14:37:46'),(135,'App\\Models\\User',106,'web-app-token','eefd7eb23f4a10146d2065bed96157f754f9315946b8592a2f2849fbcefe5baf','[\"*\"]','2025-09-04 07:17:27',NULL,'2025-09-04 06:34:10','2025-09-04 07:17:27'),(136,'App\\Models\\User',106,'web-app-token','3002dc937f5cebedbac7cb36f2500145bba5722bcf3f51203b2d854137908875','[\"*\"]','2025-09-04 10:28:51',NULL,'2025-09-04 08:41:47','2025-09-04 10:28:51'),(138,'App\\Models\\User',106,'web-app-token','91a286b07c15aa9467d19ec7dd3de21f31b3a11b39b2d81fa27645be849b82f1','[\"*\"]','2025-09-04 14:36:11',NULL,'2025-09-04 14:34:25','2025-09-04 14:36:11'),(139,'App\\Models\\User',106,'web-app-token','2fd06d86f33463caecf08515440bead39130de5c5fadbc51a97006278a5bd4b2','[\"*\"]','2025-09-05 09:46:48',NULL,'2025-09-05 08:40:28','2025-09-05 09:46:48'),(141,'App\\Models\\User',106,'web-app-token','ebb98e67a488f348a4b5ffae6a5069e9143c3ed27a2809bfb33439192150fad2','[\"*\"]','2025-09-05 14:43:27',NULL,'2025-09-05 14:00:04','2025-09-05 14:43:27'),(142,'App\\Models\\User',106,'web-app-token','ddb0d9265955ec0bf0b8210c3b22a87691763e7e3d0eac7e0b1e2077d0a060fe','[\"*\"]',NULL,NULL,'2025-09-09 06:31:53','2025-09-09 06:31:53'),(143,'App\\Models\\User',106,'web-app-token','8545fa46eaf5144e6b32cfc8bb45ad923eb2062e23d6aeb171c0c5f2504529aa','[\"*\"]',NULL,NULL,'2025-09-09 06:31:56','2025-09-09 06:31:56'),(150,'App\\Models\\User',1,'web-app-token','df79599d476202518436b90385376f296eec334b68e42c5cbb5f1d7cdf4e05f2','[\"*\"]','2025-09-09 14:07:05',NULL,'2025-09-09 12:26:18','2025-09-09 14:07:05');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pr_supplemental`
--

DROP TABLE IF EXISTS `pr_supplemental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pr_supplemental` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplemental_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_request_id` bigint unsigned NOT NULL,
  `transaction_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pr_supplemental_purchase_request_id_foreign` (`purchase_request_id`),
  KEY `pr_supplemental_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `pr_supplemental_purchase_request_id_foreign` FOREIGN KEY (`purchase_request_id`) REFERENCES `purchase_requests` (`id`),
  CONSTRAINT `pr_supplemental_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pr_supplemental`
--

LOCK TABLES `pr_supplemental` WRITE;
/*!40000 ALTER TABLE `pr_supplemental` DISABLE KEYS */;
INSERT INTO `pr_supplemental` VALUES (6,'174',19,101,NULL,NULL),(7,'175',19,101,NULL,NULL),(8,'178',19,101,NULL,NULL),(9,'174',19,103,NULL,NULL);
/*!40000 ALTER TABLE `pr_supplemental` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_images`
--

DROP TABLE IF EXISTS `profile_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_images_user_id_foreign` (`user_id`),
  CONSTRAINT `profile_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_images`
--

LOCK TABLES `profile_images` WRITE;
/*!40000 ALTER TABLE `profile_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waived',
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_id` int DEFAULT NULL,
  `section_id` int DEFAULT NULL,
  `unit_id` bigint unsigned DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bac` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `inspector` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,1,'Marco','waived','Pantonial',NULL,1,3,NULL,'Computer Programmer II','active',NULL,'2025-08-22 08:29:42','0','0'),(2,81,'Maritza','waived','Bechtelar',NULL,3,11,NULL,'Refrigeration Mechanic','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(3,46,'Lyric','waived','Lehner',NULL,1,2,NULL,'Sculptor','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(4,72,'Lucy','waived','Parker',NULL,3,13,NULL,'Choreographer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(5,27,'Cheyenne','waived','Bins',NULL,1,1,NULL,'Set and Exhibit Designer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(6,91,'Kennedi','waived','Kuvalis',NULL,2,10,NULL,'Radiologic Technologist and Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(7,74,'Anika','waived','Walsh',NULL,2,10,NULL,'Parts Salesperson','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(8,14,'Philip','waived','Predovic',NULL,4,14,NULL,'Sheet Metal Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(9,67,'Morris','waived','Gottlieb',NULL,2,10,NULL,'Nuclear Equipment Operation Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(10,82,'Aryanna','waived','Kilback',NULL,2,10,NULL,'Marketing VP','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(11,61,'Hortense','waived','Monahan',NULL,2,9,NULL,'Medical Secretary','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(12,16,'Joel','waived','Davis',NULL,1,3,NULL,'Range Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(13,2,'Abdul','waived','Schoen',NULL,1,7,NULL,'Visual Designer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(14,3,'Rowan','waived','Parker',NULL,1,6,NULL,'Musical Instrument Tuner','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(15,21,'Dixie','waived','Walker',NULL,1,1,NULL,'Life Scientists','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(16,64,'Morgan','waived','Ebert',NULL,4,14,NULL,'Cutting Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(17,73,'Jarod','waived','Witting',NULL,1,2,NULL,'Automatic Teller Machine Servicer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(18,29,'Lois','waived','Bosco',NULL,3,13,NULL,'Power Distributors OR Dispatcher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(19,76,'Hayley','waived','Hodkiewicz',NULL,4,17,NULL,'Talent Acquisition Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(20,13,'Julian','waived','Windler',NULL,3,11,NULL,'Bellhop','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(21,89,'Keegan','waived','Stehr',NULL,3,11,NULL,'Coaches and Scout','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(22,28,'Pablo','waived','Walter',NULL,2,9,NULL,'Travel Guide','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(23,4,'Anibal','waived','Heidenreich',NULL,2,9,NULL,'City','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(24,12,'Vanessa','waived','Braun',NULL,3,11,NULL,'Mathematician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(25,53,'Leland','waived','Wilderman',NULL,4,16,NULL,'Curator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(26,49,'Cristal','waived','Buckridge',NULL,4,14,NULL,'Cabinetmaker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(27,96,'Shannon','waived','Reinger',NULL,2,9,NULL,'Plumber','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(28,31,'Kraig','waived','Ortiz',NULL,4,14,NULL,'Court Reporter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(29,44,'Eryn','waived','Gibson',NULL,3,13,NULL,'Structural Metal Fabricator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(30,26,'Mustafa','waived','McCullough',NULL,1,7,NULL,'Refractory Materials Repairer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(31,85,'Carlos','waived','Frami',NULL,2,9,NULL,'Electrical and Electronic Inspector and Tester','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(32,15,'Mozell','waived','Rolfson',NULL,1,8,NULL,'Product Promoter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(33,55,'Monroe','waived','Streich',NULL,4,16,NULL,'Manager of Weapons Specialists','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(34,70,'Luther','waived','Okuneva',NULL,3,13,NULL,'Furnace Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(35,65,'Trent','waived','Osinski',NULL,4,14,NULL,'Bindery Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(36,29,'Katarina','waived','Boehm',NULL,3,12,NULL,'Credit Checker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(37,44,'Emily','waived','Heaney',NULL,2,9,NULL,'Multi-Media Artist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(38,21,'Chaya','waived','Bradtke',NULL,4,14,NULL,'Tire Changer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(39,35,'Laron','waived','Skiles',NULL,2,10,NULL,'Logistician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(40,55,'Alberta','waived','Johnston',NULL,1,2,NULL,'Loan Officer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(41,48,'Luciano','waived','Bradtke',NULL,3,12,NULL,'Manufactured Building Installer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(42,42,'Candice','waived','Smith',NULL,2,10,NULL,'Heating and Air Conditioning Mechanic','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(43,6,'Jammie','waived','Hessel',NULL,1,2,NULL,'Human Resources Assistant','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(44,85,'Caitlyn','waived','O\'Connell',NULL,1,4,NULL,'Political Science Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(45,39,'Piper','waived','Treutel',NULL,2,10,NULL,'Umpire and Referee','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(46,73,'Claude','waived','McDermott',NULL,4,14,NULL,'Office Machine and Cash Register Servicer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(47,13,'Jaycee','waived','Volkman',NULL,1,3,NULL,'Brattice Builder','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(48,53,'Brielle','waived','Armstrong',NULL,2,10,NULL,'Postal Service Mail Sorter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(49,87,'Jada','waived','Hammes',NULL,1,3,NULL,'Postsecondary Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(50,53,'Karen','waived','Bins',NULL,4,15,NULL,'Mathematician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(51,67,'Dane','waived','Kiehn',NULL,1,8,NULL,'Corporate Trainer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(52,55,'Pete','waived','Kuhlman',NULL,2,9,NULL,'Spotters','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(53,67,'Marques','waived','Rau',NULL,4,15,NULL,'Interpreter OR Translator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(54,100,'Lincoln','waived','Hartmann',NULL,3,13,NULL,'Reporters OR Correspondent','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(55,59,'Bethel','waived','Marvin',NULL,2,9,NULL,'Precision Devices Inspector','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(56,65,'Aiden','waived','Ritchie',NULL,2,10,NULL,'Directory Assistance Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(57,61,'Ahmed','waived','Reynolds',NULL,4,14,NULL,'Paste-Up Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(58,38,'Octavia','waived','Koch',NULL,4,16,NULL,'Garment','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(59,80,'Duncan','waived','Bergnaum',NULL,2,9,NULL,'Logging Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(60,98,'Rosetta','waived','Wolff',NULL,3,12,NULL,'Agricultural Inspector','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(61,50,'Ford','waived','Hane',NULL,3,11,NULL,'Radiologic Technologist and Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(62,72,'Mark','waived','Mueller',NULL,1,6,NULL,'Credit Checkers Clerk','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(63,93,'Jazmin','waived','Mertz',NULL,1,8,NULL,'Elevator Installer and Repairer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(64,89,'Piper','waived','Pfeffer',NULL,2,9,NULL,'Director Of Business Development','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(65,85,'Casper','waived','Olson',NULL,4,16,NULL,'Actuary','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(66,80,'Alvina','waived','Mraz',NULL,2,10,NULL,'Corporate Trainer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(67,40,'Lori','waived','Weimann',NULL,4,16,NULL,'Chemical Engineer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(68,32,'Bryce','waived','Torphy',NULL,2,10,NULL,'Roof Bolters Mining','active','2025-08-09 12:32:46','2025-08-13 13:09:02','0','0'),(69,5,'Laurie','waived','Osinski',NULL,3,12,NULL,'Hand Presser','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(70,64,'Lyric','waived','Ondricka',NULL,4,15,NULL,'Waitress','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(71,74,'Catharine','waived','Hayes',NULL,4,14,NULL,'Rental Clerk','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(72,67,'Emelie','waived','Upton',NULL,2,10,NULL,'Teller','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(73,17,'Perry','waived','Abernathy',NULL,3,13,NULL,'Business Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(74,67,'Laverne','waived','Dare',NULL,2,10,NULL,'Social Work Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(75,23,'Hilda','waived','Gottlieb',NULL,4,15,NULL,'Soil Scientist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(76,9,'Jasmin','waived','Vandervort',NULL,3,12,NULL,'Electrician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(77,37,'Ettie','waived','Bernhard',NULL,2,10,NULL,'General Practitioner','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(78,31,'Jennings','waived','Heaney',NULL,1,5,NULL,'Electric Motor Repairer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(79,98,'Bernadette','waived','Erdman',NULL,4,14,NULL,'Animal Control Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(80,34,'Noemi','waived','Stehr',NULL,4,16,NULL,'Food Service Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(81,13,'Marian','waived','Quitzon',NULL,3,11,NULL,'Insurance Claims Clerk','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(82,94,'Jennie','waived','Pouros',NULL,2,10,NULL,'Forester','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(83,62,'Cassidy','waived','Murray',NULL,4,16,NULL,'Philosophy and Religion Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(84,93,'Hellen','waived','Romaguera',NULL,2,10,NULL,'Engineer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(85,88,'Darren','waived','Reichel',NULL,1,6,NULL,'Welder and Cutter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(86,6,'Nasir','waived','Konopelski',NULL,2,10,NULL,'Occupational Therapist Assistant','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(87,20,'Madilyn','waived','McClure',NULL,3,13,NULL,'Woodworking Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(88,71,'Dewitt','waived','Grady',NULL,3,13,NULL,'Nursing Aide','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(89,67,'Sonia','waived','Ryan',NULL,3,13,NULL,'Correctional Officer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(90,47,'Jeffery','waived','Gleason',NULL,3,11,NULL,'Horticultural Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(91,37,'Cyrus','waived','Hintz',NULL,4,16,NULL,'Segmental Paver','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(92,84,'Danyka','waived','Kertzmann',NULL,3,11,NULL,'Annealing Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(93,77,'Annamarie','waived','Toy',NULL,1,8,NULL,'Assessor','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(94,12,'Jaiden','waived','Orn',NULL,4,15,NULL,'Fence Erector','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(95,79,'Viva','waived','Blick',NULL,4,14,NULL,'Medical Transcriptionist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(96,30,'Maryam','waived','Schimmel',NULL,2,9,NULL,'Film Laboratory Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(97,4,'Jamir','waived','Lesch',NULL,3,11,NULL,'Administrative Support Supervisors','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(98,95,'Cortez','waived','Schuster',NULL,4,14,NULL,'Production Planning','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(99,71,'Eulalia','waived','Marquardt',NULL,3,12,NULL,'Textile Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(100,35,'Melissa','waived','Kuphal',NULL,2,10,NULL,'Nursing Aide','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(101,95,'Jewell','waived','Parker',NULL,2,10,NULL,'Precision Lens Grinders and Polisher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(102,7,'Wiley','waived','Fisher',NULL,1,5,NULL,'Coating Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(103,91,'Isobel','waived','Koch',NULL,1,4,NULL,'Railroad Yard Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(104,76,'Noel','waived','Weissnat',NULL,3,11,NULL,'Biochemist or Biophysicist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(105,84,'Tamia','waived','Gibson',NULL,1,8,NULL,'Heating Equipment Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(106,91,'Zelda','waived','Emmerich',NULL,1,7,NULL,'Materials Inspector','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(107,50,'Raymundo','waived','Lueilwitz',NULL,1,8,NULL,'Director Of Marketing','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(108,59,'Orville','waived','Pfeffer',NULL,4,15,NULL,'Industrial-Organizational Psychologist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(109,80,'Julianne','waived','Koss',NULL,2,9,NULL,'Agricultural Sales Representative','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(110,90,'Cassie','waived','Jacobson',NULL,3,12,NULL,'Gaming Cage Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(111,7,'Crystel','waived','McDermott',NULL,3,12,NULL,'Central Office and PBX Installers','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(112,89,'Johnny','waived','Gerhold',NULL,3,12,NULL,'Industrial Engineering Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(113,94,'Maeve','waived','Blick',NULL,3,13,NULL,'Broadcast News Analyst','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(114,54,'Josiah','waived','Schaefer',NULL,2,9,NULL,'Plumber OR Pipefitter OR Steamfitter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(115,44,'Fredrick','waived','Kuvalis',NULL,2,10,NULL,'Septic Tank Servicer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(116,10,'Darius','waived','Ritchie',NULL,2,10,NULL,'Archivist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(117,90,'Zack','waived','Runolfsdottir',NULL,2,10,NULL,'Woodworking Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(118,60,'Cleveland','waived','Wunsch',NULL,4,15,NULL,'Precision Dyer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(119,52,'Maritza','waived','Cummerata',NULL,1,2,NULL,'Automotive Mechanic','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(120,58,'Dayana','waived','Thiel',NULL,3,12,NULL,'CSI','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(121,17,'Madelyn','waived','Dare',NULL,4,15,NULL,'Human Resource Director','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(122,82,'Zella','waived','Lehner',NULL,2,9,NULL,'Movers','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(123,34,'Joelle','waived','Feest',NULL,2,10,NULL,'Plant and System Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(124,41,'Aryanna','waived','Ryan',NULL,3,13,NULL,'Sheriff','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(125,28,'Chaz','waived','Schamberger',NULL,1,8,NULL,'Waiter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(126,12,'Gordon','waived','Roob',NULL,1,8,NULL,'Chemical Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(127,73,'Helena','waived','Smitham',NULL,2,10,NULL,'Mechanical Drafter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(128,66,'Carmelo','waived','Erdman',NULL,4,14,NULL,'Tool Sharpener','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(129,62,'Celine','waived','Gottlieb',NULL,3,11,NULL,'Farmworker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(130,58,'Rosalee','waived','Hettinger',NULL,2,10,NULL,'Statistical Assistant','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(131,51,'Zoie','waived','Rohan',NULL,4,14,NULL,'Social Work Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(132,44,'Ruby','waived','Fritsch',NULL,4,15,NULL,'Computer-Controlled Machine Tool Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(133,54,'Justyn','waived','Denesik',NULL,2,9,NULL,'Order Clerk','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(134,44,'Dexter','waived','Mante',NULL,2,10,NULL,'Industrial Equipment Maintenance','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(135,80,'Kaela','waived','Reynolds',NULL,3,13,NULL,'Locker Room Attendant','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(136,10,'Hazel','waived','Moen',NULL,1,8,NULL,'Loan Interviewer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(137,43,'Annette','waived','Pagac',NULL,1,4,NULL,'Human Resource Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(138,60,'Dessie','waived','Hettinger',NULL,3,13,NULL,'Title Searcher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(139,13,'Kelly','waived','Senger',NULL,4,14,NULL,'Human Resource Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(140,100,'Jasper','waived','Monahan',NULL,4,14,NULL,'Textile Dyeing Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(141,62,'Melany','waived','Bashirian',NULL,1,4,NULL,'Forming Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(142,93,'Eva','waived','Zboncak',NULL,2,10,NULL,'Production Control Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(143,87,'Kiana','waived','Barton',NULL,2,9,NULL,'Fashion Designer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(144,94,'Emilia','waived','Kerluke',NULL,3,11,NULL,'Mine Cutting Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(145,83,'Harry','waived','Baumbach',NULL,1,5,NULL,'Grips','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(146,101,'Maia','waived','Hammes',NULL,3,12,NULL,'Cutting Machine Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(147,46,'Ceasar','waived','Rosenbaum',NULL,4,17,NULL,'Calibration Technician OR Instrumentation Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(148,38,'Octavia','waived','Balistreri',NULL,3,11,NULL,'Gas Processing Plant Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(149,47,'Alex','waived','Rutherford',NULL,2,9,NULL,'Market Research Analyst','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(150,58,'Jeffry','waived','Tremblay',NULL,1,5,NULL,'Hand Sewer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(151,53,'Conrad','waived','Ledner',NULL,2,10,NULL,'Human Resource Manager','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(152,23,'Orlo','waived','Medhurst',NULL,2,10,NULL,'Maintenance Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(153,80,'Rusty','waived','Collier',NULL,1,3,NULL,'Psychologist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(154,82,'Estefania','waived','Flatley',NULL,3,11,NULL,'Welder-Fitter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(155,60,'Audra','waived','Kshlerin',NULL,2,9,NULL,'Building Cleaning Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(156,79,'Margret','waived','Klocko',NULL,1,5,NULL,'Ship Mates','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(157,82,'Marge','waived','Heathcote',NULL,2,9,NULL,'Administrative Support Supervisors','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(158,4,'Pierce','waived','Schneider',NULL,4,15,NULL,'Production Planner','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(159,16,'Michel','waived','Weimann',NULL,3,12,NULL,'Valve Repairer OR Regulator Repairer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(160,98,'Tyler','waived','Larson',NULL,1,2,NULL,'Protective Service Worker','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(161,29,'Mya','waived','Keeling',NULL,1,4,NULL,'Utility Meter Reader','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(162,10,'Fabiola','waived','Braun',NULL,1,5,NULL,'Fire Fighter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(163,64,'Jan','waived','Wehner',NULL,4,17,NULL,'Night Shift','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(164,16,'Amelia','waived','Senger',NULL,1,5,NULL,'Archivist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(165,43,'Elbert','waived','Metz',NULL,4,17,NULL,'Solderer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(166,12,'Herta','waived','Johns',NULL,3,12,NULL,'Weapons Specialists','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(167,75,'Rosemary','waived','Thompson',NULL,2,9,NULL,'Rock Splitter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(168,101,'Montana','waived','Trantow',NULL,4,17,NULL,'Musician OR Singer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(169,81,'Jaron','waived','Jakubowski',NULL,2,9,NULL,'Manager of Weapons Specialists','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(170,6,'Adriel','waived','Wintheiser',NULL,4,17,NULL,'Tire Builder','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(171,7,'Joelle','waived','Hansen',NULL,2,9,NULL,'Recordkeeping Clerk','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(172,28,'Donny','waived','Wisoky',NULL,1,2,NULL,'Audio and Video Equipment Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(173,50,'Clovis','waived','Hickle',NULL,4,16,NULL,'Geography Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(174,55,'Tomasa','waived','Stokes',NULL,4,17,NULL,'Pharmaceutical Sales Representative','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(175,74,'Daryl','waived','Swift',NULL,4,15,NULL,'Electrical Engineering Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(176,6,'Elise','waived','Haley',NULL,2,10,NULL,'Night Security Guard','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(177,37,'Mary','waived','Marks',NULL,1,8,NULL,'Food Scientists and Technologist','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(178,11,'Ramon','waived','Feil',NULL,1,2,NULL,'Aircraft Cargo Handling Supervisor','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(179,21,'Lessie','waived','Bernhard',NULL,2,9,NULL,'Special Forces Officer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(180,32,'Bryce','waived','Torphy',NULL,2,10,NULL,'Roof Bolters Mining','active','2025-08-09 12:32:46','2025-08-13 13:09:02','0','0'),(181,35,'William','waived','Beatty',NULL,1,4,NULL,'Transportation and Material-Moving','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(182,84,'Ophelia','waived','Blanda',NULL,3,12,NULL,'Aircraft Launch and Recovery Officer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(183,67,'Amira','waived','Kemmer',NULL,3,13,NULL,'Structural Metal Fabricator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(184,76,'Ramiro','waived','Hettinger',NULL,2,10,NULL,'Home Appliance Installer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(185,22,'Emilio','waived','Heidenreich',NULL,2,10,NULL,'Medical Sales Representative','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(186,51,'Karson','waived','Mayert',NULL,2,9,NULL,'Brazer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(187,77,'Rose','waived','McGlynn',NULL,2,10,NULL,'Clergy','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(188,19,'Kylee','waived','Bergnaum',NULL,3,13,NULL,'Agricultural Inspector','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(189,100,'Emmett','waived','Klocko',NULL,4,14,NULL,'Environmental Engineer','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(190,41,'Melyna','waived','Gleichner',NULL,2,10,NULL,'Agricultural Product Grader Sorter','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(191,20,'Elmer','waived','Carter',NULL,3,11,NULL,'Sailor','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(192,10,'Addie','waived','Littel',NULL,1,2,NULL,'Cultural Studies Teacher','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(193,97,'Fatima','waived','Predovic',NULL,1,4,NULL,'Pharmaceutical Sales Representative','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(194,47,'Marlene','waived','Schuppe',NULL,3,13,NULL,'Restaurant Cook','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(195,55,'Matteo','waived','Botsford',NULL,4,14,NULL,'Paving Equipment Operator','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(196,48,'Camylle','waived','Nicolas',NULL,4,14,NULL,'Real Estate Appraiser','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(197,13,'Wanda','waived','Shanahan',NULL,3,13,NULL,'Production Planner','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(198,13,'Nasir','waived','Donnelly',NULL,3,11,NULL,'Medical Records Technician','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(199,59,'Ashly','waived','Crist',NULL,2,9,NULL,'Production Planning','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(200,58,'Lorna','waived','Prosacco',NULL,1,4,NULL,'Sailor','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(201,96,'Ricky','waived','O\'Conner',NULL,1,1,NULL,'Separating Machine Operators','active','2025-08-09 12:32:46','2025-08-09 12:32:46','0','0'),(202,102,'Vincent','waived','Morastil',NULL,1,3,NULL,'Sixty-nine','active','2025-08-13 13:12:30','2025-08-13 13:12:30','0','0'),(203,103,'Bryan','waived','Cabacaba',NULL,1,3,NULL,'Computer Maintenance Technologist','active','2025-08-14 11:54:51','2025-08-14 11:54:51','0','0'),(204,104,'Mary Joyce','waived','Maceda',NULL,2,9,NULL,'Bookeeper','active','2025-08-14 12:03:28','2025-08-14 14:39:46','0','0'),(205,105,'Lika','waived','Mejido',NULL,2,9,NULL,'Accountant X','active','2025-08-15 07:42:42','2025-08-15 07:42:42','0','0'),(206,106,'Cedrick','waived','Terrado',NULL,2,10,1,'Supply Staff','active','2025-08-16 12:27:02','2025-08-16 12:41:35','0','0'),(207,107,'Juvy','waived','Pinson',NULL,2,10,1,'Supply Admin','active','2025-08-16 12:42:31','2025-08-16 12:52:17','0','0');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_requests`
--

DROP TABLE IF EXISTS `purchase_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fund_cluster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsibility_center_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'waived',
  `created_by` bigint unsigned NOT NULL,
  `created_in` timestamp NULL DEFAULT NULL,
  `approval` bigint unsigned DEFAULT NULL,
  `signed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_requests_created_by_foreign` (`created_by`),
  CONSTRAINT `purchase_requests_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_requests`
--

LOCK TABLES `purchase_requests` WRITE;
/*!40000 ALTER TABLE `purchase_requests` DISABLE KEYS */;
INSERT INTO `purchase_requests` VALUES (1,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:33:55','2025-08-09 12:33:55'),(2,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:38:09','2025-08-09 12:38:09'),(3,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:40:42','2025-08-09 12:40:42'),(4,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:41:56','2025-08-09 12:41:56'),(5,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:42:25','2025-08-09 12:42:25'),(6,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:49:06','2025-08-09 12:49:06'),(7,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:49:32','2025-08-09 12:49:32'),(8,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:50:02','2025-08-09 12:50:02'),(9,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:50:57','2025-08-09 12:50:57'),(10,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:51:13','2025-08-09 12:51:13'),(11,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:51:45','2025-08-09 12:51:45'),(12,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 12:52:11','2025-08-09 12:52:11'),(13,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 13:02:56','2025-08-09 13:02:56'),(14,'EMB 8','FAD','FAD',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-09 13:09:11','2025-08-09 13:09:11'),(15,'EMB 8','FAD','FINANCE',NULL,'NOTHING',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-08-11 09:46:54','2025-08-11 09:46:54'),(16,'EMB 8','PASMU','PASMU',NULL,'NONE',NULL,1,'2025-08-16 12:21:11',1,'0','2025-01-01 00:00:00','2025-09-09 12:24:28'),(17,'TEST','TEST','TEST','TEST','NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-01-01 00:00:00','2025-08-13 08:45:19'),(18,'TEST','TEST','TEST','TEST','NONE',NULL,1,'2025-08-16 12:21:11',NULL,'0','2025-01-01 00:00:00','2025-08-13 08:45:54'),(19,'EMB','EMB','EMB','EMB','NONE',NULL,1,'2025-08-16 12:21:11',1,'0','2025-01-01 00:00:00','2025-09-09 07:55:14'),(20,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,102,'2025-08-16 12:21:11',NULL,'0','2025-01-01 00:00:00','2025-08-13 13:15:08'),(21,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,102,'2025-08-16 12:21:11',NULL,'0','2025-01-01 00:00:00','2025-08-13 13:15:22'),(22,'testing','testing','tyesting',NULL,'none',NULL,102,'2025-08-16 12:21:11',NULL,'0','2025-01-01 00:00:00','2025-08-13 13:20:46'),(23,'EMB 8','PISMU','PISMU',NULL,'FUND 101',NULL,1,'2025-08-16 12:21:11',1,'0','2025-01-01 00:00:00','2025-09-02 12:52:30'),(24,'EMB 9','PISMU1','PISMU',NULL,'FUND 101',NULL,1,'2025-08-16 12:21:11',1,'0','2025-01-01 00:00:00','2025-08-27 14:51:17'),(25,'EMB 8','Bro','FAD',NULL,'FUND 101',NULL,104,'2025-07-31 23:00:00',1,'0','2025-08-13 23:00:00','2025-08-28 13:05:55'),(26,'EMB 8','FAD','FAD',NULL,'NONE',NULL,106,'2025-01-01 00:00:00',1,'0','2025-08-20 10:46:36','2025-08-29 06:33:43'),(27,'EMB 8','PISMU','PISMU',NULL,'NONE',NULL,1,'2025-08-26 23:00:00',NULL,'0','2025-08-28 07:23:19','2025-08-28 07:23:19'),(28,'AKON EMB','EMB','PISMU',NULL,'NONE',NULL,102,'2025-08-27 23:00:00',NULL,'0','2025-08-29 07:54:49','2025-08-29 07:54:49'),(29,'EMB 8','FAD','FINANCE',NULL,'NOTHING',NULL,104,'2025-08-15 23:00:00',1,'0','2025-08-29 09:22:11','2025-08-29 10:32:19'),(30,'DENR','DENR','DENR',NULL,'NONE',NULL,1,'2025-09-12 23:00:00',1,'0','2025-09-02 11:26:14','2025-09-02 11:26:58');
/*!40000 ALTER TABLE `purchase_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recepients`
--

DROP TABLE IF EXISTS `recepients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recepients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `received` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recepients_transaction_id_foreign` (`transaction_id`),
  KEY `recepients_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `recepients_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`),
  CONSTRAINT `recepients_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recepients`
--

LOCK TABLES `recepients` WRITE;
/*!40000 ALTER TABLE `recepients` DISABLE KEYS */;
INSERT INTO `recepients` VALUES (1,1,1,'0','2025-08-14 07:54:06','2025-08-14 07:54:06'),(2,2,1,'0','2025-08-14 11:41:39','2025-08-14 11:41:39'),(3,2,102,'0','2025-08-14 11:41:39','2025-08-14 11:41:39'),(4,3,1,'0','2025-08-14 11:45:36','2025-08-14 11:45:36'),(5,3,102,'0','2025-08-14 11:45:36','2025-08-14 11:45:36'),(6,4,1,'0','2025-08-14 11:56:41','2025-08-14 11:56:41'),(7,4,102,'0','2025-08-14 11:56:41','2025-08-14 11:56:41'),(8,4,103,'0','2025-08-14 11:56:41','2025-08-14 11:56:41'),(9,6,1,'0','2025-08-14 13:09:25','2025-08-14 13:09:25'),(10,6,102,'0','2025-08-14 13:09:25','2025-08-14 13:09:25'),(11,6,103,'0','2025-08-14 13:09:25','2025-08-14 13:09:25'),(12,6,44,'0','2025-08-14 13:09:25','2025-08-14 13:09:25'),(13,6,47,'0','2025-08-14 13:09:25','2025-08-14 13:09:25'),(14,6,87,'0','2025-08-14 13:09:25','2025-08-14 13:09:25'),(15,7,1,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(16,7,102,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(17,7,103,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(18,7,44,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(19,7,47,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(20,7,87,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(21,7,87,'0','2025-08-14 13:13:20','2025-08-14 13:13:20'),(22,8,1,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(23,8,102,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(24,8,103,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(25,8,44,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(26,8,47,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(27,8,87,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(28,8,96,'0','2025-08-14 13:13:59','2025-08-14 13:13:59'),(29,9,104,'0','2025-08-14 13:15:45','2025-08-20 08:52:20'),(30,12,104,'0','2025-08-15 06:40:01','2025-08-15 06:40:01'),(31,12,1,'0','2025-08-15 06:40:01','2025-08-15 06:40:01'),(32,12,103,'0','2025-08-15 06:40:01','2025-08-15 06:40:01'),(33,13,104,'0','2025-08-15 06:42:48','2025-08-15 06:42:48'),(34,13,1,'0','2025-08-15 06:42:48','2025-08-15 06:42:48'),(35,13,103,'0','2025-08-15 06:42:48','2025-08-15 06:42:48'),(36,14,104,'0','2025-08-15 06:43:46','2025-08-15 06:43:46'),(37,14,1,'0','2025-08-15 06:43:46','2025-08-15 06:43:46'),(38,14,103,'0','2025-08-15 06:43:46','2025-08-15 06:43:46'),(39,15,104,'0','2025-08-15 06:49:01','2025-08-15 06:49:01'),(40,15,1,'0','2025-08-15 06:49:01','2025-08-15 06:49:01'),(41,15,103,'0','2025-08-15 06:49:01','2025-08-15 06:49:01'),(42,16,104,'0','2025-08-15 06:52:59','2025-08-15 06:52:59'),(43,16,1,'0','2025-08-15 06:52:59','2025-08-15 06:52:59'),(44,16,103,'0','2025-08-15 06:52:59','2025-08-15 06:52:59'),(45,17,104,'0','2025-08-15 06:53:36','2025-08-15 06:53:36'),(46,17,1,'0','2025-08-15 06:53:36','2025-08-15 06:53:36'),(47,17,103,'0','2025-08-15 06:53:37','2025-08-15 06:53:37'),(48,18,104,'0','2025-08-15 06:55:33','2025-08-15 06:55:33'),(49,18,1,'0','2025-08-15 06:55:33','2025-08-15 06:55:33'),(50,18,103,'0','2025-08-15 06:55:33','2025-08-15 06:55:33'),(51,19,104,'0','2025-08-15 07:35:32','2025-08-15 07:35:32'),(52,19,1,'0','2025-08-15 07:35:32','2025-08-15 07:35:32'),(53,19,103,'0','2025-08-15 07:35:32','2025-08-15 07:35:32'),(54,21,104,'0','2025-08-15 08:07:31','2025-08-15 08:07:31'),(55,21,1,'0','2025-08-15 08:07:31','2025-08-15 08:07:31'),(56,21,103,'0','2025-08-15 08:07:31','2025-08-15 08:07:31'),(57,21,105,'0','2025-08-15 08:07:31','2025-08-15 08:07:31'),(58,24,104,'0','2025-08-15 08:15:14','2025-08-15 08:15:14'),(59,24,1,'0','2025-08-15 08:15:14','2025-08-15 08:15:14'),(60,24,103,'0','2025-08-15 08:15:14','2025-08-15 08:15:14'),(61,24,105,'0','2025-08-15 08:15:14','2025-08-15 08:15:14'),(62,24,90,'0','2025-08-15 08:15:14','2025-08-15 08:15:14'),(63,24,102,'0','2025-08-15 08:15:14','2025-08-15 08:15:14'),(64,25,104,'0','2025-08-15 08:44:50','2025-08-15 08:44:50'),(65,25,1,'0','2025-08-15 08:44:50','2025-08-15 08:44:50'),(66,25,103,'0','2025-08-15 08:44:50','2025-08-15 08:44:50'),(67,25,105,'0','2025-08-15 08:44:50','2025-08-15 08:44:50'),(68,25,90,'0','2025-08-15 08:44:50','2025-08-15 08:44:50'),(69,25,102,'0','2025-08-15 08:44:50','2025-08-15 08:44:50'),(70,26,104,'0','2025-08-15 11:25:12','2025-08-15 11:25:12'),(71,26,1,'0','2025-08-15 11:25:12','2025-08-15 11:25:12'),(72,26,103,'0','2025-08-15 11:25:12','2025-08-15 11:25:12'),(73,26,105,'0','2025-08-15 11:25:12','2025-08-15 11:25:12'),(74,26,90,'0','2025-08-15 11:25:12','2025-08-15 11:25:12'),(75,26,102,'0','2025-08-15 11:25:12','2025-08-15 11:25:12'),(76,27,104,'0','2025-08-15 13:01:26','2025-08-15 13:01:26'),(77,27,1,'0','2025-08-15 13:01:26','2025-08-15 13:01:26'),(78,27,103,'0','2025-08-15 13:01:26','2025-08-15 13:01:26'),(79,27,105,'0','2025-08-15 13:01:26','2025-08-15 13:01:26'),(80,27,90,'0','2025-08-15 13:01:26','2025-08-15 13:01:26'),(81,27,102,'0','2025-08-15 13:01:26','2025-08-15 13:01:26'),(82,28,104,'0','2025-08-15 14:03:56','2025-08-15 14:03:56'),(83,28,1,'0','2025-08-15 14:03:56','2025-08-15 14:03:56'),(84,28,103,'0','2025-08-15 14:03:56','2025-08-15 14:03:56'),(85,28,105,'0','2025-08-15 14:03:56','2025-08-15 14:03:56'),(86,28,90,'0','2025-08-15 14:03:56','2025-08-15 14:03:56'),(87,28,102,'0','2025-08-15 14:03:56','2025-08-15 14:03:56'),(88,30,104,'0','2025-08-15 14:05:47','2025-08-15 14:05:47'),(89,30,1,'0','2025-08-15 14:05:47','2025-08-15 14:05:47'),(90,30,103,'0','2025-08-15 14:05:47','2025-08-15 14:05:47'),(91,30,105,'0','2025-08-15 14:05:47','2025-08-15 14:05:47'),(92,30,90,'0','2025-08-15 14:05:47','2025-08-15 14:05:47'),(93,30,102,'0','2025-08-15 14:05:47','2025-08-15 14:05:47'),(94,32,104,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(95,32,1,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(96,32,103,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(97,32,105,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(98,32,90,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(99,32,102,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(100,32,6,'0','2025-08-15 14:53:17','2025-08-15 14:53:17'),(101,33,104,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(102,33,1,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(103,33,103,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(104,33,105,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(105,33,90,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(106,33,102,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(107,33,6,'0','2025-08-15 14:55:16','2025-08-15 14:55:16'),(108,34,104,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(109,34,1,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(110,34,103,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(111,34,105,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(112,34,90,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(113,34,102,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(114,34,6,'0','2025-08-15 14:56:18','2025-08-15 14:56:18'),(115,35,104,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(116,35,1,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(117,35,103,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(118,35,105,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(119,35,90,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(120,35,102,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(121,35,6,'0','2025-08-15 14:56:35','2025-08-15 14:56:35'),(122,36,104,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(123,36,1,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(124,36,103,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(125,36,105,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(126,36,90,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(127,36,102,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(128,36,6,'0','2025-08-15 14:57:02','2025-08-15 14:57:02'),(129,37,104,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(130,37,1,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(131,37,103,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(132,37,105,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(133,37,90,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(134,37,102,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(135,37,6,'0','2025-08-15 14:58:32','2025-08-15 14:58:32'),(136,38,104,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(137,38,1,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(138,38,103,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(139,38,105,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(140,38,90,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(141,38,102,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(142,38,6,'0','2025-08-16 09:40:40','2025-08-16 09:40:40'),(143,39,104,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(144,39,1,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(145,39,103,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(146,39,105,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(147,39,90,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(148,39,102,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(149,39,6,'0','2025-08-16 09:41:20','2025-08-16 09:41:20'),(150,40,104,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(151,40,1,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(152,40,103,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(153,40,105,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(154,40,90,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(155,40,102,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(156,40,6,'0','2025-08-16 09:41:58','2025-08-16 09:41:58'),(157,41,104,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(158,41,1,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(159,41,103,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(160,41,105,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(161,41,90,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(162,41,102,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(163,41,6,'0','2025-08-16 09:42:29','2025-08-16 09:42:29'),(164,42,104,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(165,42,1,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(166,42,103,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(167,42,105,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(168,42,90,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(169,42,102,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(170,42,6,'0','2025-08-16 09:53:42','2025-08-16 09:53:42'),(171,43,104,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(172,43,1,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(173,43,103,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(174,43,105,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(175,43,90,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(176,43,102,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(177,43,6,'0','2025-08-16 09:56:58','2025-08-16 09:56:58'),(178,44,104,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(179,44,1,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(180,44,103,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(181,44,105,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(182,44,90,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(183,44,102,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(184,44,6,'0','2025-08-16 09:57:21','2025-08-16 09:57:21'),(185,45,104,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(186,45,1,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(187,45,103,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(188,45,105,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(189,45,90,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(190,45,102,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(191,45,6,'0','2025-08-16 09:57:42','2025-08-16 09:57:42'),(192,46,104,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(193,46,1,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(194,46,103,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(195,46,105,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(196,46,90,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(197,46,102,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(198,46,6,'0','2025-08-16 09:59:54','2025-08-16 09:59:54'),(199,47,104,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(200,47,1,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(201,47,103,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(202,47,105,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(203,47,90,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(204,47,102,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(205,47,6,'0','2025-08-16 10:32:59','2025-08-16 10:32:59'),(206,48,104,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(207,48,1,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(208,48,103,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(209,48,105,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(210,48,90,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(211,48,102,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(212,48,6,'0','2025-08-16 10:33:26','2025-08-16 10:33:26'),(213,49,104,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(214,49,1,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(215,49,103,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(216,49,105,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(217,49,90,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(218,49,102,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(219,49,6,'0','2025-08-16 10:36:00','2025-08-16 10:36:00'),(220,50,104,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(221,50,1,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(222,50,103,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(223,50,105,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(224,50,90,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(225,50,102,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(226,50,6,'0','2025-08-16 11:19:20','2025-08-16 11:19:20'),(227,51,104,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(228,51,1,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(229,51,103,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(230,51,105,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(231,51,90,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(232,51,102,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(233,51,6,'0','2025-08-16 11:25:32','2025-08-16 11:25:32'),(234,52,104,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(235,52,1,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(236,52,103,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(237,52,105,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(238,52,90,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(239,52,102,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(240,52,6,'0','2025-08-16 11:32:06','2025-08-16 11:32:06'),(241,53,104,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(242,53,1,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(243,53,103,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(244,53,105,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(245,53,90,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(246,53,102,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(247,53,6,'0','2025-08-16 11:36:53','2025-08-16 11:36:53'),(248,54,104,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(249,54,1,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(250,54,103,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(251,54,105,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(252,54,90,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(253,54,102,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(254,54,6,'0','2025-08-16 11:37:45','2025-08-16 11:37:45'),(255,55,104,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(256,55,1,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(257,55,103,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(258,55,105,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(259,55,90,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(260,55,102,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(261,55,6,'0','2025-08-16 11:49:13','2025-08-16 11:49:13'),(262,56,104,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(263,56,1,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(264,56,103,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(265,56,105,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(266,56,90,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(267,56,102,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(268,56,6,'0','2025-08-16 11:49:34','2025-08-16 11:49:34'),(269,57,104,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(270,57,1,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(271,57,103,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(272,57,105,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(273,57,90,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(274,57,102,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(275,57,6,'0','2025-08-16 13:11:15','2025-08-16 13:11:15'),(276,59,106,'1','2025-08-18 12:31:59','2025-08-22 11:30:56'),(277,60,106,'1','2025-08-20 09:19:29','2025-08-22 11:30:53'),(278,61,106,'1','2025-08-20 09:30:20','2025-08-20 10:47:11'),(279,62,106,'1','2025-08-20 09:31:19','2025-08-22 14:09:58'),(280,63,1,'0','2025-08-20 10:44:59','2025-08-20 10:44:59'),(281,64,106,'0','2025-08-20 10:46:36','2025-08-20 10:46:36'),(282,65,106,'0','2025-08-20 10:48:28','2025-08-20 10:48:28'),(283,65,107,'0','2025-08-20 10:48:28','2025-08-20 10:48:28'),(284,66,106,'0','2025-08-20 10:49:46','2025-08-20 10:49:46'),(285,66,107,'0','2025-08-20 10:49:46','2025-08-20 10:49:46'),(286,67,106,'1','2025-08-22 14:11:52','2025-08-22 14:12:28'),(287,68,1,'1','2025-08-22 14:57:51','2025-08-22 14:59:06'),(288,69,107,'1','2025-08-22 15:00:29','2025-08-22 15:01:45'),(289,70,106,'1','2025-08-22 15:02:10','2025-08-22 15:02:39'),(290,71,1,'1','2025-08-27 14:51:17','2025-08-28 08:52:14'),(291,72,1,'0','2025-08-28 07:23:19','2025-08-28 07:23:19'),(292,76,1,'0','2025-08-28 11:44:57','2025-08-28 11:44:57'),(293,76,102,'0','2025-08-28 11:44:57','2025-08-28 11:44:57'),(294,76,103,'0','2025-08-28 11:44:57','2025-08-28 11:44:57'),(295,76,54,'0','2025-08-28 11:44:57','2025-08-28 11:44:57'),(296,77,1,'0','2025-08-28 11:47:05','2025-08-28 11:47:05'),(297,77,102,'0','2025-08-28 11:47:05','2025-08-28 11:47:05'),(298,77,103,'0','2025-08-28 11:47:05','2025-08-28 11:47:05'),(299,77,54,'0','2025-08-28 11:47:05','2025-08-28 11:47:05'),(300,77,48,'0','2025-08-28 11:47:05','2025-08-28 11:47:05'),(301,78,1,'1','2025-08-28 12:58:59','2025-08-28 12:59:52'),(302,79,106,'1','2025-08-28 13:00:28','2025-08-28 13:00:54'),(303,80,102,'1','2025-08-28 13:01:59','2025-08-28 13:04:00'),(304,81,1,'1','2025-08-28 13:05:55','2025-08-28 13:23:16'),(305,82,106,'1','2025-08-29 06:32:42','2025-08-29 06:33:09'),(306,83,107,'1','2025-08-29 06:33:43','2025-08-29 09:32:56'),(307,84,102,'0','2025-08-29 07:54:49','2025-08-29 07:54:49'),(308,85,102,'0','2025-08-29 08:09:03','2025-08-29 08:09:03'),(309,85,1,'0','2025-08-29 08:09:03','2025-08-29 08:09:03'),(310,86,104,'0','2025-08-29 09:22:11','2025-08-29 09:22:11'),(311,87,1,'1','2025-08-29 09:22:52','2025-08-29 09:23:44'),(312,88,107,'1','2025-08-29 09:24:57','2025-08-29 09:25:40'),(313,89,104,'1','2025-08-29 09:26:08','2025-08-29 09:28:15'),(314,90,107,'1','2025-08-29 09:29:46','2025-08-29 10:28:53'),(317,92,104,'1','2025-08-29 10:32:19','2025-08-29 10:32:47'),(318,93,1,'1','2025-09-02 11:03:53','2025-09-02 11:04:25'),(319,94,1,'0','2025-09-02 11:26:14','2025-09-02 11:26:14'),(320,95,107,'0','2025-09-02 11:26:58','2025-09-02 11:26:58'),(321,96,106,'1','2025-09-02 12:41:31','2025-09-02 12:44:16'),(322,97,1,'1','2025-09-02 12:44:32','2025-09-02 12:44:55'),(323,98,106,'1','2025-09-02 12:45:13','2025-09-02 12:47:29'),(324,99,1,'1','2025-09-02 12:52:30','2025-09-02 12:53:40'),(325,100,1,'1','2025-09-02 12:53:10','2025-09-02 12:53:51'),(326,101,106,'1','2025-09-02 12:54:11','2025-09-02 12:56:23'),(327,102,1,'1','2025-09-02 12:56:38','2025-09-02 12:57:58'),(328,103,106,'1','2025-09-02 12:58:21','2025-09-02 13:08:56'),(329,104,1,'0','2025-09-09 07:55:06','2025-09-09 07:55:06'),(330,105,1,'1','2025-09-09 07:55:14','2025-09-09 07:56:46'),(331,106,1,'0','2025-09-09 12:24:28','2025-09-09 12:24:28'),(332,107,1,'1','2025-09-09 12:54:28','2025-09-09 12:55:35');
/*!40000 ALTER TABLE `recepients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `division_id` bigint unsigned NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_division_id_foreign` (`division_id`),
  CONSTRAINT `sections_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,'LEGAL UNIT','LEGAL',NULL,NULL),(2,1,'ENVIRONMENTAL EDUCATION AND INFORMATION UNIT','EEIU',NULL,NULL),(3,1,'PLANNING AND INFORMATION SYSTEMS UNIT','PISMU',NULL,NULL),(4,1,'PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (LEYTE)','PEMU',NULL,NULL),(5,1,'PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (SOUTHERN LEYTE)','PEMU',NULL,NULL),(6,1,'PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (SAMAR','PEMU',NULL,NULL),(7,1,'PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (EASTERN SAMAR)','PEMU',NULL,NULL),(8,1,'PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (NORTHERN SAMAR)','PEMU',NULL,NULL),(9,2,'FINANCE UNIT','FINANCE',NULL,NULL),(10,2,'ADMINISTRATIVE UNIT','ADMINISTRATIVE',NULL,NULL),(11,3,'TOXIC CHEMICALS AND HAZARDOUZ WASTE PERMITTING UNIT','TCHWPU',NULL,NULL),(12,3,'AIR AND WATER WASTE PERMETTING SECTION','AWPS',NULL,NULL),(13,3,'ENVIRONMENTAL IMPACT ASSESSMENT PERMITTING SECTION','EIAPS',NULL,NULL),(14,4,'SOLID WASTE MANAGEMENT SECTION','SWM',NULL,NULL),(15,4,'AMBIENT MONITORING SECTION','AMS',NULL,NULL),(16,4,'AIR AND WATER MONITORING SECTION','AWMS',NULL,NULL),(17,4,'TOXIC CHEMICALS AND HAZARDOUS MONITORING SECTION','TCHMS',NULL,NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplementaries`
--

DROP TABLE IF EXISTS `supplementaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplementaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filetype` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplementaries_user_id_foreign` (`user_id`),
  CONSTRAINT `supplementaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplementaries`
--

LOCK TABLES `supplementaries` WRITE;
/*!40000 ALTER TABLE `supplementaries` DISABLE KEYS */;
INSERT INTO `supplementaries` VALUES (194,'SPL-2025-09-00001','SPL-2025-09-00001','SPL-2025-09-00001.pdf','pdf',1,'2025-09-09 10:13:12','2025-09-09 10:13:12'),(195,'SPL-2025-09-00006 (2)','SPL-2025-09-00002','SPL-2025-09-00006 (2).pdf','pdf',1,'2025-09-09 10:13:14','2025-09-09 10:13:14'),(196,'SPL-2025-09-00006 (1)','SPL-2025-09-00003','SPL-2025-09-00006 (1).pdf','pdf',1,'2025-09-09 10:13:15','2025-09-09 10:13:15'),(197,'SPL-2025-09-00006','SPL-2025-09-00004','SPL-2025-09-00006.pdf','pdf',1,'2025-09-09 10:13:17','2025-09-09 10:13:17'),(198,'AUGUST 19 CA (2)','SPL-2025-09-00005','AUGUST 19 CA (2).pdf','pdf',1,'2025-09-09 10:13:18','2025-09-09 10:13:18'),(199,'AUGUST 19 CA (1)','SPL-2025-09-00006','AUGUST 19 CA (1).pdf','pdf',1,'2025-09-09 10:13:20','2025-09-09 10:13:20');
/*!40000 ALTER TABLE `supplementaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `action` bigint unsigned NOT NULL DEFAULT '1',
  `body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_purchase_request_id_foreign` (`purchase_request_id`),
  KEY `transactions_sender_id_foreign` (`sender_id`),
  KEY `action` (`action`),
  CONSTRAINT `transactions_action_foreign` FOREIGN KEY (`action`) REFERENCES `alternatives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_purchase_request_id_foreign` FOREIGN KEY (`purchase_request_id`) REFERENCES `purchase_requests` (`id`),
  CONSTRAINT `transactions_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,24,1,1,'initiated the request','2025-08-14 07:54:06','2025-08-14 07:54:06'),(2,24,102,1,'changed the details of the purchase request','2025-08-14 11:41:39','2025-08-14 11:41:39'),(3,24,102,1,'changed the details of the purchase request','2025-08-14 11:45:36','2025-08-14 11:45:36'),(4,24,103,1,'changed the details of the purchase request','2025-08-14 11:56:41','2025-08-14 11:56:41'),(5,24,1,1,'Updated the purchase request with a new member','2025-08-14 13:07:54','2025-08-14 13:07:54'),(6,24,1,1,'changed the details of the purchase request','2025-08-14 13:09:25','2025-08-14 13:09:25'),(7,24,1,1,'changed the details of the purchase request','2025-08-14 13:13:20','2025-08-14 13:13:20'),(8,24,1,1,'changed the details of the purchase request','2025-08-14 13:13:59','2025-08-14 13:13:59'),(9,25,104,1,'initiated the request','2025-08-14 13:15:45','2025-08-20 08:40:03'),(10,25,104,1,'Updated the purchase request with a new member','2025-08-14 13:16:16','2025-08-20 08:40:03'),(11,25,104,1,NULL,'2025-08-14 13:16:50','2025-08-20 08:40:03'),(12,25,1,2,'Barina','2025-08-15 06:40:01','2025-08-20 08:40:03'),(13,25,1,2,'Phone Case','2025-08-15 06:42:48','2025-08-20 08:40:03'),(14,25,1,4,'Any recommendations ?','2025-08-15 06:43:46','2025-08-20 08:40:03'),(15,25,1,3,'mighty bond','2025-08-15 06:49:01','2025-08-20 08:40:03'),(16,25,1,4,'Vinceeeeeent','2025-08-15 06:52:59','2025-08-20 08:40:03'),(17,25,1,3,'Butangi hin katol','2025-08-15 06:53:36','2025-08-20 08:40:03'),(18,25,104,1,'May katol na po sir Marco','2025-08-15 06:55:33','2025-08-20 08:40:03'),(19,25,1,5,'pa approve po','2025-08-15 07:35:32','2025-08-20 08:40:03'),(20,25,1,1,'Updated the purchase request with a new member','2025-08-15 07:45:21','2025-08-20 08:40:03'),(21,25,1,5,'Pa remove an phone case','2025-08-15 08:07:31','2025-08-20 08:40:03'),(22,25,1,1,'Updated the purchase request with a new member','2025-08-15 08:08:19','2025-08-20 08:40:03'),(23,25,1,1,'Updated the purchase request with a new member','2025-08-15 08:08:44','2025-08-20 08:40:03'),(24,25,102,1,'Hello, Guys','2025-08-15 08:15:14','2025-08-20 08:40:03'),(25,25,1,1,'Welcome to the club','2025-08-15 08:44:50','2025-08-20 08:40:03'),(26,25,1,6,'ig submit na ini nim igit ka.','2025-08-15 11:25:12','2025-08-20 08:40:03'),(27,25,1,1,'Hey bro','2025-08-15 13:01:26','2025-08-20 08:40:03'),(28,25,1,7,'pa cancel nala','2025-08-15 14:03:56','2025-08-20 08:40:03'),(29,25,1,1,'Updated the purchase request with a new member','2025-08-15 14:05:02','2025-08-20 08:40:03'),(30,25,1,2,'HELLO BRO','2025-08-15 14:05:47','2025-08-20 08:40:03'),(31,25,1,1,'Updated the purchase request with a new member','2025-08-15 14:52:10','2025-08-20 08:40:03'),(32,25,1,1,'Pakitawag daw kan sir Sherwin','2025-08-15 14:53:17','2025-08-20 08:40:03'),(33,25,1,1,'Pleas wait for Mary Joyce','2025-08-15 14:55:16','2025-08-20 08:40:03'),(34,25,1,1,'Please proceed to RDs Office','2025-08-15 14:56:18','2025-08-20 08:40:03'),(35,25,1,1,'Trying hard','2025-08-15 14:56:35','2025-08-20 08:40:03'),(36,25,1,5,'Pa approved','2025-08-15 14:57:02','2025-08-20 08:40:03'),(37,25,1,1,'changed the details of the purchase request','2025-08-15 14:58:32','2025-08-20 08:40:03'),(38,25,1,1,'changed the details of the purchase request','2025-08-16 09:40:40','2025-08-20 08:40:03'),(39,25,1,1,'changed the details of the purchase request','2025-08-16 09:41:20','2025-08-20 08:40:03'),(40,25,1,1,'changed the details of the purchase request','2025-08-16 09:41:58','2025-08-20 08:40:03'),(41,25,1,1,'changed the details of the purchase request','2025-08-16 09:42:29','2025-08-20 08:40:03'),(42,25,1,1,'changed the details of the purchase request','2025-08-16 09:53:42','2025-08-20 08:40:03'),(43,25,1,1,'changed the details of the purchase request','2025-08-16 09:56:58','2025-08-20 08:40:03'),(44,25,1,1,'changed the details of the purchase request','2025-08-16 09:57:21','2025-08-20 08:40:03'),(45,25,1,1,'changed the details of the purchase request','2025-08-16 09:57:42','2025-08-20 08:40:03'),(46,25,1,1,'changed the details of the purchase request','2025-08-16 09:59:54','2025-08-20 08:40:03'),(47,25,1,1,'changed the details of the purchase request','2025-08-16 10:32:59','2025-08-20 08:40:03'),(48,25,1,1,'changed the details of the purchase request','2025-08-16 10:33:26','2025-08-20 08:40:03'),(49,25,1,1,'changed the details of the purchase request','2025-08-16 10:36:00','2025-08-20 08:40:03'),(50,25,1,1,'changed the details of the purchase request','2025-08-16 11:19:20','2025-08-20 08:40:03'),(51,25,1,1,'changed the details of the purchase request','2025-08-16 11:25:32','2025-08-20 08:40:03'),(52,25,1,1,'changed the details of the purchase request','2025-08-16 11:32:06','2025-08-20 08:40:03'),(53,25,1,1,'changed the details of the purchase request','2025-08-16 11:36:53','2025-08-20 08:40:03'),(54,25,1,1,'changed the details of the purchase request','2025-08-16 11:37:45','2025-08-20 08:40:03'),(55,25,1,1,'changed the details of the purchase request','2025-08-16 11:49:13','2025-08-20 08:40:03'),(56,25,1,1,'changed the details of the purchase request','2025-08-16 11:49:34','2025-08-20 08:40:03'),(57,25,1,1,'changed the details of the purchase request','2025-08-16 13:11:15','2025-08-20 08:40:03'),(58,25,1,5,NULL,'2025-08-18 12:30:52','2025-08-20 08:40:03'),(59,25,1,5,NULL,'2025-08-18 12:31:59','2025-08-20 08:40:03'),(60,24,1,5,'Pa approve po.','2025-08-20 09:19:29','2025-08-20 09:19:29'),(61,23,1,5,NULL,'2025-08-20 09:30:20','2025-08-20 09:30:20'),(62,16,1,5,NULL,'2025-08-20 09:31:19','2025-08-20 09:31:19'),(63,19,1,4,'Hey, I just created the PR.','2025-08-20 10:44:59','2025-08-20 10:44:59'),(64,26,106,1,'initiated the request','2025-08-20 10:46:36','2025-08-20 10:46:36'),(65,26,106,1,'changed the details of the purchase request','2025-08-20 10:48:28','2025-08-20 10:48:28'),(66,26,107,6,NULL,'2025-08-20 10:49:46','2025-08-20 10:49:46'),(67,19,1,5,NULL,'2025-08-22 14:11:52','2025-08-22 14:11:52'),(68,24,106,6,NULL,'2025-08-22 14:57:51','2025-08-22 14:57:51'),(69,24,1,5,NULL,'2025-08-22 15:00:29','2025-08-22 15:00:29'),(70,24,107,5,NULL,'2025-08-22 15:02:10','2025-08-22 15:02:10'),(71,24,106,8,'PLEASE ATTACH REQUIRED DOCUMENTS.','2025-08-27 14:51:17','2025-08-27 14:51:17'),(72,27,1,1,'initiated the request','2025-08-28 07:23:19','2025-08-28 07:23:19'),(76,27,1,1,'Updated the purchase request with a new member','2025-08-28 11:44:57','2025-08-28 11:44:57'),(77,27,1,1,'Updated the purchase request with a new member','2025-08-28 11:47:05','2025-08-28 11:47:05'),(78,25,106,8,'please provide','2025-08-28 12:58:59','2025-08-28 12:58:59'),(79,25,1,5,NULL,'2025-08-28 13:00:28','2025-08-28 13:00:28'),(80,25,106,4,'waiting for your approval.','2025-08-28 13:01:59','2025-08-28 13:01:59'),(81,25,102,6,'Forward to supply.','2025-08-28 13:05:55','2025-08-28 13:05:55'),(82,26,106,5,NULL,'2025-08-29 06:32:42','2025-08-29 06:32:42'),(83,26,106,5,NULL,'2025-08-29 06:33:43','2025-08-29 06:33:43'),(84,28,102,1,'initiated the request','2025-08-29 07:54:49','2025-08-29 07:54:49'),(85,28,102,1,'Updated the purchase request with a new member','2025-08-29 08:09:03','2025-08-29 08:09:03'),(86,29,104,1,'initiated the request','2025-08-29 09:22:11','2025-08-29 09:22:11'),(87,29,104,5,NULL,'2025-08-29 09:22:52','2025-08-29 09:22:52'),(88,29,1,5,NULL,'2025-08-29 09:24:57','2025-08-29 09:24:57'),(89,29,107,8,NULL,'2025-08-29 09:26:08','2025-08-29 09:26:08'),(90,29,104,10,NULL,'2025-08-29 09:29:46','2025-08-29 09:29:46'),(92,29,107,9,NULL,'2025-08-29 10:32:19','2025-08-29 10:32:19'),(93,23,106,9,NULL,'2025-09-02 11:03:53','2025-09-02 11:03:53'),(94,30,1,1,'initiated the request','2025-09-02 11:26:14','2025-09-02 11:26:14'),(95,30,1,5,NULL,'2025-09-02 11:26:58','2025-09-02 11:26:58'),(96,23,1,5,NULL,'2025-09-02 12:41:31','2025-09-02 12:41:31'),(97,23,106,9,NULL,'2025-09-02 12:44:32','2025-09-02 12:44:32'),(98,23,1,5,NULL,'2025-09-02 12:45:13','2025-09-02 12:45:13'),(99,23,106,5,NULL,'2025-09-02 12:52:30','2025-09-02 12:52:30'),(100,19,106,9,NULL,'2025-09-02 12:53:10','2025-09-02 12:53:10'),(101,19,1,5,NULL,'2025-09-02 12:54:11','2025-09-02 12:54:11'),(102,19,106,9,NULL,'2025-09-02 12:56:38','2025-09-02 12:56:38'),(103,19,1,5,NULL,'2025-09-02 12:58:21','2025-09-02 12:58:21'),(104,19,106,9,NULL,'2025-09-09 07:55:06','2025-09-09 07:55:06'),(105,19,106,9,NULL,'2025-09-09 07:55:14','2025-09-09 07:55:14'),(106,16,106,8,NULL,'2025-09-09 12:24:28','2025-09-09 12:24:28'),(107,19,1,1,NULL,'2025-09-09 12:54:28','2025-09-09 12:54:28');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint unsigned NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `units_section_id_foreign` (`section_id`),
  CONSTRAINT `units_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,10,'SUPPLY UNIT','2025-08-16 13:20:39','2025-08-16 13:20:39');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('superadmin','admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permit` json NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'marco_pantonial@emb.gov.ph',NULL,'$2a$12$ApuszupbbDQAo8CGYzwLjeIGpAR2vv9/cw1uNdRRa.kvwJ0wFWpJO',NULL,'admin','2025-08-09 12:32:45','2025-08-22 08:29:42','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}'),(2,'jheidenreich@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','YVKjPmsLTw','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(3,'jeanette.volkman@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','GiYfI1O8Y8','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(4,'schowalter.gerson@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ox40ohkGwL','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(5,'kkoepp@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','4ZjlANQ7Z5','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(6,'hlehner@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','sUrHk9Nj45','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(7,'yokuneva@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ZhFFsW1u6a','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(8,'howe.ulices@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','RrvIOUtEyE','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(9,'javonte06@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','v1cBaUTGLS','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(10,'efadel@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','vRMzAxHoPA','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(11,'kaya.schmeler@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','goTu6kPUYD','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(12,'yundt.baylee@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','CYBx8YmbqM','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(13,'ihowell@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','LzEVdzPBt3','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(14,'zondricka@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','DLvBCFKpxF','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(15,'qbecker@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','SyvcmwAUln','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(16,'zetta96@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','lGXKJXl6Jl','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(17,'kub.vernon@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','87S2EyH0pm','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(18,'gharber@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','u3XwHPaWqE','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(19,'nolan.zechariah@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','uiz8jREARZ','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(20,'vbraun@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0Phk72cHAB','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(21,'brigitte.mayert@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','xEEhLWmWwI','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(22,'mohr.kaycee@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','hsQtJWCQCK','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(23,'chaim73@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0dDt7FmvW0','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(24,'aurelia.lesch@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Gui4tbSXej','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(25,'wolf.lupe@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','xqW8vauOid','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(26,'jaycee.friesen@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','HjYVG4mBnI','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(27,'hrenner@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Dqsm9bUkJU','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(28,'xhermiston@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','rP92eqfUvO','user','2025-08-09 12:32:45','2025-08-09 12:32:45','[]'),(29,'rgerhold@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','DWAWZMJ9Bk','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(30,'jakubowski.veronica@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','A1zCL0Xkgx','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(31,'hertha.beier@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','JnzpX16u1f','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(32,'daryl.pagac@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','lwi9MMB4DZ','admin','2025-08-09 12:32:46','2025-08-13 13:09:02','[]'),(33,'eleanora.denesik@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','eNoTfCqDGj','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(34,'goyette.earnestine@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','yOX1Xw0HK7','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(35,'bethel57@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','POd4Eapfqb','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(36,'kimberly.grant@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','DTaePadLWY','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(37,'lucious58@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','6XUR33Jivl','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(38,'hayley40@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','UAsn2VCybW','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(39,'antonia88@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','7PVt86xKQS','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(40,'travon02@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','PtZhFFR66I','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(41,'lind.tillman@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','HWtjN80WLf','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(42,'cadams@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','lSrfEHTUuN','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(43,'beatrice.jacobs@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','v4TwsXnYjC','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(44,'lynch.aurelia@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','PrtYu9fgQR','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(45,'asa.lockman@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','qe2ALssrZw','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(46,'tromp.newton@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','BVsWTOgMBy','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(47,'sbeatty@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','PaucTpvZww','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(48,'rmueller@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ky7XYlxHNI','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(49,'wilhelm06@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Dd5FrwW7Sg','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(50,'zvon@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','uPiIqArgFM','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(51,'isom.casper@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','zWlu6AzSup','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(52,'leora.armstrong@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','bFEKrj9QQq','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(53,'ava04@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','xnXzeZmsZh','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(54,'nbayer@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','9LrLYZT3Nv','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(55,'huel.lionel@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','KdrTPqyGWm','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(56,'eoconner@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','XU404WhEfx','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(57,'dane60@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ZjjxRcofis','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(58,'aglae26@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','3X776ZV2Fn','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(59,'brennon26@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Dv2NG4iRVj','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(60,'qkunze@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','X3izBSkzeH','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(61,'wshields@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','3VyTRGAe5b','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(62,'ladarius00@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','EQhoP3sR8I','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(63,'treva.hegmann@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','b9k1fjFTdH','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(64,'ocie64@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','wsj7hk5Amz','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(65,'zberge@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','zj9DEvdAC2','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(66,'alexa.rosenbaum@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','nCVDPs7X5z','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(67,'kelton.kub@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','AyRp3bIOUb','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(68,'xrunolfsdottir@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','RdILAcGRY1','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(69,'langworth.lizeth@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0yEc6GOc9U','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(70,'everardo76@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','L84zp7mRGL','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(71,'wilhelmine31@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','lqkPR40QkK','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(72,'wgorczany@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','lAy8dqSzZR','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(73,'jarrell.schamberger@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','EyNWWPnWOy','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(74,'natasha97@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ZHeNWb75VE','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(75,'rrogahn@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ByqY3OlsEJ','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(76,'zlind@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','AqlE0JX2j8','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(77,'jacky82@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','OJQf2dPkQk','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(78,'jensen.rippin@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','rHy8YBwEgJ','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(79,'jkirlin@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','TD85IiiJHj','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(80,'roosevelt74@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','z3EWY7T27r','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(81,'kody75@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0MWdOVbkUx','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(82,'andre.fisher@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','VLqtBltuX0','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(83,'crooks.reginald@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','1j2WZ2gQc0','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(84,'kelvin.bahringer@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','dehHUYMKVu','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(85,'delilah27@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','UMJVaPUS5I','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(86,'theresia40@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','BhVqdfZRap','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(87,'kenya45@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','DQaAcOpjMX','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(88,'crystal95@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','nASKNqbFLT','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(89,'stroman.kallie@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','107LBooL63','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(90,'fskiles@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','15Yd3sYbKL','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(91,'domingo.schulist@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','gto6CtFuOB','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(92,'greenholt.nora@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','GrrTyP9WoX','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(93,'stiedemann.geovanni@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ykPIDQdmHE','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(94,'lauryn49@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','6PvcEqJJ3O','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(95,'mozelle.zemlak@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','F6NKJi58w3','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(96,'rosemary.dickinson@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','IMpWOnZzbk','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(97,'maryam.turner@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','BrmaFoNMBP','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(98,'king.roxanne@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','C3Iqz17NsH','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(99,'enrico.grady@example.org','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','edP5snA1zQ','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(100,'gbeier@example.com','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Wodvdp59bm','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(101,'conrad.witting@example.net','2025-08-09 12:32:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','qyp4zfncpI','user','2025-08-09 12:32:46','2025-08-09 12:32:46','[]'),(102,'v@gmail.com',NULL,'$2y$10$E7ct.ZUxIGDqVbLdOwt8s.6qeySB692IPg27l2JXld8xRX0xhugt2',NULL,'user','2025-08-13 13:12:30','2025-08-13 13:12:30','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}'),(103,'bryan@gmail.com',NULL,'$2y$10$.YaifVg8LLPRUtZoQnG5CeHmhlI6WdkIsQm39VZU8YNEBLkk2BwDq',NULL,'user','2025-08-14 11:54:51','2025-08-14 11:54:51','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}'),(104,'joyce@gmail.com',NULL,'$2y$10$gNXOHcWP7Sho7ukyxZYvf.rDpTYR2KdkkBTTToSTjGlBMNiXp9t9G',NULL,'admin','2025-08-14 12:03:28','2025-08-14 14:39:46','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}'),(105,'lika@gmail.com',NULL,'$2y$10$V6ygV06jXJrjsBeATCnIZOwcwsrvcAFy6Uy2zeFI0LprCHMSj6iCu',NULL,'user','2025-08-15 07:42:42','2025-08-15 07:42:42','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}'),(106,'cedrick@gmail.com',NULL,'$2y$10$tfdYD2SXOnm3Qv3o/HPl7.LqZP2gcBHj/i/HDFPP2AU0h3LKoe1hG',NULL,'user','2025-08-16 12:27:02','2025-08-16 12:41:35','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}'),(107,'juvy@gmail.com',NULL,'$2y$10$rEDDRVu6/JgE9eJzZEXtuuIpAPfgox68fJHxs4A5SzDIf7GiBPj/S',NULL,'admin','2025-08-16 12:42:31','2025-08-16 12:52:17','{\"users\": [\"c\", \"r\", \"u\", \"d\"]}');
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

-- Dump completed on 2025-09-09 16:32:17
