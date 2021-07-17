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

 Date: 17/07/2021 18:27:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_room
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_room`;
CREATE TABLE `yunzhi_room`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `num` int(0) NOT NULL DEFAULT 0 COMMENT '容量',
  `mid` int(0) NOT NULL DEFAULT 0 COMMENT '对应模板id',
  `is_occupy` int(0) NOT NULL DEFAULT 0 COMMENT '是否被占用',
  `create_time` int(0) NOT NULL DEFAULT 0,
  `update_time` int(0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_room
-- ----------------------------
INSERT INTO `yunzhi_room` VALUES (5, 'A202', 12, 104, 0, 0, 0);
INSERT INTO `yunzhi_room` VALUES (7, 'A203', 21, 105, 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
