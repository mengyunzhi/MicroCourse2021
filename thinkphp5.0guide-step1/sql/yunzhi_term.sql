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

 Date: 17/07/2021 18:28:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_term
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_term`;
CREATE TABLE `yunzhi_term`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `start_time` int(0) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `end_time` int(0) NOT NULL DEFAULT 0 COMMENT '结束时间',
  `effect` int(0) NOT NULL DEFAULT 0 COMMENT '0已生效 1未生效',
  `create_time` int(0) NULL DEFAULT 0,
  `update_time` int(0) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_term
-- ----------------------------
INSERT INTO `yunzhi_term` VALUES (13, '2021年春期学期', 1612540800, 1628092800, 0, 0, 0);
INSERT INTO `yunzhi_term` VALUES (49, '2021年春期学期', 1625673600, 1625760000, 1, 0, 0);
INSERT INTO `yunzhi_term` VALUES (52, '2021年春期学期', 1627056000, 1627488000, 0, 0, 0);
INSERT INTO `yunzhi_term` VALUES (55, '2021年春期学期', 1626192000, 1627488000, 0, 0, 0);
INSERT INTO `yunzhi_term` VALUES (58, '2021年春期学期', 1625155200, 1626796800, 0, 0, 0);
INSERT INTO `yunzhi_term` VALUES (59, '2021年春期学期', 1625673600, 1626796800, 0, 0, 0);
INSERT INTO `yunzhi_term` VALUES (61, '2021年秋期学期', 1627056000, 1625760000, 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
