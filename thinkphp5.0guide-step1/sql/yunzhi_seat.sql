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

 Date: 19/07/2021 10:10:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_seat
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_seat`;
CREATE TABLE `yunzhi_seat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `x` int(11) NOT NULL DEFAULT 0 COMMENT 'x坐标',
  `y` int(11) NOT NULL DEFAULT 0 COMMENT 'y坐标',
  `mid` int(11) NULL DEFAULT NULL COMMENT '对应的模板id',
  `create_time` int(111) NULL DEFAULT 0,
  `update_time` int(111) NULL DEFAULT 0,
  `is_seated` int(1) NOT NULL COMMENT 'x坐标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_seat
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
