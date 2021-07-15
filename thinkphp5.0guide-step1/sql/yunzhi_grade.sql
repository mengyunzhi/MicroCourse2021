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

 Date: 15/07/2021 20:54:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_grade
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_grade`;
CREATE TABLE `yunzhi_grade`  (
  `id` int unsigned NOT NULL,
  `performance` int(0) NOT NULL COMMENT '平时成绩',
  `test` int(0) NOT NULL COMMENT '期末成绩',
  `course_id` int(0) NOT NULL COMMENT '所属课程',
  `student_id` int(0) NOT NULL COMMENT '所属学生',
  `create_time` int(0) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(0) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
