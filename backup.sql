-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tienda_digital_hc
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_user_id_foreign` (`user_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  KEY `cart_items_team_id_foreign` (`team_id`),
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_items_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collection_items`
--

DROP TABLE IF EXISTS `collection_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collection_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `collection_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `collection_items_collection_id_foreign` (`collection_id`),
  KEY `collection_items_product_id_foreign` (`product_id`),
  CONSTRAINT `collection_items_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `collection_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collection_items`
--

LOCK TABLES `collection_items` WRITE;
/*!40000 ALTER TABLE `collection_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `collection_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `collections_team_id_foreign` (`team_id`),
  CONSTRAINT `collections_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
INSERT INTO `collections` VALUES (1,'Summer Sale','Discounted products for the summer season.',NULL,'2025-05-25 01:36:43','2025-05-25 01:36:43',NULL),(2,'Best Sellers','Our most popular products.',NULL,'2025-05-25 01:36:43','2025-05-25 01:36:43',NULL),(3,'New Arrivals','Latest products added to our store.',NULL,'2025-05-25 01:36:43','2025-05-25 01:36:43',NULL),(4,'Gift Ideas','Perfect gifts for any occasion.',NULL,'2025-05-25 01:36:43','2025-05-25 01:36:43',NULL);
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connected_accounts`
--

DROP TABLE IF EXISTS `connected_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connected_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `avatar_path` text DEFAULT NULL,
  `token` varchar(1000) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(1000) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `connected_accounts_user_id_id_index` (`user_id`,`id`),
  KEY `connected_accounts_provider_provider_id_index` (`provider`,`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connected_accounts`
--

LOCK TABLES `connected_accounts` WRITE;
/*!40000 ALTER TABLE `connected_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `connected_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `valid_from` timestamp NULL DEFAULT NULL,
  `valid_until` timestamp NULL DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `min_purchase_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`),
  KEY `coupons_team_id_foreign` (`team_id`),
  CONSTRAINT `coupons_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_team_id_foreign` (`team_id`),
  CONSTRAINT `customers_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloadable_products`
--

DROP TABLE IF EXISTS `downloadable_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloadable_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `download_limit` int(11) NOT NULL,
  `expiration_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `downloadable_products_product_id_foreign` (`product_id`),
  KEY `downloadable_products_team_id_foreign` (`team_id`),
  CONSTRAINT `downloadable_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `downloadable_products_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloadable_products`
--

LOCK TABLES `downloadable_products` WRITE;
/*!40000 ALTER TABLE `downloadable_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `downloadable_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_team_id_foreign` (`team_id`),
  CONSTRAINT `groups_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_team_id_foreign` (`team_id`),
  CONSTRAINT `images_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_logs`
--

DROP TABLE IF EXISTS `inventory_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity_change` int(11) NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventory_logs_product_id_foreign` (`product_id`),
  CONSTRAINT `inventory_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_logs`
--

LOCK TABLES `inventory_logs` WRITE;
/*!40000 ALTER TABLE `inventory_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_order_id_foreign` (`order_id`),
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `icon` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Home','/',NULL,1,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(2,'Products','/products',NULL,2,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(3,'All Products','/products',2,1,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(4,'Categories','/products/categories',2,2,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(5,'New Arrivals','/products/new-arrivals',2,3,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(6,'Sale','/products/sale',2,4,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(7,'Shop','/shop',NULL,3,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(8,'Men','/shop/men',7,1,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(9,'Women','/shop/women',7,2,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(10,'Kids','/shop/kids',7,3,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(11,'Accessories','/shop/accessories',7,4,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(12,'Blog','/blog',NULL,4,'2025-05-25 01:36:40','2025-05-25 01:36:40',NULL,NULL),(13,'My Account','/account',NULL,5,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL),(14,'Profile','/account/profile',13,1,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL),(15,'Orders','/account/orders',13,2,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL),(16,'Wishlist','/wishlist',13,3,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL),(17,'About','/about',NULL,6,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL),(18,'Contact','/contact',NULL,7,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL),(19,'Cart','/cart',NULL,8,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL,NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_make_password_nullable_on_users_table',1),(3,'0001_01_01_000002_create_connected_accounts_table',1),(4,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(5,'2019_08_19_000000_create_failed_jobs_table',1),(6,'2020_05_21_100000_create_teams_table',1),(7,'2020_05_21_200000_create_team_user_table',1),(8,'2020_05_21_300000_create_team_invitations_table',1),(9,'2022_09_26_113707_create_product_categories_table',1),(10,'2022_09_26_113708_create_products_table',1),(11,'2023_04_01_000000_create_downloadable_products_table',1),(12,'2023_04_01_000000_create_payment_methods_table',1),(13,'2023_04_01_000000_create_site_settings_table',1),(14,'2023_04_01_000001_create_ratings_table',1),(15,'2023_04_03_000000_create_reviews_table',1),(16,'2023_06_01_000000_create_wishlists_table',1),(17,'2023_09_26_010935_create_variations_table',1),(18,'2023_09_26_113743_create_customers_table',1),(19,'2023_09_26_113752_create_orders_table',1),(20,'2023_09_27_130936_create_cart_items_table',1),(21,'2023_09_28_010654_create_tags_table',1),(22,'2023_09_28_010821_create_images_table',1),(23,'2023_09_28_010933_create_product_images_table',1),(24,'2023_09_28_011302_create_product_tag_table',1),(25,'2023_09_28_013747_create_product_variation_table',1),(26,'2023_09_28_014231_create_group_table',1),(27,'2023_09_28_014549_create_product_group_table',1),(28,'2023_09_28_015116_create_simple_product_table',1),(29,'2023_09_28_021219_create_product_rating_table',1),(30,'2023_09_28_021229_create_product_reviews_table',1),(31,'2023_09_28_132432_create_order_items_table',1),(32,'2023_09_30_151612_create_invoices_table',1),(33,'2023_10_01_000000_create_inventory_logs_table',1),(34,'2024_01_01_000010_create_coupons_table',1),(35,'2024_02_21_190705_create_permission_tables',1),(36,'2024_03_20_000000_add_pricing_type_to_products',1),(37,'2024_07_24_080000_create_menus_table',1),(38,'2024_09_09_152656_create_collections_table',1),(39,'2024_09_09_153154_create_collection_items_table',1),(40,'2024_09_25_110504_create_articles_table',1),(41,'2024_09_25_223311_create_pages_table',1),(42,'2024_09_29_093707_add_team_to_resources',1),(43,'[timestamp]_add_icon_to_menus_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `orderable_type` varchar(255) NOT NULL,
  `orderable_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price, 10, 2` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_orderable_type_orderable_id_index` (`orderable_type`,`orderable_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `shipping_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_team_id_foreign` (`team_id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `parent_page_id` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_parent_page_id_foreign` (`parent_page_id`),
  CONSTRAINT `pages_parent_page_id_foreign` FOREIGN KEY (`parent_page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_methods_user_id_foreign` (`user_id`),
  KEY `payment_methods_team_id_foreign` (`team_id`),
  CONSTRAINT `payment_methods_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_cart::item','web','2024-09-04 19:12:04','2024-09-04 19:12:04'),(2,'view_any_cart::item','web','2024-09-04 19:12:05','2024-09-04 19:12:05'),(3,'create_cart::item','web','2024-09-04 19:12:05','2024-09-04 19:12:05'),(4,'update_cart::item','web','2024-09-04 19:12:05','2024-09-04 19:12:05'),(5,'restore_cart::item','web','2024-09-04 19:12:05','2024-09-04 19:12:05'),(6,'restore_any_cart::item','web','2024-09-04 19:12:05','2024-09-04 19:12:05'),(7,'replicate_cart::item','web','2024-09-04 19:12:05','2024-09-04 19:12:05'),(8,'reorder_cart::item','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(9,'delete_cart::item','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(10,'delete_any_cart::item','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(11,'force_delete_cart::item','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(12,'force_delete_any_cart::item','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(13,'view_customer','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(14,'view_any_customer','web','2024-09-04 19:12:06','2024-09-04 19:12:06'),(15,'create_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(16,'update_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(17,'restore_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(18,'restore_any_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(19,'replicate_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(20,'reorder_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(21,'delete_customer','web','2024-09-04 19:12:07','2024-09-04 19:12:07'),(22,'delete_any_customer','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(23,'force_delete_customer','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(24,'force_delete_any_customer','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(25,'view_group','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(26,'view_any_group','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(27,'create_group','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(28,'update_group','web','2024-09-04 19:12:08','2024-09-04 19:12:08'),(29,'restore_group','web','2024-09-04 19:12:09','2024-09-04 19:12:09'),(30,'restore_any_group','web','2024-09-04 19:12:09','2024-09-04 19:12:09'),(31,'replicate_group','web','2024-09-04 19:12:09','2024-09-04 19:12:09'),(32,'reorder_group','web','2024-09-04 19:12:09','2024-09-04 19:12:09'),(33,'delete_group','web','2024-09-04 19:12:10','2024-09-04 19:12:10'),(34,'delete_any_group','web','2024-09-04 19:12:10','2024-09-04 19:12:10'),(35,'force_delete_group','web','2024-09-04 19:12:10','2024-09-04 19:12:10'),(36,'force_delete_any_group','web','2024-09-04 19:12:10','2024-09-04 19:12:10'),(37,'view_invoice','web','2024-09-04 19:12:10','2024-09-04 19:12:10'),(38,'view_any_invoice','web','2024-09-04 19:12:10','2024-09-04 19:12:10'),(39,'create_invoice','web','2024-09-04 19:12:11','2024-09-04 19:12:11'),(40,'update_invoice','web','2024-09-04 19:12:11','2024-09-04 19:12:11'),(41,'restore_invoice','web','2024-09-04 19:12:11','2024-09-04 19:12:11'),(42,'restore_any_invoice','web','2024-09-04 19:12:11','2024-09-04 19:12:11'),(43,'replicate_invoice','web','2024-09-04 19:12:11','2024-09-04 19:12:11'),(44,'reorder_invoice','web','2024-09-04 19:12:11','2024-09-04 19:12:11'),(45,'delete_invoice','web','2024-09-04 19:12:12','2024-09-04 19:12:12'),(46,'delete_any_invoice','web','2024-09-04 19:12:12','2024-09-04 19:12:12'),(47,'force_delete_invoice','web','2024-09-04 19:12:12','2024-09-04 19:12:12'),(48,'force_delete_any_invoice','web','2024-09-04 19:12:12','2024-09-04 19:12:12'),(49,'view_order','web','2024-09-04 19:12:12','2024-09-04 19:12:12'),(50,'view_any_order','web','2024-09-04 19:12:12','2024-09-04 19:12:12'),(51,'create_order','web','2024-09-04 19:12:13','2024-09-04 19:12:13'),(52,'update_order','web','2024-09-04 19:12:13','2024-09-04 19:12:13'),(53,'restore_order','web','2024-09-04 19:12:13','2024-09-04 19:12:13'),(54,'restore_any_order','web','2024-09-04 19:12:13','2024-09-04 19:12:13'),(55,'replicate_order','web','2024-09-04 19:12:13','2024-09-04 19:12:13'),(56,'reorder_order','web','2024-09-04 19:12:14','2024-09-04 19:12:14'),(57,'delete_order','web','2024-09-04 19:12:14','2024-09-04 19:12:14'),(58,'delete_any_order','web','2024-09-04 19:12:14','2024-09-04 19:12:14'),(59,'force_delete_order','web','2024-09-04 19:12:14','2024-09-04 19:12:14'),(60,'force_delete_any_order','web','2024-09-04 19:12:14','2024-09-04 19:12:14'),(61,'view_order::item','web','2024-09-04 19:12:14','2024-09-04 19:12:14'),(62,'view_any_order::item','web','2024-09-04 19:12:15','2024-09-04 19:12:15'),(63,'create_order::item','web','2024-09-04 19:12:15','2024-09-04 19:12:15'),(64,'update_order::item','web','2024-09-04 19:12:15','2024-09-04 19:12:15'),(65,'restore_order::item','web','2024-09-04 19:12:15','2024-09-04 19:12:15'),(66,'restore_any_order::item','web','2024-09-04 19:12:15','2024-09-04 19:12:15'),(67,'replicate_order::item','web','2024-09-04 19:12:16','2024-09-04 19:12:16'),(68,'reorder_order::item','web','2024-09-04 19:12:16','2024-09-04 19:12:16'),(69,'delete_order::item','web','2024-09-04 19:12:16','2024-09-04 19:12:16'),(70,'delete_any_order::item','web','2024-09-04 19:12:16','2024-09-04 19:12:16'),(71,'force_delete_order::item','web','2024-09-04 19:12:16','2024-09-04 19:12:16'),(72,'force_delete_any_order::item','web','2024-09-04 19:12:16','2024-09-04 19:12:16'),(73,'view_product','web','2024-09-04 19:12:17','2024-09-04 19:12:17'),(74,'view_any_product','web','2024-09-04 19:12:17','2024-09-04 19:12:17'),(75,'create_product','web','2024-09-04 19:12:17','2024-09-04 19:12:17'),(76,'update_product','web','2024-09-04 19:12:17','2024-09-04 19:12:17'),(77,'restore_product','web','2024-09-04 19:12:17','2024-09-04 19:12:17'),(78,'restore_any_product','web','2024-09-04 19:12:18','2024-09-04 19:12:18'),(79,'replicate_product','web','2024-09-04 19:12:18','2024-09-04 19:12:18'),(80,'reorder_product','web','2024-09-04 19:12:18','2024-09-04 19:12:18'),(81,'delete_product','web','2024-09-04 19:12:18','2024-09-04 19:12:18'),(82,'delete_any_product','web','2024-09-04 19:12:19','2024-09-04 19:12:19'),(83,'force_delete_product','web','2024-09-04 19:12:19','2024-09-04 19:12:19'),(84,'force_delete_any_product','web','2024-09-04 19:12:19','2024-09-04 19:12:19'),(85,'view_product::category','web','2024-09-04 19:12:19','2024-09-04 19:12:19'),(86,'view_any_product::category','web','2024-09-04 19:12:19','2024-09-04 19:12:19'),(87,'create_product::category','web','2024-09-04 19:12:19','2024-09-04 19:12:19'),(88,'update_product::category','web','2024-09-04 19:12:20','2024-09-04 19:12:20'),(89,'restore_product::category','web','2024-09-04 19:12:20','2024-09-04 19:12:20'),(90,'restore_any_product::category','web','2024-09-04 19:12:20','2024-09-04 19:12:20'),(91,'replicate_product::category','web','2024-09-04 19:12:20','2024-09-04 19:12:20'),(92,'reorder_product::category','web','2024-09-04 19:12:20','2024-09-04 19:12:20'),(93,'delete_product::category','web','2024-09-04 19:12:20','2024-09-04 19:12:20'),(94,'delete_any_product::category','web','2024-09-04 19:12:21','2024-09-04 19:12:21'),(95,'force_delete_product::category','web','2024-09-04 19:12:21','2024-09-04 19:12:21'),(96,'force_delete_any_product::category','web','2024-09-04 19:12:21','2024-09-04 19:12:21'),(97,'view_product::rating','web','2024-09-04 19:12:21','2024-09-04 19:12:21'),(98,'view_any_product::rating','web','2024-09-04 19:12:21','2024-09-04 19:12:21'),(99,'create_product::rating','web','2024-09-04 19:12:22','2024-09-04 19:12:22'),(100,'update_product::rating','web','2024-09-04 19:12:22','2024-09-04 19:12:22'),(101,'restore_product::rating','web','2024-09-04 19:12:22','2024-09-04 19:12:22'),(102,'restore_any_product::rating','web','2024-09-04 19:12:22','2024-09-04 19:12:22'),(103,'replicate_product::rating','web','2024-09-04 19:12:22','2024-09-04 19:12:22'),(104,'reorder_product::rating','web','2024-09-04 19:12:22','2024-09-04 19:12:22'),(105,'delete_product::rating','web','2024-09-04 19:12:23','2024-09-04 19:12:23'),(106,'delete_any_product::rating','web','2024-09-04 19:12:23','2024-09-04 19:12:23'),(107,'force_delete_product::rating','web','2024-09-04 19:12:23','2024-09-04 19:12:23'),(108,'force_delete_any_product::rating','web','2024-09-04 19:12:23','2024-09-04 19:12:23'),(109,'view_product::review','web','2024-09-04 19:12:23','2024-09-04 19:12:23'),(110,'view_any_product::review','web','2024-09-04 19:12:23','2024-09-04 19:12:23'),(111,'create_product::review','web','2024-09-04 19:12:24','2024-09-04 19:12:24'),(112,'update_product::review','web','2024-09-04 19:12:24','2024-09-04 19:12:24'),(113,'restore_product::review','web','2024-09-04 19:12:24','2024-09-04 19:12:24'),(114,'restore_any_product::review','web','2024-09-04 19:12:24','2024-09-04 19:12:24'),(115,'replicate_product::review','web','2024-09-04 19:12:24','2024-09-04 19:12:24'),(116,'reorder_product::review','web','2024-09-04 19:12:24','2024-09-04 19:12:24'),(117,'delete_product::review','web','2024-09-04 19:12:25','2024-09-04 19:12:25'),(118,'delete_any_product::review','web','2024-09-04 19:12:25','2024-09-04 19:12:25'),(119,'force_delete_product::review','web','2024-09-04 19:12:25','2024-09-04 19:12:25'),(120,'force_delete_any_product::review','web','2024-09-04 19:12:25','2024-09-04 19:12:25'),(121,'view_product::tag','web','2024-09-04 19:12:25','2024-09-04 19:12:25'),(122,'view_any_product::tag','web','2024-09-04 19:12:25','2024-09-04 19:12:25'),(123,'create_product::tag','web','2024-09-04 19:12:26','2024-09-04 19:12:26'),(124,'update_product::tag','web','2024-09-04 19:12:26','2024-09-04 19:12:26'),(125,'restore_product::tag','web','2024-09-04 19:12:26','2024-09-04 19:12:26'),(126,'restore_any_product::tag','web','2024-09-04 19:12:26','2024-09-04 19:12:26'),(127,'replicate_product::tag','web','2024-09-04 19:12:26','2024-09-04 19:12:26'),(128,'reorder_product::tag','web','2024-09-04 19:12:26','2024-09-04 19:12:26'),(129,'delete_product::tag','web','2024-09-04 19:12:27','2024-09-04 19:12:27'),(130,'delete_any_product::tag','web','2024-09-04 19:12:27','2024-09-04 19:12:27'),(131,'force_delete_product::tag','web','2024-09-04 19:12:27','2024-09-04 19:12:27'),(132,'force_delete_any_product::tag','web','2024-09-04 19:12:27','2024-09-04 19:12:27'),(133,'view_simple::product','web','2024-09-04 19:12:27','2024-09-04 19:12:27'),(134,'view_any_simple::product','web','2024-09-04 19:12:27','2024-09-04 19:12:27'),(135,'create_simple::product','web','2024-09-04 19:12:28','2024-09-04 19:12:28'),(136,'update_simple::product','web','2024-09-04 19:12:28','2024-09-04 19:12:28'),(137,'restore_simple::product','web','2024-09-04 19:12:28','2024-09-04 19:12:28'),(138,'restore_any_simple::product','web','2024-09-04 19:12:28','2024-09-04 19:12:28'),(139,'replicate_simple::product','web','2024-09-04 19:12:29','2024-09-04 19:12:29'),(140,'reorder_simple::product','web','2024-09-04 19:12:29','2024-09-04 19:12:29'),(141,'delete_simple::product','web','2024-09-04 19:12:29','2024-09-04 19:12:29'),(142,'delete_any_simple::product','web','2024-09-04 19:12:30','2024-09-04 19:12:30'),(143,'force_delete_simple::product','web','2024-09-04 19:12:30','2024-09-04 19:12:30'),(144,'force_delete_any_simple::product','web','2024-09-04 19:12:30','2024-09-04 19:12:30'),(145,'page_EditProfile','web','2024-09-04 19:12:30','2024-09-04 19:12:30'),(146,'page_PersonalAccessTokensPage','web','2024-09-04 19:12:31','2024-09-04 19:12:31'),(147,'page_UpdateProfileInformationPage','web','2024-09-04 19:12:31','2024-09-04 19:12:31'),(148,'view_coupon','web','2024-09-04 19:20:23','2024-09-04 19:20:23'),(149,'view_any_coupon','web','2024-09-04 19:20:23','2024-09-04 19:20:23'),(150,'create_coupon','web','2024-09-04 19:20:23','2024-09-04 19:20:23'),(151,'update_coupon','web','2024-09-04 19:20:23','2024-09-04 19:20:23'),(152,'restore_coupon','web','2024-09-04 19:20:23','2024-09-04 19:20:23'),(153,'restore_any_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(154,'replicate_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(155,'reorder_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(156,'delete_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(157,'delete_any_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(158,'force_delete_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(159,'force_delete_any_coupon','web','2024-09-04 19:20:24','2024-09-04 19:20:24'),(160,'view_store','web','2024-09-04 19:20:25','2024-09-04 19:20:25'),(161,'view_any_store','web','2024-09-04 19:20:25','2024-09-04 19:20:25'),(162,'create_store','web','2024-09-04 19:20:25','2024-09-04 19:20:25'),(163,'update_store','web','2024-09-04 19:20:25','2024-09-04 19:20:25'),(164,'restore_store','web','2024-09-04 19:20:25','2024-09-04 19:20:25'),(165,'restore_any_store','web','2024-09-04 19:20:25','2024-09-04 19:20:25'),(166,'replicate_store','web','2024-09-04 19:20:26','2024-09-04 19:20:26'),(167,'reorder_store','web','2024-09-04 19:20:26','2024-09-04 19:20:26'),(168,'delete_store','web','2024-09-04 19:20:26','2024-09-04 19:20:26'),(169,'delete_any_store','web','2024-09-04 19:20:26','2024-09-04 19:20:26'),(170,'force_delete_store','web','2024-09-04 19:20:26','2024-09-04 19:20:26'),(171,'force_delete_any_store','web','2024-09-04 19:20:26','2024-09-04 19:20:26');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_category_id` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_slug_unique` (`slug`),
  KEY `product_categories_parent_category_id_foreign` (`parent_category_id`),
  KEY `product_categories_team_id_foreign` (`team_id`),
  CONSTRAINT `product_categories_parent_category_id_foreign` FOREIGN KEY (`parent_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_categories_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Sedans','sedans',NULL,'Comfortable family cars.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(2,'SUVs','suvs',NULL,'Spacious off-road vehicles.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(3,'Trucks','trucks',NULL,'Heavy-duty trucks for work and travel.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(4,'Electric Cars','electric',NULL,'Eco-friendly electric vehicles.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(5,'Hybrid Cars','hybrid',NULL,'Hybrid vehicles with fuel and electric power.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(6,'Luxury Cars','luxury',NULL,'Premium cars with luxurious features.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(7,'Car Parts & Accessories','car-parts-accessories',NULL,'All types of car parts including wheels, brakes, engines, and more.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL),(8,'Motorcycles','motorcycles',NULL,'Two-wheeled vehicles for various purposes.',NULL,'2025-05-25 01:36:41','2025-05-25 01:36:41',NULL);
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_group`
--

DROP TABLE IF EXISTS `product_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `group_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_group_product_id_foreign` (`product_id`),
  KEY `product_group_group_id_foreign` (`group_id`),
  CONSTRAINT `product_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `product_group_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_group`
--

LOCK TABLES `product_group` WRITE;
/*!40000 ALTER TABLE `product_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_rating`
--

DROP TABLE IF EXISTS `product_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_rating` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_rating_product_id_foreign` (`product_id`),
  KEY `product_rating_customer_id_foreign` (`customer_id`),
  CONSTRAINT `product_rating_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `product_rating_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_rating`
--

LOCK TABLES `product_rating` WRITE;
/*!40000 ALTER TABLE `product_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comments` text NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_reviews_product_id_foreign` (`product_id`),
  KEY `product_reviews_customer_id_foreign` (`customer_id`),
  KEY `product_reviews_team_id_foreign` (`team_id`),
  CONSTRAINT `product_reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_reviews_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_tag`
--

DROP TABLE IF EXISTS `product_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `tag_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_tag_product_id_foreign` (`product_id`),
  KEY `product_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_tag`
--

LOCK TABLES `product_tag` WRITE;
/*!40000 ALTER TABLE `product_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variation`
--

DROP TABLE IF EXISTS `product_variation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `variation_id` bigint(20) unsigned DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variation_product_id_foreign` (`product_id`),
  CONSTRAINT `product_variation_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variation`
--

LOCK TABLES `product_variation` WRITE;
/*!40000 ALTER TABLE `product_variation` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `is_variable` tinyint(1) NOT NULL DEFAULT 0,
  `is_grouped` tinyint(1) NOT NULL DEFAULT 0,
  `is_simple` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `featured_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pricing_type` enum('fixed','free','donation') NOT NULL DEFAULT 'fixed',
  `suggested_price` decimal(10,2) DEFAULT NULL,
  `minimum_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_team_id_foreign` (`team_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Toyota Camry',24999.99,'Reliable and fuel-efficient family sedan.','Ipsam soluta minima reiciendis distinctio. Consequatur ab similique distinctio nihil exercitationem similique ab in. Quasi similique rerum rem distinctio placeat.',1,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:41','2025-05-25 01:36:41','fixed',NULL,0.00,NULL),(2,'Honda Accord',26999.99,'Sleek design with excellent safety features.','Voluptas ipsum odio placeat est. Error molestiae ea quasi praesentium. Assumenda consequatur rerum corrupti soluta quae molestiae.',1,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:41','2025-05-25 01:36:41','fixed',NULL,0.00,NULL),(3,'Nissan Altima',23999.99,'Stylish sedan with advanced driver-assist features.','Voluptatum est ipsa eum distinctio porro ipsam. Vel eaque iure nisi laboriosam ut repudiandae hic. Quasi quos necessitatibus omnis corrupti soluta voluptas.',1,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:41','2025-05-25 01:36:41','fixed',NULL,0.00,NULL),(4,'Hyundai Sonata',22999.99,'Comfortable midsize sedan with a tech-packed interior.','In dolores et aut et enim quis. Sunt delectus vel hic nam et laborum. Et velit qui dicta consequuntur. Autem officia cupiditate et aut et quis non.',1,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:41','2025-05-25 01:36:41','fixed',NULL,0.00,NULL),(5,'Mazda 6',24999.99,'Sporty sedan with excellent handling and efficiency.','Rem corrupti in iste voluptas aut a. Eos odio qui qui recusandae. Est culpa numquam molestiae ipsa sit repellat cumque. Rerum expedita possimus aut.',1,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(6,'Ford Explorer',39999.99,'Spacious and powerful SUV for off-road and family trips.','Labore ipsa excepturi maiores illum. Esse maxime perspiciatis laborum velit. Ea quod eaque quos fugiat commodi vel. Natus nemo omnis perferendis.',2,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(7,'Jeep Wrangler',34999.99,'Rugged off-road performance with an iconic design.','Quos neque nisi quibusdam laudantium quia aut consequatur quia. Ratione nobis libero non est sapiente perspiciatis est. Qui maxime ut voluptatem sint sed perferendis assumenda.',2,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(8,'Toyota RAV4',30999.99,'Compact SUV with hybrid options and excellent fuel economy.','Corporis laboriosam omnis est. Aut eius voluptas dignissimos ut facilis saepe. Quisquam animi deserunt quas harum voluptates cumque animi.',2,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(9,'Honda CR-V',32999.99,'Spacious and safe SUV with a smooth ride.','Architecto sed qui similique impedit expedita. Dolor fugit et non iste ea. Maxime aut delectus dolorem corrupti in.',2,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(10,'Chevrolet Tahoe',49999.99,'Large full-size SUV with plenty of space and towing power.','Quae a placeat nisi aut repellendus. Nesciunt aspernatur eum nihil aut repellat modi sed voluptatem. Impedit odio dolorem voluptas error modi eum et ad. Quas ut animi et assumenda eveniet quia quia.',2,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(11,'Ford F-150',45999.99,'Best-selling full-size truck with superior towing capacity.','Ratione perspiciatis aperiam dolore quo rem et. Nesciunt facilis nisi et dolores tempora et est qui. Non voluptas reiciendis ipsum nulla. Quis cumque possimus iure repellat ut qui animi.',3,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(12,'Chevrolet Silverado',47999.99,'Heavy-duty truck with advanced features for towing.','In occaecati sint et eum officiis. Perferendis eos dolorem in dolorem. Odit iusto sapiente et minima. A accusamus sapiente exercitationem corrupti iste exercitationem similique dolores.',3,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(13,'Ram 1500',42999.99,'Powerful and comfortable truck with excellent towing.','Earum repellat reiciendis vitae sit ipsa. Suscipit sequi quasi non ut quis ipsam expedita. Alias dolorem cumque laborum. Et nulla ut vel aspernatur qui sed nobis.',3,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(14,'Toyota Tundra',46999.99,'Rugged truck with a reliable V8 engine.','Nihil libero sunt ut quis optio vel repudiandae quo. Officia ducimus est atque id perspiciatis eius expedita. Dicta voluptatem quibusdam sit nihil fuga. A harum voluptas quae fugit.',3,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(15,'GMC Sierra',48999.99,'Premium full-size truck with modern tech features.','Consequatur in repellat iste sint. Et ea alias porro id ea est. Illum temporibus ea nulla officia iusto harum. Maxime fugiat modi sit esse modi quo.',3,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(16,'Brake Pads Set',99.99,'Ceramic brake pads for sedans and SUVs.','Magni provident laudantium a sint. Voluptas corporis odit eligendi vel perferendis id sed a. Est tenetur cum molestiae et error sequi sunt.',7,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(17,'All-Season Tires',499.99,'Durable tires suitable for all weather conditions.','Maiores ea quidem ad beatae dolorem dignissimos et necessitatibus. Omnis accusantium enim voluptas perferendis et repellat. Est facere et deserunt minus placeat.',7,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(18,'Car Battery',149.99,'High-performance battery with a long lifespan.','Totam assumenda et quaerat reprehenderit ratione. Reiciendis tenetur et incidunt possimus laboriosam neque ipsum. Dolor perferendis maiores ea non rerum omnis tempora. Architecto illo eligendi deleniti inventore necessitatibus omnis animi.',7,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(19,'LED Headlights',59.99,'Bright, energy-efficient headlights for night driving.','Cupiditate nisi quo est fugiat ipsum iusto. Aut blanditiis dolores sit dicta provident ut. Distinctio nihil possimus cupiditate odio quo placeat odio. Reiciendis consectetur voluptatem quia necessitatibus labore sint et.',7,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(20,'Roof Rack',199.99,'Universal roof rack for luggage and equipment.','Officia voluptatem cupiditate numquam laboriosam ut rerum. Eos id est ut sint. Dolore adipisci tempore corrupti deserunt facere tempora ut delectus. Ut atque at eius voluptates ut.',7,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(21,'Tesla Model 3',39999.99,'Affordable electric car with great range and performance.','Et optio neque labore dolores ipsum dolorum excepturi voluptatem. Vel quis mollitia maxime sit voluptas. Modi corporis ea optio. Eos placeat eos soluta.',4,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(22,'Nissan Leaf',29999.99,'Compact electric vehicle with impressive efficiency.','At est fugit culpa qui recusandae omnis dolorem. Nulla corrupti dignissimos sit. Eligendi aliquid quisquam placeat perspiciatis minus aliquid.',4,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(23,'Chevrolet Bolt EV',31999.99,'Affordable electric car with a long driving range.','Dolore quod dolores dicta. Vero rerum veniam blanditiis deleniti autem dicta eum. Dolorum nostrum non distinctio enim possimus odit sapiente.',4,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(24,'Mercedes-Benz S-Class',109999.99,'Ultimate luxury sedan with cutting-edge technology.','Fugiat facilis deleniti at voluptatem est possimus expedita. Illo eos ipsam accusamus. Dolores alias suscipit assumenda laboriosam tenetur quia. Molestiae pariatur ipsum natus minima tenetur quaerat facilis.',6,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(25,'BMW 7 Series',99999.99,'Luxury sedan with a powerful engine and premium features.','Distinctio id soluta temporibus vel provident rerum non. Non amet et eum consequatur reiciendis. Quidem modi et est et quas aut vel repellendus.',6,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(26,'Audi A8',96999.99,'Sleek design with a spacious and high-tech interior.','Dolores placeat est quia. Doloribus aliquid veritatis quibusdam provident. Repellat et excepturi est ut veniam occaecati.',6,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(27,'Lexus LS',89999.99,'Luxury sedan combining comfort and performance.','Et ab omnis sunt officia. Voluptate incidunt optio dolor perferendis. Et harum nobis qui et aut nam. Numquam modi qui cumque est quas.',6,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(28,'Harley-Davidson Sportster',12999.99,'Iconic cruiser with great style and power.','Nisi nesciunt nobis facere voluptas qui. Eius quia in quae commodi.',8,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:42','2025-05-25 01:36:42','fixed',NULL,0.00,NULL),(29,'Yamaha YZF-R3',5499.99,'Compact sportbike with excellent performance for beginners.','Architecto autem rerum aut saepe et quas et aut. Cupiditate quod sunt dolores. Qui quisquam nulla expedita sint molestias aliquid. Voluptatem vel eaque iusto consequatur.',8,0,0,1,0,'https://via.placeholder.com/640x480.png/CCCCCC?text=No+image','2025-05-25 01:36:43','2025-05-25 01:36:43','fixed',NULL,0.00,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_product_id_foreign` (`product_id`),
  CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(7,1),(7,2),(8,1),(8,2),(9,1),(9,2),(10,1),(10,2),(11,1),(11,2),(12,1),(12,2),(13,1),(13,2),(14,1),(14,2),(15,1),(15,2),(16,1),(16,2),(17,1),(17,2),(18,1),(18,2),(19,1),(19,2),(20,1),(20,2),(21,1),(21,2),(22,1),(22,2),(23,1),(23,2),(24,1),(24,2),(25,1),(25,2),(26,1),(26,2),(27,1),(27,2),(28,1),(28,2),(29,1),(29,2),(30,1),(30,2),(31,1),(31,2),(32,1),(32,2),(33,1),(33,2),(34,1),(34,2),(35,1),(35,2),(36,1),(36,2),(37,1),(37,2),(38,1),(38,2),(39,1),(39,2),(40,1),(40,2),(41,1),(41,2),(42,1),(42,2),(43,1),(43,2),(44,1),(44,2),(45,1),(45,2),(46,1),(46,2),(47,1),(47,2),(48,1),(48,2),(49,1),(49,2),(50,1),(50,2),(51,1),(51,2),(52,1),(52,2),(53,1),(53,2),(54,1),(54,2),(55,1),(55,2),(56,1),(56,2),(57,1),(57,2),(58,1),(58,2),(59,1),(59,2),(60,1),(60,2),(61,1),(61,2),(62,1),(62,2),(63,1),(63,2),(64,1),(64,2),(65,1),(65,2),(66,1),(66,2),(67,1),(67,2),(68,1),(68,2),(69,1),(69,2),(70,1),(70,2),(71,1),(71,2),(72,1),(72,2),(73,1),(73,2),(74,1),(74,2),(75,1),(75,2),(76,1),(76,2),(77,1),(77,2),(78,1),(78,2),(79,1),(79,2),(80,1),(80,2),(81,1),(81,2),(82,1),(82,2),(83,1),(83,2),(84,1),(84,2),(85,1),(85,2),(86,1),(86,2),(87,1),(87,2),(88,1),(88,2),(89,1),(89,2),(90,1),(90,2),(91,1),(91,2),(92,1),(92,2),(93,1),(93,2),(94,1),(94,2),(95,1),(95,2),(96,1),(96,2),(97,1),(97,2),(98,1),(98,2),(99,1),(99,2),(100,1),(100,2),(101,1),(101,2),(102,1),(102,2),(103,1),(103,2),(104,1),(104,2),(105,1),(105,2),(106,1),(106,2),(107,1),(107,2),(108,1),(108,2),(109,1),(109,2),(110,1),(110,2),(111,1),(111,2),(112,1),(112,2),(113,1),(113,2),(114,1),(114,2),(115,1),(115,2),(116,1),(116,2),(117,1),(117,2),(118,1),(118,2),(119,1),(119,2),(120,1),(120,2),(121,1),(121,2),(122,1),(122,2),(123,1),(123,2),(124,1),(124,2),(125,1),(125,2),(126,1),(126,2),(127,1),(127,2),(128,1),(128,2),(129,1),(129,2),(130,1),(130,2),(131,1),(131,2),(132,1),(132,2),(133,1),(133,2),(134,1),(134,2),(135,1),(135,2),(136,1),(136,2),(137,1),(137,2),(138,1),(138,2),(139,1),(139,2),(140,1),(140,2),(141,1),(141,2),(142,1),(142,2),(143,1),(143,2),(144,1),(144,2),(145,1),(145,2),(146,1),(146,2),(147,1),(147,2),(148,1),(148,2),(149,1),(149,2),(150,1),(150,2),(151,1),(151,2),(152,1),(152,2),(153,1),(153,2),(154,1),(154,2),(155,1),(155,2),(156,1),(156,2),(157,1),(157,2),(158,1),(158,2),(159,1),(159,2),(160,1),(160,2),(161,1),(161,2),(162,1),(162,2),(163,1),(163,2),(164,1),(164,2),(165,1),(165,2),(166,1),(166,2),(167,1),(167,2),(168,1),(168,2),(169,1),(169,2),(170,1),(170,2),(171,1),(171,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2025-05-25 01:36:36','2025-05-25 01:36:36'),(2,'staff','web','2025-05-25 01:36:37','2025-05-25 01:36:37');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `simple_product`
--

DROP TABLE IF EXISTS `simple_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simple_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `simple_product_product_id_foreign` (`product_id`),
  CONSTRAINT `simple_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simple_product`
--

LOCK TABLES `simple_product` WRITE;
/*!40000 ALTER TABLE `simple_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `simple_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'name','Liberu Ecommerce',NULL,'2025-05-25 01:36:35','2025-05-25 01:36:35'),(2,'currency','£',NULL,'2025-05-25 01:36:35','2025-05-25 01:36:35'),(3,'default_language','en',NULL,'2025-05-25 01:36:35','2025-05-25 01:36:35'),(4,'address','123 Real Estate St, London, UK',NULL,'2025-05-25 01:36:35','2025-05-25 01:36:35'),(5,'country','United Kingdom',NULL,'2025-05-25 01:36:35','2025-05-25 01:36:35'),(6,'email','info@liberurealestate.com',NULL,'2025-05-25 01:36:35','2025-05-25 01:36:35');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_invitations`
--

DROP TABLE IF EXISTS `team_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`),
  UNIQUE KEY `team_invitations_token_unique` (`token`),
  CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_invitations`
--

LOCK TABLES `team_invitations` WRITE;
/*!40000 ALTER TABLE `team_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_user`
--

DROP TABLE IF EXISTS `team_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_user`
--

LOCK TABLES `team_user` WRITE;
/*!40000 ALTER TABLE `team_user` DISABLE KEYS */;
INSERT INTO `team_user` VALUES (1,1,1,NULL,'2025-05-25 01:36:40','2025-05-25 01:36:40'),(2,1,2,NULL,'2025-05-25 01:36:40','2025-05-25 01:36:40');
/*!40000 ALTER TABLE `team_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,1,'default',0,'2025-05-25 01:36:37','2025-05-25 01:36:37');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin@example.com','2025-05-25 01:36:38','$2y$12$H18NyDwcWwtHz5LAzmIqTOhBw9lXrqi7vHq8VICW9egbsUOTq4zJO',NULL,NULL,NULL,NULL,1,NULL,'2025-05-25 01:36:38','2025-05-25 01:36:40'),(2,'Staff User','staff@example.com','2025-05-25 01:36:40','$2y$12$OeA0excKNcpMkjSBEqEY2eq1ojdSc8peBzMWqOSmCS8F0nHUoPIQC',NULL,NULL,NULL,NULL,1,NULL,'2025-05-25 01:36:40','2025-05-25 01:36:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variations`
--

DROP TABLE IF EXISTS `variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variations`
--

LOCK TABLES `variations` WRITE;
/*!40000 ALTER TABLE `variations` DISABLE KEYS */;
/*!40000 ALTER TABLE `variations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `share_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  UNIQUE KEY `wishlists_share_token_unique` (`share_token`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  KEY `wishlists_team_id_foreign` (`team_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-24 22:09:03
