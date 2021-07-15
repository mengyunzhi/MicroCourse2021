/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : tp1

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 15/07/2021 10:08:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_aisle
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_aisle`;
CREATE TABLE `yunzhi_aisle`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `x` int(255) NOT NULL COMMENT 'x坐标',
  `y` int(255) NOT NULL COMMENT 'y坐标',
  `mid` int(255) NOT NULL COMMENT '模板对应的id',
  `create_time` int(255) NOT NULL DEFAULT 0,
  `update_time` int(255) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_aisle
-- ----------------------------
INSERT INTO `yunzhi_aisle` VALUES (1, 1, 4, 1, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (2, 2, 4, 1, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
