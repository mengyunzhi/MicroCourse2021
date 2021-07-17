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

 Date: 17/07/2021 16:12:25
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
) ENGINE = InnoDB AUTO_INCREMENT = 224 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_aisle
-- ----------------------------
INSERT INTO `yunzhi_aisle` VALUES (192, 2, 4, 100, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (193, 2, 2, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (194, 3, 2, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (195, 4, 2, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (196, 4, 3, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (199, 2, 4, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (200, 3, 4, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (201, 4, 4, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (202, 2, 4, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (203, 2, 3, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (204, 2, 2, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (205, 3, 2, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (206, 3, 3, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (207, 3, 4, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (208, 4, 4, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (209, 4, 3, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (210, 4, 2, 102, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (211, 1, 4, 103, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (212, 2, 4, 103, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (213, 2, 3, 104, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (214, 2, 2, 104, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (215, 2, 3, 105, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (216, 2, 2, 105, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (217, 2, 4, 105, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (218, 3, 4, 105, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (219, 3, 3, 105, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (220, 3, 2, 105, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (221, 1, 4, 100, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (222, 3, 3, 101, 0, 0);
INSERT INTO `yunzhi_aisle` VALUES (223, 2, 3, 101, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
