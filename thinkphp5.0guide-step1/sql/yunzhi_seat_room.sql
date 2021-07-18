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

 Date: 18/07/2021 16:26:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yunzhi_seat_room
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_seat_room`;
CREATE TABLE `yunzhi_seat_room`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '座位id',
  `x` int(0) NOT NULL,
  `y` int(0) NOT NULL,
  `mid` int(0) NOT NULL DEFAULT 0,
  `room_id` int(0) NOT NULL DEFAULT 0,
  `create_time` int(0) NOT NULL DEFAULT 0,
  `update_time` int(0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yunzhi_seat_room
-- ----------------------------
INSERT INTO `yunzhi_seat_room` VALUES (2498, 1, 1, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2499, 1, 2, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2500, 1, 3, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2502, 1, 5, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2503, 2, 1, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2504, 2, 2, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2505, 2, 3, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2507, 2, 5, 100, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2508, 1, 1, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2509, 1, 2, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2510, 1, 3, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2511, 1, 4, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2512, 1, 5, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2513, 2, 1, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2517, 2, 5, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2518, 3, 1, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2522, 3, 5, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2523, 4, 1, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2527, 4, 5, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2528, 5, 1, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2529, 5, 2, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2530, 5, 3, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2533, 1, 1, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2534, 1, 2, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2535, 1, 3, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2536, 1, 4, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2537, 1, 5, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2538, 2, 1, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2542, 2, 5, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2543, 3, 1, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2547, 3, 5, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2548, 4, 1, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2552, 4, 5, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2553, 5, 1, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2554, 5, 2, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2555, 5, 3, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2556, 5, 4, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2557, 5, 5, 102, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2558, 1, 1, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2559, 1, 2, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2560, 1, 3, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2562, 1, 5, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2563, 2, 1, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2564, 2, 2, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2568, 1, 1, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2569, 1, 2, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2570, 1, 3, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2571, 1, 4, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2572, 2, 1, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2575, 2, 4, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2576, 3, 1, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2577, 3, 2, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2580, 1, 1, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2581, 1, 2, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2582, 1, 3, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2583, 1, 4, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2584, 1, 5, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2585, 2, 1, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2589, 2, 5, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2590, 3, 1, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2594, 3, 5, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2595, 4, 1, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2596, 4, 2, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2597, 4, 3, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2598, 4, 4, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2599, 4, 5, 105, 7, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2601, 1, 1, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2602, 1, 2, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2603, 1, 3, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2604, 1, 4, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2605, 1, 5, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2606, 2, 1, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2607, 2, 2, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2608, 2, 3, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2609, 2, 4, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2610, 2, 5, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2611, 3, 1, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2612, 3, 2, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2613, 3, 3, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2614, 3, 4, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2615, 3, 5, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2616, 4, 1, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2617, 4, 2, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2618, 4, 3, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2619, 4, 4, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2620, 4, 5, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2621, 5, 1, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2622, 5, 2, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2623, 5, 3, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2624, 5, 4, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2625, 5, 5, 106, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2629, 5, 5, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2630, 5, 4, 101, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2631, 2, 5, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2632, 2, 3, 103, 0, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2633, 3, 4, 104, 5, 0, 0);
INSERT INTO `yunzhi_seat_room` VALUES (2634, 3, 3, 104, 5, 0, 0);
