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

 Date: 20/07/2021 09:43:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_course
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_course`;
CREATE TABLE `yunzhi_course`  (
  `id` int unsigned NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `term_id` int(0) NOT NULL,
  `teacher_id` int(0) NOT NULL,
  `create_time` int(0) NOT NULL DEFAULT 0,
  `update_time` int(0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yunzhi_course
-- ----------------------------
INSERT INTO `yunzhi_course` VALUES (9, '英语', 0, 1, 0, 0);
INSERT INTO `yunzhi_course` VALUES (2, '大学物理', 2, 1, 0, 0);
INSERT INTO `yunzhi_course` VALUES (7, '高数', 0, 1, 0, 0);
INSERT INTO `yunzhi_course` VALUES (10, '离散', 0, 1, 0, 0);
INSERT INTO `yunzhi_course` VALUES (12, '高数', 0, 2, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
