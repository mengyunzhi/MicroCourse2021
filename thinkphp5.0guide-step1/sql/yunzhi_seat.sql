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

 Date: 15/07/2021 09:52:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_seat
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_seat`;
CREATE TABLE `yunzhi_seat`  (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `x` int(255) NOT NULL COMMENT 'x坐标',
  `y` int(255) NOT NULL COMMENT 'y坐标',
  `mid` int(255) NULL DEFAULT NULL COMMENT '对应的模板id',
  `create_time` int(255) NULL DEFAULT 0,
  `update_time` int(255) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_seat
-- ----------------------------
INSERT INTO `yunzhi_seat` VALUES (1, 1, 1, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2, 1, 2, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (3, 1, 3, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (4, 1, 5, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (5, 2, 1, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (6, 2, 2, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (7, 2, 3, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (8, 2, 4, 1, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
