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

<<<<<<< HEAD
 Date: 17/07/2021 17:32:57
=======
 Date: 17/07/2021 18:27:31
>>>>>>> origin
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_mould
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_mould`;
CREATE TABLE `yunzhi_mould`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板名字',
  `num` int(0) NOT NULL DEFAULT 0 COMMENT '模板容量',
  `row` int(0) NOT NULL DEFAULT 0 COMMENT '行数',
  `line` int(0) NOT NULL DEFAULT 0 COMMENT '列数',
  `create_time` int(0) NOT NULL DEFAULT 0,
  `update_time` int(0) NOT NULL DEFAULT 0,
  `is_first` int(0) NOT NULL COMMENT '第一个模板',
  `is_last` int(0) NOT NULL COMMENT '最后一个模板',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_mould
-- ----------------------------
INSERT INTO `yunzhi_mould` VALUES (101, 'D教学楼', 8, 5, 5, 0, 0, 1, 0);
INSERT INTO `yunzhi_mould` VALUES (104, 'B教学楼', 12, 3, 4, 0, 0, 0, 0);
INSERT INTO `yunzhi_mould` VALUES (105, 'C教学楼', 21, 4, 5, 0, 0, 0, 0);
INSERT INTO `yunzhi_mould` VALUES (108, 'D教学楼', 16, 5, 5, 0, 0, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
