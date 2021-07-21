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

 Date: 20/07/2021 09:41:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_room
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_room`;
CREATE TABLE `yunzhi_room`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '容量',
  `mid` int(11) NOT NULL DEFAULT 0 COMMENT '对应模板id',
  `course_id` int(11) NOT NULL DEFAULT 0 COMMENT '对应模板id',
  `is_occupy` int(1) NOT NULL DEFAULT 0 COMMENT '是否被占用',
  `create_time` int(11) NOT NULL DEFAULT 0,
  `update_time` int(11) NOT NULL DEFAULT 0,
  `begin_time` int(11) NULL DEFAULT NULL,
  `out_time` int(11) NULL DEFAULT NULL,
  `sign_time` int(11) NULL DEFAULT NULL,
  `sign_begin_time` int(11) NULL DEFAULT NULL,
  `sign_out_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_room
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
