-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: estoque
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.22-MariaDB

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
-- Table structure for table `descontos`
--

DROP TABLE IF EXISTS `descontos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descontos` (
  `des_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_regra_two` int(11) NOT NULL,
  `des_regra_one` int(11) NOT NULL,
  `des_valor` int(11) NOT NULL,
  `des_porcentagem` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`des_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descontos`
--

LOCK TABLES `descontos` WRITE;
/*!40000 ALTER TABLE `descontos` DISABLE KEYS */;
INSERT INTO `descontos` VALUES (1,9,7,300,20,NULL,NULL),(2,5,9,500,15,NULL,NULL);
/*!40000 ALTER TABLE `descontos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2021_03_23_131438_create_profiles_table',1),(6,'2021_03_23_132143_add_perfil_users_create',1),(7,'2021_03_23_141012_create_descontos_table',1),(8,'2021_03_23_141924_create_status_table',1),(9,'2021_03_23_142143_create_produtos_table',1),(10,'2021_03_23_143430_add_produto_desconto_table',1),(11,'2021_03_23_144835_create_pedidos_table',1),(12,'2021_03_23_151151_add_pedido_users_table',1),(13,'2021_03_25_225758_add_create_pedido_produto',1),(14,'2021_05_04_215101_add_preco_desconto_to_pedido_produtos_table',1),(15,'2021_05_08_022628_add_perfil_to_users',1),(16,'2021_05_08_035715_add_cpf_to_users',1),(17,'2022_03_03_001614_create_add_cpf_to_users',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `pedido_produtos`
--

DROP TABLE IF EXISTS `pedido_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_produtos` (
  `pep_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pep_quantidade` int(11) NOT NULL,
  `pep_valor_pro` double(8,2) NOT NULL,
  `pep_id_use` int(11) NOT NULL,
  `pep_id_pro` int(10) unsigned NOT NULL,
  `pep_id_ped` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pep_valor_pro_desconto` double(8,2) NOT NULL,
  PRIMARY KEY (`pep_id`),
  KEY `pedido_produtos_pep_id_pro_foreign` (`pep_id_pro`),
  KEY `pedido_produtos_pep_id_ped_foreign` (`pep_id_ped`),
  CONSTRAINT `pedido_produtos_pep_id_ped_foreign` FOREIGN KEY (`pep_id_ped`) REFERENCES `pedidos` (`ped_id`),
  CONSTRAINT `pedido_produtos_pep_id_pro_foreign` FOREIGN KEY (`pep_id_pro`) REFERENCES `produtos` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_produtos`
--

LOCK TABLES `pedido_produtos` WRITE;
/*!40000 ALTER TABLE `pedido_produtos` DISABLE KEYS */;
INSERT INTO `pedido_produtos` VALUES (242,2,200.00,2,1,10,'2022-03-07 19:48:09','2022-03-07 20:02:33',0.00),(243,3,30.00,2,3,10,'2022-03-07 19:48:15','2022-03-07 20:02:33',0.00),(244,7,595.00,2,1,11,'2022-03-07 20:02:52','2022-03-07 20:07:48',105.00),(245,8,80.00,2,3,11,'2022-03-07 20:02:55','2022-03-07 20:07:48',0.00),(246,3,300.00,2,2,11,'2022-03-07 20:07:41','2022-03-07 20:07:48',0.00),(248,3,300.00,2,1,12,'2022-03-07 20:43:10','2022-03-07 21:19:25',0.00),(249,4,40.00,2,3,12,'2022-03-07 21:15:48','2022-03-07 21:19:25',0.00),(250,0,0.00,2,1,13,'2022-03-08 21:53:38','2022-03-08 21:53:38',0.00),(251,0,0.00,2,3,13,'2022-03-08 21:53:42','2022-03-08 21:53:42',0.00),(252,0,0.00,2,2,13,'2022-03-08 21:53:45','2022-03-08 21:53:45',0.00);
/*!40000 ALTER TABLE `pedido_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `ped_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ped_valor_com_desconto` double(8,2) NOT NULL,
  `ped_valor_sem_desconto` double(8,2) NOT NULL,
  `ped_id_sta` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ped_id_use` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ped_id`),
  KEY `pedidos_ped_id_sta_foreign` (`ped_id_sta`),
  KEY `pedidos_ped_id_use_foreign` (`ped_id_use`),
  CONSTRAINT `pedidos_ped_id_sta_foreign` FOREIGN KEY (`ped_id_sta`) REFERENCES `status` (`sta_id`),
  CONSTRAINT `pedidos_ped_id_use_foreign` FOREIGN KEY (`ped_id_use`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (10,0.00,230.00,3,'2022-03-07 19:48:06','2022-03-07 20:02:39',10),(11,105.00,975.00,3,'2022-03-07 20:02:48','2022-03-07 20:07:50',10),(12,0.00,340.00,3,'2022-03-07 20:21:51','2022-03-07 21:19:31',10),(13,0.00,0.00,6,'2022-03-08 21:53:31','2022-03-08 21:53:31',10);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (29,'App\\User',9,'MozillaNetscapeWin32andersonxss@hotmail.com','41df398893f435be5cf9c0a305a7090e81b6f8f538285c1e9f8890172fe8fd85','[\"*\"]','2022-03-09 22:37:04','2022-03-09 16:26:41','2022-03-09 22:37:04');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_desconto`
--

DROP TABLE IF EXISTS `produto_desconto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_desconto` (
  `pro_des_id` int(10) unsigned NOT NULL,
  `des_pro_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `produto_desconto_pro_des_id_foreign` (`pro_des_id`),
  KEY `produto_desconto_des_pro_id_foreign` (`des_pro_id`),
  CONSTRAINT `produto_desconto_des_pro_id_foreign` FOREIGN KEY (`des_pro_id`) REFERENCES `descontos` (`des_id`),
  CONSTRAINT `produto_desconto_pro_des_id_foreign` FOREIGN KEY (`pro_des_id`) REFERENCES `produtos` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_desconto`
--

LOCK TABLES `produto_desconto` WRITE;
/*!40000 ALTER TABLE `produto_desconto` DISABLE KEYS */;
INSERT INTO `produto_desconto` VALUES (1,2,'2022-03-03 04:50:19','2022-03-03 04:50:19');
/*!40000 ALTER TABLE `produto_desconto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `pro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_quantidade` int(11) NOT NULL,
  `pro_valor` double(8,2) NOT NULL,
  `pro_id_sta` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `produtos_pro_id_sta_foreign` (`pro_id_sta`),
  CONSTRAINT `produtos_pro_id_sta_foreign` FOREIGN KEY (`pro_id_sta`) REFERENCES `status` (`sta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Abacaxi',57,100.00,1,'2022-03-03 04:06:23','2022-03-07 21:19:25'),(2,'Manga',97,100.00,1,'2022-03-03 04:08:03','2022-03-07 20:07:48'),(3,'Banana',81,10.00,1,'2022-03-03 04:08:24','2022-03-07 21:19:25');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `per_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `per_nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Administrador',NULL,NULL),(2,'Cliente',NULL,NULL);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `sta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sta_nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Ativo',NULL,NULL),(2,'Inativo',NULL,NULL),(3,'Paga',NULL,NULL),(4,'Cancelado',NULL,NULL),(5,'Em análise',NULL,NULL),(6,'Pendente',NULL,NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `use_id_per` int(10) unsigned NOT NULL,
  `use_id_sta` int(10) unsigned NOT NULL DEFAULT 1,
  `use_cpf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_use_id_per_foreign` (`use_id_per`),
  KEY `users_use_id_sta_foreign` (`use_id_sta`),
  CONSTRAINT `users_use_id_per_foreign` FOREIGN KEY (`use_id_per`) REFERENCES `profiles` (`per_id`),
  CONSTRAINT `users_use_id_sta_foreign` FOREIGN KEY (`use_id_sta`) REFERENCES `status` (`sta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'Cliente','cliente@gmail.com',NULL,'$2y$10$FL9OlocEqDQ9w6UeTRyO7O65E9hf4bsiFm0VcJ.U6aRdWxuepRhlC',NULL,NULL,NULL,2,1,'11111111111');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'estoque'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-09 22:10:42
