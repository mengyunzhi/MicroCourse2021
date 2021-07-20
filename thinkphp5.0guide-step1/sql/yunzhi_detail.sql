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

 Date: 20/07/2021 09:40:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_detail
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_detail`;
CREATE TABLE `yunzhi_detail`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `klass_course_id` int(0) NULL DEFAULT NULL,
  `student_id` int(0) NULL DEFAULT NULL,
  `seat_id` int(0) NULL DEFAULT NULL,
  `create_time` int(0) NOT NULL,
  `update_time` int(0) NOT NULL,
  `room_id` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yunzhi_detail
-- ----------------------------
INSERT INTO `yunzhi_detail` VALUES (1, 97, 13, 2575, 0, 0, 5);

SET FOREIGN_KEY_CHECKS = 1;
