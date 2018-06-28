-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: dmtools
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `_class`
--

DROP TABLE IF EXISTS `_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `archetype` tinyint(1) DEFAULT '0',
  `parent_id` int(11) unsigned DEFAULT NULL,
  `magic_proficiency_type` int(11) unsigned DEFAULT NULL,
  `class_skill_proficiency` int(11) unsigned DEFAULT NULL,
  `hit_dice` varchar(255) NOT NULL,
  `first_level_hit_points` int(11) unsigned NOT NULL,
  `hit_points_per_level` varchar(255) NOT NULL,
  `hit_points_per_level_stable` int(11) NOT NULL,
  `caster_value` float DEFAULT NULL,
  `spell_ability_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_parent_id_class_id` (`parent_id`),
  KEY `_class_spell_ability_id_ability_id` (`spell_ability_id`),
  CONSTRAINT `_class_spell_ability_id_ability_id` FOREIGN KEY (`spell_ability_id`) REFERENCES `ability` (`id`),
  CONSTRAINT `class_parent_id_class_id` FOREIGN KEY (`parent_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_class`
--

LOCK TABLES `_class` WRITE;
/*!40000 ALTER TABLE `_class` DISABLE KEYS */;
INSERT INTO `_class` VALUES (1,'Ranger',NULL,NULL,2,3,'1d10',10,'1d10',6,0.5,5),(2,'Bard',0,NULL,2,3,'1d8',8,'1d8',5,1,6),(3,'Rogue',0,NULL,0,4,'1d8',8,'1d8',5,0.5,NULL),(4,'Thief',1,3,0,4,'1d8',8,'1d8',5,0.5,NULL),(5,'ОХОТНИК',1,1,2,3,'1d10',10,'1d10',6,0.5,5),(6,'Чародей',0,NULL,2,2,'1d6',6,'1d6',4,1,NULL),(7,'Волшебник',0,NULL,1,2,'1d6',6,'1d6',4,1,NULL),(9,'Друид',NULL,NULL,1,2,'1d8',8,'1d8',5,1,NULL),(10,'Паладин',NULL,NULL,1,2,'1d10',10,'1d10',6,0.5,6),(11,'Воин',0,NULL,0,2,'1d10',10,'10',6,0,4),(12,'ЧЕМПИОН',1,11,0,2,'1d10',10,'1d10',6,0,4),(13,'Трикстер',NULL,NULL,2,2,'1d8',8,'1d8',5,0.5,6),(14,'test_class',NULL,NULL,0,2,'1d8',10,'1d8',5,0,4),(15,'Друид(КРУГ ЛУНЫ)',1,9,1,2,'1d8',8,'1d8',5,1,5);
/*!40000 ALTER TABLE `_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ability`
--

DROP TABLE IF EXISTS `ability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ability` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` text,
  `name` varchar(255) NOT NULL,
  `nameID` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ability`
--

LOCK TABLES `ability` WRITE;
/*!40000 ALTER TABLE `ability` DISABLE KEYS */;
INSERT INTO `ability` VALUES (1,'Персонаж с высоким значением Ловкости, вероятно, будет гибким и стройным, в то время как персонаж с низким значением Ловкости может быть либо долговязым и неуклюжим, либо тяжелым, с толстыми, как сардельки, пальцами. ','Ловкость','DEX'),(2,'Высокое значение Силы обычно соответствует плотному или атлетичному телу, в то время как персонаж с низким значением Силы может быть худым или тучным.','Сила','STR'),(3,'Персонаж с высоким значением Телосложения обычно выглядит полным энергии, со здоровым блеском в глазах. Персонаж с низким значением Телосложения может быть болезненным или хилым.  ','Телосложение','CON'),(4,'Персонаж с высоким значением Интеллекта может быть очень любознательным и прилежным, в то время как персонаж с низким значением Интеллекта может разговаривать примитивно или легко забывать подробности. ','Интелект','INT'),(5,'Персонаж с высоким значением Мудрости проявляет рассудительность, сопереживание и имеет хорошее представление о происходящих вокруг событиях. Персонаж с низким значением Мудрости может быть рассеянным, безрассудным или забывчивым. ','Мудрость','WIS'),(6,'Персонаж с высоким значением Харизмы излучает уверенность, он привлекателен, имеет лидерские качества или способен запугать. Персонаж с низким значением Харизмы может быть воспринят как раздражающий, неубедительный или робкий. ','Харизма','CHA');
/*!40000 ALTER TABLE `ability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `armor_property`
--

DROP TABLE IF EXISTS `armor_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armor_property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned DEFAULT NULL,
  `type_id` int(11) unsigned DEFAULT NULL,
  `ac` int(11) unsigned DEFAULT NULL,
  `str` int(11) unsigned DEFAULT NULL,
  `stealth_disadvantage` tinyint(1) DEFAULT NULL,
  `dex_mod` tinyint(1) DEFAULT '1',
  `dex_mod_limit` smallint(6) DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `armor_property_item_id_items_id` (`item_id`),
  CONSTRAINT `armor_property_item_id_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armor_property`
--

LOCK TABLES `armor_property` WRITE;
/*!40000 ALTER TABLE `armor_property` DISABLE KEYS */;
INSERT INTO `armor_property` VALUES (1,2,2,2,NULL,0,0,NULL),(2,3,0,12,NULL,0,1,NULL),(3,4,0,11,NULL,0,1,NULL),(4,5,0,15,NULL,1,1,2),(5,6,0,18,15,1,0,NULL),(6,7,0,14,NULL,0,1,2),(7,45,2,0,0,0,0,NULL),(8,47,2,0,0,0,0,NULL),(9,89,2,0,0,0,0,NULL),(10,113,2,0,0,0,0,NULL),(11,114,1,2,0,0,0,NULL),(12,115,2,0,0,0,0,NULL),(13,126,0,13,NULL,0,1,NULL),(14,148,1,3,NULL,0,0,NULL),(15,149,0,13,NULL,0,1,NULL),(16,150,0,13,NULL,0,1,NULL),(17,159,0,13,NULL,0,1,2),(18,95,0,19,15,1,0,NULL),(19,97,2,1,NULL,0,0,NULL);
/*!40000 ALTER TABLE `armor_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `armor_type`
--

DROP TABLE IF EXISTS `armor_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armor_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `don` smallint(6) unsigned DEFAULT NULL,
  `don_time_type` smallint(6) unsigned DEFAULT NULL,
  `doff` smallint(6) unsigned DEFAULT NULL,
  `doff_time_type` smallint(6) unsigned DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `additional_ac` tinyint(1) DEFAULT NULL,
  `group` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armor_type`
--

LOCK TABLES `armor_type` WRITE;
/*!40000 ALTER TABLE `armor_type` DISABLE KEYS */;
INSERT INTO `armor_type` VALUES (1,'Light armor',1,0,1,0,'',0,0),(2,'Medium armor',5,0,1,0,'',0,0),(4,'Heavy armor',10,0,5,0,'',0,0),(5,'Shields',1,1,1,1,'',1,0),(13,'Non Metal, Light armor',NULL,NULL,NULL,NULL,'',NULL,1),(14,'Non Metal, Medium armor',NULL,NULL,NULL,NULL,'',NULL,1),(15,'Non Metal, Shield',NULL,NULL,NULL,NULL,'',NULL,1),(16,'Metallic',NULL,NULL,NULL,NULL,'',NULL,1);
/*!40000 ALTER TABLE `armor_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `armor_type_armor_rel`
--

DROP TABLE IF EXISTS `armor_type_armor_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armor_type_armor_rel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) unsigned DEFAULT NULL,
  `item_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `armor_type_armor_rel_type_id_armor_type_id` (`type_id`),
  KEY `armor_type_armor_rel_item_id_items_id` (`item_id`),
  CONSTRAINT `armor_type_armor_rel_item_id_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `armor_type_armor_rel_type_id_armor_type_id` FOREIGN KEY (`type_id`) REFERENCES `armor_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armor_type_armor_rel`
--

LOCK TABLES `armor_type_armor_rel` WRITE;
/*!40000 ALTER TABLE `armor_type_armor_rel` DISABLE KEYS */;
INSERT INTO `armor_type_armor_rel` VALUES (1,13,NULL),(2,13,NULL),(3,13,NULL),(4,14,NULL),(5,15,NULL),(6,16,NULL),(7,16,NULL),(8,16,NULL),(9,16,NULL),(10,16,NULL),(11,16,NULL),(12,16,NULL),(13,16,NULL),(14,16,NULL);
/*!40000 ALTER TABLE `armor_type_armor_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,'Админ',NULL,NULL,1517522930,1517522930),('user',1,'Юзер',NULL,NULL,1517522930,1517522930);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character`
--

DROP TABLE IF EXISTS `character`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `race_id` int(11) unsigned DEFAULT NULL,
  `exp` int(11) unsigned DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `max_hp` int(11) unsigned DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `icon_src` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `character_race_id_race_id` (`race_id`),
  KEY `character_player_id_user_id` (`player_id`),
  CONSTRAINT `character_player_id_user_id` FOREIGN KEY (`player_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character`
--

LOCK TABLES `character` WRITE;
/*!40000 ALTER TABLE `character` DISABLE KEYS */;
INSERT INTO `character` VALUES (1,7,94079,112,'Ройг',112,3,'http://i.imgur.com/6l39HoL.jpg?1'),(2,3,201063,373,'Эрдан',373,3,'http://pm1.narvii.com/6713/27eab26867a82c4ad9bdbe0504163a54eebe0fb3_00.jpg'),(3,9,NULL,13,'Живчик',13,NULL,''),(4,11,56327,83,'Арвис',83,3,'http://pre14.deviantart.net/8245/th/pre/i/2015/346/1/7/character_creations__gabriel__1888_by_elfsdeathbox360-d9fkb67.jpg'),(5,12,118654,185,'Латри',185,3,'https://i.pinimg.com/originals/96/c9/08/96c9086ff4d1637105cdeacf2ed87265.jpg'),(6,1,NULL,NULL,'Эдермат',NULL,NULL,''),(7,13,NULL,NULL,'Черный кот',NULL,3,''),(8,11,143349,218,'Луиза',218,3,'https://i.pinimg.com/originals/68/6c/bd/686cbd62c38deeaa98f74f6b810831c2.jpg'),(9,3,14415,38,'Терен Найло',38,3,'http://i65.tinypic.com/149m6uh.jpg'),(10,14,139504,136,'Рейган',136,3,'https://i.pinimg.com/736x/57/f5/c9/57f5c99d5771cb6516f72a38fa39d5ba--tabletop-rpg-fantasy-male.jpg'),(11,1,1,1,'test',1,1,'');
/*!40000 ALTER TABLE `character` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_ability`
--

DROP TABLE IF EXISTS `character_ability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_ability` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `ability_id` int(11) unsigned DEFAULT NULL,
  `value` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `character_ability_character_id_character_id` (`character_id`),
  CONSTRAINT `character_ability_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_ability`
--

LOCK TABLES `character_ability` WRITE;
/*!40000 ALTER TABLE `character_ability` DISABLE KEYS */;
INSERT INTO `character_ability` VALUES (1,1,1,22),(2,1,2,13),(3,1,3,12),(4,1,4,10),(5,1,5,8),(6,1,6,18),(7,2,1,18),(8,2,2,11),(9,2,3,16),(10,2,4,6),(11,2,5,17),(12,2,6,9),(13,4,1,13),(14,4,2,9),(15,4,3,15),(16,4,4,17),(17,4,5,10),(18,4,6,15),(19,5,1,16),(20,5,2,11),(21,5,3,16),(22,5,4,12),(23,5,5,12),(24,5,6,18),(25,8,1,9),(26,8,2,19),(27,8,3,13),(28,8,4,10),(29,8,5,15),(30,8,6,20),(31,9,1,14),(32,9,2,16),(33,9,3,13),(34,9,4,9),(35,9,5,12),(36,9,6,9),(37,10,1,20),(38,10,2,16),(39,10,3,10),(40,10,4,10),(41,10,5,10),(42,10,6,20),(43,11,1,1),(44,11,2,1),(45,11,3,1),(46,11,4,1),(47,11,5,1),(48,11,6,1),(49,7,1,NULL),(50,7,2,NULL),(51,7,3,NULL),(52,7,4,NULL),(53,7,5,NULL),(54,7,6,NULL);
/*!40000 ALTER TABLE `character_ability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_class`
--

DROP TABLE IF EXISTS `character_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  `level` int(11) unsigned DEFAULT NULL,
  `base_class` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `character_class_character_id_character_id` (`character_id`),
  KEY `character_class_class_id_class_id` (`class_id`),
  CONSTRAINT `character_class_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `character_class_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_class`
--

LOCK TABLES `character_class` WRITE;
/*!40000 ALTER TABLE `character_class` DISABLE KEYS */;
INSERT INTO `character_class` VALUES (1,1,4,11,1),(2,2,1,2,0),(3,4,6,3,0),(4,4,7,6,1),(5,5,2,12,1),(6,2,15,14,1),(7,8,10,14,1),(8,9,12,5,1),(9,10,13,13,1),(10,11,14,1,1),(11,11,13,12,0);
/*!40000 ALTER TABLE `character_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_items`
--

DROP TABLE IF EXISTS `character_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `item_id` int(11) unsigned DEFAULT NULL,
  `count` smallint(6) unsigned DEFAULT NULL,
  `equip` tinyint(1) DEFAULT '0',
  `sub_item_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `character_items_item_id_items_id` (`item_id`),
  KEY `character_items_character_id_character_id` (`character_id`),
  KEY `character_items_sub_item_id_character_items_id` (`sub_item_id`),
  CONSTRAINT `character_items_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `character_items_item_id_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `character_items_sub_item_id_character_items_id` FOREIGN KEY (`sub_item_id`) REFERENCES `character_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_items`
--

LOCK TABLES `character_items` WRITE;
/*!40000 ALTER TABLE `character_items` DISABLE KEYS */;
INSERT INTO `character_items` VALUES (2,2,2,1,1,NULL),(3,10,3,1,1,NULL),(6,10,8,1,1,NULL),(7,10,9,1,1,NULL),(8,3,10,1,0,NULL),(9,5,11,1,0,165),(10,2,12,5,0,15),(11,2,13,10,0,173),(13,2,15,2,0,89),(14,2,16,1,1,NULL),(15,2,17,1,1,NULL),(16,2,25,1,1,NULL),(17,4,16,1,1,NULL),(18,4,17,1,1,NULL),(19,4,18,0,0,18),(21,4,20,1,1,NULL),(22,2,18,1,0,15),(23,5,3,1,0,165),(24,10,17,1,1,NULL),(25,5,19,30,0,165),(26,1,30,1,0,139),(27,1,31,1,1,NULL),(28,7,32,1,1,NULL),(29,2,13,90,0,173),(31,4,34,1,1,NULL),(32,8,17,1,1,NULL),(33,1,26,1,0,139),(34,7,20,4,0,NULL),(35,5,35,1,0,165),(36,5,27,1,0,165),(39,1,18,7,0,139),(40,5,37,1,0,165),(44,4,15,1,0,130),(45,5,41,1,1,NULL),(46,5,42,1,0,45),(47,5,43,1,1,NULL),(48,7,44,1,0,NULL),(49,5,45,1,1,NULL),(51,5,47,1,0,165),(52,5,48,1,0,165),(53,5,49,1,0,165),(56,7,52,1,0,NULL),(57,7,53,1,0,NULL),(58,4,54,1,0,130),(59,4,55,1,0,130),(60,5,56,1,0,165),(61,7,57,1,0,NULL),(62,4,58,1,0,130),(63,8,59,1,0,32),(65,5,61,1,0,165),(67,5,63,1,0,165),(68,5,64,1,0,165),(69,5,65,1,0,165),(70,7,66,3,0,NULL),(71,5,16,1,1,NULL),(72,7,67,1,0,NULL),(73,7,68,2,0,NULL),(74,5,69,1,0,165),(75,5,70,1,1,NULL),(83,1,78,9,0,26),(89,2,41,1,1,NULL),(90,2,84,1,1,NULL),(91,2,85,1,1,NULL),(93,2,86,1,1,15),(94,2,70,1,1,NULL),(95,2,87,1,0,15),(96,2,88,1,0,15),(97,2,89,1,1,NULL),(98,2,90,1,0,15),(99,10,26,1,0,24),(100,2,27,1,0,15),(101,7,35,1,0,NULL),(102,7,28,10,0,NULL),(103,7,20,1,0,NULL),(104,3,21,1,0,NULL),(105,2,43,1,0,15),(106,2,91,1,0,15),(107,2,92,1,0,15),(108,2,93,1,0,15),(109,2,94,1,1,NULL),(110,8,95,1,1,NULL),(111,5,96,1,0,165),(112,4,97,1,1,NULL),(113,9,98,1,1,NULL),(114,6,99,1,0,NULL),(115,6,100,1,0,NULL),(116,7,101,1,0,NULL),(117,7,102,5,0,NULL),(118,7,103,3,0,NULL),(119,7,104,1,0,NULL),(120,7,105,6,0,NULL),(121,7,106,25,0,NULL),(122,5,21,3,0,165),(123,7,28,23,0,NULL),(124,7,107,1,0,NULL),(125,7,108,1,0,NULL),(126,7,11,1,1,NULL),(127,4,27,1,0,18),(128,4,26,1,0,18),(129,4,35,1,0,18),(130,4,109,1,1,NULL),(131,4,110,1,0,130),(132,4,111,1,0,130),(133,4,112,1,0,130),(135,9,6,1,1,NULL),(136,5,114,1,0,165),(139,1,17,1,1,NULL),(140,1,78,7,0,26),(141,1,109,1,1,NULL),(142,1,116,15,0,141),(143,1,117,1,1,141),(144,1,102,1,1,NULL),(145,10,102,1,1,NULL),(146,7,118,1,1,NULL),(148,2,120,1,0,15),(149,5,3,1,0,165),(150,2,121,1,1,NULL),(151,5,122,1,0,165),(152,5,123,1,1,NULL),(154,7,124,1,0,NULL),(155,7,102,1,1,NULL),(156,8,26,1,0,32),(157,2,13,20,0,173),(158,5,125,1,0,NULL),(159,5,126,1,1,NULL),(160,5,127,1,1,165),(161,2,133,1,1,NULL),(162,1,132,1,1,NULL),(163,5,131,1,1,NULL),(164,5,130,1,0,165),(165,5,129,1,1,NULL),(166,5,128,1,0,NULL),(168,5,135,1,0,165),(169,2,136,1,0,NULL),(171,1,115,1,1,NULL),(172,1,134,1,1,NULL),(173,2,138,1,1,NULL),(174,5,139,1,0,165),(175,5,140,1,1,165),(177,5,142,1,1,NULL),(179,5,144,1,0,165),(180,5,145,1,0,165),(181,10,146,1,1,NULL),(182,5,147,1,1,NULL),(183,8,148,1,1,NULL),(184,2,149,1,1,NULL),(185,1,150,1,1,NULL),(186,8,151,1,1,NULL),(187,2,152,1,0,15),(188,5,153,1,0,45),(189,1,154,1,0,141),(190,2,155,1,0,93),(192,5,157,1,0,165),(193,5,158,1,0,165),(194,5,159,1,0,165),(195,5,160,1,0,165),(196,9,121,1,1,NULL),(197,9,11,1,1,NULL),(198,9,17,1,1,NULL),(199,5,26,1,0,165),(200,9,27,1,0,198),(201,9,35,1,0,198),(202,9,28,10,0,198),(203,9,18,5,0,198),(204,9,20,1,0,198),(205,9,21,1,0,198),(206,9,13,20,0,197),(207,9,16,1,1,NULL),(208,9,101,1,0,198),(209,2,161,1,1,NULL),(210,5,162,1,0,165),(211,5,163,1,0,166),(212,5,164,1,0,166),(214,5,166,1,1,NULL),(215,5,167,15,0,165),(216,5,168,45,0,165),(217,5,18,20,0,165),(218,5,171,4,0,45),(219,5,170,0,0,45),(220,5,172,2,0,45),(221,1,168,2,0,26),(222,8,172,1,0,32),(224,5,173,1,0,165),(225,5,174,1,0,165),(226,1,18,3,0,139),(227,2,18,3,0,15),(228,4,18,3,0,18),(229,5,18,3,0,165),(230,8,18,3,0,32),(231,9,18,3,0,198),(232,10,18,3,0,24),(233,5,175,1,0,166);
/*!40000 ALTER TABLE `character_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_money`
--

DROP TABLE IF EXISTS `character_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `currency_type_id` int(11) unsigned DEFAULT NULL,
  `count` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `character_money_currency_type_id_currency_id` (`currency_type_id`),
  KEY `character_money_character_id_character_id` (`character_id`),
  CONSTRAINT `character_money_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `character_money_currency_type_id_currency_id` FOREIGN KEY (`currency_type_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_money`
--

LOCK TABLES `character_money` WRITE;
/*!40000 ALTER TABLE `character_money` DISABLE KEYS */;
INSERT INTO `character_money` VALUES (2,5,1,0),(3,5,2,12),(4,5,3,0),(5,5,4,1),(6,5,5,81),(7,2,1,31),(8,2,2,14),(9,2,3,9),(10,2,4,0),(11,2,5,23),(12,1,1,49),(13,1,2,25),(14,1,3,12),(15,1,4,13),(16,1,5,1),(17,8,1,1),(18,8,2,9),(19,8,3,1),(20,8,4,5),(21,8,5,0),(22,9,4,5);
/*!40000 ALTER TABLE `character_money` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_party`
--

DROP TABLE IF EXISTS `character_party`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_party` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `party_identifier` varchar(255) NOT NULL,
  `party_leader` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_character_party_leader` (`character_id`,`party_identifier`,`party_leader`),
  CONSTRAINT `character_party_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_party`
--

LOCK TABLES `character_party` WRITE;
/*!40000 ALTER TABLE `character_party` DISABLE KEYS */;
INSERT INTO `character_party` VALUES (1,1,'Команда Латри',0),(6,2,'Команда Латри',0),(18,2,'Эрдан',1),(13,4,'Команда Латри',0),(16,4,'Латри party',0),(4,5,'Команда Латри',1),(14,5,'Латри party',1),(5,8,'Команда Латри',0),(17,8,'Луиза',1),(10,9,'Команда Латри',0),(11,10,'Команда Латри',0),(15,10,'Латри party',0);
/*!40000 ALTER TABLE `character_party` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_skill`
--

DROP TABLE IF EXISTS `character_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_skill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `skill_id` int(11) unsigned DEFAULT NULL,
  `proficiency` tinyint(1) DEFAULT '0',
  `expertise` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `character_skill_character_id_character_id` (`character_id`),
  KEY `character_skill_skill_id_skill_id` (`skill_id`),
  CONSTRAINT `character_skill_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `character_skill_skill_id_skill_id` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_skill`
--

LOCK TABLES `character_skill` WRITE;
/*!40000 ALTER TABLE `character_skill` DISABLE KEYS */;
INSERT INTO `character_skill` VALUES (19,1,17,1,1),(20,1,18,1,1),(21,1,11,1,1),(22,1,14,1,0),(23,1,16,1,1),(24,1,9,1,0),(25,2,15,1,0),(26,2,9,1,0),(27,2,10,1,0),(28,2,7,1,0),(29,2,18,1,0),(30,2,6,1,0),(31,4,1,1,0),(32,4,5,1,0),(33,5,16,1,0),(34,5,3,1,1),(35,5,15,0,0),(36,5,9,1,0),(37,5,10,0,0),(38,5,13,1,1),(39,5,12,1,0),(40,5,2,1,0),(41,5,17,0,0),(42,5,1,0,0),(43,5,8,1,0),(44,5,11,1,0),(45,5,4,0,0),(46,5,7,1,0),(47,5,5,1,0),(48,5,18,1,1),(49,5,14,1,1),(50,5,6,1,0),(51,4,2,1,0),(52,4,3,1,0),(53,8,8,1,0),(54,8,5,1,1),(55,8,14,1,0),(56,8,7,1,0),(57,8,2,1,0),(58,1,2,1,0),(59,9,10,1,0),(60,9,15,1,0),(61,9,5,1,0),(62,9,8,1,0),(63,10,11,1,1),(64,10,5,1,1),(65,10,17,1,0),(66,10,14,1,1),(67,10,16,1,1),(68,10,7,1,0);
/*!40000 ALTER TABLE `character_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_spell_points`
--

DROP TABLE IF EXISTS `character_spell_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_spell_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `spell_level` int(11) unsigned DEFAULT NULL,
  `spell_point` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `character_spell_points_character_id_character_id` (`character_id`),
  CONSTRAINT `character_spell_points_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_spell_points`
--

LOCK TABLES `character_spell_points` WRITE;
/*!40000 ALTER TABLE `character_spell_points` DISABLE KEYS */;
INSERT INTO `character_spell_points` VALUES (95,8,3,1),(96,5,1,4),(97,5,2,1);
/*!40000 ALTER TABLE `character_spell_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_talent`
--

DROP TABLE IF EXISTS `character_talent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_talent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `talent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `character_talent_character_id_character_id` (`character_id`),
  KEY `character_talent_talent_id_talent_id` (`talent_id`),
  CONSTRAINT `character_talent_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `character_talent_talent_id_talent_id` FOREIGN KEY (`talent_id`) REFERENCES `talent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_talent`
--

LOCK TABLES `character_talent` WRITE;
/*!40000 ALTER TABLE `character_talent` DISABLE KEYS */;
INSERT INTO `character_talent` VALUES (1,3,40),(2,2,43),(3,8,44),(6,8,53),(7,8,57),(8,8,58),(9,8,59),(10,5,1),(12,5,64),(13,4,67),(14,4,68),(15,2,74),(16,4,75),(17,8,76),(18,5,77),(23,2,83),(24,2,84),(25,2,85),(27,5,87),(28,5,88),(29,2,89),(31,5,91),(32,9,93),(33,9,104),(34,2,105),(35,10,106),(36,10,107),(37,2,108),(38,5,108),(39,8,108),(40,11,109),(41,1,108),(42,4,113),(43,4,114),(44,4,115);
/*!40000 ALTER TABLE `character_talent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_talent_used`
--

DROP TABLE IF EXISTS `character_talent_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_talent_used` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `character_id` int(11) unsigned DEFAULT NULL,
  `talent_id` int(11) unsigned DEFAULT NULL,
  `used` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `character_talent_used_character_id_character_id` (`character_id`),
  KEY `character_talent_used_talent_id_talent_id` (`talent_id`),
  CONSTRAINT `character_talent_used_character_id_character_id` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `character_talent_used_talent_id_talent_id` FOREIGN KEY (`talent_id`) REFERENCES `talent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_talent_used`
--

LOCK TABLES `character_talent_used` WRITE;
/*!40000 ALTER TABLE `character_talent_used` DISABLE KEYS */;
INSERT INTO `character_talent_used` VALUES (1,5,61,0),(2,2,83,0),(3,9,100,0),(4,10,106,0),(5,4,72,0),(6,10,111,0),(9,8,56,0);
/*!40000 ALTER TABLE `character_talent_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_armor_proficiency`
--

DROP TABLE IF EXISTS `class_armor_proficiency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_armor_proficiency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `armor_type_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_armor_proficiency_armor_type_id_armor_type_id` (`armor_type_id`),
  KEY `class_armor_proficiency_class_id_class_id` (`class_id`),
  CONSTRAINT `class_armor_proficiency_armor_type_id_armor_type_id` FOREIGN KEY (`armor_type_id`) REFERENCES `armor_type` (`id`),
  CONSTRAINT `class_armor_proficiency_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_armor_proficiency`
--

LOCK TABLES `class_armor_proficiency` WRITE;
/*!40000 ALTER TABLE `class_armor_proficiency` DISABLE KEYS */;
INSERT INTO `class_armor_proficiency` VALUES (1,1,2),(2,1,1),(3,2,1),(4,5,1),(5,1,3);
/*!40000 ALTER TABLE `class_armor_proficiency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_magic_level_point`
--

DROP TABLE IF EXISTS `class_magic_level_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_magic_level_point` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spell_level` int(11) unsigned DEFAULT NULL,
  `spell_point` int(11) unsigned DEFAULT NULL,
  `level` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_magic_level_point_class_id_class_id` (`class_id`),
  CONSTRAINT `class_magic_level_point_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_magic_level_point`
--

LOCK TABLES `class_magic_level_point` WRITE;
/*!40000 ALTER TABLE `class_magic_level_point` DISABLE KEYS */;
INSERT INTO `class_magic_level_point` VALUES (1,1,2,1,2),(2,1,3,2,2),(3,1,4,3,2),(4,2,2,3,2),(5,1,4,4,2),(6,2,3,4,2),(7,1,4,5,2),(8,2,3,5,2),(9,3,2,5,2),(10,1,4,6,2),(11,2,3,6,2),(12,3,3,6,2),(13,1,4,7,2),(14,2,3,7,2),(15,3,3,7,2),(16,4,1,7,2),(17,1,4,8,2),(18,2,3,8,2),(19,3,3,8,2),(20,4,2,8,2),(21,1,4,9,2),(22,2,3,9,2),(23,3,3,9,2),(24,4,3,9,2),(25,5,1,9,2),(26,1,4,10,2),(27,2,3,10,2),(28,3,3,10,2),(29,4,3,10,2),(30,5,2,10,2),(31,1,4,11,2),(32,2,3,11,2),(33,3,3,11,2),(34,4,3,11,2),(35,5,2,11,2),(36,6,1,11,2),(37,1,4,12,2),(38,2,3,12,2),(39,3,3,12,2),(40,4,3,12,2),(41,5,2,12,2),(42,6,1,12,2),(43,1,4,13,2),(44,2,3,13,2),(45,3,3,13,2),(46,4,3,13,2),(47,5,2,13,2),(48,6,1,13,2),(49,7,1,13,2),(50,1,4,14,2),(51,2,3,14,2),(52,3,3,14,2),(53,4,3,14,2),(54,5,2,14,2),(55,6,1,14,2),(56,7,1,14,2),(57,8,1,15,2),(58,7,1,15,2),(59,1,4,15,2),(60,2,3,15,2),(61,3,3,15,2),(62,4,3,15,2),(63,5,2,15,2),(64,6,1,15,2),(65,8,1,16,2),(66,7,1,16,2),(67,6,1,16,2),(68,5,2,16,2),(69,4,3,16,2),(70,3,3,16,2),(71,2,3,16,2),(72,1,4,16,2),(73,1,4,17,2),(74,1,4,18,2),(75,1,4,19,2),(76,1,4,20,2),(77,2,3,17,2),(78,3,3,17,2),(79,4,3,17,2),(80,5,2,17,2),(81,6,1,17,2),(82,7,1,17,2),(83,8,1,17,2),(84,9,1,17,2),(85,2,3,18,2),(86,2,3,19,2),(87,2,3,20,2),(88,3,3,20,2),(89,3,3,19,2),(90,3,3,18,2),(91,4,3,18,2),(92,4,3,19,2),(93,4,3,20,2),(94,5,3,18,2),(95,5,3,19,2),(96,5,3,20,2),(97,6,1,18,2),(98,6,2,19,2),(99,6,2,20,2),(100,7,1,18,2),(101,7,1,19,2),(102,7,2,20,2),(103,8,1,18,2),(104,8,1,19,2),(105,8,1,20,2),(106,9,1,18,2),(107,9,1,19,2),(108,9,1,20,2),(109,1,2,2,10),(110,1,3,3,10),(111,1,3,4,10),(112,1,4,5,10),(113,2,2,5,10),(114,1,4,6,10),(115,2,2,6,10),(116,1,4,7,10),(117,2,3,7,10),(118,1,4,8,10),(119,2,3,8,10),(120,1,4,9,10),(121,2,3,9,10),(122,3,2,9,10),(123,1,4,10,10),(124,2,3,10,10),(125,3,2,10,10),(126,1,4,11,10),(127,2,3,11,10),(128,3,3,11,10),(129,1,4,12,10),(130,2,3,12,10),(131,3,3,12,10),(132,1,4,13,10),(133,2,3,13,10),(134,3,3,13,10),(135,4,1,13,10),(136,1,4,14,10),(137,2,3,14,10),(138,3,3,14,10),(139,4,1,14,10),(140,1,4,15,10),(141,2,3,15,10),(142,3,3,15,10),(143,4,2,15,10),(144,1,4,16,10),(145,1,4,17,10),(146,1,4,18,10),(147,1,4,19,10),(148,1,4,20,10),(149,2,3,16,10),(150,3,3,17,10),(151,3,3,16,10),(152,2,3,17,10),(153,2,3,18,10),(154,2,3,19,10),(155,2,3,20,10),(156,3,3,18,10),(157,3,3,19,10),(158,3,3,20,10),(159,5,1,17,10),(160,5,1,18,10),(161,5,2,19,10),(162,5,2,20,10),(163,4,2,16,10),(164,4,3,17,10),(165,4,3,18,10),(166,4,3,19,10),(167,4,3,20,10);
/*!40000 ALTER TABLE `class_magic_level_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_magic_point`
--

DROP TABLE IF EXISTS `class_magic_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_magic_point` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spell_point` int(11) unsigned DEFAULT NULL,
  `level` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_magic_point_class_id_class_id` (`class_id`),
  CONSTRAINT `class_magic_point_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_magic_point`
--

LOCK TABLES `class_magic_point` WRITE;
/*!40000 ALTER TABLE `class_magic_point` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_magic_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_saving_throws`
--

DROP TABLE IF EXISTS `class_saving_throws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_saving_throws` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) unsigned DEFAULT NULL,
  `ability_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_saving_throws_ability_id_ability_id` (`ability_id`),
  KEY `class_saving_throws_class_id_class_id` (`class_id`),
  CONSTRAINT `class_saving_throws_ability_id_ability_id` FOREIGN KEY (`ability_id`) REFERENCES `ability` (`id`),
  CONSTRAINT `class_saving_throws_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_saving_throws`
--

LOCK TABLES `class_saving_throws` WRITE;
/*!40000 ALTER TABLE `class_saving_throws` DISABLE KEYS */;
INSERT INTO `class_saving_throws` VALUES (1,1,1),(2,1,2),(3,2,1),(4,2,6),(5,3,1),(6,3,4),(7,5,1),(8,5,2),(9,6,6),(10,6,3),(11,7,4),(12,7,5),(13,10,5),(14,10,6),(15,3,1),(16,3,4),(17,4,1),(18,4,4),(19,2,3),(20,12,2),(21,12,3),(22,11,2),(23,11,3),(24,13,1),(25,13,6);
/*!40000 ALTER TABLE `class_saving_throws` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_skill_proficiency`
--

DROP TABLE IF EXISTS `class_skill_proficiency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_skill_proficiency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_skill_proficiency_skill_id` (`skill_id`),
  KEY `class_skill_proficiency_class_id_class_id` (`class_id`),
  CONSTRAINT `class_skill_proficiency_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`),
  CONSTRAINT `class_skill_proficiency_skill_id` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_skill_proficiency`
--

LOCK TABLES `class_skill_proficiency` WRITE;
/*!40000 ALTER TABLE `class_skill_proficiency` DISABLE KEYS */;
INSERT INTO `class_skill_proficiency` VALUES (1,3,1),(2,15,1),(3,9,1),(4,10,1),(5,4,1),(6,7,1),(7,18,1),(8,6,1),(9,1,2),(10,2,2),(11,3,2),(12,4,2),(13,5,2),(14,6,2),(15,7,2),(16,8,2),(17,9,2),(18,10,2),(19,11,2),(20,12,2),(21,13,2),(22,14,2),(23,15,2),(24,16,2),(25,17,2),(26,18,2),(27,16,3),(28,3,3),(29,15,3),(30,9,3),(31,13,3),(32,12,3),(33,17,3),(34,11,3),(35,7,3),(36,18,3),(37,14,3),(38,12,6),(39,1,6),(40,11,6),(41,7,6),(42,5,6),(43,14,6),(44,3,7),(45,2,7),(46,1,7),(47,8,7),(48,5,7),(49,7,7);
/*!40000 ALTER TABLE `class_skill_proficiency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_talent`
--

DROP TABLE IF EXISTS `class_talent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_talent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) unsigned DEFAULT NULL,
  `talent_id` int(11) unsigned DEFAULT NULL,
  `level` int(11) unsigned NOT NULL,
  `property` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_talent_class_id_class_id` (`class_id`),
  KEY `class_talent_talent_id_talent_id` (`talent_id`),
  CONSTRAINT `class_talent_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`),
  CONSTRAINT `class_talent_talent_id_talent_id` FOREIGN KEY (`talent_id`) REFERENCES `talent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_talent`
--

LOCK TABLES `class_talent` WRITE;
/*!40000 ALTER TABLE `class_talent` DISABLE KEYS */;
INSERT INTO `class_talent` VALUES (11,3,37,2,NULL),(12,3,24,1,NULL),(13,4,26,3,NULL),(14,4,26,3,NULL),(15,4,34,9,NULL),(16,4,35,13,NULL),(17,4,36,17,NULL),(18,3,25,5,NULL),(19,3,28,7,NULL),(20,3,29,11,NULL),(21,3,30,14,NULL),(22,3,31,15,NULL),(23,3,32,18,NULL),(24,3,33,20,NULL),(25,4,27,3,NULL),(26,3,9,1,'1d6'),(27,3,9,3,'2d6'),(28,3,9,5,'3d6'),(29,3,9,7,'4d6'),(30,3,9,9,'5d6'),(31,3,9,11,'6d6'),(32,3,9,13,'7d6'),(33,3,9,15,'8d6'),(34,3,9,17,'9d6'),(35,3,9,19,'10d6'),(36,1,39,3,''),(37,1,38,5,''),(38,2,41,1,''),(39,2,42,2,''),(40,10,45,6,'10'),(41,10,48,6,'10'),(42,10,48,18,'30'),(43,10,49,3,''),(44,10,50,10,'10'),(45,10,50,18,'30'),(46,10,51,5,''),(47,10,52,2,''),(48,10,56,1,''),(51,2,61,10,'1d10'),(52,2,61,15,'1d12'),(53,2,62,5,''),(54,2,63,6,''),(55,2,65,2,'1d6'),(56,2,65,9,'1d8'),(57,2,65,13,'1d10'),(58,2,65,17,'1d12'),(59,10,66,1,'5'),(60,10,66,2,'10'),(61,10,66,3,'15'),(62,10,66,4,'20'),(63,10,66,5,'25'),(64,10,66,6,'30'),(65,10,66,7,'35'),(66,10,66,8,'40'),(67,10,66,9,'45'),(68,10,66,10,'50'),(69,7,69,1,''),(70,7,70,1,''),(71,6,71,1,''),(72,6,72,2,'2'),(73,6,72,3,'3'),(74,6,72,4,'4'),(75,9,73,1,''),(76,10,66,11,'55'),(77,10,66,12,'60'),(78,10,66,13,'65'),(79,10,92,11,''),(80,11,94,1,''),(81,12,95,3,''),(82,12,96,7,''),(83,12,97,10,''),(84,12,98,15,''),(85,12,99,18,''),(86,11,100,2,'1'),(87,11,100,17,'2'),(88,11,101,5,'1'),(89,11,101,11,'2'),(90,11,101,20,'3'),(91,11,102,9,'1'),(92,11,102,13,'2'),(93,11,102,17,'3'),(94,13,9,13,'7d6'),(95,13,9,15,'8d6'),(96,13,9,19,'10d6'),(97,14,110,1,''),(98,13,111,9,''),(99,6,112,3,'2'),(100,6,112,10,'3'),(101,6,112,13,'4'),(102,10,116,14,'{МОД_ХАР}'),(103,15,117,1,''),(104,15,118,10,''),(105,15,119,14,'');
/*!40000 ALTER TABLE `class_talent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_tools_proficiency`
--

DROP TABLE IF EXISTS `class_tools_proficiency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_tools_proficiency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) unsigned DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `tools_object_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_tools_proficiency_class_id_class_id` (`class_id`),
  CONSTRAINT `class_tools_proficiency_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_tools_proficiency`
--

LOCK TABLES `class_tools_proficiency` WRITE;
/*!40000 ALTER TABLE `class_tools_proficiency` DISABLE KEYS */;
INSERT INTO `class_tools_proficiency` VALUES (1,2,3,3),(2,3,1,3);
/*!40000 ALTER TABLE `class_tools_proficiency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_weapon_proficiency`
--

DROP TABLE IF EXISTS `class_weapon_proficiency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_weapon_proficiency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weapon_type_id` int(11) unsigned DEFAULT NULL,
  `class_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_weapon_proficiency_weapon_type_id_weapon_type_id` (`weapon_type_id`),
  KEY `class_weapon_proficiency_class_id_class_id` (`class_id`),
  CONSTRAINT `class_weapon_proficiency_class_id_class_id` FOREIGN KEY (`class_id`) REFERENCES `_class` (`id`),
  CONSTRAINT `class_weapon_proficiency_weapon_type_id_weapon_type_id` FOREIGN KEY (`weapon_type_id`) REFERENCES `weapon_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_weapon_proficiency`
--

LOCK TABLES `class_weapon_proficiency` WRITE;
/*!40000 ALTER TABLE `class_weapon_proficiency` DISABLE KEYS */;
INSERT INTO `class_weapon_proficiency` VALUES (1,1,2),(2,8,2),(3,10,2),(4,11,2),(5,12,2),(6,1,1),(7,2,1),(8,1,3),(9,12,3),(10,8,3),(11,11,3),(12,10,3);
/*!40000 ALTER TABLE `class_weapon_proficiency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(2) NOT NULL,
  `value_weight` float NOT NULL,
  `weight` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'Copper','cp',1,0.02),(2,'Silver','sp',10,0.02),(3,'Electrum','ep',50,0.02),(4,'Gold','gp',100,0.02),(5,'Platinum','pp',1000,0.02);
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_type` smallint(6) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `cost` float DEFAULT NULL,
  `currency_type_id` int(11) unsigned DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `description` text,
  `short_description` text,
  `packable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `items_currency_type_id_currency_id` (`currency_type_id`),
  CONSTRAINT `items_currency_type_id_currency_id` FOREIGN KEY (`currency_type_id`) REFERENCES `currency` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (2,2,'Наручи троля',NULL,NULL,0.5,'<p>Наручи из хвоста троля убитого следопытом Эрданом.</p>\r\n','<p>Наручи из хвоста троля.</p>\r\n',0),(3,2,'Проклёпанная кожа',45,4,13,'','',0),(4,2,'Кожаный',10,4,10,'','',0),(5,2,'Полулаты',750,4,40,'','',0),(6,2,'Латы',1500,4,65,'','',0),(7,2,'Кираса',400,4,20,'','',0),(8,1,'Рапира',25,4,2,'','',0),(9,1,'Кинжал',2,4,1,'','',0),(10,4,'Капкан',NULL,NULL,25,'','',0),(11,4,'Колчан',1,4,1,'','',1),(12,4,'Еловая ветка',NULL,NULL,0.2,'','',0),(13,5,'Стрела',5,1,0.05,'','',0),(14,5,'Отравленная стрела(2d6) Спас:11',NULL,NULL,0.05,'','',0),(15,4,'Зелье лечения(2d4+2)',50,4,0.5,'','',0),(16,4,'Одежда, дорожная',2,4,4,'','',0),(17,4,'Рюкзак',2,4,5,'','',1),(18,4,'Рационы',5,2,2,'','',0),(19,4,'Свеча',1,1,0.001,'','',0),(20,4,'Бурдюк',2,2,5,'','',0),(21,4,'Верёвка пеньковая (50 футов)',1,4,10,'','',0),(22,4,'Верёвка, шёлковая (50 футов)',10,4,5,'','',0),(23,4,'Ломик',2,4,5,'','',0),(24,4,'Лопата',2,4,5,'','',0),(25,4,'Металлические шарики (1 000 шт. в сумке)',1,4,2,'','',0),(26,4,'Спальник',1,4,7,'','',0),(27,4,'Столовый набор',2,2,1,'','',0),(28,4,'Факел',1,1,1,'','',0),(29,1,'Боевой посох',2,2,4,'','',0),(30,4,'Кошель',5,2,1,'','',1),(31,1,'Светоносный',NULL,NULL,2,'<p>Светится как факел когда этого захочет владелец.</p>\r\n\r\n<p>Когда меч светиться, он причиняет нежити дополнительный урон излучением <strong>1d6</strong></p>\r\n','<p>Светится как факел когда этого захочет владелец.</p>\r\n\r\n<p>Когда меч светиться, он причиняет нежити дополнительный урон излучением <strong>1d6</strong></p>\r\n',0),(32,1,'Короткий лук',25,4,2,'<p>Боеприпас (дис. 80/320), двуручное</p>\r\n','<p>Боеприпас (дис. 80/320), двуручное</p>\r\n',0),(33,1,'Рейган(рапира)',NULL,NULL,2,'<p>Когда пылает причиняет дополнительный урон <strong>2d6</strong></p>\r\n','<p>Когда пылает причиняет дополнительный урон <strong>2d6</strong></p>\r\n',0),(34,1,'Палочка волшебных стрел',NULL,NULL,1,'<p>Палочка волшебных стрел У этой волшебной палочки есть 7 зарядов. Когда палочка находится у вас в руке, вы можете действием выпустить из неё заклинание волшебная стрела, не тратя никаких компонентов, и расходуя от 1 до 3 зарядов. За каждый дополнительный заряд сверх первого уровень заклинания повышается на 1. Вы можете использовать эту палочку, даже если не способны накладывать заклинания. Палочка восстанавливает 1к6 + 1 израсходованных зарядов каждый день на рассвете. Если вы израсходовали последний заряд, бросьте к20. Если выпадет 1, палочка будет уничтожена и рассыплется в пепел.</p>\r\n','<p>Палочка волшебных стрел У этой волшебной палочки есть 7 зарядов. Когда палочка находится у вас в руке, вы можете действием выпустить из неё заклинание волшебная стрела, не тратя никаких компонентов, и расходуя от 1 до 3 зарядов. За каждый дополнительный заряд сверх первого уровень заклинания повышается на 1. Вы можете использовать эту палочку, даже если не способны накладывать заклинания. Палочка восстанавливает 1к6 + 1 израсходованных зарядов каждый день на рассвете. Если вы израсходовали последний заряд, бросьте к20. Если выпадет 1, палочка будет уничтожена и рассыплется в пепел.</p>\r\n',0),(35,4,'Трутница',5,2,1,'<p>В этом небольшом контейнере находится кремень, кресало и трут (обычно это сухая<br />\r\nтряпка, вымоченная в масле), используемые для<br />\r\nразжигания огня. Использование его для разжигания факела &mdash; или чего-нибудь другого, легковоспламеняющегося &mdash; требует одного действия. Разжигание другого огня требует 1 минуты.</p>\r\n','<p>В этом небольшом контейнере находится кремень, кресало и трут (обычно это сухая<br />\r\nтряпка, вымоченная в масле), используемые для<br />\r\nразжигания огня. Использование его для разжигания факела &mdash; или чего-нибудь другого, легковоспламеняющегося &mdash; требует одного действия. Разжигание другого огня требует 1 минуты.</p>\r\n',0),(36,4,'Шелковый мещочек',2,2,0.2,'','',1),(37,3,'набор для грима',25,4,3,'<p>Набор для грима. Этот набор косметики, красителей для волос и бутафории позволяет изменять<br />\r\nваш внешний облик. Владение этим набором позволяет добавлять бонус мастерства к проверкам<br />\r\nхарактеристик, совершённым для визуальной маскировки.</p>\r\n','<p>Набор для грима. Этот набор косметики, красителей для волос и бутафории позволяет изменять<br />\r\nваш внешний облик. Владение этим набором позволяет добавлять бонус мастерства к проверкам<br />\r\nхарактеристик, совершённым для визуальной маскировки.</p>\r\n',0),(38,4,'склянка с ртутью',NULL,NULL,0.2,'','',0),(39,4,'склянка с желчью дракона',NULL,NULL,0.2,'','',0),(40,4,'склянка с порошком паслена',NULL,NULL,0.2,'','',0),(41,4,'Сумка-пояс для зелий',NULL,NULL,1,'','',1),(42,4,'Зелье ясновидения',NULL,NULL,0.5,'<p>Закл. подсматривания</p>\r\n','<p>Закл. подсматривания</p>\r\n',0),(43,3,'Лютня',NULL,NULL,2,'','',0),(44,3,'Волынка',NULL,NULL,6,'','',0),(45,2,'Амулет с магическим кристалом',NULL,NULL,0.1,'<p>Позволяет хранить в себе заклинание и высвобождать его действием без использования компонентов</p>\r\n','<p>Позволяет хранить в себе заклинание и высвобождать его действием без использования компонентов</p>\r\n',0),(46,4,'Кулон - для связи с Эдвином',NULL,NULL,0.1,'','',0),(47,2,'Венец архидруида',NULL,NULL,1,'','',0),(48,4,'Карта Моря упавших звезд',NULL,NULL,NULL,'<p>Морская карта Моря Упавших звезд</p>\r\n','<p>Морская карта Моря Упавших звезд</p>\r\n',0),(49,4,'Судовой журнал Ордогена Рыжего (в отрезе льна)',NULL,NULL,1,'<p>Судовой журнал знаменитого пирата Ордогена Рыжего</p>\r\n','<p>Судовой журнал знаменитого пирата Ордогена Рыжего</p>\r\n',0),(50,4,'Долговая расписка на ферму в топях',NULL,NULL,NULL,'','',0),(51,4,'Купчая на землю в Топях',NULL,NULL,NULL,'','',0),(52,4,'Бухг. по поставкам в замок Руперштайна',NULL,NULL,NULL,'','',0),(53,4,'Журнал тактильный шрифт(от илитида в черных топях)',NULL,NULL,2,'','',0),(54,4,'Книга по истории',NULL,NULL,1,'','',0),(55,4,'Науч. изыск. о фаэрзеце',NULL,NULL,1,'','',0),(56,4,'Книга об истории падения дроу',NULL,NULL,1,'','',0),(57,4,'\"Расистская\" книга',NULL,NULL,1,'','',0),(58,4,'Дневник фон Руперштейна',NULL,NULL,1,'','',0),(59,4,'свиток возрождения',NULL,NULL,0.02,'<p>Заклинания Возрождение</p>\r\n','<p>Заклинания Возрождение</p>\r\n',0),(60,4,'свиток очарования личности',NULL,NULL,0.02,'','',0),(61,4,'свиток гадания',NULL,NULL,0.02,'','',0),(62,4,'карикатура вампира-огра-эльфа',NULL,NULL,NULL,'','',0),(63,4,'Писчее перо',NULL,NULL,NULL,'','',0),(64,4,'Книга Латри',NULL,NULL,2.5,'','',0),(65,4,'Чернила 30 гр.',NULL,NULL,0.05,'','',0),(66,4,'Плащ красноклейменного',NULL,NULL,0.4,'','',0),(67,4,'Одеяние из золотой парчи',NULL,NULL,3,'','',0),(68,4,'Костюм',NULL,NULL,3,'','',0),(69,4,'Черная бархатная маска, вышитая серебрянной нитью',NULL,NULL,0.04,'','',0),(70,4,'повязка на лицо',NULL,NULL,0.02,'','',0),(71,4,'бриллиант(300зм)',300,4,0.1,'','',0),(72,4,'Золотой медальон с портретом девушки',NULL,NULL,0.05,'','',0),(73,4,'Золотой браслет мага',NULL,NULL,0.05,'','',0),(74,4,'жемчужное ожерелье (24)',NULL,NULL,0.05,'','',0),(75,4,'флаконы духов',10,4,0.2,'','',0),(76,4,'Медальоны со знаком паука',20,4,0.05,'','',0),(77,4,'платиновое кольцо',75,4,NULL,'','',0),(78,4,'Маленький драгоценный камень(10зм)',10,4,0.01,'','',0),(79,4,'дварф. круж. д. эля, из кован. электрум (100 зм)',100,4,0.5,'','',0),(80,4,'золотые серьги с мал. рубинами (30 зм)',NULL,NULL,0.05,'','',0),(81,4,'Золотой амулет с рубином',60,4,0.05,'','',0),(82,4,'муз. шкатулка гномьей работы',NULL,NULL,0.2,'','',0),(83,4,'перо сойки',NULL,NULL,NULL,'','',0),(84,2,'Сапоги ходьбы и прыжков',NULL,NULL,1,'<p>Когда вы одеты в эти сапоги, ваша скорость становится 30 футов, если только она не была выше. Также ваша скорость не снижается, если вы перегружены или носите тяжёлые доспехи. Кроме того, всякий раз, когда вы прыгаете, вы можете прыгнуть на расстояние, в три раза превосходящее дальность обычного прыжка.</p>\r\n','<p>Когда вы одеты в эти сапоги, ваша скорость становится 30 футов, если только она не была выше. Также ваша скорость не снижается, если вы перегружены или носите тяжёлые доспехи. Кроме того, всякий раз, когда вы прыгаете, вы можете прыгнуть на расстояние, в три раза превосходящее дальность обычного прыжка.</p>\r\n',1),(85,1,'Кинжал Яда',NULL,NULL,1,'<p>Оружие (кинжал), редкое Вы получаете бонус +1 к броскам атаки и урона, совершённым этим магическим оружием. Вы можете действием заставить этот клинок покрыться густым чёрным ядом. Яд остаётся 1 минуту, или пока атака этим оружием не попадёт по существу. Цель должна преуспеть в спасброске Телосложения со Сл 15, иначе она получит урон ядом 2к10 и станет отравленной на 1 минуту, в течение которой получает урон 1к6 каждый ход.</p>\r\n','<p>Оружие (кинжал), редкое Вы получаете бонус +1 к броскам атаки и урона, совершённым этим магическим оружием. Вы можете действием заставить этот клинок покрыться густым чёрным ядом. Яд остаётся 1 минуту, или пока атака этим оружием не попадёт по существу. Цель должна преуспеть в спасброске Телосложения со Сл 15, иначе она получит урон ядом 2к10 и станет отравленной на 1 минуту, в течение которой получает урон 1к6 каждый ход.</p>\r\n',0),(86,4,'Непромокаемая сумка',NULL,NULL,0.3,'','',1),(87,4,'Карта к кузнице заклинаний',NULL,NULL,NULL,'','',0),(88,4,'Карта гор меча',NULL,NULL,NULL,'','',0),(89,2,'Ожерелье из когтей совомеда',NULL,NULL,0.4,'','',0),(90,3,'Колода игральных карт',NULL,NULL,NULL,'','',0),(91,4,'Перо совы',NULL,NULL,NULL,'','',0),(92,4,'Письмо от \"черного паука\" \"стеклянному посоху\"',NULL,NULL,NULL,'','',0),(93,4,'Перо ворона',NULL,NULL,NULL,'','',0),(94,4,'Знак ордена латной перчатки',NULL,NULL,NULL,'','',0),(95,2,'Драконий страж',NULL,NULL,65,'<p>На этом нагруднике +1 (латы) изображён золотой дракон. Созданный для героя Невервинтера &mdash; человека по имени Тергон &mdash; он позволяет владельцу совершать с преимуществом спасброски против оружия дыхания существ, имеющих тип &laquo;дракон&raquo;.</p>\r\n','<p>На этом нагруднике +1 (латы) изображён золотой дракон. Созданный для героя Невервинтера &mdash; человека по имени Тергон &mdash; он позволяет владельцу совершать с преимуществом спасброски против оружия дыхания существ, имеющих тип &laquo;дракон&raquo;.</p>\r\n',0),(96,1,'Посох паука',NULL,NULL,4,'<p>Навершие этого чёрного адамантинового посоха выполнено в форме паука. Посох весит 6 фунтов. Вы должны быть настроены на посох, чтобы получить все его преимущества и накладывать заключённые в посохе заклинания. Посох можно использовать как боевой посох. Он причиняет дополнительный урон ядом 1к6 при попадании, когда используется как оружие. У посоха есть 10 зарядов, которые расходуются на применение заключённых в нём заклинаний. Когда посох находится в руке, вы можете действие наложить одно из следующих заклинаний, при условии, что оно есть списке заклинаний вашего класса: паук (1 заряд) или паутина (2 заряда, Сл спасбросков от заклинания 15). Для накладывания заклинаний не требуется никаких компонентов. Посох восстанавливает 1к6 + 4 израсходованных зарядов каждый день на закате. Если вы израсходовали последний заряд, бросьте к20. Если выпадет 1, посох будет уничтожен и рассыпается в пыль.</p>\r\n','<p>Навершие этого чёрного адамантинового посоха выполнено в форме паука. Посох весит 6 фунтов. Вы должны быть настроены на посох, чтобы получить все его преимущества и накладывать заключённые в посохе заклинания. Посох можно использовать как боевой посох. Он причиняет дополнительный урон ядом 1к6 при попадании, когда используется как оружие. У посоха есть 10 зарядов, которые расходуются на применение заключённых в нём заклинаний. Когда посох находится в руке, вы можете действие наложить одно из следующих заклинаний, при условии, что оно есть списке заклинаний вашего класса: паук (1 заряд) или паутина (2 заряда, Сл спасбросков от заклинания 15). Для накладывания заклинаний не требуется никаких компонентов. Посох восстанавливает 1к6 + 4 израсходованных зарядов каждый день на закате. Если вы израсходовали последний заряд, бросьте к20. Если выпадет 1, посох будет уничтожен и рассыпается в пыль.</p>\r\n',0),(97,2,'Посох защиты',NULL,NULL,3,'<p>Этот тонкий полый стеклянный посох прочен, буд-то сделан из дуба. Он весит 3 фунта. Вы должны быть на- строены на посох, чтобы получить все его преимущества и накладывать заключённые в посохе заклинания. Пока вы держите этот посох, вы получаете бонус +1 к Классу Доспеха. У посоха есть 10 зарядов, которые расходуются на применение заключённых в нем заклинаний. Когда посох удерживается в руке, вы можете действие наложить одно из следующих заклинаний, при условии, что оно есть списке заклинаний вашего класса: доспехи мага (1 заряд) или щит (2 заряда). Для накладывания заклинаний не требуется никаких компонентов. Посох восстанавливает 1к6 + 4 израсходованных зарядов каждый день на рассвете. Если вы израсходовали последний заряд, бросьте к20. Если выпадет 1, посох будет уничтожен и разобьётся.</p>\r\n\r\n<p>Посох &quot;стеклянного посоха&quot;.</p>\r\n','<p>Этот тонкий полый стеклянный посох прочен, буд-то сделан из дуба. Он весит 3 фунта. Вы должны быть на- строены на посох, чтобы получить все его преимущества и накладывать заключённые в посохе заклинания. Пока вы держите этот посох, вы получаете бонус +1 к Классу Доспеха. У посоха есть 10 зарядов, которые расходуются на применение заключённых в нем заклинаний. Когда посох удерживается в руке, вы можете действие наложить одно из следующих заклинаний, при условии, что оно есть списке заклинаний вашего класса: доспехи мага (1 заряд) или щит (2 заряда). Для накладывания заклинаний не требуется никаких компонентов. Посох восстанавливает 1к6 + 4 израсходованных зарядов каждый день на рассвете. Если вы израсходовали последний заряд, бросьте к20. Если выпадет 1, посох будет уничтожен и разобьётся.</p>\r\n\r\n<p>Посох &quot;стеклянного посоха&quot;.</p>\r\n',0),(98,1,'Коготь',NULL,NULL,6,'<p>Против орков еще +1 к урону</p>\r\n','<p>Против орков еще +1 к урону</p>\r\n',0),(99,2,'Накидка из шкуры совомеда',NULL,NULL,3,'','',0),(100,4,'Голова молод. зеленого дракона',NULL,NULL,30,'','',0),(101,4,'Одеяло',NULL,NULL,1,'','',0),(102,1,'Короткий меч',10,4,2,'<p>Лёгкое, фехтовальное</p>\r\n','<p>Лёгкое, фехтовальное</p>\r\n',0),(103,1,'Пика',5,4,18,'<p>Двуручное, досягаемость, тяжёлое</p>\r\n','<p>Двуручное, досягаемость, тяжёлое</p>\r\n',0),(104,1,'Арбалет, тяжёлый',50,4,18,'<p>Боеприпас (дис. 100/400), двуручное, перезарядка, тяжёлое</p>\r\n','<p>Боеприпас (дис. 100/400), двуручное, перезарядка, тяжёлое</p>\r\n',0),(105,1,'Сеть',1,4,3,'<p>Метательное (дис. 5/15), особое</p>\r\n\r\n<p>Сеть. Существа Большого и меньшего размеров,<br />\r\nпо которым попала атака сетью, становятся опутанными, пока не высвободятся. Сеть не оказывает<br />\r\nэффекта на бесформенных существ и тех, чей размер Огромный или ещё больше. Существо может<br />\r\nдействием совершить проверку Силы со Сл 10,<br />\r\nчтобы высвободиться самому или освободить другое существо, находящееся в пределах его досягаемости. Причинение сети 5 единиц рубящего урона<br />\r\n(КД 10) тоже освобождает существо, не причиняя<br />\r\nему вреда, оканчивая эффект и уничтожая сеть</p>\r\n','<p>Метательное (дис. 5/15), особое</p>\r\n\r\n<p>Сеть. Существа Большого и меньшего размеров,<br />\r\nпо которым попала атака сетью, становятся опутанными, пока не высвободятся. Сеть не оказывает<br />\r\nэффекта на бесформенных существ и тех, чей размер Огромный или ещё больше. Существо может<br />\r\nдействием совершить проверку Силы со Сл 10,<br />\r\nчтобы высвободиться самому или освободить другое существо, находящееся в пределах его досягаемости. Причинение сети 5 единиц рубящего урона<br />\r\n(КД 10) тоже освобождает существо, не причиняя<br />\r\nему вреда, оканчивая эффект и уничтожая сеть</p>\r\n',0),(106,4,'Кандалы',2,4,6,'<p>Кандалы. Эти металлические оковы удерживают существ Маленького и Среднего размера.<br />\r\nДля того чтобы сбежать из кандалов, требуется<br />\r\nуспешная проверка Ловкости со Сл 20. Для того<br />\r\nчтобы их сломать, требуется проверка Силы со Сл<br />\r\n20. Каждый набор кандалов идёт с одним ключом.<br />\r\nБез ключа существо, владеющее воровскими инструментами, может вскрыть замок кандалов<br />\r\nуспешной проверкой Ловкости со Сл 15. У кандалов 15 хитов</p>\r\n','<p>Кандалы. Эти металлические оковы удерживают существ Маленького и Среднего размера.<br />\r\nДля того чтобы сбежать из кандалов, требуется<br />\r\nуспешная проверка Ловкости со Сл 20. Для того<br />\r\nчтобы их сломать, требуется проверка Силы со Сл<br />\r\n20. Каждый набор кандалов идёт с одним ключом.<br />\r\nБез ключа существо, владеющее воровскими инструментами, может вскрыть замок кандалов<br />\r\nуспешной проверкой Ловкости со Сл 15. У кандалов 15 хитов</p>\r\n',0),(107,3,'Инструменты навигатора',25,4,2,'<p>Эти инструменты используются для навигации в море. Владение инструментами навигатора позволяет прокладывать<br />\r\nкурс корабля и пользоваться морскими картами.<br />\r\nКроме того, эти инструменты позволяют вам добавлять бонус мастерства к проверкам характеристик, совершённым, чтобы не потеряться в море.</p>\r\n','<p>Эти инструменты используются для навигации в море. Владение инструментами навигатора позволяет прокладывать<br />\r\nкурс корабля и пользоваться морскими картами.<br />\r\nКроме того, эти инструменты позволяют вам добавлять бонус мастерства к проверкам характеристик, совершённым, чтобы не потеряться в море.</p>\r\n',0),(108,3,'Инструменты картографа',15,4,6,'','',0),(109,4,'Набедренная сумка',10,4,2,'','',1),(110,4,'Книга заклинания Арвиса',50,4,3,'<p><strong>Заклинания:</strong></p>\r\n\r\n<p><br />\r\nБЕЗМОЛВНЫЙ ОБРАЗ(1)</p>\r\n\r\n<p>РАЗМЫТЫЙ ОБРАЗ(2)</p>\r\n\r\n<p>СВЕРКАЮЩИЕ БРЫЗГИ(1)</p>\r\n\r\n<p>ОБРАЗ(3)</p>\r\n\r\n<p>НЕВИДИМЫЙ СЛУГА(1)</p>\r\n\r\n<p>Открывание(2)</p>\r\n\r\n<p>Рассеивание магии(3)</p>\r\n\r\n<p>Языки(3)</p>\r\n\r\n<p>Огненный шар(3)</p>\r\n\r\n<p>Огненные ладони(1)</p>\r\n\r\n<p>Обнаружение магии(1)</p>\r\n\r\n<p>Волшебная стрела(1)</p>\r\n\r\n<p>Молния(3)</p>\r\n\r\n<p>ТИШИНА(2)</p>\r\n','<p><strong>Заклинания:</strong></p>\r\n\r\n<p><br />\r\nБЕЗМОЛВНЫЙ ОБРАЗ(1)</p>\r\n\r\n<p>РАЗМЫТЫЙ ОБРАЗ(2)</p>\r\n\r\n<p>СВЕРКАЮЩИЕ БРЫЗГИ(1)</p>\r\n\r\n<p>ОБРАЗ(3)</p>\r\n\r\n<p>НЕВИДИМЫЙ СЛУГА(1)</p>\r\n\r\n<p>Открывание(2)</p>\r\n\r\n<p>Рассеивание магии(3)</p>\r\n\r\n<p>Языки(3)</p>\r\n\r\n<p>Огненный шар(3)</p>\r\n\r\n<p>Огненные ладони(1)</p>\r\n\r\n<p>Обнаружение магии(1)</p>\r\n\r\n<p>Волшебная стрела(1)</p>\r\n\r\n<p>Молния(3)</p>\r\n\r\n<p>ТИШИНА(2)</p>\r\n',0),(111,4,'Книга заклинания иллюзиониста/фокусника',50,4,3,'<p><strong>Заклинания:</strong></p>\r\n\r\n<p>БЕЗМОЛВНЫЙ ОБРАЗ(1)</p>\r\n\r\n<p>УЖАС(3)</p>\r\n\r\n<p>РАЗМЫТЫЙ ОБРАЗ(2)</p>\r\n\r\n<p>СВЕРКАЮЩИЕ БРЫЗГИ(1)</p>\r\n\r\n<p>ПРИЗРАЧНЫЙ СКАКУН(3)</p>\r\n\r\n<p>ОБРАЗ(3)</p>\r\n\r\n<p>ПРИТВОРСТВО(5)</p>\r\n','<p><strong>Заклинания:</strong></p>\r\n\r\n<p>БЕЗМОЛВНЫЙ ОБРАЗ(1)</p>\r\n\r\n<p>УЖАС(3)</p>\r\n\r\n<p>РАЗМЫТЫЙ ОБРАЗ(2)</p>\r\n\r\n<p>СВЕРКАЮЩИЕ БРЫЗГИ(1)</p>\r\n\r\n<p>ПРИЗРАЧНЫЙ СКАКУН(3)</p>\r\n\r\n<p>ОБРАЗ(3)</p>\r\n\r\n<p>ПРИТВОРСТВО(5)</p>\r\n',0),(112,4,'Книга заклинания мага из серебрянной пирамиды',50,4,3,'<p><strong>Заклинания:</strong></p>\r\n\r\n<p>Опознание(1)</p>\r\n\r\n<p>Тензеров парящий диск(1)</p>\r\n\r\n<p>Псевдожизнь(1)</p>\r\n\r\n<p>Внушение(2)</p>\r\n\r\n<p>Мельфова кислотная стрела(2)</p>\r\n\r\n<p>Порыв ветра(2)</p>\r\n\r\n<p>Магический круг(3)</p>\r\n\r\n<p>Кабинет Морденкайнена(4)</p>\r\n\r\n<p>Сотворение(5)</p>\r\n\r\n<p>Разящее око(6)</p>\r\n','<p><strong>Заклинания:</strong></p>\r\n\r\n<p>Опознание(1)</p>\r\n\r\n<p>Тензеров парящий диск(1)</p>\r\n\r\n<p>Псевдожизнь(1)</p>\r\n\r\n<p>Внушение(2)</p>\r\n\r\n<p>Мельфова кислотная стрела(2)</p>\r\n\r\n<p>Порыв ветра(2)</p>\r\n\r\n<p>Магический круг(3)</p>\r\n\r\n<p>Кабинет Морденкайнена(4)</p>\r\n\r\n<p>Сотворение(5)</p>\r\n\r\n<p>Разящее око(6)</p>\r\n',0),(113,2,'Маска человесности',450,4,1,'<p>Позволяет владельцу выглядеть как человек. Внешность не выбирается а подгоняется под стандарты человека.</p>\r\n','<p>Позволяет владельцу выглядеть как человек. Внешность не выбирается а подгоняется под стандарты человека.</p>\r\n',0),(114,2,'Щит',10,4,6,'','',0),(115,2,'Кольцо невидимости',100,4,0.2,'<p>Кольцо невидимости 1 раз в день дает возвожность наложить заклинание &quot;невидимость&quot; на себя, востанавливаеться на рассвете.</p>\r\n','<p>Кольцо невидимости 1 раз в день дает возвожность наложить заклинание &quot;невидимость&quot; на себя, востанавливаеться на рассвете.</p>\r\n',0),(116,5,'Маленький камень для пращи',NULL,NULL,0.25,'','',0),(117,1,'Праща',1,2,NULL,'<p>Боеприпас (дис. 30/120)</p>\r\n','<p>Боеприпас (дис. 30/120)</p>\r\n',0),(118,1,'Цеп',10,4,2,'','',0),(119,4,'Книга Тьмы(Книга лича)',NULL,NULL,5,'','',0),(120,4,'Амулет тьмы(ключ от книги)',NULL,NULL,2,'','',0),(121,1,'Длинный лук',50,4,2,'<p>Боеприпас (дис. 150/600), двуручное, тяжёлое</p>\r\n','<p>Боеприпас (дис. 150/600), двуручное, тяжёлое</p>\r\n',0),(122,4,'Графин бесконечной воды ',NULL,NULL,2,'<p>Эта закупоренная ёмкость булькает, если её потрясти, как будто в ней находится вода. Весит графин 2 фунта.</p>\r\n\r\n<p>Вы можете действием откупорить графин и произнести одно из трёх ключевых слов, после чего из графина выливается указанное количество пресной или солёной воды (на ваш выбор). Вода прекращает литься в начале вашего следующего хода. У вас есть следующие варианты:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&laquo;Ручей&raquo; производит 1 галлон воды.</p>\r\n\r\n<p>&laquo;Фонтан&raquo; производит 5 галлонов воды.</p>\r\n\r\n<p>&laquo;Гейзер&raquo; производит 30 галлонов воды, которая вырывается струёй 30 футов длиной и 1 фут шириной. Держа графин, вы можете бонусным действием нацелиться графином на существо, которое видите в пределах 30 футов от себя. Цель должна преуспеть в спасброске Силы со Сл 13, иначе получит дробящий урон 1d4 и будет сбита с ног. Вместо существа вы можете нацелиться на предмет, который никто не несёт и не носит, и который весит не больше 200 фунтов. Предмет или падает или толкается на 15 футов от вас.&nbsp;</p>\r\n','<p>Эта закупоренная ёмкость булькает, если её потрясти, как будто в ней находится вода. Весит графин 2 фунта.</p>\r\n\r\n<p>Вы можете действием откупорить графин и произнести одно из трёх ключевых слов, после чего из графина выливается указанное количество пресной или солёной воды (на ваш выбор). Вода прекращает литься в начале вашего следующего хода. У вас есть следующие варианты:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&laquo;Ручей&raquo; производит 1 галлон воды.</p>\r\n\r\n<p>&laquo;Фонтан&raquo; производит 5 галлонов воды.</p>\r\n\r\n<p>&laquo;Гейзер&raquo; производит 30 галлонов воды, которая вырывается струёй 30 футов длиной и 1 фут шириной. Держа графин, вы можете бонусным действием нацелиться графином на существо, которое видите в пределах 30 футов от себя. Цель должна преуспеть в спасброске Силы со Сл 13, иначе получит дробящий урон 1d4 и будет сбита с ног. Вместо существа вы можете нацелиться на предмет, который никто не несёт и не носит, и который весит не больше 200 фунтов. Предмет или падает или толкается на 15 футов от вас.&nbsp;</p>\r\n',0),(123,4,'Струны для лютни из страны Фей',NULL,NULL,1,'<p>Магические струны</p>\r\n\r\n<p>+1 к магическим атакам</p>\r\n\r\n<p>+1 к сложности заклинаний</p>\r\n\r\n<p>Броски против очарования и испуга цель совершает спасброски с помехой</p>\r\n','<p>Магические струны</p>\r\n\r\n<p>+1 к магическим атакам</p>\r\n\r\n<p>+1 к сложности заклинаний</p>\r\n\r\n<p>Броски против очарования и испуга цель совершает спасброски с помехой</p>\r\n',0),(124,4,'Записи лабораторных исследований из пирамиды Яраша',NULL,NULL,3,'<p>Записи о результатах алхимических эксперементов, все указано под индексами.</p>\r\n','<p>Записи о результатах алхимических эксперементов, все указано под индексами.</p>\r\n',0),(125,4,'Амулет планов',NULL,NULL,0.5,'<p>Пока вы носите этот амулет, вы можете действием назвать хорошо знакомое вам место на другом плане. После этого необходимо совершить проверку Интеллекта со Сл 15. При успехе вы накладываете заклинание <strong>уход в иной мир</strong>. При провале вы и все существа и предметы в пределах 15 футов от вас переноситесь в случайном направлении. Бросьте d100. При результате 1&ndash;60 вы переноситесь в случайное место на названном вами плане. При результате 61&ndash;100 вы переноситесь в случайное место на вашем текущем плане существования.</p>\r\n\r\n<p>УХОД В ИНОЙ МИР<br />\r\n7 уровень, вызов<br />\r\nВремя накладывания: 1 действие<br />\r\nДистанция: Касание<br />\r\nКомпоненты: В, С, М (раздвоенный металлический<br />\r\nпрут, стоящий как минимум 250 зм, настроенный<br />\r\nна конкретный план существования)<br />\r\nДлительность: Мгновенная<br />\r\nВы и до восьми согласных существ, взявшиеся за<br />\r\nруки кругом, перемещаетесь на другой план существования. Вы можете указать в общих чертах<br />\r\nточку прибытия, например, Медный город на Стихийном Плане Огня или дворец Диспатера на втором уровне Девяти Преисподних, и вы появитес<br />\r\nвозле этого места. Например, если вы хотели оказаться в Медном городе, вы можете прибыть на<br />\r\nСтальную улицу, перед Вратами Пепла, или оказаться посреди Моря Огня, на выбор Мастера.<br />\r\nВ качестве альтернативы, если вы знаете последовательность знаков телепортационного круга<br />\r\nна другом плане существования, это заклинание<br />\r\nможет перенести вас в этот круг. Если круг телепортации слишком мал для переносимого количества существ, они появляются в ближайшем свободном пространстве рядом с кругом.<br />\r\nВы можете использовать это заклинание,<br />\r\nчтобы изгонять несогласных существ на другой<br />\r\nплан. Выберите существо в пределах досягаемости<br />\r\nи совершите по нему рукопашную атаку заклинанием. При попадании существо должно совершить<br />\r\nспасбросок Харизмы. Если существо его проваливает, оно переносится в случайным образом выбранное место на выбранном вами плане существования. Перенесённое таким образом существо<br />\r\nдолжно будет самостоятельно найти дорогу на<br />\r\nваш текущий план существования.</p>\r\n','<p>Пока вы носите этот амулет, вы можете действием назвать хорошо знакомое вам место на другом плане. После этого необходимо совершить проверку Интеллекта со Сл 15. При успехе вы накладываете заклинание <strong>уход в иной мир</strong>. При провале вы и все существа и предметы в пределах 15 футов от вас переноситесь в случайном направлении. Бросьте d100. При результате 1&ndash;60 вы переноситесь в случайное место на названном вами плане. При результате 61&ndash;100 вы переноситесь в случайное место на вашем текущем плане существования.</p>\r\n\r\n<p>УХОД В ИНОЙ МИР<br />\r\n7 уровень, вызов<br />\r\nВремя накладывания: 1 действие<br />\r\nДистанция: Касание<br />\r\nКомпоненты: В, С, М (раздвоенный металлический<br />\r\nпрут, стоящий как минимум 250 зм, настроенный<br />\r\nна конкретный план существования)<br />\r\nДлительность: Мгновенная<br />\r\nВы и до восьми согласных существ, взявшиеся за<br />\r\nруки кругом, перемещаетесь на другой план существования. Вы можете указать в общих чертах<br />\r\nточку прибытия, например, Медный город на Стихийном Плане Огня или дворец Диспатера на втором уровне Девяти Преисподних, и вы появитес<br />\r\nвозле этого места. Например, если вы хотели оказаться в Медном городе, вы можете прибыть на<br />\r\nСтальную улицу, перед Вратами Пепла, или оказаться посреди Моря Огня, на выбор Мастера.<br />\r\nВ качестве альтернативы, если вы знаете последовательность знаков телепортационного круга<br />\r\nна другом плане существования, это заклинание<br />\r\nможет перенести вас в этот круг. Если круг телепортации слишком мал для переносимого количества существ, они появляются в ближайшем свободном пространстве рядом с кругом.<br />\r\nВы можете использовать это заклинание,<br />\r\nчтобы изгонять несогласных существ на другой<br />\r\nплан. Выберите существо в пределах досягаемости<br />\r\nи совершите по нему рукопашную атаку заклинанием. При попадании существо должно совершить<br />\r\nспасбросок Харизмы. Если существо его проваливает, оно переносится в случайным образом выбранное место на выбранном вами плане существования. Перенесённое таким образом существо<br />\r\nдолжно будет самостоятельно найти дорогу на<br />\r\nваш текущий план существования.</p>\r\n',0),(126,2,'Красивый проклёпанный доспех',NULL,NULL,13,'<p><strong>Тип:</strong> Доспех (проклёпанная кожа)</p>\r\n\r\n<p><strong>Качество:</strong> Редкий</p>\r\n\r\n<p>Описание</p>\r\n\r\n<p>Пока вы носите этот доспех, вы получаете бонус +1 к КД. Вы также можете бонусным действием произнести его командное слово и заставить доспех принять облик обычной одежды или любого другого доспеха. Вы сами решаете, как он будет выглядеть, включая цвет, стиль и аксессуары, но доспех при этом сохраняет свой объём и вес. Иллюзорный облик длится до тех пор, пока вы не используете это свойство повторно или не снимете доспех.</p>\r\n','<p><strong>Тип:</strong> Доспех (проклёпанная кожа)</p>\r\n\r\n<p><strong>Качество:</strong> Редкий</p>\r\n\r\n<p>Описание</p>\r\n\r\n<p>Пока вы носите этот доспех, вы получаете бонус +1 к КД. Вы также можете бонусным действием произнести его командное слово и заставить доспех принять облик обычной одежды или любого другого доспеха. Вы сами решаете, как он будет выглядеть, включая цвет, стиль и аксессуары, но доспех при этом сохраняет свой объём и вес. Иллюзорный облик длится до тех пор, пока вы не используете это свойство повторно или не снимете доспех.</p>\r\n',0),(127,4,'Очки детального зрения',NULL,NULL,0.5,'<p>Эти кристаллические линзы размещаются напротив глаз. Пока вы их носите, вы видите лучше, чем обычно, в пределах 1 фута. Вы совершаете с преимуществом проверки Интеллекта (Анализ), полагающиеся на исследование местности или предмета в пределах 1 фута.</p>\r\n','<p>Эти кристаллические линзы размещаются напротив глаз. Пока вы их носите, вы видите лучше, чем обычно, в пределах 1 фута. Вы совершаете с преимуществом проверки Интеллекта (Анализ), полагающиеся на исследование местности или предмета в пределах 1 фута.</p>\r\n',0),(128,4,'Переносная дыра',NULL,NULL,NULL,'<p>Эта тонкая чёрная ткань, гладкая как шёлк, складывается до размеров носового платка. Она разворачивается в круг диаметром 6 футов.</p>\r\n\r\n<p>Вы можете действием развернуть переносную дыру и поместить её на твёрдую поверхность, после чего дыра создаёт межпространственное отверстие глубиной 10 футов. Цилиндрическое пространство внутри дыры находится на другом плане, поэтому с её помощью не получится создавать сквозные проходы. Все существа, находящиеся внутри открытой переносной дыры, могут покинуть её, просто вылезая из неё.</p>\r\n\r\n<p>Вы можете действием закрыть переносную дыру, взявшись за края ткани и сложив её. Складывание ткани закрывает дыру, и все существа и предметы, находящиеся в ней, остаются в межпространстве. Что бы в ней ни находилось, дыра практически ничего не весит.</p>\r\n\r\n<p>Если дыра сложена, существо, находящееся в её межпространстве, может действием совершить проверку Силы со Сл 10. При успехе существо вырывается наружу и появляется в пределах 5 футов от переносной дыры или существа, несущего её. Дышащее существо, находящееся в закрытой переносной дыре, может перетерпеть 10 минут, после чего начинает задыхаться.</p>\r\n','<p>Эта тонкая чёрная ткань, гладкая как шёлк, складывается до размеров носового платка. Она разворачивается в круг диаметром 6 футов.</p>\r\n\r\n<p>Вы можете действием развернуть переносную дыру и поместить её на твёрдую поверхность, после чего дыра создаёт межпространственное отверстие глубиной 10 футов. Цилиндрическое пространство внутри дыры находится на другом плане, поэтому с её помощью не получится создавать сквозные проходы. Все существа, находящиеся внутри открытой переносной дыры, могут покинуть её, просто вылезая из неё.</p>\r\n\r\n<p>Вы можете действием закрыть переносную дыру, взявшись за края ткани и сложив её. Складывание ткани закрывает дыру, и все существа и предметы, находящиеся в ней, остаются в межпространстве. Что бы в ней ни находилось, дыра практически ничего не весит.</p>\r\n\r\n<p>Если дыра сложена, существо, находящееся в её межпространстве, может действием совершить проверку Силы со Сл 10. При успехе существо вырывается наружу и появляется в пределах 5 футов от переносной дыры или существа, несущего её. Дышащее существо, находящееся в закрытой переносной дыре, может перетерпеть 10 минут, после чего начинает задыхаться.</p>\r\n',1),(129,4,'Сумка хранения',NULL,NULL,15,'<p>Эта сумка внутри гораздо больше, чем можно было предположить, исходя из её внешних размеров (приблизительно 2 фута в диаметре и 4 фута глубины). Сумка может вместить до 500 фунтов, не превышающих в объёме 64 кубических фута. При этом сумка всегда весит 15 фунтов, вне зависимости от её содержания. Извлечение чего-либо из сумки совершается действием.</p>\r\n\r\n<p>Если сумка перегружена, проткнута, или порвана, она рвётся окончательно, уничтожается, и её содержимое разбрасывается по Астральному Плану. Если сумка оказывается вывернутой наизнанку, то её содержимое вываливается наружу невредимым, но прежде, чем её можно будет снова использовать, сумку необходимо вывернуть обратно. Дышащие существа, помещённые внутрь мешка, способны оставаться в живых в течение времени, равного десяти минутам, поделённым на количество существ (минимум 1 минута), после чего они начинают задыхаться.</p>\r\n','<p>Эта сумка внутри гораздо больше, чем можно было предположить, исходя из её внешних размеров (приблизительно 2 фута в диаметре и 4 фута глубины). Сумка может вместить до 500 фунтов, не превышающих в объёме 64 кубических фута. При этом сумка всегда весит 15 фунтов, вне зависимости от её содержания. Извлечение чего-либо из сумки совершается действием.</p>\r\n\r\n<p>Если сумка перегружена, проткнута, или порвана, она рвётся окончательно, уничтожается, и её содержимое разбрасывается по Астральному Плану. Если сумка оказывается вывернутой наизнанку, то её содержимое вываливается наружу невредимым, но прежде, чем её можно будет снова использовать, сумку необходимо вывернуть обратно. Дышащие существа, помещённые внутрь мешка, способны оставаться в живых в течение времени, равного десяти минутам, поделённым на количество существ (минимум 1 минута), после чего они начинают задыхаться.</p>\r\n',1),(130,4,'Колода многих вещей полная',NULL,NULL,1,'<p>Эта колода, находящаяся в коробке или мешочке, состоит из карт, сделанных из слоновой кости или пергамента. Включают двадцать две.</p>\r\n\r\n<p>Перед тем, как тянуть карты, вы должны объявить, сколько собираетесь брать, а затем тяните их по одной (можете использовать модифицированную колоду обычных игральных карт). Карты, взятые сверх названного числа, не будут иметь эффекта. Как только вы вытянули карту, её магия начинает действовать. Вы должны тянуть следующую карту не позднее, чем через час после предыдущей. Если вы не вытянули названное число карт, оставшиеся сами вылетают из колоды и вступают в силу одновременно. Как только карта вытягивается, она исчезает. Если это не Дурак, и не Шут, карта вновь появляется в колоде, что позволяет вытянуть её повторно.</p>\r\n','<p>Эта колода, находящаяся в коробке или мешочке, состоит из карт, сделанных из слоновой кости или пергамента. Включают двадцать две.</p>\r\n\r\n<p>Перед тем, как тянуть карты, вы должны объявить, сколько собираетесь брать, а затем тяните их по одной (можете использовать модифицированную колоду обычных игральных карт). Карты, взятые сверх названного числа, не будут иметь эффекта. Как только вы вытянули карту, её магия начинает действовать. Вы должны тянуть следующую карту не позднее, чем через час после предыдущей. Если вы не вытянули названное число карт, оставшиеся сами вылетают из колоды и вступают в силу одновременно. Как только карта вытягивается, она исчезает. Если это не Дурак, и не Шут, карта вновь появляется в колоде, что позволяет вытянуть её повторно.</p>\r\n',0),(131,4,'Кольцо отражения заклинаний (требуется настройка)',NULL,NULL,0.02,'<p>Нося это кольцо, вы совершаете с преимуществом спасброски от заклинаний, нацеленных только на вас (не обладающих зонами воздействия). Кроме того, если у вас выпадет &laquo;20&raquo; при спасброске от заклинание с уровнем не больше 7, заклинание не оказывает на вас никакого эффекта, и вместо этого нацеливается на заклинателя, используя уровень ячейки, Сл спасброска, бонус атаки и базовую характеристику самого заклинателя.</p>\r\n','<p>Нося это кольцо, вы совершаете с преимуществом спасброски от заклинаний, нацеленных только на вас (не обладающих зонами воздействия). Кроме того, если у вас выпадет &laquo;20&raquo; при спасброске от заклинание с уровнем не больше 7, заклинание не оказывает на вас никакого эффекта, и вместо этого нацеливается на заклинателя, используя уровень ячейки, Сл спасброска, бонус атаки и базовую характеристику самого заклинателя.</p>\r\n',0),(132,4,'Кольцо трёх желаний(0 желаний)',NULL,NULL,0.05,'<p>Нося это кольцо, вы можете действием использовать 1 из 3 его зарядов, чтобы наложить им заклинание <strong>исполнение желаний</strong>. Кольцо перестаёт быть магическим, когда тратится последний заряд.</p>\r\n','<p>Нося это кольцо, вы можете действием использовать 1 из 3 его зарядов, чтобы наложить им заклинание <strong>исполнение желаний</strong>. Кольцо перестаёт быть магическим, когда тратится последний заряд.</p>\r\n',0),(133,4,'Плащ летучей мыши(требуется настройка)',NULL,NULL,4,'<p>Пока вы носите этот плащ, вы совершаете с преимуществом проверки Ловкости (Скрытность). В области тусклого освещения или темноте вы можете схватить края плаща обеими руками и использовать его для полёта со скоростью 40 футов. Если вы отпустите плащ во время полёта или перестанете находиться в области тусклого света или тьмы, вы теряете эту скорость полёта.</p>\r\n\r\n<p>Если вы носите этот плащ, и находитесь в области тусклого освещения или темноте, вы можете действием наложить на себя <strong>превращение </strong>и стать летучей мышью. Пока вы находитесь в облике летучей мыши, вы сохраняете свои значения Интеллекта, Мудрости и Харизмы. Это свойство плаща нельзя использовать повторно до следующего рассвета.</p>\r\n','<p>Пока вы носите этот плащ, вы совершаете с преимуществом проверки Ловкости (Скрытность). В области тусклого освещения или темноте вы можете схватить края плаща обеими руками и использовать его для полёта со скоростью 40 футов. Если вы отпустите плащ во время полёта или перестанете находиться в области тусклого света или тьмы, вы теряете эту скорость полёта.</p>\r\n\r\n<p>Если вы носите этот плащ, и находитесь в области тусклого освещения или темноте, вы можете действием наложить на себя <strong>превращение </strong>и стать летучей мышью. Пока вы находитесь в облике летучей мыши, вы сохраняете свои значения Интеллекта, Мудрости и Харизмы. Это свойство плаща нельзя использовать повторно до следующего рассвета.</p>\r\n',0),(134,4,'Камень зрения(требуется настройка)',NULL,NULL,NULL,'<p>У этого драгоценного камня есть 3 заряда. Вы можете действием произнести командное слово и потратить 1 заряд. В течение следующих 10 минут вы обладаете истинным зрением в пределах 120 футов, если смотрите через этот драгоценный камень.</p>\r\n\r\n<p>Камень ежедневно восстанавливает 1к3 заряда на рассвете.</p>\r\n','<p>У этого драгоценного камня есть 3 заряда. Вы можете действием произнести командное слово и потратить 1 заряд. В течение следующих 10 минут вы обладаете истинным зрением в пределах 120 футов, если смотрите через этот драгоценный камень.</p>\r\n\r\n<p>Камень ежедневно восстанавливает 1к3 заряда на рассвете.</p>\r\n',0),(135,4,'Музыкальный альбом Латри',NULL,NULL,0.5,'<p>Музыкальный альбом Латри</p>\r\n','<p>Музыкальный альбом Латри</p>\r\n',0),(136,4,'Жетон законника Флана',NULL,NULL,NULL,'','',0),(137,4,'Ювелирное украшение',2000,4,2,'','',0),(138,4,'Колчан Элонны',NULL,NULL,2,'<p>Все три отделения этого колчана соединены с межпространственным местом, что позволяет ему вмещать множество предметов, но весит он всегда не более 2 фунтов. В самом коротком отделении может поместиться до шестидесяти стрел, арбалетных болтов или подобных предметов. В среднем отделении помещается до восемнадцати метательных копий или подобных предметов. В самом длинном отделении помещается до шести длинных предметов, таких как луки, боевые посохи и копья.</p>\r\n\r\n<p>Вы можете вынуть любой предмет из колчана, как если бы это был обычный колчан или ножны.</p>\r\n','<p>Все три отделения этого колчана соединены с межпространственным местом, что позволяет ему вмещать множество предметов, но весит он всегда не более 2 фунтов. В самом коротком отделении может поместиться до шестидесяти стрел, арбалетных болтов или подобных предметов. В среднем отделении помещается до восемнадцати метательных копий или подобных предметов. В самом длинном отделении помещается до шести длинных предметов, таких как луки, боевые посохи и копья.</p>\r\n\r\n<p>Вы можете вынуть любой предмет из колчана, как если бы это был обычный колчан или ножны.</p>\r\n',1),(139,4,'Свиток \"Поиск пути\"',NULL,NULL,NULL,'<p>Спас: <strong>17</strong>, Атака: <strong>+9</strong></p>\r\n\r\n<p>Это заклинание позволяет найти кратчайший и самый прямой путь к определённому месту, знакомому вам, находящемуся на том же плане существования. Если искомое место находится на другом плане существования, если это место перемещается (например, это передвижная крепость), или это не конкретное место (например, &laquo;логово зелёного дракона&raquo;), заклинание проваливается. Пока заклинание активно, и пока вы находитесь на одном плане существования с искомым местом, вы знаете, как далеко, и в каком направлении оно находится. Пока вы направляетесь туда, каждый раз, когда у вас появляются разные варианты направления, вы автоматически определяете, какой путь самый короткий и прямой (но не обязательно самый безопасный) к искомому месту.</p>\r\n','<p>Спас: <strong>17</strong>, Атака: <strong>+9</strong></p>\r\n\r\n<p>Это заклинание позволяет найти кратчайший и самый прямой путь к определённому месту, знакомому вам, находящемуся на том же плане существования. Если искомое место находится на другом плане существования, если это место перемещается (например, это передвижная крепость), или это не конкретное место (например, &laquo;логово зелёного дракона&raquo;), заклинание проваливается. Пока заклинание активно, и пока вы находитесь на одном плане существования с искомым местом, вы знаете, как далеко, и в каком направлении оно находится. Пока вы направляетесь туда, каждый раз, когда у вас появляются разные варианты направления, вы автоматически определяете, какой путь самый короткий и прямой (но не обязательно самый безопасный) к искомому месту.</p>\r\n',0),(140,4,'Красивая дварфская брошь ',NULL,NULL,0.02,'<p>Красивая дварфская брошь</p>\r\n','<p>Красивая дварфская брошь</p>\r\n',0),(141,4,'Небольшая золотая статуэтка с рубинами ',7500,4,0.1,'<p>Небольшая золотая статуэтка с рубинами</p>\r\n','<p>Небольшая золотая статуэтка с рубинами</p>\r\n',0),(142,4,'Кольцо пепла',NULL,NULL,0.02,'<p>Нося это кольцо, вы обладаете сопротивлением к урону огнем. Кроме того, вы и всё, что вы несёте и носите, не получают вреда от температур выше&minus;50 &deg;F (&minus;45 &deg;C)</p>\r\n','<p>Нося это кольцо, вы обладаете сопротивлением к урону огнем. Кроме того, вы и всё, что вы несёте и носите, не получают вреда от температур выше&minus;50 &deg;F (&minus;45 &deg;C)</p>\r\n',0),(143,4,'Зелье превращения в демона',NULL,NULL,0.5,'<p>На 1 час превращяет в случайного демона.</p>\r\n','<p>На 1 час превращяет в случайного демона.</p>\r\n',0),(144,4,'Небольшой золотой идол',750,4,1,'<p>Золотой идол дракона.</p>\r\n','<p>Золотой идол дракона.</p>\r\n',0),(145,4,'Железный святой символ неизвестного божества ',10,1,0.5,'<p>Железный святой символ неизвестного божества</p>\r\n','<p>Железный святой символ неизвестного божества</p>\r\n',0),(146,1,'Кинжал драконьего зуба',NULL,NULL,1,'<p>Кинжал&nbsp;выполнен из драконьего зуба. Клинком служит клык или зуб хищника, а рукоять представляет собой обмотанный кожей корень зуба. Гарда отсутствуют.</p>\r\n\r\n<p>Вы получаете бонус +1 на броски атаки и урона проводимые этим оружием. При попадании этим оружием, цель получает дополнительный урон кислотой 1d6.</p>\r\n\r\n<p><strong>Мощь дракона</strong>. Против врагов Культа Дракона, бонус кинжала на броски атаки и урона повышается до +2, и дополнительный урон кислотой возрастает до 2d6.</p>\r\n','<p>Кинжал&nbsp;выполнен из драконьего зуба. Клинком служит клык или зуб хищника, а рукоять представляет собой обмотанный кожей корень зуба. Гарда отсутствуют.</p>\r\n\r\n<p>Вы получаете бонус +1 на броски атаки и урона проводимые этим оружием. При попадании этим оружием, цель получает дополнительный урон кислотой 1d6.</p>\r\n\r\n<p><strong>Мощь дракона</strong>. Против врагов Культа Дракона, бонус кинжала на броски атаки и урона повышается до +2, и дополнительный урон кислотой возрастает до 2d6.</p>\r\n',0),(147,4,'Диадема человечности',NULL,NULL,0.05,'<p>Настройка, пока вы ее носите вы выглядете как человек.</p>\r\n','<p>Настройка, пока вы ее носите вы выглядете как человек.</p>\r\n',0),(148,2,'Смелое сердце',NULL,NULL,6,'<p>Щит + 1 КД сопротивление к огню и атаки демонов с помехой &ldquo;Смелое сердце&rdquo;, настройки.</p>\r\n','<p>Щит + 1 КД сопротивление к огню и атаки демонов с помехой &ldquo;Смелое сердце&rdquo;, настройки.</p>\r\n',0),(149,2,'Серебрянный лист(Проклепанная кожа)',NULL,NULL,13,'<p>+1КД C преимуществом выживание, уход за жив, природа. 1 раз до рассвета бросить 2d8+2 востановить здоровье.</p>\r\n','<p>+1КД C преимуществом выживание, уход за жив, природа. 1 раз до рассвета бросить 2d8+2 востановить здоровье.</p>\r\n',0),(150,2,'Ласка (Проклепанная кожа)',NULL,NULL,13,'<p>+1КД, проверки ловкости и спас. ловкости с преимуществом.</p>\r\n','<p>+1КД, проверки ловкости и спас. ловкости с преимуществом.</p>\r\n',0),(151,1,'Защитник',NULL,NULL,3,'<p>Вы получаете бонус +3 к броскам атаки и урона этим магическим оружием.</p>\r\n\r\n<p>В первый раз в каждом своём ходу, когда вы атакуете этим оружием, вы можете перевести весь бонус или его часть в бонус к КД, а не броскам атаки и урона. Например, вы можете уменьшить бонус к броскам атаки и урона до +1, но получить +2 к КД. Изменённые бонусы действуют до начала вашего следующего хода, но вы должны держать этот меч, чтобы получать от него бонус к КД.</p>\r\n','<p>Вы получаете бонус +3 к броскам атаки и урона этим магическим оружием.</p>\r\n\r\n<p>В первый раз в каждом своём ходу, когда вы атакуете этим оружием, вы можете перевести весь бонус или его часть в бонус к КД, а не броскам атаки и урона. Например, вы можете уменьшить бонус к броскам атаки и урона до +1, но получить +2 к КД. Изменённые бонусы действуют до начала вашего следующего хода, но вы должны держать этот меч, чтобы получать от него бонус к КД.</p>\r\n',0),(152,4,'Справочник телесного здоровья',NULL,NULL,NULL,'<p>Эта книга содержит советы по здоровью и питанию, и её слова наполнены магией. Если вы потратите 48 часов за 6 дней на изучение содержимого книги и применение его на практике, ваше Телосложение, а также его максимум увеличатся на 2. После этого руководство теряет магию, но восстанавливает её через 100 лет.</p>\r\n','<p>Эта книга содержит советы по здоровью и питанию, и её слова наполнены магией. Если вы потратите 48 часов за 6 дней на изучение содержимого книги и применение его на практике, ваше Телосложение, а также его максимум увеличатся на 2. После этого руководство теряет магию, но восстанавливает её через 100 лет.</p>\r\n',0),(153,4,'Зелье газообразной формы',NULL,NULL,NULL,'<p>Когда вы выпиваете это зелье, вы получаете эффект заклинания <strong>газообразная форма</strong> (концентрация не требуется) на 1 час, или пока вы бонусным действием не прервёте его. Пузырёк с этим зельем как будто содержит туман, перетекающий, словно вода.</p>\r\n','<p>Когда вы выпиваете это зелье, вы получаете эффект заклинания <strong>газообразная форма</strong> (концентрация не требуется) на 1 час, или пока вы бонусным действием не прервёте его. Пузырёк с этим зельем как будто содержит туман, перетекающий, словно вода.</p>\r\n',0),(154,4,'Зелье превосходного лечения(10d4 + 20)',NULL,NULL,NULL,'','',0),(155,4,'Свиток заклинания 4-го уровня «Страж природы», Спас: 15, Атака: +7',NULL,NULL,NULL,'','',0),(156,4,'Свиток заклинания 9-го уровня «Полное превращение», Спас: 19, Атака: +11',NULL,NULL,NULL,'','',0),(157,4,'Свиток заклинания 8-го уровня «Аура святости », Спас: 18, Атака: +10',NULL,NULL,NULL,'','',0),(158,4,'Свиток заклинания 9-го уровня «Множественное полное исцеление», Спас: 19, Атака: +11',NULL,NULL,NULL,'','',0),(159,2,'Кольчужная рубаха',50,4,20,'','',0),(160,1,'Длинный меч',15,4,3,'','',0),(161,1,'Солнечный клинок',NULL,NULL,0.6,'<p>Этот предмет выглядит как рукоять длинного меча. Держа эту рукоятку, вы можете бонусным действием заставить появиться или исчезнуть клинок из чистого сияния. Пока клинок существует, этот магический длинный меч обладает свойством &laquo;фехтовальное&raquo;. Если вы владеете обращением с короткими или длинными клинками, то вы владеете и обращением с солнечным клинком.</p>\r\n\r\n<p>Вы получаете бонус +2 к броскам атаки и урона, совершённым этим оружием, и причиняете не рубящий урон, а урон излучением. Если вы попадаете им по нежити, цель получает дополнительный урон излучением 1d8.</p>\r\n\r\n<p>Клинок этого меча испускает яркий свет в радиусе 15 фт. и тусклый свет в радиусе ещё 15 фт. Это солнечный свет. Пока клинок существует, вы можете действием увеличить или уменьшить радиус и яркого и тусклого света на 5 фт. каждый, с максимумом 30 фт. и минимумом 10 фт. для каждого.</p>\r\n','<p>Этот предмет выглядит как рукоять длинного меча. Держа эту рукоятку, вы можете бонусным действием заставить появиться или исчезнуть клинок из чистого сияния. Пока клинок существует, этот магический длинный меч обладает свойством &laquo;фехтовальное&raquo;. Если вы владеете обращением с короткими или длинными клинками, то вы владеете и обращением с солнечным клинком.</p>\r\n\r\n<p>Вы получаете бонус +2 к броскам атаки и урона, совершённым этим оружием, и причиняете не рубящий урон, а урон излучением. Если вы попадаете им по нежити, цель получает дополнительный урон излучением 1d8.</p>\r\n\r\n<p>Клинок этого меча испускает яркий свет в радиусе 15 фт. и тусклый свет в радиусе ещё 15 фт. Это солнечный свет. Пока клинок существует, вы можете действием увеличить или уменьшить радиус и яркого и тусклого света на 5 фт. каждый, с максимумом 30 фт. и минимумом 10 фт. для каждого.</p>\r\n',0),(162,4,'Мантия архимага(Белая)',NULL,NULL,NULL,'<p>Этот красивый наряд пошит из белой, серой или чёрной ткани и украшен серебристыми рунами. Цвет мантии соответствует мировоззрению, для которого она и создана. Белые мантии делают для добрых, серые для нейтральных, а чёрные для злых. Вы не можете настроиться на мантию архимага, чьё мировоззрение не совпадает с вашим.</p>\r\n\r\n<p>Вы получаете следующие преимущества, пока носите мантию:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Если вы не носите доспех, ваш базовый Класс Доспеха равен 15 + ваш модификатор Ловкости.</p>\r\n\r\n<p>Вы совершаете с преимуществом спасброски от заклинаний и других магических эффектов.</p>\r\n\r\n<p>Сл спасбросков от ваших заклинаний и бонус атаки заклинаниями увеличиваются на 2.</p>\r\n','<p>Этот красивый наряд пошит из белой, серой или чёрной ткани и украшен серебристыми рунами. Цвет мантии соответствует мировоззрению, для которого она и создана. Белые мантии делают для добрых, серые для нейтральных, а чёрные для злых. Вы не можете настроиться на мантию архимага, чьё мировоззрение не совпадает с вашим.</p>\r\n\r\n<p>Вы получаете следующие преимущества, пока носите мантию:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Если вы не носите доспех, ваш базовый Класс Доспеха равен 15 + ваш модификатор Ловкости.</p>\r\n\r\n<p>Вы совершаете с преимуществом спасброски от заклинаний и других магических эффектов.</p>\r\n\r\n<p>Сл спасбросков от ваших заклинаний и бонус атаки заклинаниями увеличиваются на 2.</p>\r\n',0),(163,4,'Центральный осколок мозаики безымянного \"Разбивающий оковы\"',NULL,NULL,0.1,'','',0),(164,4,'Левый осколок мозаики безымянного \"Божественный смертный\"',NULL,NULL,0.1,'','',0),(165,4,'Талисман Зла',NULL,NULL,0.02,'<p>Для злового персонажа фокусировка +2. При касании добрым персонажем наносит 8d6 некротиком.</p>\r\n','<p>Для злового персонажа фокусировка +2. При касании добрым персонажем наносит 8d6 некротиком.</p>\r\n',0),(166,1,'Танцующий меч',NULL,NULL,2,'<p>&nbsp;Вы можете бонусным действием бросить этот магический меч в воздух и произнести командное слово. После этого меч начнёт парить, пролетает до 30 фт. и атакует одно существо на ваш выбор в пределах 5 фт. от него. Меч использует ваш бросок атаки и ваш модификатор характеристики для броска урона.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; Пока меч парит, вы можете бонусным действием заставить его перелететь на расстояние 30 фт. в другое место, находящееся в пределах 30 фт. от вас. Частью этого же бонусного действия вы можете заставить меч атаковать одно существо, находящееся в пределах 5 фт. от него.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; После того как парящий меч совершит четвёртую атаку, он пролетает до 30 фт. и пытается вернуться в вашу руку. Если у вас нет свободных рук, он падает на землю у ваших ног. Если у меча нет свободного пути до вас, он перемещается максимально близко к вам и потом падает на землю. Он перестаёт парить, если вы хватаете его или перемещаетесь более чем на 30 фт. от него.</p>\r\n','<p>&nbsp;Вы можете бонусным действием бросить этот магический меч в воздух и произнести командное слово. После этого меч начнёт парить, пролетает до 30 фт. и атакует одно существо на ваш выбор в пределах 5 фт. от него. Меч использует ваш бросок атаки и ваш модификатор характеристики для броска урона.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; Пока меч парит, вы можете бонусным действием заставить его перелететь на расстояние 30 фт. в другое место, находящееся в пределах 30 фт. от вас. Частью этого же бонусного действия вы можете заставить меч атаковать одно существо, находящееся в пределах 5 фт. от него.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; После того как парящий меч совершит четвёртую атаку, он пролетает до 30 фт. и пытается вернуться в вашу руку. Если у вас нет свободных рук, он падает на землю у ваших ног. Если у меча нет свободного пути до вас, он перемещается максимально близко к вам и потом падает на землю. Он перестаёт парить, если вы хватаете его или перемещаетесь более чем на 30 фт. от него.</p>\r\n',0),(167,4,'Ювелирное украшение',2000,4,0.5,'','',0),(168,4,'Драгоценных камень(1000зм.)',1000,4,0.5,'','',0),(170,4,'Чернила с основой из драг камне',50,4,NULL,'','',0),(171,4,'Брилиантовая пыль ',100,4,NULL,'','',0),(172,4,'Драгоценных камень(500зм.)',500,4,NULL,'','',0),(173,4,'Документ на владение поместьем в Фандалине',NULL,NULL,NULL,'','',0),(174,4,'Грамота-благодарность за помощь в освобождении кузницы заклинаний',NULL,NULL,NULL,'','',0),(175,4,'Верхний осколок мозаики безымянного \"Божественный\"',NULL,NULL,NULL,'','',0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `img_name` varchar(255) DEFAULT NULL,
  `type` smallint(6) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `map_owner_id_user_id` (`owner_id`),
  CONSTRAINT `map_owner_id_user_id` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
INSERT INTO `map` VALUES (5,'Фаерун','Экономически и технологически Фаэрун сопоставим с Западной Европой в период Позднего Средневековья. Порох, известный здесь как дымной порошок, уже известен, но по своему составу он отличается от своего исторического прародителя. Он начинает обретать популярность, но все-таки в большей части вооружения по-прежнему доминирует оружие, существовавшее до пороха, такое как мечи, копья, луки и т. п. Большинство населения Фаэруна состоит из фермеров, которые живут довольно свободно в полуфеодальной системе. Есть также ряд крупных городов, а торговля между странами является распространенной, как в эпоху Возрождения. Однако еще сохранились и варварские племена, где властвуют традиции.\r\n\r\nВ мире Фаэруна существует несколько расовых пантеонов, которым поклоняются жители того или иного географического региона или целая раса. Вера охватывает широкий круг этических убеждений и интересов.\r\n\r\nНа просторах Фаэрунского континента развернули свою деятельность сотни гильдий, культов, орденов и тайных обществ. Некоторые из них собрались, чтобы вести войну против зла, дав клятвы служить добру, подобно тем, что дают паладины. Но большинство организаций состоят из богатых, жадных до власти, и часто жестоких людей, заинтересованных лишь в воплощении своих грязных планов.\r\n\r\nПостоянные организации стандартны, но в Королевствах это может означать многое. В большинстве случаев такие организации имеют единственного лидера. В этом случае ясно, кто отвечает за их действия. Обычно постоянная организация также имеет штаб или замок, построенный силами самой гильдии, или город, в котором живут все её члены. Гильдия без постоянного штаба почти всегда имеет средства передвижения, и, прибывая на место задания, её члены встают большим лагерем.','5ExAv_FOLbHAuP6f3e54RdfTrMTFcWSO.jpg',1,1),(10,'Округи Фандалина','','tXCwwZiRi9iEET3CCwaAXZyY2-dnXnVl.png',0,1),(11,'Фандалин','','anDuXVXbU0N0fiRCJo02cMdzTdaiLe5E.png',0,1),(12,'Флан','','c3hekmaXM1COlIdAnrLg-6uytK0Dy38r.png',0,1);
/*!40000 ALTER TABLE `map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_markers`
--

DROP TABLE IF EXISTS `map_markers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map_markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `img_name` varchar(255) DEFAULT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  `sub_map_id` int(11) DEFAULT NULL,
  `map_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `map_maker_map_id_map_id` (`map_id`),
  KEY `map_maker_sub_map_id_map_id` (`sub_map_id`),
  CONSTRAINT `map_maker_map_id_map_id` FOREIGN KEY (`map_id`) REFERENCES `map` (`id`),
  CONSTRAINT `map_maker_sub_map_id_map_id` FOREIGN KEY (`sub_map_id`) REFERENCES `map` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_markers`
--

LOCK TABLES `map_markers` WRITE;
/*!40000 ALTER TABLE `map_markers` DISABLE KEYS */;
INSERT INTO `map_markers` VALUES (1,'Детальная карта Фандалина','','',531,462,0,10,5),(2,'Фандалин','','',944,1747,0,11,10),(24,'ВАЛИНГЕНСКОЕ КЛАДБИЩЕ','На противоположном берегу реки Стоянов, находится городское кладбище  Флана — величественный сад полный деревьев и цветущих растений. Один из  первых, выданных Кваалом Даораном [Cvaal Daoran] эдиктов приказывал  небольшому контингенту церкви Келемвора [Kelemvor] очистить кладбище от  нежити.\r\n Они предоставляют городу погребальные и поминальные услуги. С момента  перехода под их опеку нежить на кладбище прекратила появляться. Это  кладбище является местом упокоения Мильтиадеса, неживого паладина из  легенд.','',650,670,0,NULL,12),(25,'ТРЕПЕЩУЩИЙ ЛЕС','Этот огромный зачарованный лес был высажен много лет назад дикими  эльфами для зашиты от орд из Тара [Thar]. Кроме прочего, чары ускоряют  рост леса. За два года после полной вырубки, на его месте вырастает  новый, молодой лес, а за время человеческой жизни он превращается в  густую и темную чащу.\r\n Могучая карга, Зеленозубая Джени [Jeny Greenteeth], и другие темные феи  этого леса, после того, как Жентарим пришёл к власти во Флане, заключили  договор с Киноварным Троном, который гласил, что теперь лес закрыт для  прохода и топоров дровосеков.\r\n Этот пакт принес свои плоды во время Теневой Войны [Shadowbane War] 1383  АД предотвратив раз¬рушение Флана руками Нетерильцев. С тех пор договор  нарушался только раз, когда второй Лорд-протектор исчез отправившись в  лес.','',1298,103,0,NULL,12),(26,'ОСТРОВ КОЛДУНА','Этот небольшой остров на реке Стоянов, невзрачное пристанище для  большой серебряной пирамиды, 120 футов высотой и 90 футов шириной  стороны по основанию. Эта таинственная конструкция была домом для  безумного волшебника Яраша Яраш проводил эксперименты над местной флорой  и фауной превращая их в ужасных существ.\r\n Перемещение в, внутри и наружу пирамиды происходит при помощи магической  телепортации. По слухам, внутри пирамиды, находятся чудовищные  существа, магические ловушки, и сокровища перешагивающие грани  воображения. Однако, никто из пошедших за ними, не вернулся. В настоящее  время пирамида занята племенем мутантов ящеролюдов, потомков нескольких  жертв экспериментов Яраша.','',725,419,0,NULL,12),(27,'Тюрьма Гримшекл','','',1936,1205,0,NULL,12);
/*!40000 ALTER TABLE `map_markers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1517519596),('m130524_201442_init',1517519598),('m140506_102106_rbac_init',1517522903),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1517522903),('m180201_221011_create_map_table',1517532007),('m180206_200706_mapMarkersCreate',1517949434),('m180207_193335_create_token',1519222155),('m180221_141501_character',1519235039),('m180221_183626_fixAbility',1519238245),('m180221_190130_addAbilityNameID',1519240009),('m180221_194643_addRaceInfo',1519242451),('m180221_195940_RaceUpdate',1519243342),('m180221_203416_skillFix',1519245310),('m180221_211010_skillUpdate',1519247720),('m180221_212018_deleteClassSkillModifier',1519248076),('m180221_212501_fixRaceSkillProf',1519248541),('m180221_225154_classUpdate',1519254770),('m180221_233606_armorType',1519256386),('m180221_233826_weaponType',1519256386),('m180222_001031_armorItems',1519259388),('m180222_001454_armorTypesUpdate',1519259388),('m180222_002004_createCurrency',1519259388),('m180222_013150_updateArmorTypes',1519263710),('m180222_023630_updateWeaponType',1519267092),('m180222_024828_weapon',1519269610),('m180222_024840_weaponProperties',1519269711),('m180222_024848_weaponTypeGroups',1519269711),('m180222_025955_armorTypeGroups',1519270893),('m180222_034051_weaponNarmorTypesGroups',1519270893),('m180226_111714_damageTypeAdd',1519643988),('m180226_144843_weaponTypeUpdate',1519659809),('m180226_160158_classWeaponProficiency',1519661220),('m180227_130049_tools',1519737224),('m180227_130106_class_tools_prof',1519737224),('m180227_133420_toolsType',1519740268),('m180227_144336_class_tools_prof_update',1519743019),('m180227_222815_class_level_talant',1519770616),('m180227_223643_talent_update',1519771574),('m180302_221105_character_update',1520029885),('m180303_000420_character_name',1520035552),('m180303_002416_character_ability',1520036727),('m180303_154033_class_talent_update',1520091761),('m180303_160656_notes',1520094421),('m180303_162345_tags',1520094421),('m180303_162438_notes_tags',1520094421),('m180304_150909_character_skill',1520176432),('m180304_153128_proficiency_bonus_level_rel',1520177574),('m180304_162605_character_update',1520180806),('m180306_002636_character_inventory',1520812327),('m180312_005050_weapon_property',1520815888),('m180312_033410_race_update',1520825708),('m180312_034020_race_update_2',1520826100),('m180312_034822_character_talent',1520826644),('m180320_185932_spell',1521572864),('m180320_192023_spell_update',1521573730),('m180325_140553_characterMoney',1521987108),('m180325_141533_updateCurrency',1521987448),('m180325_143715_characterItemsUpdate',1521988859),('m180325_151444_weaponUpdate',1521991381),('m180325_175437_itemsUpdate',1522000524),('m180325_193543_characterClassUpdate',1522006924),('m180328_010802_multiclass_magic_level_point',1522199394),('m180328_013215_update_classes_by_caster_value',1522200839),('m180328_020059_character_spell_points',1522202579),('m180328_142004_update_user_role',1522246852),('m180328_142243_character_update_player_id',1522247130),('m180328_144057_character_party',1522248374),('m180330_172643_talents_update',1522432501),('m180330_190755_spellAbility',1522437086),('m180427_173326_spell_propery',1524850698),('m180427_174220_spell_school_update',1524850985),('m180506_080627_class_talent_character_used',1525594564),('m180506_083547_update_CharacterTalent',1525595820),('m180515_154501_talentUpdate',1526399182),('m180515_160353_characterUpdate',1526400294);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multiclass_magic_level_point`
--

DROP TABLE IF EXISTS `multiclass_magic_level_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multiclass_magic_level_point` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spell_level` int(11) unsigned DEFAULT NULL,
  `spell_point` int(11) unsigned DEFAULT NULL,
  `level` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiclass_magic_level_point`
--

LOCK TABLES `multiclass_magic_level_point` WRITE;
/*!40000 ALTER TABLE `multiclass_magic_level_point` DISABLE KEYS */;
INSERT INTO `multiclass_magic_level_point` VALUES (1,1,2,1),(2,1,3,2),(3,1,4,3),(4,2,2,3),(5,1,4,4),(6,2,3,4),(7,1,4,5),(8,2,3,5),(9,3,2,5),(10,1,4,6),(11,2,3,6),(12,3,3,6),(13,1,4,7),(14,2,3,7),(15,3,3,7),(16,4,1,7),(17,1,4,8),(18,2,3,8),(19,3,3,8),(20,4,2,8),(21,1,4,9),(22,2,3,9),(23,3,3,9),(24,4,3,9),(25,5,1,9),(26,1,4,10),(27,2,3,10),(28,3,3,10),(29,4,3,10),(30,5,2,10),(31,1,4,11),(32,2,3,11),(33,3,3,11),(34,4,3,11),(35,5,2,11),(36,6,1,11),(37,1,4,12),(38,2,3,12),(39,3,3,12),(40,4,3,12),(41,5,2,12),(42,6,1,12),(43,1,4,13),(44,2,3,13),(45,3,3,13),(46,4,3,13),(47,5,2,13),(48,6,1,13),(49,7,1,13),(50,1,4,14),(51,2,3,14),(52,3,3,14),(53,4,3,14),(54,5,2,14),(55,6,1,14),(56,7,1,14),(57,8,1,15),(58,7,1,15),(59,1,4,15),(60,2,3,15),(61,3,3,15),(62,4,3,15),(63,5,2,15),(64,6,1,15),(65,8,1,16),(66,7,1,16),(67,6,1,16),(68,5,2,16),(69,4,3,16),(70,3,3,16),(71,2,3,16),(72,1,4,16),(73,1,4,17),(74,1,4,18),(75,1,4,19),(76,1,4,20),(77,2,3,17),(78,3,3,17),(79,4,3,17),(80,5,2,17),(81,6,1,17),(82,7,1,17),(83,8,1,17),(84,9,1,17),(85,2,3,18),(86,2,3,19),(87,2,3,20),(88,3,3,20),(89,3,3,19),(90,3,3,18),(91,4,3,18),(92,4,3,19),(93,4,3,20),(94,5,3,18),(95,5,3,19),(96,5,3,20),(97,6,1,18),(98,6,2,19),(99,6,2,20),(100,7,1,18),(101,7,1,19),(102,7,2,20),(103,8,1,18),(104,8,1,19),(105,8,1,20),(106,9,1,18),(107,9,1,19),(108,9,1,20);
/*!40000 ALTER TABLE `multiclass_magic_level_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note_tags`
--

DROP TABLE IF EXISTS `note_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `note_id` int(11) unsigned DEFAULT NULL,
  `tag_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `note_tags_note_id_note_id` (`note_id`),
  KEY `note_tags_tag_id_tags_id` (`tag_id`),
  CONSTRAINT `note_tags_note_id_note_id` FOREIGN KEY (`note_id`) REFERENCES `notes` (`id`),
  CONSTRAINT `note_tags_tag_id_tags_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note_tags`
--

LOCK TABLES `note_tags` WRITE;
/*!40000 ALTER TABLE `note_tags` DISABLE KEYS */;
INSERT INTO `note_tags` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,2,2),(6,2,4);
/*!40000 ALTER TABLE `note_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `map_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_map_id_map_id` (`map_id`),
  KEY `notes_parent_id_notes_id` (`parent_id`),
  CONSTRAINT `notes_map_id_map_id` FOREIGN KEY (`map_id`) REFERENCES `map` (`id`),
  CONSTRAINT `notes_parent_id_notes_id` FOREIGN KEY (`parent_id`) REFERENCES `notes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,'Боги','<p>Забытые королевства &ndash; мир большой и разнообразный. И хотя среди людей, эльфов, дварфов, и прочих рас случаются и отъявленные атеисты, большинство всё же верит в своих богов, надеется на них, молит о помощи и покровительстве, и, как правило, получает ответ.<br />\r\nПоскольку пантеон богов насчитывает не один и не два десятка, мы выбрали наиболее &laquo;статусных&raquo; вершителей судеб, дабы не вносить сумятицу в умы игроков. Религия на игре держится на <strong>трех важных постулатах</strong>:<br />\r\n1) Проводниками &laquo;божественной воли&raquo; на игре являются храмы и священники (жрецы).<br />\r\n2) Взаимодействие с богами на игре носит характер бартера: вера и пожертвования, в обмен на помощь и чудеса. Проводниками бартера выступают священники и Обряды.<br />\r\n3) Несмотря на &laquo;расовый&raquo; характер богов, никому не возбраняется верить в величие и могущество любого бога.<br />\r\n<strong>Об обрядах:</strong><br />\r\n1) Мастерская группа сознательно не даёт каких-либо четких словесных формулировок обрядов и молитв, дабы не регламентировать творческие порывы игроков. Жрецы Богов самостоятельно решают, как и какими словесами призывать божественных заступников.<br />\r\n2) Описания обрядов включают в себя лишь необходимые обязательные элементы.<br />\r\n3) Чем ярче и изобретательнее проведен обряд, тем больше вероятности, что боги вас услышат.<br />\r\n4) Игротехника обрядов изложена после краткой характеристики каждого бога.<br />\r\n5) Волю богов, после совершения обряда, передает игрокам региональщик. В случае успешного проведения, игроки получают божественное благословение указанное в обряде.<br />\r\n6) Жрецы в своем храме могут совершать божественное вмешательство и три различных обряда во имя своего бога.<br />\r\n7) Если обряд прерывается по любой возможной причине, то он считается проваленным. Подношения не возвращаются. В зависимости от обстоятельств, божество наказывает за прерванный обряд.<br />\r\n8) Жрецы могут исцелять союзных персонажей в храме своего бога. Персонаж в храме восстанавливает все свои хиты за 10 минут. Отыгрывается заботой жреца о больном.<br />\r\n9) В особо важных случаях, либо при возникновении спорных ситуаций, жрецы могут обращаться в игротехническую локацию Храм Всех Богов.<br />\r\n<br />\r\n<strong>Храмы:</strong><br />\r\nВ локации можно построить только один храм каждого божества. Два храма одному божеству строить нельзя. Строить один храм для нескольких богов тоже запрещено.<br />\r\n<br />\r\n<strong>Требования по антуражу</strong>: Храм - отгороженное здание площадью не меньше 4 квадратных метров. В храме должен находиться алтарь божества в любом стиле, соответствующем божеству, а также изображение символа божества размером не менее 20х20 см.<br />\r\n&nbsp;</p>\r\n',NULL,NULL),(2,'Илматер','<p>Среднее божество</p>\r\n\r\n<p><a href=\"https://vignette.wikia.nocookie.net/rpg/images/c/c4/Ilmater_FRFnP_p32_2002.jpg/revision/latest?cb=20100430095123&amp;path-prefix=ru\"><img alt=\"Ilmater FRFnP p32 2002\" src=\"https://vignette.wikia.nocookie.net/rpg/images/c/c4/Ilmater_FRFnP_p32_2002.jpg/revision/latest/scale-to-width-down/200?cb=20100430095123&amp;path-prefix=ru\" style=\"height:240px; width:200px\" /></a></p>\r\n\r\n<p><a href=\"http://ru.rpg.wikia.com/wiki/%D0%A1%D0%B5%D1%82%D1%82%D0%B8%D0%BD%D0%B3\">Сеттинг</a>(и)<a href=\"http://ru.rpg.wikia.com/wiki/Forgotten_Realms\">Forgotten Realms</a></p>\r\n\r\n<p>Титул(ы)</p>\r\n\r\n<p><em>Плачущий бог, </em></p>\r\n\r\n<p><em>Сломанный бог, </em></p>\r\n\r\n<p><em>Владыка дыбы, </em></p>\r\n\r\n<p><em>Переносящий, </em></p>\r\n\r\n<p><em>Аюрук</em></p>\r\n\r\n<p>Союзники<a href=\"http://ru.rpg.wikia.com/wiki/%D0%A2%D0%B8%D1%80\">Тир</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%A2%D0%BE%D1%80%D0%BC\">Торм</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%9B%D0%B0%D1%82%D0%B0%D0%BD%D0%B4%D0%B5%D1%80\">Латандер</a></p>\r\n\r\n<p>Враги<a href=\"http://ru.rpg.wikia.com/wiki/%D0%9B%D0%BE%D0%B2%D0%B8%D0%B0%D1%82%D0%B0%D1%80\">Ловиатар</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%91%D1%8D%D0%B9%D0%BD\">Бэйн</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%93%D0%B0%D1%80%D0%B0%D0%B3%D0%BE%D1%81\">Гарагос</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%9C%D0%B0%D0%BB%D0%B0%D1%80\">Малар</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%A8%D0%B0%D1%80\">Шар</a>, <a href=\"http://ru.rpg.wikia.com/wiki/%D0%A2%D0%B0%D0%BB%D0%BE%D1%81\">Талос</a></p>\r\n\r\n<p>Домашний <a href=\"http://ru.rpg.wikia.com/wiki/%D0%9F%D0%BB%D0%B0%D0%BD\">план</a><a href=\"http://ru.rpg.wikia.com/wiki/%D0%A6%D0%B5%D0%BB%D0%B5%D1%81%D1%82%D0%B8%D1%8F\"> Целестия</a>, ранее <a href=\"http://ru.rpg.wikia.com/wiki/%D0%94%D0%BE%D0%BC_%D0%A2%D1%80%D0%B8%D0%B0%D0%B4%D1%8B\">Дом Триады</a></p>\r\n\r\n<p><a href=\"http://ru.rpg.wikia.com/wiki/%D0%9C%D0%B8%D1%80%D0%BE%D0%B2%D0%BE%D0%B7%D0%B7%D1%80%D0%B5%D0%BD%D0%B8%D0%B5\">Мировоззрение</a><a href=\"http://ru.rpg.wikia.com/wiki/Neutral_Good\"> Neutral Good</a>, ранее <a href=\"http://ru.rpg.wikia.com/wiki/Lawful_Good\">Lawful Good</a>Сферы влиянияСтрадание, выносливость, мученичество, стойкостьПрихожанеКалеки, угнетаемые, бедняки, монахи, паладины, крепостные, рабыМировоззрение <a href=\"http://ru.rpg.wikia.com/wiki/%D0%9A%D0%BB%D0%B5%D1%80%D0%B8%D0%BA\">клериков</a><a href=\"http://ru.rpg.wikia.com/wiki/Lawful_Good\">LG</a><a href=\"http://ru.rpg.wikia.com/wiki/Neutral_Good\">NG</a>CG<a href=\"http://ru.rpg.wikia.com/wiki/Lawful_Neutral\">LN</a>NCNLENECE<a href=\"http://ru.rpg.wikia.com/wiki/%D0%94%D0%BE%D0%BC%D0%B5%D0%BD_(D%26D_3.x)\">Домены</a>Свобода, Надежда; ранее Добро, Лечение, Закон, Сила, Страдание<a href=\"http://ru.rpg.wikia.com/wiki/%D0%98%D0%B7%D0%B1%D1%80%D0%B0%D0%BD%D0%BD%D0%BE%D0%B5_%D0%BE%D1%80%D1%83%D0%B6%D0%B8%D0%B5\">Избранное оружие</a>Открытая рука (рукопашный удар)</p>\r\n\r\n<p>Нежный и добродушный, Илматер (илл-мэй-тер, ill-may-ter) - тихое, миролюбивое божество, охотно берущее на себя трудности и слезы давно страдающего мира. Хотя его и нелегко возмутить, гнев Сломанного Божества перед лицом чрезвычайной жестокости или злодеяний ужасен. Он предпринимает огромные усилия, чтобы защитить и оберегать детей и молодёжь, и он сурово карает тех, кто способен повредить им. Плачущий Бог выглядит как человек, тело которого было ужасно искалечено наказаниями, испещрено отметками от пыток, с переломанными и разбитыми суставами. Он невысок, крепок, лысеет и носит лишь набедренную повязку, но его доброе, домашнее лицо светится теплотой и покоем. Неправильно понимаемая большинством, жалеемая и даже иногда презираемая, церковь Илматера все же имеет на Фаэруне чуть ли не больше всего преданных последователей. В жестоком мире страдающие, больные и бедные могут полагаться лишь на последователей Плачущего Бога, которые помогают всем. Церковь Илматера широко любима простым народом всех заселенных земель, и его духовенство может рассчитывать на щедрую поддержку в своей пожизненной миссии лечения. Те, кто не могут постичь, как кто-либо по своей воле может подвергнуться мучениям и жестокости, как это преданные преданные Илматера, просто неверно истолковывают суть церкви. Среди тех, кто презирает слабых, церковь Плачущего Бога считается слабой и глупой - жестокие тираны и мощные злодеи опасно недооценивают ее членов. Жрецы Илматера молятся о заклинаниях утром, хотя они все же должны ритуально молиться Илматеру по крайней мере шесть раз в день. Они не имеют никаких ежегодных церковных праздников, но иногда клерик взывает к Мольбе Отдыха. Это позволяет ему десятидневную передышку от диктата Илматера, предотвращающую эмоциональное истощение или позволяющее клерику сделать что-либо, чем Илматер обычно может быть недоволен. Этот обычай - установленная традиция, на которую полагаются некоторые лидеры веры, посылая свое лучшее боевое духовенство делать то, что церковь не может выполнить иначе (например, тайное удаление тирана вместо открытого противостояния ему). Самым важным ритуалом Обращение: обязанность каждого клерика Илматера убедить любого умирающего обратиться к Илматеру за благословением Сломанного Бога перед смертью. (Эта предсмертная молитва не изменяет божество-покровителя умирающего на Илматера). Поскольку почитание Илматера растет, даже в смерти, его целебная сила становится все больше. Многие из клериков изучают умение Сварить Зелье, чтобы помогать тем, кто вне пределов их непосредственной досягаемости. Одна из групп илматерских монахов, Сломанные, действует в качестве защитников преданных и храмов церкви, а также карателей тех, кто безжалостно вредит другим. Эти монахи могут свободно мультиклассировать как тайные приверженцы, жрецы, божественные чемпионы, божественные ученики, божественные искатели или иерофанты. История и отношения[править]</p>\r\n\r\n<p>Илматер - среднее божество, давно связанное с Тиром (своим старшим) и Тормом. Вместе они известны как Триада. Триада тесно сотрудничает, поскольку в союзе они гораздо сильнее, чем порознь. Илматер также в союзе с Латандером. Он выступает против божеств, наслаждающихся разрушением и причиняющих боль и страдания другим, особенно против Ловиатар и Талоны, характер которых диаметрально протиположен его собственному. Другие противники этого божества - Бэйн, Гарагос, Малар, Шар и Талос.</p>\r\n\r\n<p><br />\r\nДуховенство и храмы</p>\r\n\r\n<p><br />\r\nСимвол Илматера - пара белых рук, связанных в запястьях красным шнуром Илматари разделяют то, что имеют, с теми, кто нуждается, и всегда находят время посоветовать тем, кто опечален, и позаботиться о поврежденных. Илматари защищают угнетенных, ведут потерявшихся, кормят голодных, оберегают бездомных и собирают травы и делают лекарства для грядущих бедствий. Они хоронят мертвых, ухаживают за больными и дают еду, питье и дрова бедным. Жизнь для них священна и в то же время полна страданий, но они не стоят на пути желаний других и не осуждают их за избранный ими путь. Когда ожидается война и позволяет время, жрецы Илматера собирают палатки, повязки и фургоны лекарств и излечивающих микстур для тех, кто вскоре может пострадать. Они также совершают поездки по самым состоятельным городам и поселениям Фаэруна, по разному ходатайствуя для поддержки церкви. Храмы Илматера, как правило, располагаются в сельской местности на главных торговых маршрутах, служа путевыми станциями для утомленных путешественников. Большинство их названы по имени святых-илматари, которых очень много. Большинство храмов выглядят как поместья, с крепкими стенами, окружающими по меньшей мере часовню, дом главы, конюшни и сад. Многие имеют запасы лекарств для заботы о больных и увечных. Другие содержат библиотеки, кельи монахов, отдельные от дома главы или бараки, для присоединившегося благородного ордена. Илматари носят жесткую серую тунику, табард и брюки или серые робы. Они носят тюбетейки серого (большинство членов духовенства) или красного цвета (старшие жрецы). Еще не посвящённые новички не носят тюбетеек. Символ Илматера носится как булавка на сердце или на цепочке на шее и служит святым символом. У некоторых из старших членов веры есть серая слезинка, вытатуированная у уголка их правого или левого глаза. Илматари организованы в неофициальную иерархию, сосредоточенную воокруг лидера большого храма, аббатства или монастыря, перед которым отвечают илматари региона. Аббатства и монастыри обычно привязываются к определенным храмам, часто добавляя второй ряд в неофициальной иерархии. Никакого понтифика или управляющего органа у веры нет, хотя старшее духовенство при необходимости собирается вместе для неофициальных тайных совещаний. Хотя большинство монахов живет отдельно от церкви в монастырях или аббатствах, некоторые живут в храмах илматари как преподаватели или защитники. Церковь Илматера имеет несколько присоединенных благородных орденов паладинов и воинов, включая Братство Благородного Сердца, Святых Воинов Страдания, Орден Золотого Кубка и Орден Сверкающей Розы. Монашеские ордена также многочисленны и включают Учеников Св.Соллара Дважды Мученика, самая известная из резидеций которых, Монастырь Желтой Розы, расположено в Дамаре, около Ледника Белого Червя. (Монахи этого монастыря специализируются в генеалогии). Другие монашеские ордена илматари включают Последователей Беспрепятственного Пути, Учеников Cв.Моргана Молчаливого и Сестер Cв.Джаспера из Скал. Большинство монастырей илматари традиционно называется по именам цветков, символизирующих что-либо значащее для ордена, хотя и не утвержденное официально.</p>\r\n\r\n<p>Догма</p>\r\n\r\n<p>Помогите всем, кто страдает, независимо от того, кто они. Истинно святой берет на себя страдания других. Если Вы страдаете во имя его, Илматер поддержит Вас. Придерживайтесь ваших принципов, если они правильны, невзирая на боль или опасность. Нет позора в что-либо значащей смерти. Выступайте против всех тиранов и не позволяйте несправедливости свободно продвигаться по миру. Ставьте духовность жизни выше существования материального тела.</p>\r\n',1,NULL);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proficiency_bonus_level_rel`
--

DROP TABLE IF EXISTS `proficiency_bonus_level_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proficiency_bonus_level_rel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proficiency_bonus` int(11) unsigned NOT NULL,
  `level` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proficiency_bonus_level_rel`
--

LOCK TABLES `proficiency_bonus_level_rel` WRITE;
/*!40000 ALTER TABLE `proficiency_bonus_level_rel` DISABLE KEYS */;
INSERT INTO `proficiency_bonus_level_rel` VALUES (1,2,1),(2,2,2),(3,2,3),(4,2,4),(5,3,5),(6,3,6),(7,3,7),(8,3,8),(9,4,9),(10,4,10),(11,4,11),(12,4,12),(17,5,13),(18,5,14),(19,5,15),(20,5,16),(21,6,17),(22,6,18),(23,6,19),(24,6,20);
/*!40000 ALTER TABLE `proficiency_bonus_level_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race`
--

DROP TABLE IF EXISTS `race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `info` text,
  `speed` int(11) DEFAULT NULL,
  `ideology` text,
  `age` text,
  `size` text,
  `names` text,
  `playable` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `race_parent_id_race_id` (`parent_id`),
  CONSTRAINT `race_parent_id_race_id` FOREIGN KEY (`parent_id`) REFERENCES `race` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race`
--

LOCK TABLES `race` WRITE;
/*!40000 ALTER TABLE `race` DISABLE KEYS */;
INSERT INTO `race` VALUES (1,'Эльф',NULL,'<p>Эльфы это волшебный народ, обладающий неземным изяществом, живущий в мире, но не являющийся его частью. Они живут в местах, наполненных воздушной красотой, в глубинах древних лесов или в серебряных жилищах, увенчанных сверкающими шпилями и переливающихся волшебным светом. Там лёгкие дуновения ветра разносят обрывки тихих мелодий и нежные ароматы.</p>\r\n\r\n<p>Эльфы любят природу и магию, музыку и поэзию, и всё прекрасное, что есть в мире.</p>\r\n\r\n<p><br />\r\n<strong>СТРОЙНЫЕ И ИЗЯЩНЫЕ</strong><br />\r\nОбладая неземным изяществом и тонкими чертами, эльфы кажутся людям и представителям других рас чересчур красивыми. В среднем, они немного ниже людей, их рост колеблется от 5 до 6 футов (от 150 до 185 сантиметров). Они стройнее людей, и весят от 100 до 145 фунтов (от 45 до 65 килограмм). Мужчины и женщины почти одинакового роста, и мужчины весят лишь незначительно больше.<br />\r\nЦвета кожи у эльфов включают в себя все человеческие оттенки, а также цвета с медным, бронзовым и голубовато-белым отливом. Волосы помимо человеческих цветов могут быть зелёными или синими, а глаза приобретать цвет жидкого золота или серебра. У эльфов не растут волосы на лице, и почти отсутствуют волосы на теле. Они предпочитают элегантную одежду ярких цветов и простые, но красивые украшения.</p>\r\n\r\n<p><br />\r\n<strong>НЕПОДВЛАСТНЫЙ ВРЕМЕНИ ВЗГЛЯД</strong><br />\r\nЭльфы способны жить более 700 лет, что даёт им более широкий взгляд на проблемы, беспокоящие короткоживущие расы. События чаще кажутся им забавными, чем волнующими, и ими чаще движет любопытство, чем жадность. В случае мелких происшествий они чаще проявляют равнодушие и остаются в стороне. В случае же преследования цели, выполнения задания или изучения нового навыка эльфы остаются собранными и целеустремлёнными. Они не торопятся заводить друзей или врагов, а прощают ещё медленнее. На мелкие оскорбления они отвечают пренебрежением,<br />\r\nна крупные же &mdash; местью. Подобно молодым ветвям дерева эльфы проявляют гибкость перед лицом опасности. Они верят в дипломатию и предпочитают с помощью компромисса уладить разногласие прежде чем оно перешло в насилие. Они способны отступить перед лицом вторжения вглубь своих лесов, уверенные, что просто смогут подождать, пока захватчики уйдут. Но если придёт нужда, эльфы способны проявить свою воинскую сторону, продемонстрировав владение мечом, луком и стратегией.</p>\r\n\r\n<p><br />\r\n<strong>СКРЫТЫЕ ЛЕСНЫЕ КОРОЛЕВСТВА</strong><br />\r\nБольшинство эльфов живёт в маленьких лесных деревнях, спрятанных среди деревьев. Эльфы охотятся на дичь, собирают пищу и растят овощи. Их навыки и магия позволяют им прокормить себя без вырубки леса и вспахивания земли. Они талантливы в ремёслах, изготавливают качественную одежду и предметы искусства. Их контакты с другими народами обычно ограничены, но некоторые эльфы всё же преуспели в торговле, выменивая свои товары на металлы, которые эльфы не любят добывать сами. Эльфы, встречающиеся за пределами родных земель, чаще всего оказываются путешествующими менестрелями, артистами или мудрецами. Людские дворяне соревнуются за услуги эльфа-наставника, способного обучить их детей фехтованию или магии.</p>\r\n\r\n<p><br />\r\n<strong>ИССЛЕДОВАНИЯ И ПРИКЛЮЧЕНИЯ</strong><br />\r\nЭльфы берутся за приключения из страсти к путешествиям. Благодаря большому сроку жизни, они могут посвятить столетия изучению и исследованию. Им не нравится темп человеческого общества, упорядоченный изо дня в день, но полностью меняющийся за десятилетие, и они предпочитают найти себе занятие, позволяющее им часто путешествовать, устанавливая свой собственный темп жизни. Эльфам также нравится оттачивать своё воинское мастерство, или добиваться великой волшебной мощи, и приключения способствуют этому. Некоторые могут присоединиться к повстанцам, борющимся против угнетателей, а другие становятся борцами за моральные ценности.</p>\r\n\r\n<p><br />\r\n<strong>ЭЛЬФИЙСКИЕ ИМЕНА</strong><br />\r\nЭльфы считаются детьми, пока они не объявят себя взрослыми, где-то вскоре после сотого дня рождения. До этого времени их называют детским именем. Достигая зрелости, эльф выбирает себе новое, взрослое имя, хотя те, кто знал его под детским именем, могут продолжать пользоваться им. Имя каждого взрослого эльфа уникально, хотя может отражать имена уважаемых личностей или членов семьи. Мужские и женские имена различаются лишь незначительно, и чёткой границы тут нет. Также каждый эльф носит фамилию, обычно это сочетание нескольких эльфийских слов. Некоторые эльфы, путешествующие среди людей, переводят фамилию на Общий, другие сохраняют эльфийскую версию.</p>\r\n\r\n<p><br />\r\n<strong>ВЫСОКОМЕРНЫЕ, НО ЛЮБЕЗНЫЕ</strong><br />\r\nХотя эльфы могут быть высокомерными, они обычно любезны даже с теми, кто не оправдал их высоких ожиданий.<br />\r\nКак правило, это все не-эльфы. Но всё же, они способны найти что-то хорошее почти в каждом.<br />\r\n<em>О дварфах.</em><br />\r\n&nbsp;&laquo;Дварфы скучные, неотёсанные болваны. Но свой недостаток чувства юмора, утончённости и манер они способны компенсировать отвагой. И смею заметить, изделия их лучших кузнецов способны сравниться с эльфийскими&raquo;.<br />\r\n<em>О полуросликах.</em><br />\r\n&nbsp;&laquo;Полурослики &mdash; народ простых удовольствий, и это не повод их презирать. Они хороший народ, заботятся друг о друге и ухаживают за своими садами, и они доказали, что они намного крепче, чем это может показаться, когда возникает такая необходимость&raquo;.<br />\r\n<em>О людях.</em><br />\r\n&nbsp;&laquo;Вся эта поспешность, их амбиции и стремление совершить что-нибудь, прежде чем окончатся их краткие жизни &mdash; всё это кажется иногда настолько бесполезным. Но взгляните на то, чего они добились, и вы начнёте ценить их достижения. Если бы только они могли немного сбавить обороты и приобрести хоть толику изящества&raquo;</p>\r\n',30,'<p>Эльфы любят свободу, разнообразие и самовыражение. Таким образом, они относятся к добрым аспектам хаоса. Они ценят защиту чужой свободы так же как и своей, и чаще они скорее добры, чем нет. Исключением из этого правила являются дроу. Их изгнание в Подземье сделало их злобными и опасными. Дроу чаще являются злыми.</p>\r\n','<p>Несмотря на то, что физически эльфы взрослеют в том же возрасте, что и люди, их понимание о взрослении выходит за рамки физического развития, и располагается в сфере житейского опыта. Обычно эльф получает статус взрослого и взрослое имя в возрасте 100 лет, и может прожить до 750 лет.</p>\r\n','<p>&nbsp;Рост эльфов колеблется между 5 и 6 футами (152 и 183 сантиметрами), у них стройное телосложение. Ваш размер &mdash; Средний.</p>\r\n','<p><em>Детские имена:</em><br />\r\n&nbsp;Ара, Брин, Валь, Дель, Иннил, Лаэль,Мелла, Наиль, Наэрис, Раэль, Ринн, Сай, Силлин,Тиа, Фанн, Фаэн, Эрин<br />\r\n<em>Мужские взрослые имена:</em><br />\r\n&nbsp;Адран, Арамиль, Араннис,Ауст, Аэлар, Бейро, Берриан, Варис, Галинндан,Ивеллиос, Иммераль, Каррик, Куарион, Лаусиан,Миндартис, Паэлиас, Перен, Риардон, Ролен,Совелисс, Тамиорн, Таривол, Терен, Хадарай,Химо, Хэйян, Эниалис, Эрдан, Эреван</p>\r\n\r\n<p><em>Женские взрослые имена:</em><br />\r\n&nbsp;Адрие, Альтеа, Анастрианна, Андрасте, Антинуа, Бетринна, Бирель, Вадания, Валанте, Джеленетт, Друсилиа, Йелениа, Каэлинн, Квеленна, Квиласи, Кейлет, Ксанафия,Лешанна, Лиа, Миали, Мэриэль, Найвара, Сариэль, Силакви, Теирастра, Тиа, Фелосиаль, Шава,Шанайра, Энна</p>\r\n\r\n<p><em>Фамилии (перевод на Общий):</em><br />\r\n&nbsp;Амакиир (Сверкающий Цветок), Амастасия (Звёздный Цветок),Галанодель (Лунный Шёпот), Ильфелкиир(Сверкающий Бутон), Ксилосент (Золотой Лепе-<br />\r\nсток), Лиадон (Серебряный Лист), Найло (Ночной Бриз), Сианодель (Лунный Ручей), Холимион (Алмазная Роса)</p>\r\n',1),(2,'Высший Эльф',1,'<p>Поскольку вы &mdash; высший эльф, у вас острый ум и вы знакомы, по крайней мере, с основами магии. Во многих мирах D&amp;D существует два вида высших эльфов. Один вид (который включает серых эльфов и эльфов долин Серого Ястреба, сильванести Саги о Копье и солнечных эльфов Забытых Королевств) высокомерен и замкнут, считая себя выше не-эльфов и даже других эльфов. Другой вид (включающий высших эльфов Серого Ястреба, квалинести из Саги о Копье и лунных эльфов из Забытых Королевств) более распространён и дружелюбен, и часто встречается среди людей и других рас. У солнечных эльфов Фаэруна (также называемых золотыми эльфами или эльфами восхода) бронзовая кожа и волосы медного, чёрного или золотистого оттенка. У них золотые, серебристые или чёрные глаза. Лунные эльфы (также называемые серебряными или серыми эльфами) гораздо бледнее, с алебастровой кожей, имеющей иногда оттенок синего. У них часто серебристо-белые, чёрные или синие волосы, но и различные оттенки светлых, коричневых и рыжих тонов также не являются редкими. У них синие или зелёные глаза с золотыми вкраплениями.</p>\r\n',30,'','','','',1),(3,'Лесной Эльф',1,'<p>Поскольку вы &mdash; лесной эльф, у вас обострённые чувства и интуиция, и ваши стремительные ноги несут вас быстро и незаметно через ваши родные леса. Эта категория включает диких эльфов Серого Ястреба и кагонести из Саги о Копье, а также расы, называемые лесными эльфами Серого Ястреба и Забытых Королевств. В Фаэруне лесные эльфы (также называемые дикими или зелёными) являются затворниками, не доверяющими не-эльфам. &nbsp;<br />\r\nКожа лесных эльфов, как правило, имеет медный оттенок, иногда со следами зелёного. У них часто коричневые и чёрные волосы, но иногда они бывают светлого или бронзового оттенков. У них зелёные, карие или орехового цвета глаза.</p>\r\n',35,'','','','',1),(4,'Темный Эльф(Дроу)',1,'<p>Произошедшие от более древней подрасы темнокожих эльфов, дроу были изгнаны с земной поверхности мира, и обречены поклоняться богине Лолс и следовать пути зла и упадка. Теперь они построили свою цивилизацию в глубинах Подземья, устроенную согласно Пути Лолс. Также называемые тёмными эльфами, дроу имеют чёрную кожу, которая напоминает полированный обсидиан и совершенно белые или очень светлые волосы. У них обычно бледные глаза (настолько бледные, что могут показаться белыми) с сиреневым, серебряным, розовым, красным или синим оттенком. Они, как правило, меньше и стройнее, чем большинство эльфов. Искатели приключений дроу редки, и их раса существует не во всех мирах. Спросите вашего Мастера, можете ли вы играть персонажем дроу.</p>\r\n',30,'','','','',1),(5,'Полурослик',NULL,'',25,'<p>Большинство полуросликов законно-добрые. Как правило, они добросердечны и<br />\r\nлюбезны, не выносят чужой боли и не терпят притеснения. Также они являются поборниками порядка и традиций, сильно полагаясь на общество<br />\r\nи предпочитая проверенные пути.</p>\r\n','<p>Полурослики достигают зрелости к 20<br />\r\nгодам, и обычно живут до середины своего второго столетия</p>\r\n','<p>Полурослики в среднем примерно 3<br />\r\nфута (90 сантиметров) ростом и весят около 40<br />\r\nфунтов (18 килограмм). Ваш размер &mdash; Маленький.</p>\r\n','<p>Мужские имена: Альтон, Андер, Гаррет, Кейд, Коррин, Лайл, Линдал, Майло, Меррик, Осборн, Перрин, Рид, Роско, Уэллби, Финнан, Элдон, Эррих<br />\r\nЖенские имена: Бри, Вани, Верна, Джиллиан, Китри, Кора, Кэлли, Лавиния, Лидда, Мерла, Недда, Паэла, Портия, Серафина, Трим, Шаэна, Эндри, Юфемия<br />\r\nФамилии: Вверхтормашкин, Высокохолм, Галькоброс, Добробочка, Зеленофляг, Кустосбор, Лугодуг, Подветкин, Репейник, Чайнолист</p>\r\n',1),(6,'КОРЕНАСТЫЙ',5,'',25,'','','','',1),(7,'ЛЕГКОНОГИЙ',5,'',25,'','','','',1),(8,'Зверь',NULL,'',NULL,'','','','',0),(9,'Eздовая лошадь',10,'',60,'','','','',0),(10,'Большой зверь',8,'',NULL,'','','','',0),(11,'Человек',NULL,'',30,'','','','',1),(12,'Полуэльф',NULL,'',30,'','','','',1),(13,'Транспорт',NULL,'',NULL,'','','','',0),(14,'Демон',NULL,'',NULL,'','','','',0);
/*!40000 ALTER TABLE `race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_ability_modifier`
--

DROP TABLE IF EXISTS `race_ability_modifier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_ability_modifier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ability_id` int(11) unsigned DEFAULT NULL,
  `modifier` int(11) DEFAULT NULL,
  `race_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `race_ability_modifier_race_id_race_id` (`race_id`),
  KEY `race_ability_modifier_ability_id_ability_id` (`ability_id`),
  CONSTRAINT `race_ability_modifier_ability_id_ability_id` FOREIGN KEY (`ability_id`) REFERENCES `ability` (`id`),
  CONSTRAINT `race_ability_modifier_race_id_race_id` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_ability_modifier`
--

LOCK TABLES `race_ability_modifier` WRITE;
/*!40000 ALTER TABLE `race_ability_modifier` DISABLE KEYS */;
INSERT INTO `race_ability_modifier` VALUES (1,1,2,1),(2,6,1,4),(3,5,1,3),(4,4,1,2),(5,1,2,5),(6,3,1,6),(7,6,1,7),(8,1,10,9),(9,2,16,9),(10,3,12,9),(11,4,4,9),(12,5,11,9),(13,6,7,9),(14,1,1,11),(15,2,1,11),(16,3,1,11),(17,4,1,11),(18,5,1,11),(19,6,1,11),(20,6,2,12);
/*!40000 ALTER TABLE `race_ability_modifier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_skill_proficiency`
--

DROP TABLE IF EXISTS `race_skill_proficiency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_skill_proficiency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `race_id` int(11) unsigned DEFAULT NULL,
  `skill_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `race_skill_proficiency_race_id_race_id` (`race_id`),
  KEY `race_skill_proficiency_skill_id_skill_id` (`skill_id`),
  CONSTRAINT `race_skill_proficiency_race_id_race_id` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  CONSTRAINT `race_skill_proficiency_skill_id_skill_id` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_skill_proficiency`
--

LOCK TABLES `race_skill_proficiency` WRITE;
/*!40000 ALTER TABLE `race_skill_proficiency` DISABLE KEYS */;
INSERT INTO `race_skill_proficiency` VALUES (1,1,9);
/*!40000 ALTER TABLE `race_skill_proficiency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_talent`
--

DROP TABLE IF EXISTS `race_talent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_talent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `race_id` int(11) unsigned DEFAULT NULL,
  `talent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `race_talent_race_id_race_id` (`race_id`),
  KEY `race_talent_talent_id_talent_id` (`talent_id`),
  CONSTRAINT `race_talent_race_id_race_id` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  CONSTRAINT `race_talent_talent_id_talent_id` FOREIGN KEY (`talent_id`) REFERENCES `talent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_talent`
--

LOCK TABLES `race_talent` WRITE;
/*!40000 ALTER TABLE `race_talent` DISABLE KEYS */;
INSERT INTO `race_talent` VALUES (1,1,1),(2,1,2),(3,1,3),(4,3,4),(5,4,5),(6,4,6),(7,1,7),(8,5,11),(9,5,12),(10,5,13),(11,6,14),(12,7,15),(13,12,2),(14,12,3);
/*!40000 ALTER TABLE `race_talent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ability_id` int(11) unsigned DEFAULT NULL,
  `desc` text,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `character_ability_id_ability_id` (`ability_id`),
  CONSTRAINT `character_ability_id_ability_id` FOREIGN KEY (`ability_id`) REFERENCES `ability` (`id`),
  CONSTRAINT `skill_ability_id_ability_id` FOREIGN KEY (`ability_id`) REFERENCES `ability` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (1,4,'Знание магических формул и принципов, умение определять тип заклинаний и школу магии.','Магия'),(2,4,'Знание истории игрового мира, древних языков, знаний итд.','История'),(3,4,'Поиск улик и связывание их воедино','Анализ'),(4,4,'Знание географии, растений и животных игрового мира, погоды и природных явлений.','Природа'),(5,4,'Знание религий, пантеонов богов, обрядов и духовных традиций.','Религия'),(6,5,'Уход, дрессировка, контроль.','Уход за  животными'),(7,5,'Умение чувствовать ложь и настроение, читать язык тела.','Проницательность'),(8,5,'Умение лечить раны немагическими методами, уход за ранеными.','Медицина'),(9,5,'Зрение, слух, поиск ловушек.','Внимательность'),(10,5,'Умение выживать в дикой природе, охотиться, читать следы.','Выживание'),(11,6,'Умение лгать.','Обман'),(12,6,'Умение запугивать и угрожать.','Запугивание'),(13,6,'Умение развлекать публику – танцы, пение, игра на музыкальном инструменте.','Выступление'),(14,6,'Умение убеждать.','Убеждение'),(15,2,'','Атлетика'),(16,1,'','Акробатика'),(17,1,'','Ловкость рук'),(18,1,'','Скрытность');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spell`
--

DROP TABLE IF EXISTS `spell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spell` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` int(11) unsigned DEFAULT NULL,
  `spell_property` varchar(255) DEFAULT NULL,
  `overlay_time` int(11) unsigned DEFAULT NULL,
  `overlay_time_type` smallint(6) NOT NULL,
  `distance` int(11) unsigned DEFAULT NULL,
  `components` varchar(255) DEFAULT NULL,
  `duration_time` int(11) unsigned DEFAULT NULL,
  `duration_time_type` int(11) unsigned NOT NULL,
  `description` text NOT NULL,
  `concentration` tinyint(1) DEFAULT NULL,
  `spell_school_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spell_spell_school_spell_school_id_spell_school_id` (`spell_school_id`),
  CONSTRAINT `spell_spell_school_spell_school_id_spell_school_id` FOREIGN KEY (`spell_school_id`) REFERENCES `spell_school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spell`
--

LOCK TABLES `spell` WRITE;
/*!40000 ALTER TABLE `spell` DISABLE KEYS */;
INSERT INTO `spell` VALUES (1,'ЗАВЕСА СТРЕЛ',2,'преобразование',1,1,5,'В, С, М (как минимум четыре стрелы или арбалетных болта)',8,4,'Вы втыкаете четыре немагических боеприпаса —\r\nстрелы или арбалетные болты — в землю в пределах дистанции и накладываете на них заклинание,\r\nзащищающее область. Пока заклинание активно,\r\nкаждый раз, когда другое существо кроме вас\r\nвпервые за ход оказывается в пределах 30 футов\r\nот боеприпасов или оканчивает там ход, один боеприпас вылетает и атакует его. Существо должно\r\nпреуспеть в спасброске Ловкости, иначе оно получит колющий урон 1к6. Боеприпас при этом уничтожается. Заклинание заканчивается, когда кончаются боеприпасы.\r\nНакладывая это заклинание, вы можете указать любых существ, которых это заклинание будет игнорировать.\r\nНа больших уровнях: Если вы накладываете\r\nэто заклинание, используя ячейку 3 уровня или\r\nвыше, количество боеприпасов увеличивается на\r\nдва за каждый уровень ячейки выше второго.',NULL,NULL),(2,'ДРУЖБА С ЖИВОТНЫМИ',1,'очарование',1,1,30,'В, С, М (кусочек пищи)',24,4,'Это заклинание позволяет убедить зверя, что вы\r\nне намерены причинять ему вред. Выберите зверя,\r\nкоторого вы видите в пределах дистанции. Он\r\nдолжен видеть и слышать вас. Если у зверя Интеллект не меньше 4, заклинание проваливается. В\r\nпротивном случае зверь должен преуспеть в спасброске Мудрости, иначе он станет очарованным\r\nна время действия заклинания. Если вы или один\r\nиз ваших спутников причинит цели вред, заклинание окончится.\r\nНа больших уровнях: Если вы накладываете\r\nэто заклинание, используя ячейку 2 уровня или\r\nвыше, вы можете воздействовать на одного дополнительного зверя за каждый уровень ячейки\r\nвыше первого.',NULL,NULL),(3,'МЕТКА ОХОТНИКА',1,'прорицание',1,2,90,'В',1,4,'Вы выбираете существо, видимое в пределах дистанции, и объявляете его своей добычей. Пока заклинание активно, вы причиняете цели дополнительный урон 1к6 каждый раз, когда попадаете по\r\nней атакой оружием, и вы совершаете с преимуществом проверки Мудрости (Внимательность) и\r\nМудрость (Выживание), совершённые для её поиска. Если хиты цели опускаются до 0, пока заклинание активно, вы можете в свой следующий ход\r\nбонусным действием выбрать целью новое существо.\r\nНа больших уровнях: Если вы накладываете\r\nэто заклинание, используя ячейку 3 или 4 уровня,\r\nвы можете поддерживать концентрацию 8 часов.\r\nЕсли вы используете ячейку заклинания 5 уровня\r\nили выше, вы можете поддерживать концентрацию 24 часа.',1,NULL);
/*!40000 ALTER TABLE `spell` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spell_school`
--

DROP TABLE IF EXISTS `spell_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spell_school` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spell_school`
--

LOCK TABLES `spell_school` WRITE;
/*!40000 ALTER TABLE `spell_school` DISABLE KEYS */;
INSERT INTO `spell_school` VALUES (1,'Прорицание');
/*!40000 ALTER TABLE `spell_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Бог'),(2,'Боги'),(3,'Религия'),(4,'Илматер');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talent`
--

DROP TABLE IF EXISTS `talent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `count` int(11) DEFAULT NULL,
  `rest_condition` smallint(6) DEFAULT '1',
  `scalable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talent`
--

LOCK TABLES `talent` WRITE;
/*!40000 ALTER TABLE `talent` DISABLE KEYS */;
INSERT INTO `talent` VALUES (1,'Транс',' Эльфы не спят. Вместо этого они погружаются в глубокую медитацию, находясь в полубессознательном состоянии до 4 часов в сутки (обычно такую медитацию называют трансом). Во время этой медитации вы можете грезить о разных вещах. Некоторые из этих грёз являются ментальными упражнениями, выработанными за годы тренировок. После такого отдыха вы получаете все преимущества, которые получает человек после 8 часов сна. ',NULL,1,0),(2,'Dark vision',' Привыкнув к сумраку леса и ночному небу, вы обладаете превосходным зрением в темноте и при тусклом освещении. На расстоянии в 60 футов вы при тусклом освещении можете видеть так, как будто это яркое освещение, и в темноте так, как будто это тусклое освещение. В темноте вы не можете различать цвета, только оттенки серого. ',NULL,1,0),(3,'Наследие фей',' Вы совершаете с преимуществом спасброски от очарования, и вас невозможно магически усыпить',NULL,1,0),(4,'Маскировка в дикой местности',' Вы можете предпринять попытку спрятаться, даже если вы слабо заслонены листвой, сильным дождем, снегопадом, туманом или другими природными явлениями. ',NULL,1,0),(5,'Superior dark vision','Ваше тёмное зрение имеет радиус 120 футов. ',NULL,1,0),(6,'Чувствительность к солнцу','Вы совершаете с помехой броски атаки и проверки Мудрости (Внимательность), основанные на зрении, если вы, цель вашей атаки или изучаемый предмет расположены на прямом солнечном свете. ',NULL,1,0),(7,'Обострённые чувства','Вы владеете навыком Внимательность. ',NULL,1,0),(8,'Expertise(Rogue/1lvl.)','На 1 уровне выберите два ваших владения в навыках или одно владение навыком и владение воровскими инструментами. Ваш бонус мастерства удваивается для всех проверок характеристик, которые вы совершаете, используя любое из выбранных владений',NULL,1,0),(9,'Sneak Attack','Один раз в ход вы можете причинить дополнительный урон 1к6 одному из существ, по которому вы попали атакой, совершённой с преимуществом к броску атаки. Атака должна использовать дальнобойное оружие или оружие со свойством «фехтовальное». Вам не нужно иметь преимущество при броске атаки, если другой враг цели находится в пределах 5 футов от неё. Этот враг не должен быть недееспособным, и у вас не должно быть помехи для броска атаки. ',NULL,1,0),(11,'Везучий','Если при броске атаки, проверке характеристики или спасброске у вас выпало «1», вы можете перебросить кость, и должны использовать новый результат.',NULL,1,0),(12,'Храбрый','Вы совершаете с преимуществом спасброски от испуга.',NULL,1,0),(13,'Проворство полуросликов. ','Вы можете проходить сквозь пространство, занятое существами, чей размер больше вашего.',NULL,1,0),(14,'Устойчивость коренастых.','Вы совершаете с преимуществом спасброски от яда, и вы получаете сопротивление к урону ядом.',NULL,1,0),(15,'Естественная скрытность.','Вы можете предпринять попытку скрыться даже если заслонены только существом, превосходящими вас в размере как минимум на одну категорию',NULL,1,0),(24,'ВОРОВСКОЙ ЖАРГОН','Во время плутовского обучения вы выучили воровской жаргон, тайную смесь диалекта, жаргона и шифра, который позволяет скрывать сообщения в, казалось бы, обычном разговоре. Только другое существо, знающее воровской жаргон, понимает такие сообщения. Это занимает в четыре раза больше времени, нежели передача тех же слов прямым текстом.\r\nКроме того, вы понимаете набор секретных знаков и символов, используемый для передачи коротких и простых сообщений. Например, является ли область опасной или территорией гильдии воров, находится ли поблизости добыча, простодушны ли люди в округе, и предоставляют ли здесь безопасное убежище для воров в бегах',NULL,1,0),(25,'НЕВЕРОЯТНОЕ УКЛОНЕНИЕ','Начиная с 5 уровня, когда нападающий, которого вы можете видеть, попадает по вам атакой, вы можете реакцией уменьшить вдвое урон, причиняемый вам этой атакой.',NULL,1,0),(26,'БЫСТРЫЕ РУКИ','Вы можете бонусным действием, предоставленным вашим Хитрым действием, совершить проверку Ловкости (Ловкость рук), использовать воровские инструменты, чтобы обезвредить ловушку или вскрыть замок, или же совершить действие Использование предмета',NULL,1,0),(27,'ФОРТОЧНИК','Вы получаете возможность лазать быстрее, чем обычно; лазание больше не стоит вам дополнительного движения. Кроме того, когда вы совершаете прыжок с разбега, расстояние, которое вы преодолеваете, увеличивается на число футов, равное вашему модификатору Ловкости.',NULL,1,0),(28,'УВЁРТЛИВОСТЬ','Вы можете ловко увернуться от зональных эффектов, например, огненного дыхания красного дракона или заклинания град. Если вы попадаете под действие эффекта, который позволяет вам совершить спасбросок Ловкости, чтобы получить только половину урона, вместо этого вы не получаете вовсе никакого урона, если спасбросок был успешен, и только половину урона, если он был провален.',NULL,1,0),(29,'НАДЁЖНЫЙ ТАЛАНТ','Вы улучшаете выбранные навыки, пока они не достигнут совершенства. Каждый раз, когда вы совершаете проверку характеристики, которая позволяет добавить бонус мастерства, вы можете при выпадении на к20 результата «1–9» считать, что выпало «10»',NULL,1,0),(30,'СЛЕПОЕ ЗРЕНИЕ','Eсли вы можете слышать, то знаете о местонахождении всех скрытых и невидимых существ в пределах 10 футов от себя.',NULL,1,0),(31,'СКОЛЬЗКИЙ УМ','Вы увеличиваете силу мышления. Вы получаете владение спасбросками Мудрости.',NULL,1,0),(32,'НЕУЛОВИМОСТЬ','Вы можете уклоняться так хорошо, что противник крайне редко может взять над вами верх. Никакие броски атаки не получают преимущества над вами, пока вы не станете недееспособным.',NULL,1,0),(33,'УДАЧА','Вы получаете сверхъестественный дар преуспевать, когда это нужнее всего. Если ваша атака промахивается по цели, находящейся в пределах досягаемости, вы можете изменить промах на попадание. В качестве альтернативы, если вы провалили проверку характеристики, вы можете заменить результат, выпавший\r\nна к20, на «20». Использовав это умение, вы не можете использовать его повторно, пока не завершите короткий или продолжительный отдых',NULL,1,0),(34,'ВЫСОКАЯ СКРЫТНОСТЬ','Вы совершаете с преимуществом проверки Ловкости (Скрытность), если в этом ходу перемещались не более чем на половину своей скорости.',NULL,1,0),(35,'ИСПОЛЬЗОВАНИЕ МАГИЧЕСКИХ ПРЕДМЕТОВ','Вы узнаёте достаточно о магических процессах, чтобы импровизировать при использовании предметов, даже если раньше вы не умели ими пользоваться. Вы игнорируете все требования класса, расы и уровня при использовании магических предметов.',NULL,1,0),(36,'ВОРОВСКИЕ РЕФЛЕКСЫ','Вы обретаете большой опыт организации засад и быстрого отступления при опасности. Вы можете совершить два хода во время первого раунда боя. Совершите первый ход согласно своей нормальной инициативе, и второй ход с инициативой на 10 меньше. Вы не можете использовать это умение, если захвачены врасплох.',NULL,1,0),(37,'ХИТРОЕ ДЕЙСТВИЕ','Ваше мышление и ловкость позволяют двигаться и действовать быстрее. Вы можете в каждом ходу боя совершать бонусное действие. Это действие может быть использовано только для Рывка, Отхода или Засады.',NULL,1,0),(38,'ДОПОЛНИТЕЛЬНАЯ АТАКА','Eсли вы в свой ход совершаете действие Атака, вы можете совершить две атаки вместо одной.',NULL,1,0),(39,'ПЕРВОЗДАННАЯ ОСВЕДОМЛЁННОСТЬ','Вы можете действием потратить одну ячейку заклинаний следопыта, чтобы сосредоточиться на познании пространства вокруг себя. В течение 1 минуты за каждый уровень использованной ячейки заклинаний вы можете ощутить присутствие следующих видов существ в\r\nпределах 1 мили (или в пределах 6 миль, если вы\r\nнаходитесь в избранной местности): аберрации,\r\nдраконы, исчадия, небожители, нежить, феи и элементали. Это умение не раскрывает местоположение и количество существ.',NULL,1,0),(40,'Копыта','Рукопашная атака оружием: +5 к попаданию, досягаемость 5 фт., одна цель. Попадание: Дробящий урон 8 (2к4+3)',NULL,1,0),(41,'МАСТЕР НА ВСЕ РУКИ','Начиная со 2 уровня вы можете добавлять половину бонуса мастерства, округлённую в меньшую\r\nсторону, ко всем проверкам характеристик, куда\r\nэтот бонус ещё не включён.',NULL,1,0),(42,'handyman','',NULL,1,0),(43,'dualdef','',NULL,1,0),(44,'armordef','',NULL,1,0),(45,'charAura','',NULL,1,0),(46,'Ритуал Мистры','Ритуал занимает 30 минут и тратит 10 свечей. Восстанавливает все ячейки.',NULL,1,0),(47,'Касание Корелона','1 раз до полного отдыха',1,1,0),(48,'АУРА ЗАЩИТЫ','Начиная с 6 уровня, если вы или дружественное существо в пределах 10 футов от вас должны совершить спасбросок, это существо получает бонус к\r\nспасброску, равный модификатору вашей Харизмы\r\n(минимальный бонус +1). Вы должны находиться в\r\nсознании, чтобы предоставлять этот бонус.\r\nНа 18 уровне дистанция этой ауры увеличивается до 30 футов.',NULL,1,0),(49,'БОЖЕСТВЕННОЕ ЗДОРОВЬЕ','Начиная с 3 уровня божественная магия, текущая\r\nчерез вас, даёт вам иммунитет к болезням',NULL,1,0),(50,'АУРА ОТВАГИ','Начиная с 10 уровня, вы и дружественные существа в пределах 10 футов от вас не можете быть\r\nиспуганы, пока вы находитесь в сознании.\r\nНа 18 уровне дистанция этой ауры увеличивается до 30 футов.',NULL,1,0),(51,'ДОПОЛНИТЕЛЬНАЯ АТАКА','Начиная с 5 уровня, если вы в свой ход совершаете действие Атака, вы можете совершить две\r\nатаки вместо одной.',NULL,1,0),(52,'БОЖЕСТВЕННАЯ КАРА','Начиная со 2 уровня, если вы попадаете по существу атакой рукопашным оружием, вы можете потратить одну ячейку заклинания любого своего\r\nкласса для причинения цели урона излучением, который добавится к урону от оружия.</br>\r\nДополнительный урон равен 2к8 за ячейку 1 уровня, плюс 1к8 за каждый уровень ячейки выше первого, до максимума 5к8. </br>\r\nУрон увеличивается на 1к8, если цель — нежить или исчадие',NULL,1,0),(53,'Боевой стиль:ОБОРОНА','Пока вы носите доспехи, вы получаете бонус +1 к КД',NULL,1,0),(54,'Боевой стиль:ДУЭЛЯНТ','Пока вы держите рукопашное оружие в одной\r\nруке, и не используете другого оружия, вы получаете бонус +2 к броскам урона этим оружием.',NULL,1,0),(55,'Боевой стиль:ЗАЩИТА','Если существо, которое вы видите, атакует не вас,\r\nа другое существо, находящееся в пределах 5 футов от вас, вы можете реакцией создать помеху\r\nего броску атаки. Для этого вы должны использовать щит',NULL,1,0),(56,'БОЖЕСТВЕННОЕ ЧУВСТВО','Присутствие сильного зла воспринимается вашими\r\nчувствами как неприятный запах, а могущественное добро звучит как небесная музыка в ваших\r\nушах. Вы можете действием открыть своё сознание для обнаружения таких сил. Вы до конца своего следующего хода знаете местоположение всех\r\nисчадий, небожителей и нежити в пределах 60 футов, не имеющих полного укрытия. Вы знаете тип\r\n(исчадие, небожитель, нежить) любого существа,\r\nчьё присутствие вы чувствуете, но не можете\r\nопределить, кто это конкретно (например, вампир\r\nГраф Страд фон Зарович). В этом же радиусе вы\r\nтакже обнаруживаете присутствие мест и предметов, которые были освящены или осквернены,\r\nнапример, заклинанием святилище.\r\nВы можете использовать это умение количество раз, равное 1 + модификатор Харизмы. Когда\r\nвы заканчиваете продолжительный отдых, вы восстанавливаете все потраченные использования',6,1,0),(57,'БОЖЕСТВЕННЫЙ КАНАЛ: Клятва преданности','Когда вы даёте эту клятву на 3 уровне, вы получаете следующие два варианта использования Божественного канала.</br>\r\n<b>Священное оружие.</b> Вы можете действием наполнить одно оружие, которое вы держите, позитивной энергией, используя Божественный канал. На протяжении 1 минуты вы добавляете свой модификатор Харизмы к броскам атаки, сделанным этим оружием (минимальный бонус +1). Также оружие испускает яркий свет в радиусе 20 футов и тусклый свет в пределах ещё 20 футов. Если оружие не является волшебным, то оно считается волшебным на время действия заклинания. Вы можете закончить этот эффект в свой ход частью любого другого действия. Если вы не держите или не несёте это оружие, или теряете сознание, то этот эффект заканчивается</br>\r\n<b>Изгнать нечистого.</b>\r\nВы действием показываете свой священный символ и произносите слова молитвы, осуждающей исчадия и нежить, используя Божественный канал. Все исчадия и нежить, которые могут видеть или слышать вас, находящиеся в пределах 30 футов от вас, должны совершить спасбросок Мудрости. Если они проваливают спасбросок, то изгоняются на 1 минуту или до тех пор, пока не получат урон. Изгнанные существа должны весь свой ход пытаться убежать от вас так далеко, как только могут, и не могут добровольно переместиться в пространство, находящееся в пределах 30 футов от вас. Также они не могут совершать реакции. Из всех действий они могут совершать только Рывок и попытки избежать эффекта, не дающего им перемещаться. Если же двигаться некуда, существа могут использовать действие Уклонение.',1,3,0),(58,'АУРА ПРЕДАННОСТИ','Начиная с 7 уровня вы и дружественные вам существа в пределах 10 футов от вас не могут быть\r\nочарованы, пока вы находитесь в сознании.\r\nНа 18 уровне радиус ауры увеличивается до 30\r\nфутов.',NULL,1,0),(59,'ЗАКЛИНАНИЯ КЛЯТВЫ ПРЕДАННОСТИ','Уровень паладина / Заклинания\r\n<ul>\r\n<li>3 / защита от зла и добра, убежище</li>\r\n<li>5 / малое восстановление, область истины</li>\r\n<li>9 / маяк надежды, рассеивание магии</li>\r\n<li>13 / свобода перемещения, страж веры</li>\r\n<li>17 / небесный огонь, общение</li>\r\n</ul>',NULL,1,0),(60,'Солнечный эльф','Персонаж относиться к расе Эльф/Солнечный Эльф, даже если не был эльфом изначально.',NULL,1,0),(61,'ВДОХНОВЕНИЕ БАРДА','Своими словами или музыкой вы можете вдохновлять других. \r\nДля этого вы должны бонусным действием выбрать одно существо, отличное от вас, в пределах 60 футов, которое может вас слышать.\r\nЭто существо получает кость бардовского вдохновения — к6. В течение следующих 10 минут это существо может один раз бросить эту кость и добавить результат к проверке характеристики, броску атаки или спасброску, который оно совершает. \r\nСущество может принять решение о броске кости вдохновения уже после броска к20, но должно сделать это прежде, чем Мастер объявит результат броска. \r\nКак только кость бардовского вдохновения брошена, она исчезает. \r\nСущество может иметь только одну такую кость одновременно.\r\nВы можете использовать это умение количество раз, равное модификатору вашей Харизмы, но как минимум один раз. \r\nПотраченные использования этого умения восстанавливаются после продолжительного отдыха.\r\nВаша кость бардовского вдохновения изменяется с ростом вашего уровня в этом классе. \r\nОна становится к8 на 5 уровне, к10 на 10 уровне и к12 на 15 уровне',5,1,0),(62,'ИСТОЧНИК ВДОХНОВЕНИЯ','Начиная с 5 уровня вы восстанавливаете истраченные вдохновения барда и после короткого и после продолжительного отдыха.',NULL,1,0),(63,'КОНТРОЧАРОВАНИЕ','На 6 уровне вы получаете возможность использовать звуки или слова силы для разрушения воздействующих на разум эффектов. Вы можете действием начать исполнение, которое продлится до\r\nконца вашего следующего хода. В течение этого\r\nвремени вы и все дружественные существа в пределах 30 футов от вас совершают спасброски от\r\nзапугивания и очарования с преимуществом.\r\nЧтобы получить это преимущество, существа\r\nдолжны слышать вас. Исполнение заканчивается\r\nпреждевременно, если вы оказываетесь недееспособны, теряете способность говорить, или прекращаете исполнение добровольно (на это не требуется действие)',NULL,1,0),(64,'ОСТРОЕ СЛОВЦО','Также на 3 уровне вы узнаёте, как использовать\r\nсобственное остроумие, чтобы отвлечь, смутить\r\nили по-другому подорвать способности и уверенность противников. Если существо, которое вы\r\nможете видеть, в пределах 60 футов от вас совершает бросок атаки, урона или проверку характеристики, вы можете реакцией потратить одну из ваших костей бардовского вдохновения, и вычесть\r\nрезультат броска этой кости из броска этого существа. Вы можете принять решение об использовании этой способности после броска существа, но\r\nдо того момента, когда Мастер объявит результат\r\nброска или проверки. Существо не подвержено\r\nэтой способности, если не может слышать вас, или\r\nобладает иммунитетом к очарованию',NULL,1,0),(65,'ПЕСНЬ ОТДЫХА','Начиная со 2 уровня вы с помощью успокаивающей музыки или речей можете помочь своим раненым союзникам восстановить их силы во время\r\nкороткого отдыха. Если вы, или любые союзные\r\nсущества, способные слышать ваше исполнение,\r\nвосстанавливаете хиты в конце короткого отдыха,\r\nкаждый из вас восстанавливает дополнительно\r\n1к6 хитов. Для того, чтобы восстановить дополнительные хиты, существо должно потратить в\r\nконце короткого отдыха как минимум одну Кость\r\nХитов.\r\nКоличество дополнительно восстанавливаемых\r\nхитов растёт с вашим уровнем в этом классе: 1к8\r\nна 9 уровне, 1к10 на 13 уровне и 1к12 на 17 уровне.',NULL,1,0),(66,'НАЛОЖЕНИЕ РУК','Ваше благословенное касание может лечить раны.<br>\r\nУ вас есть запас целительной силы, который восстанавливается после продолжительного отдыха.</br>\r\nПри помощи этого запаса вы можете восстанавливать количество хитов, равное уровню паладина, умноженному на 5.\r\nВы можете действием коснуться существа и, зачерпнув силу из запаса, восстановить количество хитов этого существа на любое число, вплоть до\r\nмаксимума, оставшегося в вашем запасе. </br>\r\nВ качестве альтернативы, вы можете потрать 5 хитов из вашего запаса хитов для излечения цели от одной болезни или одного действующего на неё\r\nяда. Вы можете устранить несколько эффектов болезни и ядов одним использованием Наложения рук, тратя хиты отдельно для каждого эффекта.</br>\r\nЭто умение не оказывает никакого эффекта на нежить и конструктов.',65,1,1),(67,'МАСТЕР ИЛЛЮЗИЙ','Когда вы выбираете эту школу на 2 уровне, золото\r\nи время, которое вы тратите на копирование заклинания Иллюзии в свою книгу заклинаний,\r\nуменьшаются вдвое',NULL,1,0),(68,'УЛУЧШЕННАЯ МАЛАЯ ИЛЛЮЗИЯ','Когда вы выбираете данную школу на 2 уровне,\r\nвы узнаёте заговор малая иллюзия. Если вам уже\r\nизвестен этот заговор, то вы изучаете любой другой заговор волшебника на свой выбор. Этот заговор не учитывается в общем количестве известных вам заговоров.\r\nПри сотворении малой иллюзии вы можете использовать эффекты звука и изображения вместе,\r\nединым заклинанием.',NULL,1,0),(69,'МАГИЧЕСКОЕ ВОССТАНОВЛЕНИЕ','Вы знаете как восстанавливать часть магической\r\nэнергии, изучая книгу заклинаний. Один раз в\r\nдень, когда вы заканчиваете короткий отдых, вы\r\nможете восстановить часть использованных ячеек\r\nзаклинаний. Ячейки заклинаний могут иметь суммарный уровень, который не превышает половину\r\nуровня вашего волшебника (округляя в большую\r\nсторону), и ни одна из ячеек не может быть шестого уровня или выше.\r\nНапример, если вы волшебник 4 уровня, вы\r\nможете восстановить ячейки заклинаний с суммой уровней не больше двух. Вы можете восстановить одну ячейку заклинаний 2 уровня, или две\r\nячейки заклинаний 1 уровня.',NULL,1,0),(70,'РИТУАЛЬНОЕ КОЛДОВСТВО','Вы можете сотворить заклинание волшебника как\r\nритуал, если у этого заклинания есть ключевое слово\r\n«ритуал», и оно есть в вашей книге заклинаний. Вам\r\nне нужно иметь это заклинание подготовленным',NULL,1,0),(71,'СВОБОДНОЕ ЗАКЛИНАТЕЛЬСТВО','Вы можете использовать единицы чародейства,\r\nчтобы получить дополнительные ячейки заклинаний,\r\nи наоборот, пожертвовать ячейками, чтоб получить\r\nединицы. Другие способы использования единиц чародейства вы освоите на более высоких уровнях.\r\nСоздание ячеек заклинаний. В свой ход вы можете бонусным действием превратить оставшиеся\r\nединицы чародейства в дополнительные ячейки\r\nзаклинаний. Приведённая таблица отображает стоимость создания ячеек разных уровней. Вы не можете создавать ячейки с уровнем выше 5. Созданные ячейки заклинаний исчезают в конце длительного отдыха.\r\nСОЗДАНИЕ ЯЧЕЕК ЗАКЛИНАНИЙ\r\nУровень ячейки заклинаний<=>Единицы чародейства\r\n1<=>2\r\n2<=>3\r\n3<=>5\r\n4<=>6\r\n5<=>7\r\nПреобразование ячейки заклинания в единицы\r\nчародейства. Вы можете в свой ход бонусным действием преобразовать одну ячейку заклинаний в\r\nединицы чародейства, количество которых равно\r\nуровню ячейки',NULL,1,0),(72,'Единицы чародейства','',3,1,0),(73,'ДРУИДИЧЕСКИЙ ЯЗЫК','Вы знаете Друидический язык — тайный язык\r\nдруидов. Вы можете на нём говорить и оставлять\r\nтайные послания. Вы и все, кто знают этот язык,\r\nавтоматически замечаете эти послания. Другие замечают присутствие послания при успешной проверке Мудрости (Внимательность) со Сл 15, но без\r\nпомощи магии не могут расшифровать его.',NULL,1,0),(74,'Эрдан/Заклинания','Как следопыт:<br>\r\n<ul>\r\n<li>Лечение ран(1)</li>\r\n<li>Метка охотника(1)</li>\r\n</ul>\r\nКак друид может подготовить:<br>\r\nМудрость(4)+Уровень друида(14) =<b>18</b> заклинаний<br>\r\nСейчас подготовлены:<br>\r\n<br>\r\n<ul>\r\n4 кантрипа:<br>\r\n<li>Искусство друидов</li>\r\n<li>Указание</li>\r\n<li>Сопротивление</li>\r\n<li>Ядовитые брызги</li>\r\n<br>1 уровень<br>\r\n<li>Дружба с животными</li>\r\n<li>Разговор с животными</li>\r\n\r\n<br>2 уровень <br>\r\n<li>Почтовое животное</li>\r\n<li>Раскаленный металл</li>\r\n\r\n<br>3 уровень<br>\r\n<li>Рассеивание магии</li>\r\n<br>\r\n4 УРОВЕНЬ\r\n<br>\r\n<li>Цепкая лоза</li>\r\n<li>Превращение</li>\r\n<li>Огненная стена</li>\r\n\r\n\r\n<br>5 УРОВЕНЬ<br>\r\n<li>Древесный путь</li>\r\n<li>Каменная стена</li>\r\n<li>Множественное лечение ран</li>\r\n\r\n\r\n<br>6 УРОВЕНЬ<br>\r\n<li>Полное исцеление</li>\r\n<li>Путешествие через растения</li>\r\n<li>Солнечный луч</li>\r\n<li>Терновая стена</li>\r\n\r\n\r\n<br>7 УРОВЕНЬ<br>\r\n<li>Таинственный мираж</li>\r\n\r\n<br8 УРОВЕНЬ<br>\r\n<li>Превращение в животных</li>\r\n<li>Солнечный ожог</li>\r\n</ul>',NULL,1,0),(75,'Заклинания и ячейки Арвиса Заклинатель 6-го уровня','<b>Ячейки:</b>\r\n<ul>\r\n<li>1-го Уровня: 3/4</li>\r\n<li>3-го Уровня: 3/3</li>\r\n<li>2-го Уровня: 1/3</li>\r\n</ul>\r\nКак чародей, знает 4 заговора 3 заклинания 1-го уровня:<br>\r\n<b>Заговоры:</b>\r\n<ul>\r\n<li>Малая иллюзия</li>\r\n<li>Починка</li>\r\n<li>Сообщение</li>\r\n<li>Фокусы</li>\r\n</ul>\r\n<b>Заклинания 1-го уровня</b>\r\n<ul>\r\n<li>Маскировка</li>\r\n<li>Доспех мага</li>\r\n<li>Огненные ладони</li>\r\n</ul>\r\n<ul>\r\n<b>Заклинания 2-го уровня</b>\r\n<li>Смена обличья</li>\r\n</ul>\r\nКак волшебник знает 4 заговора и может подготовить интеллект(4) + уровень волшебника(4)=<b>8</b> заклинаний\r\n<b>Заговоры:</b>\r\n<ul>\r\n<li>Волшебная рука</li>\r\n<li>Огненный снаряд</li>\r\n<li>Леденящее прикосновение</li>\r\n<li>Свет</li>\r\n</ul>\r\n<b>Сейчас подготовлены:</b>\r\n<ul>\r\n<li>1.Открывание(2)</li>\r\n<li>2.Рассеивание магии(3)</li>\r\n<li>3.Языки(3)</li>\r\n<li>4.Огненный шар(3)</li>\r\n<li>5.Огненные ладони(1)</li>\r\n<li>6.Обнаружение магии(1)</li>\r\n<li>7.Волшебная стрела(1)</li>\r\n<li>8.Молния(3)</li>\r\n</ul>\r\n',NULL,1,0),(76,'Луиза Заклинания','Может подготовить Харизма(4)+Уровень паладины/2(6)=<b>10</b>\r\n<ul>\r\n<li>Щит веры (1)</li>\r\n<li>Лечение ран (1)</li>\r\n<li>ПОДМОГА (2)</li>\r\n<li>Возрождение (3)</li>\r\n<li>Сотворение пищи и питья (3)</li>\r\n<li>АУРА ЖИВУЧЕСТИ (3)</li>\r\n<li>Снятие проклятья (3)</li>\r\n<li>ИЗГНАНИЕ (4)</li>\r\n<li>АУРА ЖИЗНИ (4)</li>\r\n<li>ЗАЩИТА ОТ СМЕРТИ (4)</li>\r\n</ul>',NULL,1,0),(77,'Знание леденящего прикоснования','Знание заговора Леденящее прикосновение<br>\r\n\r\n<b>ЛЕДЕНЯЩЕЕ ПРИКОСНОВЕНИЕ</b>\r\n<br>Заговор, некромантия\r\n<br>Время накладывания: 1 действие\r\n<br>Дистанция: 120 футов\r\n<br>Компоненты: В, С\r\n<br>Длительность: 1 раунд\r\n<br>Вы создаёте призрачную руку скелета в пространстве существа, находящегося в пределах дистанции. Совершите дальнобойную атаку заклинанием\r\n<br>по существу, чтобы окутать его могильным холодом. При попадании цель получает урон некротической энергией 1к8, и не может восстанавливать\r\n<br>хиты до начала вашего следующего хода. Всё это\r\n<br>время рука держится за цель.\r\n<br>Если вы попадаете по нежити, то она вместо\r\n<br>этого до конца вашего следующего хода совершает по вам броски атаки с помехой.\r\n<br>Урон этого заклинания увеличивается на 1к8,\r\n<br>когда вы достигаете 5 уровня (2к8), 11 уровня (3к8)\r\n<br>и 17 уровня (4к8).',NULL,1,0),(78,'Благословение Корелона/Эрдан','+2 К броску попадания, \r\nВыживание и выслеживание с преимуществом до 30 Элейнта',NULL,1,0),(79,'Благословение Корелона/Латри','Броски Убеждения, Проницательность, Выступление с преимуществом.\r\nСложность заклинаний+2. \r\nДо 30-го Элейнта.',NULL,1,0),(80,'Наставление Хельма','1 броску на кости при помощи/содействии Латри или Эрдану до иных указаний от Хельма.',NULL,1,0),(81,'ВЕЗУНЧИК/ от Тиморы','Единиц удачи = 3\r\nВам непонятным образом везёт как раз тогда, когда это нужно.\r\nУ вас есть 3 единицы удачи. Каждый раз, когда\r\nвы совершаете бросок атаки, проверку характеристики или спасбросок, вы можете потратить одну\r\nединицу удачи, чтобы бросить дополнительный к20.\r\nВы можете решить потратить единицу удачи после\r\nобычного броска кости, но до определения последствий. После этого вы сами выбираете, какую к20\r\nиспользовать для броска атаки, проверки характеристики или спасброска\r\n\r\n\r\nДо тех пор пока Леди Удача не отвернется от везунчика)',3,1,0),(83,'ДИКИЙ ОБЛИК (число часов, равное половине уровня друида=7ч.)','Начиная со 2 уровня вы можете действием принять при помощи магии облик любого зверя, которого вы видели. Вы можете использовать это умение два раза, восстанавливая его после короткого<br>\r\nили продолжительного отдыха.<br>\r\nУровень друида определяет, в каких зверей<br>\r\nможно превращаться. Например, на 2 уровне можно<br>\r\nпревращаться в животное с показателем опасности<br>\r\nне более 1/4, без скорости полёта и плавания.<br>\r\n<b>ОБЛИК ЖИВОТНОГО</b><br>\r\nУровень Макс. ПО Ограничения Пример<br>\r\n2 1/4 Без скорости<br>\r\nплавания и полёта<br>\r\nВолк<br>\r\n4 1/2 Без скорости полёта Крокодил<br>\r\n8 1 — Гигантский<br>\r\nорёл<br>\r\nВ облике животного можно оставаться число<br>\r\nчасов, равное половине уровня друида (округляя в<br>\r\nменьшую сторону). Затем друид возвращается в<br>\r\nнормальный облик, если только не потратит ещё<br>\r\nодно использование Дикого облика. Можно вернуться в нормальный облик досрочно, бонусным<br>\r\nдействием. Бессознательный, доведённый до 0 хитов или мёртвый друид сразу возвращается в нормальный облик.<br>\r\nКогда вы превращены, действуют следующие<br>\r\nправила:<br>\r\n• Все игровые параметры берутся из параметров<br>\r\nзверя, но сохраняются мировоззрение, личность и значения Интеллекта, Мудрости и Харизмы. Также у вас остаются владения навыками и спасбросками, в <br>дополнение к таковым нового облика. Если квалификация есть<br>\r\nи у вас и у зверя, но у него бонус выше, используется бонус зверя. Легендарные действия<br>\r\nи действия в логове недоступны.<br>\r\n• Когда вы превращены, вы принимаете хиты и<br>\r\nКость Хитов зверя. Вернувшись в нормальный<br>\r\nоблик, ваши хиты будут такими же, как до<br>\r\nпревращения. Однако если вы вернулись в<br>\r\nсвой облик из-за опускания хитов до 0, «лишний» урон переносится на нормальный облик.<br>\r\nНапример, если вы в облике зверя получили<br>\r\nурон 10, имея при этом 1 хит, то вы возвращаетесь в нормальный облик и получаете 9 урона.<br>\r\nЕсли этот урон не довёл хиты персонажа до 0,<br>\r\nон не теряет сознание.<br>\r\n• Вы не можете накладывать заклинания, а<br>\r\nречь и действия, требующие рук, могут быть<br>\r\nограничены видом зверя. Превращение не прерывает вашу концентрацию на уже сотворённых заклинаниях и не мешает совершать действия, являющиеся частью <br>заклинания, такие<br>\r\nкак в случае заклинания призыв молнии.<br>\r\n• Вы сохраняете преимущества от всех умений<br>\r\nкласса, расы и прочих источников, и можете<br>\r\nпользоваться ими, если этому не препятствует<br>\r\nновый физический облик. Однако недоступны<br>\r\nособые чувства, такие как тёмное зрение, если<br>\r\nтолько их нет у зверя.<br>\r\n• Вы сами определяете, какое снаряжение останется лежать на земле, какое сольётся с новым обликом, а какое будет надето. Мастер решает, какое снаряжение может носить животное, чтобы оно действовало как обычно. Снаряжение не меняет форму и размер под новый облик, и если не подходит новому облику,\r\nоно должно остаться на земле или слиться с\r\nновым обликом. <br>Слившееся с обликом снаряжение не работает, пока вы опять не примете\r\nсвой облик<br>',2,3,0),(84,'БОЕВОЙ ДИКИЙ ОБЛИК','Выбрав этот круг на 2 уровне, вы получаете способность принимать дикий облик бонусным действием вместо обычного.<br><br>\r\nКроме того, в диком облике вы можете бонусным действием потратить ячейку заклинания,<br>\r\nчтобы восстановить 1к8 хитов за каждый уровень потраченной ячейки<br>',NULL,1,0),(85,'ОБЛИКИ КРУГА','Обряды круга Луны позволяют принимать облик\r\nболее опасных животных. Начиная со 2 уровня,\r\nможно превращаться в зверя с показателем опасности 1 (игнорируйте столбец «Макс. ПО» таблицы\r\n«Облик животного»).\r\nНачиная с 6 уровня можно превращаться в\r\nзверя с показателем опасности вплоть до уровня\r\nдруида, поделённого на 3 (округляя в меньшую\r\nсторону).',NULL,1,0),(86,'magic_diff_2','',NULL,1,0),(87,'magic_attack_1','',NULL,1,0),(88,'magic_diff_1','',NULL,1,0),(89,'attack_2','',NULL,1,0),(90,'ВДОХНОВЕНИЕ БАРДА(1d8)','Своими словами или музыкой вы можете вдохновлять других. Для этого вы должны бонусным действием выбрать одно существо, отличное от вас, в пределах 60 футов, которое может вас слышать. Это существо получает кость бардовского вдохновения — к8. В течение следующих 10 минут это существо может один раз бросить эту кость и добавить результат к проверке характеристики, броску атаки или спасброску, который оно совершает. Существо может принять решение о броске кости вдохновения уже после броска к20, но должно сделать это прежде, чем Мастер объявит результат броска. Как только кость бардовского вдохновения брошена, она исчезает. Существо может иметь только одну такую кость одновременно. Вы можете использовать это умение количество раз, равное модификатору вашей Харизмы, но как минимум один раз. Потраченные использования этого умения восстанавливаются после продолжительного отдыха. Ваша кость бардовского вдохновения изменяется с ростом вашего уровня в этом классе. ',5,1,0),(91,'УСТОЙЧИВЫЙ(Телосложение)','Выберите одну характеристику. Вы получаете следующие преимущества:\r\n• Увеличьте значение выбранной характеристики на 1, при максимуме 20.\r\n• Вы получаете владение спасбросками этой характеристики.',NULL,1,0),(92,'УЛУЧШЕННАЯ БОЖЕСТВЕННАЯ КАРА','На 11 уровне вы проникаетесь праведной мощью, что даёт всем вашим атакам рукопашным оружием божественную силу. </br>\r\nКаждый раз, когда вы попадаете по существу рукопашным оружием, это существо получает дополнительный урон излучением 1к8. \r\n</br>Если вы также используете Божественную кару, вы добавляете этот урон к дополнительному урону от Божественной кары.',NULL,1,0),(93,'Боевой стиль:СТРЕЛЬБА','Вы получаете бонус +2 к броску атаки, когда атакуете дальнобойным оружием.',NULL,1,0),(94,'ВТОРОЕ ДЫХАНИЕ','Вы обладаете ограниченным источником выносливости, которым можете воспользоваться, чтобы уберечь себя. <br>\r\nВ свой ход вы можете бонусным действием восстановить хиты в размере 1к10 + ваш уровень воина.<br>\r\nИспользовав это умение, вы должны завершить короткий либо продолжительный отдых, чтобы получить возможность использовать его снова.',1,3,0),(95,'УЛУЧШЕННЫЕ КРИТИЧЕСКИЕ ПОПАДАНИЯ','Ваши атаки оружием совершают критическое попадание при выпадении «19» или «20» на кости атаки.',NULL,1,0),(96,'ВЫДАЮЩИЙСЯ АТЛЕТ','Вы можете добавлять половину бонуса мастерства, округлённую в большую сторону, ко всем проверкам Силы, Ловкости или Телосложения, куда этот бонус ещё не включён.<br>\r\nКроме того, если вы совершаете прыжок в длину с разбега, дальность прыжка увеличивается на количество футов, равное модификатору Силы.',NULL,1,0),(97,'ДОПОЛНИТЕЛЬНЫЙ БОЕВОЙ СТИЛЬ','Вы можете выбрать второй боевой стиль.',NULL,1,0),(98,'ПРЕВОСХОДНЫЕ КРИТИЧЕСКИЕ ПОПАДАНИЯ','Ваши атаки оружием совершают критическое попадание при выпадении «18–20» на кости атаки.',NULL,1,0),(99,'УЦЕЛЕВШИЙ','Вы достигаете вершин стойкости в бою. В начале каждого своего хода вы восстанавливаете количество хитов, равное 5 + ваш модификатор Телосложения, если количество ваших хитов не превышает половины от максимума. Эта способность не работает, если у вас 0 хитов.',NULL,1,0),(100,'ВСПЛЕСК ДЕЙСТВИЙ','Начиная со 2 уровня вы получаете возможность на мгновение преодолеть обычные возможности. <br>\r\nВ свой ход вы можете совершить одно дополнительное действие помимо обычного и бонусного действий.<br>\r\nИспользовав это умение, вы должны завершить короткий или продолжительный отдых, чтобы получить возможность использовать его снова.<br> \r\nНачиная с 17 уровня вы можете использовать это умение дважды, прежде чем вам понадобится отдых, но в течение одного хода его всё равно можно использовать лишь один раз.',1,3,0),(101,'ДОПОЛНИТЕЛЬНАЯ АТАКА / Воин','Начиная с 5 уровня, если вы в свой ход совершаете действие Атака, вы можете совершить две атаки вместо одной. Количество атак увеличивается до трёх на 11 уровне этого класса, и до четырёх на 20 уровне.',NULL,1,0),(102,'УПОРНЫЙ','Вы можете перебросить проваленный спасбросок, и должны использовать новый результат. <br>\r\nПосле этого вы можете повторно использовать это умение только после завершения продолжительного отдыха.<br>\r\nВы можете использовать это умение дважды между периодами продолжительного отдыха после достижения 13 уровня, и трижды после достижения 17 уровня.',1,1,0),(103,'archery_2','archery_2',NULL,1,0),(104,'Владение инструментами: Набор травника','',NULL,1,0),(105,'Визирь','В любой момент в течение года, после того как вы вытянули эту карту, вы можете заняться медитацией и задать вопрос, чтобы получить мысленный правдивый ответ. Кроме простой информации ответ может помочь вам решить головоломку или другую дилемму. Другими словами, приходит не только знание, но и мудрость, позволяющая этим знанием распорядиться.',1,5,0),(106,'Удар в спину','Действием перемещается за спину врагу и совершает рукопашную атаку с преимуществом на дистанции в 120 фт.',3,1,0),(107,'ТЫСЯЧА ЛИЦ','Вы понимаете, как магически изменять детали своего облика. Вы можете неограниченно творить заклинание смена обличья\r\n<br>\r\nСМЕНА ОБЛИЧЬЯ<br>\r\nВремя накладывания: 1 действие<br>\r\nДистанция: На себя<br>\r\nКомпоненты: В, С<br>\r\nДлительность: Концентрация, вплоть до 1 часа<br>\r\nВы принимаете другой облик. При накладывании выберите один из представленных ниже вариантов, эффект от которого будет длиться всю длительность заклинания. Пока заклинание активно, вы можете действием окончить один эффект, чтобы получить преимущества другого.<br>\r\n<b>Адаптация к воде.</b><br> Вы приспосабливаете своё тело к существованию в воде, отращивая жабры\r\nи перепонки между пальцами. Вы можете дышать под водой и получаете скорость плавания, равную\r\nскорости хождения.<br>\r\n<b>Естественное оружие.</b><br> Вы отращиваете когти, клыки, шипы, рога или другое естественное оружие на свой выбор. Ваш безоружный удар причиняет дробящий, колющий или рубящий урон 1к6, в зависимости от выбранного вами оружия, и вы владеете безоружными ударами. Это оружие будет\r\nмагическим, и вы получаете бонус +1 к броскам атаки и урона им.<br>\r\n<b>Изменение внешности.</b><br> Вы изменяете свою внешность. Вы сами решаете, на кого будете походить, включая рост, вес, лицо, звук голоса, длину\r\nволос, цвета и отличительные характеристики. Вы можете стать похожим на представителя другой расы, но ваши показатели не изменяются. Вы\r\nтакже не можете выглядеть как существо другой категории размера, и ваше тело остаётся примерно тем же самым; например, это заклинание не сделает вас четырёхногим. Пока заклинание активно, вы можете действием изменять свою внешность.',NULL,1,0),(108,'Исполненное желание','Не способен накладывать заклинание \"Исполнение желания\"',NULL,1,0),(109,'test_character_talent','',5,1,0),(110,'test_class_talent','',10,1,0),(111,'Распознать фальшивку','Вы можете действием даровать истинное зрение согласному существу на 1 час.',3,1,0),(112,'Метамагия','МЕТАМАГИЯ<br>\r\nНа 3 уровне вы получаете способность подстраивать заклинания под свои нужды.<br>\r\n Вы выбираете два варианта метамагии из перечисленных ниже. <br>\r\n<ul>\r\n<li><b>АККУРАТНОЕ ЗАКЛИНАНИЕ</b>\r\nКогда вы накладываете заклинание, которое вынуждает других существ совершить спасбросок, вы можете защитить некоторых из них от магического воздействия. <br>Для этого вы тратите 1 единицу чародейства и выбираете существ в количестве, равном вашему модификатору Харизмы (минимум одно существо). Указанные существа автоматически преуспевают в спасброске от данного заклинания.</li>\r\n<li><b>ДАЛЁКОЕ ЗАКЛИНАНИЕ</b><br>\r\nПри накладывании заклинания, дистанция которого 5 футов и более, вы можете потратить 1 единицу чародейства, чтобы удвоить это расстояние.\r\n<br>При накладывании заклинания с дистанцией «прикосновение», вы можете потратить 1 единицу чародейства, чтобы увеличить это расстояние до\r\n30 футов.</li>\r\n<li><b>НЕПРЕОДОЛИМОЕ ЗАКЛИНАНИЕ</b>\r\n<br>Когда вы накладываете заклинание, которое вынуждает существо совершить спасбросок для защиты от его эффектов, вы можете потратить 3\r\nединицы чародейства, чтобы одна из целей заклинания совершила первый спасбросок от этого заклинания с помехой.</li>\r\n<li><b>НЕУЛОВИМОЕ ЗАКЛИНАНИЕ</b><br>\r\nВо время использования заклинания вы можете потратить 1 единицу чародейства, чтоб сотворить его без вербальных и соматических компонентов.</li>\r\n<li><b>ПРОДЛЁННОЕ ЗАКЛИНАНИЕ</b>\r\n<br>При накладывании заклинания с длительностью 1 минута или более, вы можете потратить 1 единицу чародейства, чтобы удвоить это время, вплоть до максимального в 24 часа.</li>\r\n<li><b>УДВОЕННОЕ ЗАКЛИНАНИЕ</b>\r\n<br>Если вы используете заклинание, нацеливаемое на текущем накладываемом уровне только на одно существо и не имеющее дальность «на себя», вы можете потратить количество единиц чародейства, равное уровню заклинания (1 для заговоров), чтобы нацелиться им на второе существо-цель в пределах дистанции этого заклинания.</li>\r\n<li><b>УСИЛЕННОЕ ЗАКЛИНАНИЕ</b><br>\r\nПри совершении броска урона от заклинания вы можете потратить 1 единицу чародейства, чтобы перебросить несколько костей урона (количество\r\nравно вашему модификатору Харизмы, минимум одна). Вы должны использовать новое выпавшее значение.\r\nВы можете воспользоваться вариантом «усиленное заклинание» даже если вы уже использовали другой вариант метамагии для этого заклинания.</li>\r\n<li><b>УСКОРЕННОЕ ЗАКЛИНАНИЕ</b><br>\r\nЕсли вы используете заклинание со временем накладывания «1 действие», вы можете потратить 2 единицы чародейства, чтобы сотворить это заклинание бонусным действием.\r\n</li>\r\n</ul>\r\nНа 10 и 17 уровне вы получаете ещё по одному варианту.<br>\r\nПри сотворении заклинания может быть использован только один метамагический вариант, если в его описании не указано обратное.<br>',NULL,1,0),(113,'Метамагия / УСКОРЕННОЕ ЗАКЛИНАНИЕ','Если вы используете заклинание со временем накладывания «1 действие», вы можете потратить 2 единицы чародейства, чтобы сотворить это заклинание бонусным действием.',NULL,1,0),(114,'Метамагия / НЕУЛОВИМОЕ ЗАКЛИНАНИЕ','Во время использования заклинания вы можете потратить 1 единицу чародейства, чтоб сотворить его без вербальных и соматических компонентов',NULL,1,0),(115,'ПЛАСТИЧНЫЕ ИЛЛЮЗИИ','Начиная с 6 уровня, если вы сотворили заклинание школы Иллюзии длительностью как минимум\r\n1 минута, вы можете действием изменить характер этой иллюзии (используя обычные ограничения для этой иллюзии), при условии, что можете\r\nвидеть эту иллюзию.',NULL,1,0),(116,'ОЧИЩАЮЩЕЕ КАСАНИЕ','Начиная с 14 уровня вы можете действием окончить действие заклинания на себе или на одном\r\nсогласном существе, которого вы касаетесь.\r\nВы можете использовать это умение количество раз, равное вашему модификатору Харизмы\r\n(минимум 1). Вы восстанавливаете возможность использования после продолжительного отдыха.',5,1,0),(117,'ПРИРОДНЫЙ УДАР','Начиная с 6 уровня ваши атаки в облике зверя\r\nсчитаются магическими для преодоления сопротивления и иммунитета к немагическим атакам и\r\nурону',NULL,1,0),(118,'СТИХИЙНЫЙ ДИКИЙ ОБЛИК','С 10 уровня вы можете одновременно потратить два применения дикого облика, чтобы принять облик водяного, воздушного, земляного или огненного элементаля.',NULL,1,0),(119,'ТЫСЯЧА ЛИЦ','С 14 уровня вы понимаете, как магически изменять детали своего облика. Вы можете неограниченно творить заклинание смена обличья.',NULL,1,0);
/*!40000 ALTER TABLE `talent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portrait` varchar(255) DEFAULT NULL,
  `border_color` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text,
  `short_desc` text,
  `cost` float DEFAULT NULL,
  `currency_type_id` int(11) unsigned DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `type_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tools_currency_type_id_currency_id` (`currency_type_id`),
  KEY `tools_type_id_tools_type_id` (`type_id`),
  CONSTRAINT `tools_currency_type_id_currency_id` FOREIGN KEY (`currency_type_id`) REFERENCES `currency` (`id`),
  CONSTRAINT `tools_type_id_tools_type_id` FOREIGN KEY (`type_id`) REFERENCES `tools_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tools`
--

LOCK TABLES `tools` WRITE;
/*!40000 ALTER TABLE `tools` DISABLE KEYS */;
INSERT INTO `tools` VALUES (3,'Thieves\' tools','<p>В этот набор инструментов входят небольшой напильник, набор отмычек, небольшое зеркальце на длинной ручке, ножницы и пара щипчиков. Владение этими инструментами позволяет добавлять бонус мастерства ко всем проверкам характеристик, сделанным для отключения ловушек и взлома замков.</p>\r\n','<p>Владение добавляет бонус мастерства ко всем проверкам характеристик, сделанным для <strong>отключения ловушек</strong> и <strong>взлома замков</strong>.</p>\r\n',25,4,1,NULL),(4,'Dragonchess set','','',1,4,0.5,1),(5,'Playing card set','','',5,2,0,1),(6,'Dice set','','',1,2,0,1),(7,'Three-Dragon Ante set','','',1,4,0,1),(8,'Navigator\'s tools','<p>Эти инструменты используются для навигации в море. Владение инструментами навигатора позволяет прокладывать курс корабля и пользоваться морскими картами. Кроме того, эти инструменты позволяют вам добавлять бонус мастерства к проверкам характеристик, совершённым, чтобы не потеряться в море</p>\r\n','<p>Владение позволяет <strong>прокладывать курс корабля</strong> и <strong>пользоваться морскими картами</strong> и добавлять <strong>бонус мастерства к</strong> <strong>проверкам</strong> характеристик, совершённым, <strong>чтобы не потеряться в море.</strong></p>\r\n',25,4,2,NULL),(9,'Poisoner\'s kit','<p>В набор отравителя входят флаконы, химикаты и прочее снаряжение, необходимое для создания ядов. Владение этим набором позволяет вам добавлять бонус мастерства к проверкам характеристик, совершённым для создания и использования ядов.</p>\r\n','<p>Владение позволяет добавлять <strong>бонус мастерства к</strong> проверкам характеристик, совершённым для <strong>создания</strong> и <strong>использования</strong> <strong>ядов</strong>.</p>\r\n',50,4,2,NULL),(10,'Alchemist\'s supplies','','',50,4,5,2),(11,'Potter\'s tools','','',10,4,3,2),(12,'Tinker\'s tools','','',50,4,10,2),(13,'Calligrapher\'s supplies','','',10,4,5,2),(14,'Leatherworker\'s tools','','',5,4,5,2),(15,'Smith\'s tools','','',20,4,8,2),(16,'Brewer\'s supplies','','',20,4,9,2),(17,'Carpenter\'s tools','','',8,4,6,2),(18,'Cook\'s utensils','','',1,4,8,2),(19,'Woodcarver\'s tools','','',1,4,5,2),(20,'Cobbler\'s tools','','',5,4,5,2),(21,'Glassblower\'s tools','','',30,4,5,2),(22,'Weaver\'s tools','','',1,4,5,2),(23,'Painter\'s supplies','','',10,4,5,2),(24,'Jeweler\'s tools','','',25,4,5,2),(25,'Drum','','',6,4,3,3),(26,'Viol','','',30,4,1,3),(27,'Bagpipes','','',30,4,6,3),(28,'Lyre','','',30,4,2,3),(29,'Lute','','',35,4,2,3),(30,'Horn','','',3,4,2,3),(31,'Pan flute','','',12,4,2,3),(32,'Flute','','',2,4,1,3),(33,'Dulcimer','','',25,4,10,3),(34,'Shawm','','',2,4,1,3),(35,'Disguise kit','<p>Этот набор косметики, красителей для волос и бутафории позволяет изменять ваш внешний облик. Владение этим набором позволяет добавлять бонус мастерства к проверкам характеристик, совершённым для визуальной маскировки.</p>\r\n','<p>Владение позволяет добавлять <strong>бонус мастерства к проверкам</strong> характеристик, совершённым для <strong>визуальной</strong> <strong>маскировки</strong>.</p>\r\n',25,4,3,NULL),(36,'Forgery kit','<p>В этой небольшой коробке лежат разные бумаги и пергаменты, ручки и чернила, печати и куски воска, золотая и серебряная фольга, и прочие припасы, необходимые для создания убедительных подделок документов. Владение этим набором позволяет добавлять бонус мастерства к проверкам характеристик, совершённым при создании поддельных документов.</p>\r\n','<p>Владение позволяет добавлять <strong>бонус мастерства к проверкам</strong> характеристик, совершённым <strong>при создании поддельных документов</strong>.</p>\r\n',15,4,5,NULL),(37,'Herbalism kit','<p>В этот набор входят разнообразные инструменты, такие как ножницы, ступка и пестик, а также мешочки и флаконы, используемые травниками при создании снадобий и зелий. Владение этим набором позволяет добавлять бонус мастерства к проверкам характеристик, совершённым при опознании и использовании трав. Кроме того, владение этим набором требуется для создания противоядия и зелья лечения.</p>\r\n','<p>Владение позволяет добавлять <strong>бонус мастерства к проверкам</strong> характеристик, совершённым <strong>при</strong> <strong>опознании</strong> <strong>и использовании трав</strong>. Кроме того, владение этим набором <strong>требуется для создания противоядия и зелья лечения</strong>.</p>\r\n',5,4,3,NULL);
/*!40000 ALTER TABLE `tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tools_type`
--

DROP TABLE IF EXISTS `tools_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tools_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text,
  `short_desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tools_type`
--

LOCK TABLES `tools_type` WRITE;
/*!40000 ALTER TABLE `tools_type` DISABLE KEYS */;
INSERT INTO `tools_type` VALUES (1,'Gaming set','<p>Игры могут состоять из разных предметов, включая кости и колоды карт. Если вы владеете игровым набором, вы можете добавлять бонус мастерства к проверкам характеристик, совершаемым во время игры. Для каждой игры требуется отдельное владение.</p>\r\n','<p>Владение&nbsp; дает возможность добавлять <strong>бонус мастерства к проверкам</strong> характеристик, совершаемым <strong>во время игры</strong>.</p>\r\n'),(2,'Artisan\'s tools','<p>В эти особые наборы входят инструменты, необходимые для ремесла и торговли. В таблице приведены примеры самых распространённых наборов, каждый из которых связан со своим ремеслом. Владение инструментами ремесленника позволяет добавлять бонус мастерства к проверкам характеристик, совершённым при использовании инструментов в ремесле. Для каждого набора инструментов требуется отдельное владение.</p>\r\n','<p>Владение позволяет <strong>добавлять бонус мастерства к проверкам</strong> характеристик, совершённым <strong>при использовании инструментов в ремесле</strong>.</p>\r\n'),(3,'Musical instrument','<p>Если вы владеете определённым музыкальным инструментом, вы можете добавлять бонус мастерства к проверкам характеристик, совершённым во время игры на нём. Бард может использовать музыкальный инструмент в качестве фокусировки для заклинаний. Для каждого музыкального инструмента нужно отдельное владение</p>\r\n','<p>Владеете определённым музыкальным инструментом, вы можете добавлять бонус мастерства к проверкам характеристик, совершённым во время игры на нём.</p>\r\n');
/*!40000 ALTER TABLE `tools_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','xUi2Mh_I38hlbZsJChFgRXyqVdBA5cPd','$2y$13$4CPHhE2oSSTDrvzrhXrLw.JRwKjwwVChRtrp4jxW.hzVv3X4lH4u.',NULL,'admin@admin.com',10,1517520255,1517520255,1),(2,'admin2','ULgWiUBnPKaQoHiXSznBt4wUWRo5pcj-','$2y$13$2IOHOdc2pLBO7uY40KtiU.PhTQSSvMWGBAgTqrcUC6JLWnhrhvTwS',NULL,'admin2@admin.com',10,1517521849,1517521849,1),(3,'Ecchi','tTW1d5PDzufXowvqkJ-TaXzmA61K8ory','$2y$13$3K18ikauaSJQrqZ5ycOFwecs/HfctAhi7/zJMGEUMAPlYl08NE30S',NULL,'ecchi-san@gmail.com',10,1519142140,1519142140,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weapon_properties`
--

DROP TABLE IF EXISTS `weapon_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weapon_properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property` smallint(6) unsigned NOT NULL,
  `property_value` varchar(255) DEFAULT NULL,
  `item_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `weapon_properties_item_id_items_id` (`item_id`),
  CONSTRAINT `weapon_properties_item_id_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weapon_properties`
--

LOCK TABLES `weapon_properties` WRITE;
/*!40000 ALTER TABLE `weapon_properties` DISABLE KEYS */;
INSERT INTO `weapon_properties` VALUES (1,3,'',NULL),(3,10,'1d8',NULL),(4,3,'',NULL),(5,8,'20/60',NULL),(6,1,'',NULL),(7,8,'20/60',NULL),(8,10,'1d8',NULL),(9,3,'',NULL),(10,8,'20/60',NULL),(11,8,'30/120',NULL),(12,9,'',NULL),(13,3,'',NULL),(14,8,'20/60',NULL),(15,3,'',NULL),(16,0,'80/320',NULL),(17,4,'',NULL),(18,9,'',NULL),(19,8,'20/60',NULL),(20,1,'',NULL),(21,0,'80/320',NULL),(22,9,'',NULL),(23,0,'30/120',NULL),(24,6,'',NULL),(25,9,'',NULL),(26,2,'',NULL),(27,10,'1d10',NULL),(28,10,'1d10',NULL),(29,9,'',NULL),(30,6,'',NULL),(31,2,'',NULL),(32,9,'',NULL),(33,2,'',NULL),(34,6,'',NULL),(35,7,'',NULL),(36,10,'1d10',NULL),(37,6,'',NULL),(38,1,'',NULL),(39,3,'',NULL),(40,1,'',NULL),(41,9,'',NULL),(42,2,'',NULL),(43,9,'',NULL),(44,6,'',NULL),(45,2,'',NULL),(46,1,'',NULL),(47,9,'',NULL),(48,2,'',NULL),(49,3,'',NULL),(50,1,'',NULL),(51,8,'20/60',NULL),(52,10,'1d8',NULL),(53,0,'30/120',NULL),(54,3,'',NULL),(55,4,'',NULL),(56,0,'100/400',NULL),(57,9,'',NULL),(58,4,'',NULL),(59,2,'',NULL),(60,0,'150/600',NULL),(61,9,'',NULL),(62,2,'',NULL),(63,0,'25/100',NULL),(64,4,'',NULL),(65,8,'5/15',NULL),(66,7,'',NULL);
/*!40000 ALTER TABLE `weapon_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weapon_property`
--

DROP TABLE IF EXISTS `weapon_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weapon_property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned DEFAULT NULL,
  `damage_dice` varchar(255) NOT NULL,
  `two_hand_damage_dice` varchar(255) DEFAULT NULL,
  `attack_bonus` int(11) DEFAULT NULL,
  `damage_bonus` int(11) DEFAULT NULL,
  `fit` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `weapon_property_item_id_items_id` (`item_id`),
  CONSTRAINT `weapon_property_item_id_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weapon_property`
--

LOCK TABLES `weapon_property` WRITE;
/*!40000 ALTER TABLE `weapon_property` DISABLE KEYS */;
INSERT INTO `weapon_property` VALUES (1,8,'1d8','0',NULL,NULL,1),(2,9,'1d4','',NULL,NULL,1),(3,29,'1d6','1d8',NULL,NULL,0),(4,31,'1d6','',1,1,1),(5,32,'1d6','',0,0,1),(6,33,'1d8','',2,2,1),(7,34,'1','',NULL,NULL,0),(8,85,'1d4','',1,1,1),(9,96,'1d6','1d8',NULL,NULL,0),(10,97,'1d6','1d8',NULL,NULL,0),(11,98,'1d8','1d10',1,1,0),(12,102,'1d6','',NULL,NULL,1),(13,103,'1d10','',NULL,NULL,0),(14,105,'-','',NULL,NULL,0),(15,117,'1d4','',NULL,NULL,1),(16,118,'1d8','',NULL,NULL,0),(17,121,'1d8','',NULL,NULL,1),(18,146,'1d4','',1,1,1),(19,151,'1d8','1d10',3,3,0),(20,160,'1d8','1d10',NULL,NULL,0),(21,161,'1d8','1d10',2,2,1),(22,166,'1d6','',NULL,NULL,1);
/*!40000 ALTER TABLE `weapon_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weapon_type`
--

DROP TABLE IF EXISTS `weapon_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weapon_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_type_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `weapon_type_parent_type_id_weapon_type_id` (`parent_type_id`),
  CONSTRAINT `weapon_type_parent_type_id_weapon_type_id` FOREIGN KEY (`parent_type_id`) REFERENCES `weapon_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weapon_type`
--

LOCK TABLES `weapon_type` WRITE;
/*!40000 ALTER TABLE `weapon_type` DISABLE KEYS */;
INSERT INTO `weapon_type` VALUES (1,'Simple weapons',NULL),(2,'Martial weapons',NULL),(4,'Simple Ranged Weapons',1),(5,'Martial Melee Weapons',2),(6,'Martial Ranged Weapons',2),(8,'Longswords',5),(9,'Simple Melee Weapons',1),(10,'Shortswords',5),(11,'Rapiers',5),(12,'Hand crossbows',6);
/*!40000 ALTER TABLE `weapon_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weapon_type_weapon_rel`
--

DROP TABLE IF EXISTS `weapon_type_weapon_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weapon_type_weapon_rel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) unsigned DEFAULT NULL,
  `item_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `weapon_type_weapon_rel_type_id_weapon_type_id` (`type_id`),
  KEY `weapon_type_weapon_rel_item_id_items_id` (`item_id`),
  CONSTRAINT `weapon_type_weapon_rel_item_id_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `weapon_type_weapon_rel_type_id_weapon_type_id` FOREIGN KEY (`type_id`) REFERENCES `weapon_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weapon_type_weapon_rel`
--

LOCK TABLES `weapon_type_weapon_rel` WRITE;
/*!40000 ALTER TABLE `weapon_type_weapon_rel` DISABLE KEYS */;
INSERT INTO `weapon_type_weapon_rel` VALUES (1,10,NULL);
/*!40000 ALTER TABLE `weapon_type_weapon_rel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-28 14:36:20
