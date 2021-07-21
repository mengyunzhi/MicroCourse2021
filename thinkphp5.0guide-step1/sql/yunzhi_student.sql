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

 Date: 20/07/2021 09:38:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_student
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_student`;
CREATE TABLE `yunzhi_student`  (
  `id` int unsigned NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '姓名',
  `sex` tinyint unsigned NULL COMMENT '0男，1女',
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '邮箱',
  `create_time` int unsigned NOT NULL COMMENT '创建时间',
  `update_time` int unsigned NOT NULL COMMENT '更新时间',
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '123' COMMENT '密码',
  `number` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '学号',
  `klass_id` int unsigned NULL COMMENT '所在班级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yunzhi_student
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
