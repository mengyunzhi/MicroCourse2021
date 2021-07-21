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

 Date: 21/07/2021 11:09:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_mould
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_mould`;
CREATE TABLE `yunzhi_mould`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板名字',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '模板容量',
  `row` int(255) NOT NULL DEFAULT 0 COMMENT '行数',
  `line` int(255) NOT NULL DEFAULT 0 COMMENT '列数',
  `create_time` int(255) NOT NULL DEFAULT 0,
  `update_time` int(255) NOT NULL DEFAULT 0,
  `is_first` int(255) NOT NULL COMMENT '第一个模板',
  `is_last` int(255) NOT NULL COMMENT '最后一个模板',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
