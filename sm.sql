/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50734 (5.7.34)
 Source Host           : localhost:3306
 Source Schema         : sm

 Target Server Type    : MySQL
 Target Server Version : 50734 (5.7.34)
 File Encoding         : 65001

 Date: 22/05/2023 17:28:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kecamatan
-- ----------------------------
BEGIN;
INSERT INTO `kecamatan` (`id`, `nama`, `lat`, `long`) VALUES (1, 'Banjarmasin Barat', '-3.319231594719411', '114.59940804211638');
INSERT INTO `kecamatan` (`id`, `nama`, `lat`, `long`) VALUES (2, 'Banjarmasin Selatan', '-3.3375255359541174', '114.59012579369698');
INSERT INTO `kecamatan` (`id`, `nama`, `lat`, `long`) VALUES (3, 'Banjarmasin Tengah', '-3.3206882675833933', '114.58996393606607');
INSERT INTO `kecamatan` (`id`, `nama`, `lat`, `long`) VALUES (4, 'Banjarmasin Timur', '-3.3194029681090265', '114.5753684994429');
INSERT INTO `kecamatan` (`id`, `nama`, `lat`, `long`) VALUES (5, 'Banjarmasin Utara', '-3.300380340711564', '114.5830996156001');
COMMIT;

-- ----------------------------
-- Table structure for kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `kelurahan`;
CREATE TABLE `kelurahan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelurahan
-- ----------------------------
BEGIN;
INSERT INTO `kelurahan` (`id`, `nama`, `kecamatan_id`, `lat`, `long`) VALUES (1, 'Basirih', 1, NULL, NULL);
INSERT INTO `kelurahan` (`id`, `nama`, `kecamatan_id`, `lat`, `long`) VALUES (2, 'Belitung Selatan', 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for person
-- ----------------------------
DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kecamatan_id` int(11) DEFAULT NULL,
  `kelurahan_id` int(11) DEFAULT NULL,
  `rt_id` int(11) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of person
-- ----------------------------
BEGIN;
INSERT INTO `person` (`id`, `kecamatan_id`, `kelurahan_id`, `rt_id`, `nik`, `nama`, `telp`, `user_id`, `created_at`, `updated_at`) VALUES (2, 1, 1, 3, '1234567654321453', 'asrani', '0987656781', 1, '2023-05-15 16:33:02', '2023-05-15 16:33:02');
INSERT INTO `person` (`id`, `kecamatan_id`, `kelurahan_id`, `rt_id`, `nik`, `nama`, `telp`, `user_id`, `created_at`, `updated_at`) VALUES (6, 1, 1, 2, '123', 'asrani', '0987654', 4, '2023-05-15 21:00:21', '2023-05-15 21:00:21');
COMMIT;

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`) USING BTREE,
  KEY `role_users_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of role_users
-- ----------------------------
BEGIN;
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (1, 1);
INSERT INTO `role_users` (`user_id`, `role_id`) VALUES (4, 2);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'superadmin', '2020-12-23 23:17:35', '2020-12-23 23:17:35');
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (2, 'user', '2023-05-15 16:36:37', '2023-05-15 16:36:37');
COMMIT;

-- ----------------------------
-- Table structure for rt
-- ----------------------------
DROP TABLE IF EXISTS `rt`;
CREATE TABLE `rt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kecamatan_id` int(11) DEFAULT NULL,
  `kelurahan_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rt
-- ----------------------------
BEGIN;
INSERT INTO `rt` (`id`, `kecamatan_id`, `kelurahan_id`, `nama`, `lat`, `long`) VALUES (2, NULL, 1, '1', NULL, NULL);
INSERT INTO `rt` (`id`, `kecamatan_id`, `kelurahan_id`, `nama`, `lat`, `long`) VALUES (3, NULL, 1, '2', NULL, NULL);
INSERT INTO `rt` (`id`, `kecamatan_id`, `kelurahan_id`, `nama`, `lat`, `long`) VALUES (4, NULL, 1, '3', NULL, NULL);
INSERT INTO `rt` (`id`, `kecamatan_id`, `kelurahan_id`, `nama`, `lat`, `long`) VALUES (5, NULL, 1, '4', NULL, NULL);
INSERT INTO `rt` (`id`, `kecamatan_id`, `kelurahan_id`, `nama`, `lat`, `long`) VALUES (6, NULL, 1, '5', NULL, NULL);
INSERT INTO `rt` (`id`, `kecamatan_id`, `kelurahan_id`, `nama`, `lat`, `long`) VALUES (7, NULL, 2, '1', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `password_superadmin` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `api_token` varchar(255) DEFAULT NULL,
  `last_session` varchar(255) DEFAULT NULL,
  `change_password` int(1) unsigned DEFAULT '0' COMMENT '0: belum, 1: sudah',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`) VALUES (1, 'admin', NULL, 'admin', '2023-04-29 07:57:56', '$2y$10$E9xG1OtIFvBRbHqlwHCC3u48vO5eBf2OQ9wFNpi.qKOAzVqNDUdW2', NULL, NULL, '2023-04-29 07:57:56', '2023-04-29 07:57:56', '$2y$10$tjMANlV25IUwvKuPxEODW.3qE3zPSKjwhmgTcZUgsPDZRGcpgGAN.', NULL, 0);
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `password_superadmin`, `remember_token`, `created_at`, `updated_at`, `api_token`, `last_session`, `change_password`) VALUES (4, 'budi', NULL, 'budi', '2023-05-15 20:58:28', '$2y$10$RxhAbRImcouzNE31XoRS9e13HIIyYxHHoLqx22jOnFI1BdkcMpqKq', NULL, NULL, '2023-05-15 20:58:28', '2023-05-15 20:58:28', NULL, NULL, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
