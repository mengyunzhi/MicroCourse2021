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

 Date: 17/07/2021 18:27:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_klass_course
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_klass_course`;
CREATE TABLE `yunzhi_klass_course`  (
  `id` int unsigned NOT NULL,
  `klass_id` int unsigned NOT NULL,
  `course_id` int unsigned NOT NULL,
  `create_time` int unsigned NOT NULL,
  `update_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 82 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of yunzhi_klass_course
-- ----------------------------
INSERT INTO `yunzhi_klass_course` VALUES (2, 1, 2, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (1, 1, 1, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (3, 2, 1, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
