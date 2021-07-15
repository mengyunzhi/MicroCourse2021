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

 Date: 14/07/2021 21:27:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_klass
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_klass`;
CREATE TABLE `yunzhi_klass`  (
  `id` int unsigned NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `size` int unsigned NULL COMMENT '班级人数',
  `create_time` int unsigned NOT NULL,
  `update_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
