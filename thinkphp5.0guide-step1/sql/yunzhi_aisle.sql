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

 Date: 17/07/2021 18:26:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_aisle
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_aisle`;
CREATE TABLE `yunzhi_aisle`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `x` int(11) NOT NULL DEFAULT 0 COMMENT 'x坐标',
  `y` int(11) NOT NULL DEFAULT 0 COMMENT 'y坐标',
  `mid` int(11) NOT NULL DEFAULT 0 COMMENT '模板对应的id',
  `create_time` int(11) NOT NULL DEFAULT 0,
  `update_time` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 224 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_aisle
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
