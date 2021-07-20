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
INSERT INTO `yunzhi_student` VALUES (16, '张三', NULL, NULL, 'zhangsan@yunzhi.club', 0, 0, '123', '200013', 1);
INSERT INTO `yunzhi_student` VALUES (2, '小明', 0, 'xiaoming', '23456789012@qq.com', 0, 0, '123', '200002', 1);
INSERT INTO `yunzhi_student` VALUES (3, '小亮', 0, 'xiaoliang', '3456789012@qq.com', 0, 0, '123', '200004', 2);
INSERT INTO `yunzhi_student` VALUES (13, '张三1', NULL, NULL, '', 0, 0, '200050', '200050', 1);
INSERT INTO `yunzhi_student` VALUES (14, '李四1', NULL, NULL, '', 0, 0, '200051', '200051', 1);
INSERT INTO `yunzhi_student` VALUES (17, '张三', NULL, NULL, '1@yunzhi.com', 0, 0, '123', '200000', 6);
INSERT INTO `yunzhi_student` VALUES (18, '李四', NULL, NULL, '2@yunzhi.com', 0, 0, '123', '200001', 6);
INSERT INTO `yunzhi_student` VALUES (12, '李四', NULL, NULL, 'zhangsan@yunzhi.club', 0, 0, '123', '123456', 1);

SET FOREIGN_KEY_CHECKS = 1;
