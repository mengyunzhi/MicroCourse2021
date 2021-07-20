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

 Date: 20/07/2021 09:42:47
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
) ENGINE = MyISAM AUTO_INCREMENT = 108 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of yunzhi_klass_course
-- ----------------------------
INSERT INTO `yunzhi_klass_course` VALUES (107, 4, 9, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (106, 3, 9, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (83, 2, 0, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (84, 7, 0, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (85, 5, 0, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (105, 2, 9, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (104, 1, 9, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (92, 1, 10, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (93, 2, 10, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (99, 3, 12, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (98, 2, 12, 0, 0);
INSERT INTO `yunzhi_klass_course` VALUES (97, 1, 12, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
