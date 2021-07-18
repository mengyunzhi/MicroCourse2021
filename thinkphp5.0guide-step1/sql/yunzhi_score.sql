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

 Date: 17/07/2021 18:27:46
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
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
