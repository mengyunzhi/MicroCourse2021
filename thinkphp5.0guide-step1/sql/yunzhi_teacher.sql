/*
 Navicat Premium Data Transfer

 Source Server         : tp1
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : tp1

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 17/07/2021 10:10:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_teacher
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_teacher`;
CREATE TABLE `yunzhi_teacher`  (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '姓名',
  `number` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '工号',
  `sex` tinyint(3) UNSIGNED NOT NULL COMMENT '0男，1女',
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '123' COMMENT '密码',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_teacher
-- ----------------------------
INSERT INTO `yunzhi_teacher` VALUES (0, 'q', '0', 0, '2@da.com', '123', 0, 0, 'qwe');

SET FOREIGN_KEY_CHECKS = 1;
