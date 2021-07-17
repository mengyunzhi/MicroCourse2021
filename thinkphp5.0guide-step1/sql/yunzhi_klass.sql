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

 Date: 17/07/2021 18:26:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_klass
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_klass`;
CREATE TABLE `yunzhi_klass`  (
  `id` int unsigned NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `student_number` int unsigned NULL COMMENT '班级人数',
  `create_time` int unsigned NOT NULL,
  `update_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yunzhi_klass
-- ----------------------------
INSERT INTO `yunzhi_klass` VALUES (1, '1班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (2, '2班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (3, '3班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (4, '4班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (7, '7班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (5, '5班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (6, '6班', NULL, 0, 0);
INSERT INTO `yunzhi_klass` VALUES (34, '8班', NULL, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
