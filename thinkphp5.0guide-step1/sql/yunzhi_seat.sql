/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : tp1

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 17/07/2021 17:35:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_seat
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_seat`;
CREATE TABLE `yunzhi_seat`  (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `x` int(255) NOT NULL COMMENT 'x坐标',
  `y` int(255) NOT NULL COMMENT 'y坐标',
  `mid` int(255) NULL DEFAULT NULL COMMENT '对应的模板id',
  `create_time` int(255) NULL DEFAULT 0,
  `update_time` int(255) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2678 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_seat
-- ----------------------------
INSERT INTO `yunzhi_seat` VALUES (2508, 1, 1, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2509, 1, 2, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2510, 1, 3, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2511, 1, 4, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2512, 1, 5, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2513, 2, 1, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2517, 2, 5, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2518, 3, 1, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2522, 3, 5, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2523, 4, 1, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2527, 4, 5, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2528, 5, 1, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2529, 5, 2, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2530, 5, 3, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2531, 5, 4, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2532, 5, 5, 101, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2568, 1, 1, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2569, 1, 2, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2570, 1, 3, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2571, 1, 4, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2572, 2, 1, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2575, 2, 4, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2576, 3, 1, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2577, 3, 2, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2578, 3, 3, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2579, 3, 4, 104, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2580, 1, 1, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2581, 1, 2, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2582, 1, 3, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2583, 1, 4, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2584, 1, 5, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2585, 2, 1, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2589, 2, 5, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2590, 3, 1, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2594, 3, 5, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2595, 4, 1, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2596, 4, 2, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2597, 4, 3, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2598, 4, 4, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2599, 4, 5, 105, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2628, 1, 1, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2629, 1, 2, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2630, 1, 3, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2631, 1, 4, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2632, 1, 5, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2633, 2, 1, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2634, 2, 2, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2635, 2, 3, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2636, 2, 4, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2637, 2, 5, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2638, 3, 1, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2639, 3, 2, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2640, 3, 3, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2641, 3, 4, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2642, 3, 5, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2643, 4, 1, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2644, 4, 2, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2645, 4, 3, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2646, 4, 4, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2647, 4, 5, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2648, 5, 1, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2649, 5, 2, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2650, 5, 3, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2651, 5, 4, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2652, 5, 5, 107, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2653, 1, 1, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2654, 1, 2, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2655, 1, 3, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2656, 1, 4, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2657, 1, 5, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2658, 2, 1, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2662, 2, 5, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2663, 3, 1, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2667, 3, 5, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2668, 4, 1, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2672, 4, 5, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2673, 5, 1, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2674, 5, 2, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2675, 5, 3, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2676, 5, 4, 108, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2677, 5, 5, 108, 0, 0);
