/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : fleetdb

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 31/10/2024 21:55:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('0f69269805f0d655c043e8ce5769ee46', 'i:1;', 1729222810);
INSERT INTO `cache` VALUES ('0f69269805f0d655c043e8ce5769ee46:timer', 'i:1729222810;', 1729222810);
INSERT INTO `cache` VALUES ('1eb7c659f04fd156385f8e19b7b93ce2', 'i:1;', 1730286545);
INSERT INTO `cache` VALUES ('1eb7c659f04fd156385f8e19b7b93ce2:timer', 'i:1730286545;', 1730286545);
INSERT INTO `cache` VALUES ('adisarana@gmail.comx|::1', 'i:1;', 1730286545);
INSERT INTO `cache` VALUES ('adisarana@gmail.comx|::1:timer', 'i:1730286545;', 1730286545);
INSERT INTO `cache` VALUES ('aditya@mailer.com|::1', 'i:1;', 1729222810);
INSERT INTO `cache` VALUES ('aditya@mailer.com|::1:timer', 'i:1729222810;', 1729222810);
INSERT INTO `cache` VALUES ('de2894409555db1c889ebc6f0957081f', 'i:2;', 1728353961);
INSERT INTO `cache` VALUES ('de2894409555db1c889ebc6f0957081f:timer', 'i:1728353961;', 1728353961);
INSERT INTO `cache` VALUES ('f274f5bf4d88afe268f56d023cbab588', 'i:1;', 1730375320);
INSERT INTO `cache` VALUES ('f274f5bf4d88afe268f56d023cbab588:timer', 'i:1730375320;', 1730375320);
INSERT INTO `cache` VALUES ('fleet@gmail.com|::1', 'i:2;', 1728353962);
INSERT INTO `cache` VALUES ('fleet@gmail.com|::1:timer', 'i:1728353962;', 1728353962);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for fleet_banner
-- ----------------------------
DROP TABLE IF EXISTS `fleet_banner`;
CREATE TABLE `fleet_banner`  (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_header` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `b_desc` varchar(155) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `b_date` datetime NULL DEFAULT NULL,
  `b_by` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `b_image` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `b_active` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`b_id`) USING BTREE,
  INDEX `b_id`(`b_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fleet_banner
-- ----------------------------
INSERT INTO `fleet_banner` VALUES (1, 'Hilux Rangga', 'Launching Toyota Hilux Rangga', '2024-10-28 13:51:19', 'admin', 'rangga.jpeg', '0');
INSERT INTO `fleet_banner` VALUES (2, 'Agya Amazing Raxe', 'Toyota GR ', '2024-10-20 13:51:51', 'admin', 'jedagjedug.jpeg', '0');
INSERT INTO `fleet_banner` VALUES (3, 'Promo No 3', 'Data Promo', '2024-10-20 13:51:51', 'admin', 'jedagjedug.jpeg', '0');
INSERT INTO `fleet_banner` VALUES (4, 'Promo No 4', 'Data Promo', '2024-10-20 13:51:51', 'admin', 'jedagjedug.jpeg', '0');
INSERT INTO `fleet_banner` VALUES (5, 'Promo No 5', 'Data Promo', '2024-10-20 13:51:51', 'admin', 'jedagjedug.jpeg', '0');
INSERT INTO `fleet_banner` VALUES (6, 'Max Promo', 'Data Promo', '2024-10-20 13:51:51', 'admin', 'jedagjedug.jpeg', '0');

-- ----------------------------
-- Table structure for fleet_customer
-- ----------------------------
DROP TABLE IF EXISTS `fleet_customer`;
CREATE TABLE `fleet_customer`  (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_number` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_name` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_phone` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_mobile` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_mail` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_pic_name` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_pic_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cust_pic_mail` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cust_id`) USING BTREE,
  INDEX `cust_id`(`cust_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fleet_customer
-- ----------------------------
INSERT INTO `fleet_customer` VALUES (1, 'F001', 'PT. CSM CORPORATAMA', 'INDORENT JAMBI. Jl. Sunan Kalijaga RT.13, Kel. Simpang III Sipin, Kec. Kota Baru, Jambi. -.', '021 80675777\r\n', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_customer` VALUES (2, 'F002', 'PT. ADI SARANA ARMADA, TBK', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for fleet_vehicle
-- ----------------------------
DROP TABLE IF EXISTS `fleet_vehicle`;
CREATE TABLE `fleet_vehicle`  (
  `fu_id` int(11) NOT NULL AUTO_INCREMENT,
  `fu_customer_id` int(11) NULL DEFAULT NULL,
  `fu_no_rangka` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_no_pol` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_model` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_color` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_tgl_spk` date NULL DEFAULT NULL,
  `fu_tgl_dec` date NULL DEFAULT NULL,
  `fu_tgl_bp` date NULL DEFAULT NULL,
  `fu_tgl_bpkb` date NULL DEFAULT NULL,
  `fu_tgl_stnk` date NULL DEFAULT NULL,
  `fu_tgl_last_service` date NULL DEFAULT NULL,
  `fu_tgl_next_service` date NULL DEFAULT NULL,
  `fu_last_note` varchar(190) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_insurance_merk` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `fu_insurance_active` date NULL DEFAULT NULL,
  `fu_client` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_client_note` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_appraise_price` double NULL DEFAULT 0,
  `fu_appraise_date` datetime NULL DEFAULT NULL,
  `fu_appraise_by` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_appraise_location` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fu_image` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`fu_id`) USING BTREE,
  INDEX `fu_id`(`fu_id`) USING BTREE,
  INDEX `fu_customer_id`(`fu_customer_id`) USING BTREE,
  INDEX `fu_no_rangka`(`fu_no_rangka`) USING BTREE,
  INDEX `fu_no_pol`(`fu_no_pol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fleet_vehicle
-- ----------------------------
INSERT INTO `fleet_vehicle` VALUES (1, 2, 'MHKAA1BY0NK011608', 'BH-1395-YE', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2022-07-15', NULL, '2022-07-30', '2022-09-13', '2022-08-11', '2024-03-09', '2024-09-09', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (2, 2, 'MHKAA1BY0NK011639', 'BH-1397-YE', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2022-07-15', NULL, '2022-07-30', '2022-09-13', '2022-08-11', '2024-04-17', '2024-10-17', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (3, 2, 'MHKAA1BY7NK009225', 'BH-1286-YE', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2022-07-15', NULL, '2022-07-30', '2022-08-13', '2022-07-29', '2024-02-17', '2024-08-17', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (4, 2, 'MHKAA1BY7NK011587', 'BH-1396-YE', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2022-07-15', NULL, '2022-07-30', '2022-09-13', '2022-08-11', '2024-05-28', '2024-11-28', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (5, 2, 'MHKAA1BYXNK009333', 'BH-1285-YE', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2022-07-15', NULL, '2022-07-30', '2022-08-13', '2022-07-29', '2024-09-07', '2025-03-07', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (6, 2, 'MHKAA1BYXNK011616', 'BH-1394-YE', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2022-07-15', NULL, '2022-07-30', '2022-09-13', '2022-08-11', '2024-03-30', '2024-09-30', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (7, 2, 'MHKAB1BYXNK026212', 'BH-1854-YE', 'AVANZA', 'NEW 1.5 G M/T', 'SILVER METALIK', '2022-08-29', NULL, '2022-08-31', '2022-10-04', '2022-09-17', '2024-06-25', '2024-12-25', NULL, 'RAMAYANA', '0', '2024-09-14', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (8, 2, 'MHFJB8EM0N1106169', 'BH-1856-YE', 'INNOVA', '2.4 G MT DIESEL', 'HITAM METALIK', '2022-07-15', NULL, '2022-09-30', '2022-10-04', '2022-09-17', '2024-09-19', '2025-03-19', NULL, 'RAMAYANA', '0', '2024-10-20', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (9, 2, 'MHFJB8EM1N1106214', 'BH-1855-YE', 'INNOVA', '2.4 G MT DIESEL', 'HITAM METALIK', '2022-07-15', NULL, '2022-09-30', '2022-10-04', '2022-09-17', '2024-06-23', '2024-12-23', NULL, 'RAMAYANA', '0', '2024-10-20', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (10, 2, 'MHFJW8EM0N2406339', 'BH-1311-YG', 'INNOVA', '2.0 G MT BENSIN', 'HITAM METALIK', '2022-11-21', NULL, '2022-11-30', '2023-01-11', '2022-12-09', '2024-09-18', '2025-03-18', NULL, 'RAMAYANA', '0', '2025-01-22', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (11, 2, 'MHFJW8EM9N2406338', 'BH-1310-YG', 'INNOVA', '2.0 G MT BENSIN', 'HITAM METALIK', '2022-11-09', NULL, '2022-11-30', '2023-01-11', '2022-12-09', '2024-08-03', '2025-02-03', NULL, 'RAMAYANA', '0', '2025-01-22', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (12, 2, 'MHKE8FB2JPK015552', 'BH-1563-YH', 'RUSH', '1.5 G A/T', 'HITAM METALIK', '2023-02-03', NULL, '2023-02-28', '2023-03-14', '2023-02-28', '2023-12-21', '2024-06-21', NULL, 'RAMAYANA', '0', '2025-02-08', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (13, 2, 'MHKAB1BY3PK048149', 'BH-1640-YH', 'AVANZA', 'NEW 1.5 G CVT', 'ABU-ABU METALIK', '2023-02-03', NULL, '2023-02-28', '2023-03-14', '2023-03-03', '2024-08-16', '2025-02-16', NULL, 'RAMAYANA', '0', '2025-02-15', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (14, 2, 'MHKE8FB2JPK015448', 'BH-1353-YH', 'RUSH', '1.5 G A/T', 'HITAM METALIK', '2023-01-12', NULL, '2023-02-16', '2023-03-14', '2023-02-14', '2024-05-22', '2024-11-22', NULL, 'RAMAYANA', '0', '2025-02-21', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (15, 2, 'MHKA6GJ6JPJ658140', 'BH-1798-YI', 'CALYA', 'NEW 1.2 G M/T', 'MERAH TUA METALIK', '2023-04-19', NULL, '2023-04-29', '2023-06-08', '2024-05-25', '2024-07-27', '2025-01-27', NULL, 'RAMAYANA', '0', '2025-04-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (16, 2, 'MHKAA1BY0PK026984', 'BH-1649-YI', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2023-04-19', NULL, '2023-04-29', '2023-06-08', '2023-05-15', '2024-04-17', '2024-10-17', NULL, 'RAMAYANA', '0', '2025-04-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (17, 2, 'MHKAA1BY3PK026834', 'BH-1650-YI', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2023-04-19', NULL, '2023-04-29', '2023-06-08', '2023-05-15', '2024-05-29', '2024-11-29', NULL, 'RAMAYANA', '0', '2025-04-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (18, 2, 'MHKAA1BY4PK027202', 'BH-1652-YI', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2023-04-19', NULL, '2023-04-29', '2023-06-08', '2023-05-15', '2024-09-14', '2025-03-14', NULL, 'RAMAYANA', '0', '2025-04-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (19, 2, 'MHKAA1BY4PK027295', 'BH-1651-YI', 'AVANZA', 'NEW 1.3 E M/T', 'HITAM METALIK', '2023-04-19', NULL, '2023-04-29', '2023-06-08', '2023-05-15', '2024-07-15', '2025-01-15', NULL, 'RAMAYANA', '0', '2025-04-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (20, 2, 'MHKAA1BY0PK029951', 'BH-1240-YJ', 'AVANZA', 'NEW 1.3 E CVT', 'HITAM METALIK', '2023-05-31', NULL, '2023-06-16', '2023-07-28', '2024-06-23', '2024-06-08', '2024-12-08', NULL, 'RAMAYANA', '0', '2025-06-15', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (21, 2, 'MHKAB1BY9PK061794', 'BH-1641-YJ', 'AVANZA', 'NEW 1.5 G M/T', 'HITAM METALIK', '2023-07-05', NULL, '2023-07-30', '2023-08-10', '2024-07-29', '2024-06-15', '2024-12-15', NULL, 'RAMAYANA', '0', '2025-07-12', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (22, 2, 'MHKAB1BY3PK061354', 'BH-1728-YJ', 'AVANZA', 'NEW 1.5 G M/T', 'HITAM METALIK', '2023-07-05', NULL, '2023-07-30', '2023-09-13', '2024-08-10', '2024-05-27', '2024-11-27', NULL, 'RAMAYANA', '0', '2025-07-13', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (23, 2, 'MHKAB1BY5PK059878', 'BH-1707-YJ', 'AVANZA', 'NEW 1.5 G M/T', 'HITAM METALIK', '2023-07-08', NULL, '2023-07-30', '2023-09-13', '2024-08-07', '2024-07-15', '2025-01-15', NULL, 'RAMAYANA', '0', '2025-07-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (24, 2, 'MR2BU3BEXP0015213', 'BH-1337-YK', 'COROLLA', 'ALTIS 1.8 V AT', 'HITAM METALIK', '2023-07-24', NULL, '2023-10-31', '2023-10-24', '2024-09-20', '2024-04-30', '2024-10-30', NULL, 'RAMAYANA', '0', '2025-08-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (25, 2, 'MHKAA1BY2PK038246', 'BH-1461-YK', 'AVANZA', 'NEW 1.3 E M/T', 'PUTIH', '2023-09-12', NULL, '2023-09-30', '2023-11-09', '2023-10-05', '2024-08-30', '2025-03-02', NULL, 'RAMAYANA', '0', '2025-09-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (26, 2, 'MHKAA1BY5PK037219', 'BH-1459-YK', 'AVANZA', 'NEW 1.3 E M/T', 'PUTIH', '2023-09-12', NULL, '2023-09-30', '2023-11-09', '2023-10-05', '2024-08-22', '2025-02-22', NULL, 'RAMAYANA', '0', '2025-09-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (27, 2, 'MHKAA1BY6PK038198', 'BH-1458-YK', 'AVANZA', 'NEW 1.3 E M/T', 'PUTIH', '2023-09-12', NULL, '2023-09-30', '2023-11-09', '2023-10-05', '2024-10-19', '2025-04-19', NULL, 'RAMAYANA', '0', '2025-09-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (28, 2, 'MHKA6GJ6JPJ165717', 'BH-1142-YO', 'CALYA', 'NEW 1.2 G M/T', 'PUTIH', '2023-11-17', NULL, '2023-11-30', '2024-01-23', '2024-12-01', '2024-10-10', '2025-04-10', NULL, 'RAMAYANA', '0', '2025-11-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (29, 2, 'MHKAB1BY2PK075973', 'BH-1463-YO', 'AVANZA', 'NEW 1.5 G CVT', 'SILVER METALIK', '2023-12-11', NULL, '2023-12-27', '2024-01-31', '2025-01-03', '2024-07-16', '2025-01-16', NULL, 'RAMAYANA', '0', '2025-12-26', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (30, 2, 'MHFAAAAA9P0024035', 'BH-1481-YO', 'INNOVA', 'Zenix 2.0 G CVT', 'HITAM METALIK', '2023-12-13', NULL, '2023-12-30', '2024-01-31', '2025-01-06', '2024-10-04', '2025-04-04', NULL, 'RAMAYANA', '0', '2025-12-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (31, 2, 'MHKE8FB2JPK017882', 'BH-1479-YO', 'RUSH', '1.5 G A/T', 'HITAM METALIK', '2023-12-21', NULL, '2023-12-30', '2024-01-31', '2025-01-06', '2024-05-24', '2024-11-24', NULL, 'RAMAYANA', '0', '2025-12-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (32, 2, 'MHKE8FB2JPK018065', 'BH-1480-YO', 'RUSH', '1.5 G A/T', 'HITAM METALIK', '2023-12-21', NULL, '2023-12-30', '2024-01-31', '2025-01-06', '2024-07-09', '2025-01-09', NULL, 'RAMAYANA', '0', '2025-12-29', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (33, 2, 'MHFAAAAA1P0015927', 'BH-1839-YO', 'INNOVA', 'Zenix 2.0 V CVT', 'SILVER METALIK', '2024-01-05', NULL, '2024-01-29', '2024-06-26', '2025-02-02', '2024-08-29', '2025-03-01', NULL, 'RAMAYANA', '0', '2026-01-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (34, 2, 'MHFAAAAA8P0023880', 'BH-1840-YO', 'INNOVA', 'Zenix 2.0 V CVT', 'HITAM METALIK', '2024-01-02', NULL, '2024-01-29', '2024-06-26', '2025-02-02', '2024-07-25', '2025-01-25', NULL, 'RAMAYANA', '0', '2026-01-28', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (35, 2, 'MHFAAAAA8R0025955', 'BH-1179-YP', 'INNOVA', 'Zenix 2.0 G CVT', 'HITAM METALIK', '2024-02-06', NULL, '2024-02-27', '2024-06-26', '2025-03-05', '2024-08-18', '2025-02-18', NULL, 'RAMAYANA', '0', '2026-03-11', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (36, 2, 'MHKE8FA2JRK020454', 'BH-1178-YP', 'RUSH', '1.5 G M/T', 'HITAM METALIK', '2024-02-01', NULL, '2024-02-27', '2024-06-26', '2025-03-05', '2024-10-10', '2025-04-10', NULL, 'RAMAYANA', '0', '2026-03-11', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (37, 2, 'MHKE8FA2JRK020559', 'BH-1172-YP', 'RUSH', '1.5 G M/T', 'HITAM METALIK', '2024-02-01', NULL, '2024-02-27', '2024-06-26', '2025-03-05', '2024-08-29', '2025-03-01', NULL, 'RAMAYANA', '0', '2026-03-11', NULL, NULL, 0, NULL, NULL, NULL, '1489681906colour-view-white_optimized.png');
INSERT INTO `fleet_vehicle` VALUES (38, 2, 'MR0KB8CD9P1149545', 'BH-8158-MZ', 'HILUX_DC', '2.4 G 4X4 MT NEW', 'PUTIH', '2024-01-18', NULL, '2024-02-28', '2024-06-26', '2025-02-17', '2024-07-09', '2025-01-09', NULL, 'RAMAYANA', '0', '2026-03-11', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (39, 2, 'MHFABAAA7R0018606', 'BH-1472-YP', 'INNOVA', 'Zenix 2.0 G HV CVT', 'HITAM METALIK', '2024-02-24', NULL, '2024-03-25', '2024-06-26', '2025-04-03', '2024-07-04', '2025-01-04', NULL, 'RAMAYANA', '0', '2026-03-24', NULL, NULL, 0, NULL, NULL, NULL, NULL);
INSERT INTO `fleet_vehicle` VALUES (40, 2, 'MR0KB8CD1R1222183', 'BH-8243-MZ', 'HILUX_DC', '2.4 G 4X4 MT NEW', 'HITAM METALIK', '2024-03-12', NULL, '2024-03-27', '2024-07-04', '2025-04-03', '2024-10-01', '2025-04-01', NULL, 'RAMAYANA', '0', '2026-04-21', NULL, NULL, 400000000, '2024-10-02 19:52:37', 'M. Ridho Suganda', 'Bengkel BP', 'hilux.png');
INSERT INTO `fleet_vehicle` VALUES (41, 2, 'MHFAAAAA2R0025191', 'BH-1370-YQ', 'INNOVA', 'Zenix 2.0 V CVT', 'HITAM METALIK', '2024-06-10', NULL, '2024-06-29', '2024-08-23', '2025-07-10', '2024-08-24', '2025-02-24', NULL, 'RAMAYANA', '0', '2026-06-30', 'PT Sawit Jambi Jaya', 'Digunakan Dirut Sawit Jaya : No Reff 1110023', 450000000, '2024-10-02 19:52:37', 'M. Ridho Suganda', 'Bengkel GR ', 'zenix.jpg');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for master_body_price
-- ----------------------------
DROP TABLE IF EXISTS `master_body_price`;
CREATE TABLE `master_body_price`  (
  `bp_id` int(11) NOT NULL AUTO_INCREMENT,
  `bp_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bp_price` double NULL DEFAULT NULL,
  `bp_description` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`bp_id`) USING BTREE,
  INDEX `bp_id`(`bp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_body_price
-- ----------------------------
INSERT INTO `master_body_price` VALUES (1, 'Poles All Body', 765000, NULL);
INSERT INTO `master_body_price` VALUES (2, 'Engine Care', 275000, NULL);
INSERT INTO `master_body_price` VALUES (3, 'Cabin Cleaner', 506000, NULL);
INSERT INTO `master_body_price` VALUES (4, 'Front Cabin Comfort + Plafon', 433000, NULL);
INSERT INTO `master_body_price` VALUES (5, 'Plafon Care', 255000, NULL);
INSERT INTO `master_body_price` VALUES (6, 'Body Care', 555000, 'Poles Body Exterior');
INSERT INTO `master_body_price` VALUES (7, 'Windshield Cleaning', 195000, NULL);
INSERT INTO `master_body_price` VALUES (8, 'Glass Cleaner', 226000, NULL);
INSERT INTO `master_body_price` VALUES (9, 'Headlamp Cleaner', 139000, NULL);
INSERT INTO `master_body_price` VALUES (10, 'Front Window Coating', 412000, NULL);
INSERT INTO `master_body_price` VALUES (11, 'Injector Purging Gasoline', 317000, NULL);
INSERT INTO `master_body_price` VALUES (12, 'Injector Purging Diesel', 317000, NULL);
INSERT INTO `master_body_price` VALUES (13, 'Aurora Body Coating', 5439000, NULL);
INSERT INTO `master_body_price` VALUES (14, 'Undercoat Anti Karat', 2800000, NULL);
INSERT INTO `master_body_price` VALUES (15, 'Ozone Refreshment', 250000, NULL);

-- ----------------------------
-- Table structure for master_price
-- ----------------------------
DROP TABLE IF EXISTS `master_price`;
CREATE TABLE `master_price`  (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_model` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mp_type` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mp_year` year NULL DEFAULT NULL,
  `mp_price` double NULL DEFAULT NULL,
  PRIMARY KEY (`mp_id`) USING BTREE,
  INDEX `mp_id`(`mp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_price
-- ----------------------------
INSERT INTO `master_price` VALUES (1, 'INNOVA', 'Zenix 2.0 V CVT', 2023, 449000000);
INSERT INTO `master_price` VALUES (2, 'INNOVA', 'Zenix 2.0 V CVT', 2024, 555000000);
INSERT INTO `master_price` VALUES (3, 'AVANZA', 'G', 2020, 199000000);
INSERT INTO `master_price` VALUES (4, 'RUSH', 'G', 2020, 211000000);

-- ----------------------------
-- Table structure for master_price_service
-- ----------------------------
DROP TABLE IF EXISTS `master_price_service`;
CREATE TABLE `master_price_service`  (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_model` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sp_jasa` double NULL DEFAULT NULL,
  `sp_part` double NULL DEFAULT NULL,
  `sp_km` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`sp_id`) USING BTREE,
  INDEX `sp_id`(`sp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_price_service
-- ----------------------------
INSERT INTO `master_price_service` VALUES (1, 'AVANZA', 576339.75, 484050, 70000);
INSERT INTO `master_price_service` VALUES (2, 'AVANZA', 902097, 934500, 80000);
INSERT INTO `master_price_service` VALUES (3, 'AVANZA', 576339.75, 484050, 90000);
INSERT INTO `master_price_service` VALUES (4, 'AVANZA', 626456.25, 887250, 100000);
INSERT INTO `master_price_service` VALUES (5, 'VELOZ', 576339.75, 484050, 70000);
INSERT INTO `master_price_service` VALUES (6, 'VELOZ', 902097, 934500, 80000);
INSERT INTO `master_price_service` VALUES (7, 'VELOZ', 576339.75, 484050, 90000);
INSERT INTO `master_price_service` VALUES (8, 'VELOZ', 626456.25, 887250, 100000);
INSERT INTO `master_price_service` VALUES (9, 'INNOVA ZENIX', 763985.25, 999600, 70000);
INSERT INTO `master_price_service` VALUES (10, 'INNOVA ZENIX', 1195803, 1488900, 80000);
INSERT INTO `master_price_service` VALUES (11, 'INNOVA ZENIX', 763985.25, 999600, 90000);
INSERT INTO `master_price_service` VALUES (12, 'INNOVA ZENIX', 830418.75, 4023600, 100000);
INSERT INTO `master_price_service` VALUES (13, 'RUSH', 571509.75, 484050, 70000);
INSERT INTO `master_price_service` VALUES (14, 'RUSH', 894537, 1034250, 80000);
INSERT INTO `master_price_service` VALUES (15, 'RUSH', 571509.75, 484050, 90000);
INSERT INTO `master_price_service` VALUES (16, 'RUSH', 621206.25, 887250, 100000);
INSERT INTO `master_price_service` VALUES (17, 'YARIS', 763985.25, 554400, 70000);
INSERT INTO `master_price_service` VALUES (18, 'YARIS', 1195803, 1125600, 80000);
INSERT INTO `master_price_service` VALUES (19, 'YARIS', 763985.25, 554400, 90000);
INSERT INTO `master_price_service` VALUES (20, 'YARIS', 830418.75, 957600, 100000);
INSERT INTO `master_price_service` VALUES (21, 'VIOS', 763985.25, 554400, 70000);
INSERT INTO `master_price_service` VALUES (22, 'VIOS', 1195803, 1125600, 80000);
INSERT INTO `master_price_service` VALUES (23, 'VIOS', 763985.25, 554400, 90000);
INSERT INTO `master_price_service` VALUES (24, 'VIOS', 830418.75, 957600, 100000);
INSERT INTO `master_price_service` VALUES (25, 'INNOVA DIESEL', 763985.25, 989100, 70000);
INSERT INTO `master_price_service` VALUES (26, 'INNOVA DIESEL', 1195803, 2388750, 80000);
INSERT INTO `master_price_service` VALUES (27, 'INNOVA DIESEL', 763985.25, 1370250, 90000);
INSERT INTO `master_price_service` VALUES (28, 'INNOVA DIESEL', 830418.75, 989100, 100000);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_10_01_031739_add_two_factor_columns_to_users_table', 2);
INSERT INTO `migrations` VALUES (5, '2024_10_01_082840_create_permission_tables', 3);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('tj90xsDSy1xguJnc1Ajlq7nYKoszAvbAKpxsPBa6', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQVk4c2JmRDJKdDhicXlHZ0JoZTJQazgxakVrSmhKc05LU2NCVmZLNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3QvZmxlZXQtc2VydmljZS9hZG1pbi9ib2R5cGFpbnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1730386424);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `customer_address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_npwp` varchar(26) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_pic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_pic_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'PT. ADI SARANA ARMADA', 'adisarana@gmail.com', NULL, '$2y$12$ymuHG7eNNM9WhhuPJHehAeR1XlpDObfg6eKlOIFA7z72jdu5nWA.6', NULL, NULL, NULL, NULL, '2024-10-01 03:16:48', '2024-10-01 03:16:48', 2, 'Jl. Yos Sudarso No.88, RT.11/RW.11, Sunter Jaya, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14350', '(021) 4563390', '10000010000', 'Abdul Karim', '0343434', 'asarent.png');

SET FOREIGN_KEY_CHECKS = 1;
