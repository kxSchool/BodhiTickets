/*
 Navicat Premium Data Transfer

 Source Server         : www.kxschool.com
 Source Server Type    : MySQL
 Source Server Version : 50744
 Source Host           : www.kxschool.com:3306
 Source Schema         : paomi_log

 Target Server Type    : MySQL
 Target Server Version : 50744
 File Encoding         : 65001

 Date: 20/05/2024 08:14:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for log_201803
-- ----------------------------
DROP TABLE IF EXISTS `log_201803`;
CREATE TABLE `log_201803`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 147 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_201803
-- ----------------------------
INSERT INTO `log_201803` VALUES (14, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521441988);
INSERT INTO `log_201803` VALUES (13, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521195546);
INSERT INTO `log_201803` VALUES (12, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521195545);
INSERT INTO `log_201803` VALUES (11, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521193283);
INSERT INTO `log_201803` VALUES (10, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521189357);
INSERT INTO `log_201803` VALUES (9, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521186477);
INSERT INTO `log_201803` VALUES (8, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521186313);
INSERT INTO `log_201803` VALUES (15, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521445931);
INSERT INTO `log_201803` VALUES (16, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521445949);
INSERT INTO `log_201803` VALUES (17, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521447497);
INSERT INTO `log_201803` VALUES (18, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521448049);
INSERT INTO `log_201803` VALUES (19, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521448054);
INSERT INTO `log_201803` VALUES (20, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521448505);
INSERT INTO `log_201803` VALUES (21, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521448538);
INSERT INTO `log_201803` VALUES (22, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521448625);
INSERT INTO `log_201803` VALUES (23, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521448627);
INSERT INTO `log_201803` VALUES (24, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521449497);
INSERT INTO `log_201803` VALUES (25, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521449618);
INSERT INTO `log_201803` VALUES (26, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521450955);
INSERT INTO `log_201803` VALUES (27, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521450959);
INSERT INTO `log_201803` VALUES (28, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521450975);
INSERT INTO `log_201803` VALUES (29, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521450978);
INSERT INTO `log_201803` VALUES (30, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521451257);
INSERT INTO `log_201803` VALUES (31, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521451262);
INSERT INTO `log_201803` VALUES (32, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521452884);
INSERT INTO `log_201803` VALUES (33, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453069);
INSERT INTO `log_201803` VALUES (34, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453294);
INSERT INTO `log_201803` VALUES (35, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453298);
INSERT INTO `log_201803` VALUES (36, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453301);
INSERT INTO `log_201803` VALUES (37, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453540);
INSERT INTO `log_201803` VALUES (38, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453543);
INSERT INTO `log_201803` VALUES (39, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453549);
INSERT INTO `log_201803` VALUES (40, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453642);
INSERT INTO `log_201803` VALUES (41, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521453810);
INSERT INTO `log_201803` VALUES (42, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521454118);
INSERT INTO `log_201803` VALUES (43, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521454519);
INSERT INTO `log_201803` VALUES (44, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521454866);
INSERT INTO `log_201803` VALUES (45, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521455043);
INSERT INTO `log_201803` VALUES (46, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521455089);
INSERT INTO `log_201803` VALUES (47, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521455459);
INSERT INTO `log_201803` VALUES (48, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521456852);
INSERT INTO `log_201803` VALUES (49, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521457405);
INSERT INTO `log_201803` VALUES (50, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521458289);
INSERT INTO `log_201803` VALUES (51, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521458774);
INSERT INTO `log_201803` VALUES (52, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521459567);
INSERT INTO `log_201803` VALUES (53, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521459928);
INSERT INTO `log_201803` VALUES (54, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460194);
INSERT INTO `log_201803` VALUES (55, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460405);
INSERT INTO `log_201803` VALUES (56, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460729);
INSERT INTO `log_201803` VALUES (57, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460751);
INSERT INTO `log_201803` VALUES (58, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460763);
INSERT INTO `log_201803` VALUES (59, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460874);
INSERT INTO `log_201803` VALUES (60, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460882);
INSERT INTO `log_201803` VALUES (61, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460962);
INSERT INTO `log_201803` VALUES (62, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521460968);
INSERT INTO `log_201803` VALUES (63, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505731);
INSERT INTO `log_201803` VALUES (64, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505742);
INSERT INTO `log_201803` VALUES (65, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505812);
INSERT INTO `log_201803` VALUES (66, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505816);
INSERT INTO `log_201803` VALUES (67, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505846);
INSERT INTO `log_201803` VALUES (68, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505911);
INSERT INTO `log_201803` VALUES (69, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505915);
INSERT INTO `log_201803` VALUES (70, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505921);
INSERT INTO `log_201803` VALUES (71, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521505999);
INSERT INTO `log_201803` VALUES (72, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506013);
INSERT INTO `log_201803` VALUES (73, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506031);
INSERT INTO `log_201803` VALUES (74, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506047);
INSERT INTO `log_201803` VALUES (75, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506064);
INSERT INTO `log_201803` VALUES (76, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506070);
INSERT INTO `log_201803` VALUES (77, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506136);
INSERT INTO `log_201803` VALUES (78, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506144);
INSERT INTO `log_201803` VALUES (79, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506152);
INSERT INTO `log_201803` VALUES (80, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506581);
INSERT INTO `log_201803` VALUES (81, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506695);
INSERT INTO `log_201803` VALUES (82, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521506930);
INSERT INTO `log_201803` VALUES (83, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507147);
INSERT INTO `log_201803` VALUES (84, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507151);
INSERT INTO `log_201803` VALUES (85, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507174);
INSERT INTO `log_201803` VALUES (86, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507184);
INSERT INTO `log_201803` VALUES (87, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507255);
INSERT INTO `log_201803` VALUES (88, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507545);
INSERT INTO `log_201803` VALUES (89, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507589);
INSERT INTO `log_201803` VALUES (90, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507602);
INSERT INTO `log_201803` VALUES (91, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507850);
INSERT INTO `log_201803` VALUES (92, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521507897);
INSERT INTO `log_201803` VALUES (93, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521511501);
INSERT INTO `log_201803` VALUES (94, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521514887);
INSERT INTO `log_201803` VALUES (95, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521514899);
INSERT INTO `log_201803` VALUES (96, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521515339);
INSERT INTO `log_201803` VALUES (97, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521522050);
INSERT INTO `log_201803` VALUES (98, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521523619);
INSERT INTO `log_201803` VALUES (99, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521523992);
INSERT INTO `log_201803` VALUES (100, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521531084);
INSERT INTO `log_201803` VALUES (101, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521531897);
INSERT INTO `log_201803` VALUES (102, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521531989);
INSERT INTO `log_201803` VALUES (103, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521536986);
INSERT INTO `log_201803` VALUES (104, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521537004);
INSERT INTO `log_201803` VALUES (105, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521537042);
INSERT INTO `log_201803` VALUES (106, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521540649);
INSERT INTO `log_201803` VALUES (107, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521540688);
INSERT INTO `log_201803` VALUES (108, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521541310);
INSERT INTO `log_201803` VALUES (109, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521541318);
INSERT INTO `log_201803` VALUES (110, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521541584);
INSERT INTO `log_201803` VALUES (111, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521541593);
INSERT INTO `log_201803` VALUES (112, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521541729);
INSERT INTO `log_201803` VALUES (113, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521591920);
INSERT INTO `log_201803` VALUES (114, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521593222);
INSERT INTO `log_201803` VALUES (115, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521593342);
INSERT INTO `log_201803` VALUES (116, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521595822);
INSERT INTO `log_201803` VALUES (117, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521595865);
INSERT INTO `log_201803` VALUES (118, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521595885);
INSERT INTO `log_201803` VALUES (119, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521600206);
INSERT INTO `log_201803` VALUES (120, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521600562);
INSERT INTO `log_201803` VALUES (121, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521604193);
INSERT INTO `log_201803` VALUES (122, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521616653);
INSERT INTO `log_201803` VALUES (123, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521617121);
INSERT INTO `log_201803` VALUES (124, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521618495);
INSERT INTO `log_201803` VALUES (125, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521618724);
INSERT INTO `log_201803` VALUES (126, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521620352);
INSERT INTO `log_201803` VALUES (127, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521682803);
INSERT INTO `log_201803` VALUES (128, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521683956);
INSERT INTO `log_201803` VALUES (129, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521685853);
INSERT INTO `log_201803` VALUES (130, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521685871);
INSERT INTO `log_201803` VALUES (131, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521685941);
INSERT INTO `log_201803` VALUES (132, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521685952);
INSERT INTO `log_201803` VALUES (133, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521686171);
INSERT INTO `log_201803` VALUES (134, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521686175);
INSERT INTO `log_201803` VALUES (135, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521687345);
INSERT INTO `log_201803` VALUES (136, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521687496);
INSERT INTO `log_201803` VALUES (137, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521687929);
INSERT INTO `log_201803` VALUES (138, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521687941);
INSERT INTO `log_201803` VALUES (139, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1521694634);
INSERT INTO `log_201803` VALUES (140, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522130339);
INSERT INTO `log_201803` VALUES (141, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522143615);
INSERT INTO `log_201803` VALUES (142, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522200477);
INSERT INTO `log_201803` VALUES (143, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522201322);
INSERT INTO `log_201803` VALUES (144, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522201364);
INSERT INTO `log_201803` VALUES (145, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522206099);
INSERT INTO `log_201803` VALUES (146, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522206166);

-- ----------------------------
-- Table structure for log_201804
-- ----------------------------
DROP TABLE IF EXISTS `log_201804`;
CREATE TABLE `log_201804`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 123 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_201804
-- ----------------------------
INSERT INTO `log_201804` VALUES (1, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522635800);
INSERT INTO `log_201804` VALUES (2, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522635837);
INSERT INTO `log_201804` VALUES (3, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522636197);
INSERT INTO `log_201804` VALUES (4, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522636495);
INSERT INTO `log_201804` VALUES (5, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522636559);
INSERT INTO `log_201804` VALUES (6, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522637423);
INSERT INTO `log_201804` VALUES (7, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522637483);
INSERT INTO `log_201804` VALUES (8, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522663927);
INSERT INTO `log_201804` VALUES (9, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522663931);
INSERT INTO `log_201804` VALUES (10, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522663933);
INSERT INTO `log_201804` VALUES (11, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522750019);
INSERT INTO `log_201804` VALUES (12, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522750025);
INSERT INTO `log_201804` VALUES (13, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522750028);
INSERT INTO `log_201804` VALUES (14, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522812582);
INSERT INTO `log_201804` VALUES (15, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522812590);
INSERT INTO `log_201804` VALUES (16, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1522812905);
INSERT INTO `log_201804` VALUES (17, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523154580);
INSERT INTO `log_201804` VALUES (18, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523154592);
INSERT INTO `log_201804` VALUES (19, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523177734);
INSERT INTO `log_201804` VALUES (20, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523179168);
INSERT INTO `log_201804` VALUES (21, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523182146);
INSERT INTO `log_201804` VALUES (22, 1, 'map/manage', '192.168.1.5', 'admin:座位图请求', 1523326850);
INSERT INTO `log_201804` VALUES (23, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523587573);
INSERT INTO `log_201804` VALUES (24, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523614896);
INSERT INTO `log_201804` VALUES (25, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523614965);
INSERT INTO `log_201804` VALUES (26, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523615159);
INSERT INTO `log_201804` VALUES (27, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523861017);
INSERT INTO `log_201804` VALUES (28, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871351);
INSERT INTO `log_201804` VALUES (29, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871361);
INSERT INTO `log_201804` VALUES (30, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871366);
INSERT INTO `log_201804` VALUES (31, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871375);
INSERT INTO `log_201804` VALUES (32, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871456);
INSERT INTO `log_201804` VALUES (33, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871459);
INSERT INTO `log_201804` VALUES (34, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871472);
INSERT INTO `log_201804` VALUES (35, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871478);
INSERT INTO `log_201804` VALUES (36, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871654);
INSERT INTO `log_201804` VALUES (37, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871659);
INSERT INTO `log_201804` VALUES (38, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871737);
INSERT INTO `log_201804` VALUES (39, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871854);
INSERT INTO `log_201804` VALUES (40, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871891);
INSERT INTO `log_201804` VALUES (41, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871900);
INSERT INTO `log_201804` VALUES (42, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871908);
INSERT INTO `log_201804` VALUES (43, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871911);
INSERT INTO `log_201804` VALUES (44, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871917);
INSERT INTO `log_201804` VALUES (45, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523871940);
INSERT INTO `log_201804` VALUES (46, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523872764);
INSERT INTO `log_201804` VALUES (47, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523874101);
INSERT INTO `log_201804` VALUES (48, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523874753);
INSERT INTO `log_201804` VALUES (49, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523935457);
INSERT INTO `log_201804` VALUES (50, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523935691);
INSERT INTO `log_201804` VALUES (51, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523941973);
INSERT INTO `log_201804` VALUES (52, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523942083);
INSERT INTO `log_201804` VALUES (53, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523942102);
INSERT INTO `log_201804` VALUES (54, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523942132);
INSERT INTO `log_201804` VALUES (55, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523942229);
INSERT INTO `log_201804` VALUES (56, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523942840);
INSERT INTO `log_201804` VALUES (57, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523943279);
INSERT INTO `log_201804` VALUES (58, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523946665);
INSERT INTO `log_201804` VALUES (59, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523946668);
INSERT INTO `log_201804` VALUES (60, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523946854);
INSERT INTO `log_201804` VALUES (61, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947050);
INSERT INTO `log_201804` VALUES (62, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947058);
INSERT INTO `log_201804` VALUES (63, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947156);
INSERT INTO `log_201804` VALUES (64, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947412);
INSERT INTO `log_201804` VALUES (65, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947473);
INSERT INTO `log_201804` VALUES (66, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947475);
INSERT INTO `log_201804` VALUES (67, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523947481);
INSERT INTO `log_201804` VALUES (68, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948263);
INSERT INTO `log_201804` VALUES (69, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948265);
INSERT INTO `log_201804` VALUES (70, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948282);
INSERT INTO `log_201804` VALUES (71, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948745);
INSERT INTO `log_201804` VALUES (72, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948763);
INSERT INTO `log_201804` VALUES (73, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948785);
INSERT INTO `log_201804` VALUES (74, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523948992);
INSERT INTO `log_201804` VALUES (75, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949018);
INSERT INTO `log_201804` VALUES (76, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949019);
INSERT INTO `log_201804` VALUES (77, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949030);
INSERT INTO `log_201804` VALUES (78, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949118);
INSERT INTO `log_201804` VALUES (79, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949224);
INSERT INTO `log_201804` VALUES (80, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949440);
INSERT INTO `log_201804` VALUES (81, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949454);
INSERT INTO `log_201804` VALUES (82, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949465);
INSERT INTO `log_201804` VALUES (83, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949479);
INSERT INTO `log_201804` VALUES (84, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949853);
INSERT INTO `log_201804` VALUES (85, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523949863);
INSERT INTO `log_201804` VALUES (86, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523950047);
INSERT INTO `log_201804` VALUES (87, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523950170);
INSERT INTO `log_201804` VALUES (88, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523951670);
INSERT INTO `log_201804` VALUES (89, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523952370);
INSERT INTO `log_201804` VALUES (90, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523952404);
INSERT INTO `log_201804` VALUES (91, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1523960322);
INSERT INTO `log_201804` VALUES (92, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524020467);
INSERT INTO `log_201804` VALUES (93, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524020594);
INSERT INTO `log_201804` VALUES (94, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524020627);
INSERT INTO `log_201804` VALUES (95, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524023945);
INSERT INTO `log_201804` VALUES (96, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524023967);
INSERT INTO `log_201804` VALUES (97, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524027732);
INSERT INTO `log_201804` VALUES (98, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524032418);
INSERT INTO `log_201804` VALUES (99, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524034943);
INSERT INTO `log_201804` VALUES (100, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524034989);
INSERT INTO `log_201804` VALUES (101, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524035309);
INSERT INTO `log_201804` VALUES (102, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524035334);
INSERT INTO `log_201804` VALUES (103, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524035869);
INSERT INTO `log_201804` VALUES (104, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524035902);
INSERT INTO `log_201804` VALUES (105, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524035974);
INSERT INTO `log_201804` VALUES (106, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036108);
INSERT INTO `log_201804` VALUES (107, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036164);
INSERT INTO `log_201804` VALUES (108, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036223);
INSERT INTO `log_201804` VALUES (109, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036465);
INSERT INTO `log_201804` VALUES (110, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036497);
INSERT INTO `log_201804` VALUES (111, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036693);
INSERT INTO `log_201804` VALUES (112, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036733);
INSERT INTO `log_201804` VALUES (113, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524036777);
INSERT INTO `log_201804` VALUES (114, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524037421);
INSERT INTO `log_201804` VALUES (115, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524037481);
INSERT INTO `log_201804` VALUES (116, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524037517);
INSERT INTO `log_201804` VALUES (117, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524038670);
INSERT INTO `log_201804` VALUES (118, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524040297);
INSERT INTO `log_201804` VALUES (119, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524044455);
INSERT INTO `log_201804` VALUES (120, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524044472);
INSERT INTO `log_201804` VALUES (121, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524044484);
INSERT INTO `log_201804` VALUES (122, 1, 'map/manage', '192.168.1.3', 'admin:座位图请求', 1524044493);

-- ----------------------------
-- Table structure for log_201805
-- ----------------------------
DROP TABLE IF EXISTS `log_201805`;
CREATE TABLE `log_201805`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_201805
-- ----------------------------
INSERT INTO `log_201805` VALUES (1, 1, 'map/manage', '192.168.1.6', 'admin:座位图请求', 1526539747);
INSERT INTO `log_201805` VALUES (2, 1, 'map/manage', '192.168.1.6', 'admin:座位图请求', 1526539769);
INSERT INTO `log_201805` VALUES (3, 1, 'map/manage', '192.168.1.6', 'admin:座位图请求', 1526541177);
INSERT INTO `log_201805` VALUES (4, 1, 'map/manage', '192.168.1.6', 'admin:座位图请求', 1526541223);
INSERT INTO `log_201805` VALUES (5, 1, 'map/manage', '192.168.1.6', 'admin:座位图请求', 1527241181);
INSERT INTO `log_201805` VALUES (6, 1, 'map/manage', '192.168.1.6', 'admin:座位图请求', 1527241191);

-- ----------------------------
-- Table structure for log_201806
-- ----------------------------
DROP TABLE IF EXISTS `log_201806`;
CREATE TABLE `log_201806`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_201806
-- ----------------------------
INSERT INTO `log_201806` VALUES (1, 1, 'map/manage', '127.0.0.1', 'admin:座位图请求', 1529056968);

-- ----------------------------
-- Table structure for log_201903
-- ----------------------------
DROP TABLE IF EXISTS `log_201903`;
CREATE TABLE `log_201903`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_201903
-- ----------------------------
INSERT INTO `log_201903` VALUES (1, 1, 'map/manage', '124.79.29.154', 'admin:座位图请求', 1553643213);
INSERT INTO `log_201903` VALUES (2, 1, 'map/manage', '124.79.29.154', 'admin:座位图请求', 1553643432);
INSERT INTO `log_201903` VALUES (3, 1, 'map/manage', '124.79.29.154', 'admin:座位图请求', 1553643763);
INSERT INTO `log_201903` VALUES (4, 1, 'map/manage', '124.79.29.154', 'admin:座位图请求', 1553644053);
INSERT INTO `log_201903` VALUES (5, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553735774);
INSERT INTO `log_201903` VALUES (6, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553735790);
INSERT INTO `log_201903` VALUES (7, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553735813);
INSERT INTO `log_201903` VALUES (8, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553735826);
INSERT INTO `log_201903` VALUES (9, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736577);
INSERT INTO `log_201903` VALUES (10, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736592);
INSERT INTO `log_201903` VALUES (11, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736708);
INSERT INTO `log_201903` VALUES (12, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736729);
INSERT INTO `log_201903` VALUES (13, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736735);
INSERT INTO `log_201903` VALUES (14, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736740);
INSERT INTO `log_201903` VALUES (15, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736818);
INSERT INTO `log_201903` VALUES (16, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736830);
INSERT INTO `log_201903` VALUES (17, 1, 'map/manage', '114.93.83.143', 'admin:座位图请求', 1553736833);

-- ----------------------------
-- Table structure for log_201911
-- ----------------------------
DROP TABLE IF EXISTS `log_201911`;
CREATE TABLE `log_201911`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_201911
-- ----------------------------
INSERT INTO `log_201911` VALUES (1, 1, 'map/manage', '116.228.196.18', 'admin:座位图请求', 1573554752);

-- ----------------------------
-- Table structure for log_202004
-- ----------------------------
DROP TABLE IF EXISTS `log_202004`;
CREATE TABLE `log_202004`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_202004
-- ----------------------------
INSERT INTO `log_202004` VALUES (1, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587887909);
INSERT INTO `log_202004` VALUES (2, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587889420);
INSERT INTO `log_202004` VALUES (3, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587889424);
INSERT INTO `log_202004` VALUES (4, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587889479);
INSERT INTO `log_202004` VALUES (5, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587889488);
INSERT INTO `log_202004` VALUES (6, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587889491);
INSERT INTO `log_202004` VALUES (7, 1, 'map/manage', '116.234.93.203', 'admin:座位图请求', 1587889527);

-- ----------------------------
-- Table structure for log_202403
-- ----------------------------
DROP TABLE IF EXISTS `log_202403`;
CREATE TABLE `log_202403`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_202403
-- ----------------------------
INSERT INTO `log_202403` VALUES (1, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598024);
INSERT INTO `log_202403` VALUES (2, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598026);
INSERT INTO `log_202403` VALUES (3, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598097);
INSERT INTO `log_202403` VALUES (4, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598448);
INSERT INTO `log_202403` VALUES (5, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598768);
INSERT INTO `log_202403` VALUES (6, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598780);
INSERT INTO `log_202403` VALUES (7, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711598802);
INSERT INTO `log_202403` VALUES (8, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711599620);
INSERT INTO `log_202403` VALUES (9, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600730);
INSERT INTO `log_202403` VALUES (10, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600733);
INSERT INTO `log_202403` VALUES (11, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600737);
INSERT INTO `log_202403` VALUES (12, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600741);
INSERT INTO `log_202403` VALUES (13, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600743);
INSERT INTO `log_202403` VALUES (14, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600746);
INSERT INTO `log_202403` VALUES (15, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600749);
INSERT INTO `log_202403` VALUES (16, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600753);
INSERT INTO `log_202403` VALUES (17, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600756);
INSERT INTO `log_202403` VALUES (18, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600761);
INSERT INTO `log_202403` VALUES (19, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600765);
INSERT INTO `log_202403` VALUES (20, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600776);
INSERT INTO `log_202403` VALUES (21, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600785);
INSERT INTO `log_202403` VALUES (22, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600807);
INSERT INTO `log_202403` VALUES (23, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600821);
INSERT INTO `log_202403` VALUES (24, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711600827);
INSERT INTO `log_202403` VALUES (25, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711603360);
INSERT INTO `log_202403` VALUES (26, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711603394);
INSERT INTO `log_202403` VALUES (27, 1, 'map/manage', '112.2.149.89', 'admin:座位图请求', 1711603430);

-- ----------------------------
-- Table structure for log_202405
-- ----------------------------
DROP TABLE IF EXISTS `log_202405`;
CREATE TABLE `log_202405`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(6) NULL DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `remark` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `createtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_202405
-- ----------------------------
INSERT INTO `log_202405` VALUES (1, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715151235);
INSERT INTO `log_202405` VALUES (2, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715151258);
INSERT INTO `log_202405` VALUES (3, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715151265);
INSERT INTO `log_202405` VALUES (4, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715151268);
INSERT INTO `log_202405` VALUES (5, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715243552);
INSERT INTO `log_202405` VALUES (6, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715243602);
INSERT INTO `log_202405` VALUES (7, 1, 'map/manage', '223.84.179.112', 'admin:座位图请求', 1715243621);
INSERT INTO `log_202405` VALUES (8, 1, 'map/manage', '58.17.70.238', 'admin:座位图请求', 1715751586);
INSERT INTO `log_202405` VALUES (9, 1, 'map/manage', '58.17.70.238', 'admin:座位图请求', 1715751598);

SET FOREIGN_KEY_CHECKS = 1;
