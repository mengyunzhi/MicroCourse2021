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

 Date: 17/07/2021 16:14:49
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
) ENGINE = InnoDB AUTO_INCREMENT = 2628 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yunzhi_seat
-- ----------------------------
INSERT INTO `yunzhi_seat` VALUES (57, 2, 1, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (58, 1, 1, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (64, 2, 5, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (115, 1, 2, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (125, 2, 2, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2242, 2, 3, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2243, 2, 4, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2244, 1, 5, 1, 0, NULL);
INSERT INTO `yunzhi_seat` VALUES (2245, 1, 3, 1, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2498, 1, 1, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2499, 1, 2, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2500, 1, 3, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2502, 1, 5, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2503, 2, 1, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2504, 2, 2, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2505, 2, 3, 100, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2507, 2, 5, 100, 0, 0);
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
INSERT INTO `yunzhi_seat` VALUES (2533, 1, 1, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2534, 1, 2, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2535, 1, 3, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2536, 1, 4, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2537, 1, 5, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2538, 2, 1, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2542, 2, 5, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2543, 3, 1, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2547, 3, 5, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2548, 4, 1, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2552, 4, 5, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2553, 5, 1, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2554, 5, 2, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2555, 5, 3, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2556, 5, 4, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2557, 5, 5, 102, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2558, 1, 1, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2559, 1, 2, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2560, 1, 3, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2562, 1, 5, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2563, 2, 1, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2564, 2, 2, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2565, 2, 3, 103, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2567, 2, 5, 103, 0, 0);
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
INSERT INTO `yunzhi_seat` VALUES (2601, 1, 1, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2602, 1, 2, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2603, 1, 3, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2604, 1, 4, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2605, 1, 5, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2606, 2, 1, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2607, 2, 2, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2608, 2, 3, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2609, 2, 4, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2610, 2, 5, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2611, 3, 1, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2612, 3, 2, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2613, 3, 3, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2614, 3, 4, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2615, 3, 5, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2616, 4, 1, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2617, 4, 2, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2618, 4, 3, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2619, 4, 4, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2620, 4, 5, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2621, 5, 1, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2622, 5, 2, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2623, 5, 3, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2624, 5, 4, 106, 0, 0);
INSERT INTO `yunzhi_seat` VALUES (2625, 5, 5, 106, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
