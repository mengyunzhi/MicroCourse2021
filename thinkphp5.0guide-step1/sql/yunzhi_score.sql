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

 Date: 20/07/2021 09:39:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_score
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_score`;
CREATE TABLE `yunzhi_score`  (
  `id` int unsigned NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '姓名',
  `create_time` int unsigned NOT NULL COMMENT '创建时间',
  `update_time` int unsigned NOT NULL COMMENT '更新时间',
  `student_id` int(0) NULL DEFAULT NULL COMMENT '学生id',
  `course_id` int(0) NULL DEFAULT NULL COMMENT '课程id',
  `usual_score` double(11, 0) NULL DEFAULT NULL COMMENT '平时成绩',
  `exam_score` double(11, 0) NULL DEFAULT NULL COMMENT '考试成绩',
  `sum_score` double(11, 0) NULL DEFAULT NULL COMMENT '总成绩',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yunzhi_score
-- ----------------------------
INSERT INTO `yunzhi_score` VALUES (12, '', 0, 0, 11, 7, 40, 50, 90);
INSERT INTO `yunzhi_score` VALUES (19, '', 0, 0, 13, 12, 0, 0, 0);
INSERT INTO `yunzhi_score` VALUES (13, '', 0, 0, 14, 7, 30, 40, 70);
INSERT INTO `yunzhi_score` VALUES (18, '', 0, 0, 16, 10, 0, 0, 0);
INSERT INTO `yunzhi_score` VALUES (17, '', 0, 0, 16, 9, 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
