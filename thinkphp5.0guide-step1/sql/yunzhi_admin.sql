/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : tp1

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 17/07/2021 18:25:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_admin
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_admin`;
CREATE TABLE `yunzhi_admin`  (
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id` int(0) NOT NULL,
  `sex` tinyint(1) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_admin
-- ----------------------------
INSERT INTO `yunzhi_admin` VALUES ('管理员', 'guanliyuan', 'zxczxc', 0, 0, 'hebut@a.com');
INSERT INTO `yunzhi_admin` VALUES ('123', 'qweasd', 'asdasd', 1, 1, '2508912994@qq.com');

SET FOREIGN_KEY_CHECKS = 1;
