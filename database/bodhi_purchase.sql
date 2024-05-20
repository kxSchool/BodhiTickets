/*
 Navicat Premium Data Transfer

 Source Server         : www.kxschool.com
 Source Server Type    : MySQL
 Source Server Version : 50744
 Source Host           : www.kxschool.com:3306
 Source Schema         : paomi_purchase

 Target Server Type    : MySQL
 Target Server Version : 50744
 File Encoding         : 65001

 Date: 20/05/2024 08:14:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for inquriy_quotation_relation
-- ----------------------------
DROP TABLE IF EXISTS `inquriy_quotation_relation`;
CREATE TABLE `inquriy_quotation_relation`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '寻报价关系id',
  `inquirycode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '询价单编号',
  `shoperid` int(11) NOT NULL DEFAULT 0 COMMENT '商家id',
  `staffid` int(11) NOT NULL DEFAULT 0 COMMENT '职员id',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '询价单状态{1:待报价,2:已报价,3:无需报价}',
  `addtime` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `offertime` int(11) NOT NULL DEFAULT 0 COMMENT '报价时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '询价单报价单关系表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inquriy_quotation_relation
-- ----------------------------
INSERT INTO `inquriy_quotation_relation` VALUES (13, '107110114533773', 66, 66, 1, 1509519217, 0);
INSERT INTO `inquriy_quotation_relation` VALUES (14, '107110115511181', 11, 66, 1, 1509522671, 0);
INSERT INTO `inquriy_quotation_relation` VALUES (15, '107110115511181', 66, 105, 2, 1509522671, 1509530150);
INSERT INTO `inquriy_quotation_relation` VALUES (16, '107110115583435', 66, 105, 1, 1509523114, 0);
INSERT INTO `inquriy_quotation_relation` VALUES (17, '107110115583435', 105, 145, 1, 1509523114, 0);
INSERT INTO `inquriy_quotation_relation` VALUES (18, '107110218525433', 11, 66, 2, 1509619974, 0);
INSERT INTO `inquriy_quotation_relation` VALUES (19, '107110218525433', 66, 105, 2, 1509619974, 1509620017);

-- ----------------------------
-- Table structure for new_inquiry
-- ----------------------------
DROP TABLE IF EXISTS `new_inquiry`;
CREATE TABLE `new_inquiry`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '询价单id',
  `inquirycode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '询价单编号',
  `batchcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '批次(号)编码',
  `quotation_batchcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '成功竞价号(报价单里面的批次号)',
  `vincode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件VIN码',
  `carmodel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '已选车型数据',
  `oecode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件OE码',
  `partname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件名称',
  `number` smallint(5) UNSIGNED NOT NULL DEFAULT 1 COMMENT '配件数量',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '买家留言',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '询价单状态{1:待报价,2:已报价,3:已作废,4:待处理:5:已超时(24小时)}',
  `addtime` int(11) NOT NULL DEFAULT 0 COMMENT '询价时间',
  `partquality` tinyint(1) NOT NULL DEFAULT 1 COMMENT '配件品质要求(1:原厂原装,2:同质配件,3:品牌件,9:末指定则默认为原厂原装)',
  `staff_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作客服id',
  `memeberid` int(11) NOT NULL DEFAULT 0 COMMENT '买家id',
  `shoppingaddressid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收货地址id',
  `brandname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '品牌或者厂商信息',
  `sourcefrom` smallint(2) NOT NULL DEFAULT 1 COMMENT '询价单来源:1:自主询单,2:待客询单',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 270 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '询价单' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of new_inquiry
-- ----------------------------
INSERT INTO `new_inquiry` VALUES (264, '107110114533773', '20171101145337_QHWLd3sY_901758', '', '65432568412354036', '大众 大众帕萨特1.8T', '461465658845', '都是肥肉和', 33, '说个话建议看', 1, 1509519217, 1, 152, 65, 56, '大众', 2);
INSERT INTO `new_inquiry` VALUES (265, '107110114533773', '20171101145337_QHWLd3sY_901758', '', '65432568412354036', '大众 大众帕萨特1.8T', '', '东风添加', 12, '的身份和竟然与快乐', 1, 1509519217, 3, 152, 65, 56, '大众', 2);
INSERT INTO `new_inquiry` VALUES (266, '107110115511181', '20171101155111_VYqCAyWY_515218', '', '', '宝马xxx5', '35675456756', '梵蒂冈和', 2, '梵蒂冈好看', 4, 1509522671, 2, 152, 71, 57, '宝马', 2);
INSERT INTO `new_inquiry` VALUES (267, '107110115511181', '20171101155111_VYqCAyWY_515218', '', '', '宝马xxx5', '', '的方式格瑞特看', 3, '', 4, 1509522671, 1, 152, 71, 57, '宝马', 2);
INSERT INTO `new_inquiry` VALUES (268, '107110115583435', '20171101155834_or1NFyc5_375448', '', '', '别克 别的444ujn丰田', '435657653423', '发生过好还让他', 3, '这个地方感觉他', 1, 1509523114, 3, 152, 73, 58, '别克', 2);
INSERT INTO `new_inquiry` VALUES (269, '107110218525433', '20171102185254_qL4uMD9d_789349', '20171102185337_FD2m235o_057795', '', '宝马 博鳌吗非法个人', '', '发生过好', 1, '个人条件, ', 2, 1509619974, 1, 152, 65, 60, '宝马', 2);

-- ----------------------------
-- Table structure for new_quotation
-- ----------------------------
DROP TABLE IF EXISTS `new_quotation`;
CREATE TABLE `new_quotation`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '报价单id',
  `batchcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '报价批次号',
  `iqrid` int(11) NOT NULL DEFAULT 0 COMMENT '竞价id',
  `inquiry_batchcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '询价id',
  `shopid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '卖家id',
  `staff_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作客服id',
  `vincode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件VIN码',
  `carmodel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '已选车型数据',
  `partid` int(11) NOT NULL DEFAULT 0 COMMENT '询价单配件id',
  `partname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件名称',
  `partquality` tinyint(1) NOT NULL DEFAULT 1 COMMENT '配件品质要求(1:原厂原装,2:同质配件,3:品牌件,9:末指定则默认为原厂原装)',
  `number` smallint(5) UNSIGNED NOT NULL DEFAULT 1 COMMENT '配件数量',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '买家留言',
  `oecode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件OE码',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '询价单状态{1:待报价,2:已报价,3:重新报价}',
  `addtime` int(11) NOT NULL DEFAULT 0 COMMENT '询价时间',
  `free_type` tinyint(2) NOT NULL DEFAULT 1 COMMENT '运输方式{1:专线,2:普通物流,3:摩的,4:快递,5:其他}',
  `free_price` decimal(11, 2) NOT NULL,
  `stock_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '库存类型{1:现货,2:订货}',
  `order_day` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订货周期，单位天',
  `partprice` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品价格',
  `partbrand` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配件品牌',
  `shippingdetail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '货运信息',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 270 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '报价单' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of new_quotation
-- ----------------------------
INSERT INTO `new_quotation` VALUES (1, '', 0, '', 15, 15, '12345678900987654', '大众 上汽大众 POLO 2014 1.4 手自一体 舒适版', 0, '前大灯', 1, 1, '', '', 2, 1503650010, 2, 90.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (2, '', 0, '', 15, 15, '12345678900987654', '大众 上汽大众 POLO 2014 1.4 手自一体 舒适版', 0, '后大灯', 3, 1, '很好', '', 2, 1503650010, 2, 90.00, 2, 2, 0.00, '帝宝', '');
INSERT INTO `new_quotation` VALUES (3, '', 0, '', 14, 14, '12345678901234567', '大众 上汽大众 高尔 2003 1.6 手动 两门基本版', 0, '前保险杠', 1, 1, '', '', 2, 1503653775, 2, 60.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (4, '', 0, '', 2, 2, '', '本田 东风本田 CR-V 2013 2.0 自动 Exi四驱经典版', 0, '中网', 3, 1, '好的', 'oe1', 2, 1503887621, 1, 100.00, 2, 2, 0.00, '有名牌', '');
INSERT INTO `new_quotation` VALUES (5, '', 0, '', 2, 2, '', '本田 东风本田 CR-V 2013 2.0 自动 Exi四驱经典版', 0, '前保', 2, 1, '', 'oe2', 2, 1503887621, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (6, '', 0, '', 2, 2, 'ADS45678901234567', '本田 东风本田 艾力绅 2015 2.4 自动 VTi 豪华版', 0, '中网标', 1, 1, '', '1234567890', 2, 1503888233, 1, 100.00, 1, 0, 0.00, '1323', '');
INSERT INTO `new_quotation` VALUES (7, '', 0, '20170828184417_0000000219_pacotj', 12, 12, '', '奥迪  一汽大众(奥迪)  Q3  2016年1.4TFSI 双离合 30TFSI 典藏版 舒享型', 0, '左前门', 1, 1, '', '', 2, 1504159370, 2, 63.00, 1, 0, 0.00, 'gfbbn', '');
INSERT INTO `new_quotation` VALUES (8, '', 0, '20170828184417_0000000219_pacotj', 12, 12, '', '奥迪  一汽大众(奥迪)  Q3  2016年1.4TFSI 双离合 30TFSI 典藏版 舒享型', 0, '前大灯', 1, 1, '', '', 2, 1504159799, 4, 15.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (9, '', 0, '', 23, 23, '12345678901234567', 'akld jslkjflks jfdlsj', 0, '前大灯', 3, 1, '', '', 2, 1503976022, 1, 10.00, 1, 0, 0.00, 'aaaa', '');
INSERT INTO `new_quotation` VALUES (10, '', 0, '', 23, 23, '12345678901234567', 'akld jslkjflks jfdlsj', 0, '前大灯', 1, 1, '', '', 2, 1503976022, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (11, '', 0, '', 23, 23, '12345678901234567', 'akld jslkjflks jfdlsj', 0, '前大灯', 3, 1, '', '', 2, 1503976022, 1, 10.00, 2, 2, 0.00, 'bbbb', '');
INSERT INTO `new_quotation` VALUES (12, '', 0, '', 23, 23, '12345678901234567', 'akld jslkjflks jfdlsj', 0, '后大灯', 1, 1, '', '', 2, 1503976022, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (13, '', 0, '', 12, 12, '', '奥迪 奥迪(进口) A5 2014 Coupe 2.0TFSI 无级 45TFSI 风尚版', 0, 'nvjfnj', 1, 12, '', '', 2, 1504062925, 2, 39.00, 2, 9, 0.00, 'cjdnjcnjd', '');
INSERT INTO `new_quotation` VALUES (14, '', 0, '', 22, 22, 'abcdefg1234567898', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前大灯', 1, 1, '', '', 2, 1504076580, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (15, '', 0, '', 23, 23, 'abcdefg1234567898', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前大灯', 1, 1, '', '', 2, 1504076408, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (16, '', 0, '20170830152645_0000000219_erecat', 23, 23, '', '别克  上汽通用别克  昂科拉  2016年1.4T 手动 18T 两驱都市进取型', 0, '后保险杠', 1, 1, '', '', 2, 1504078142, 1, 15.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (17, '', 0, '20170830152645_0000000219_erecat', 20, 20, '', '别克  上汽通用别克  昂科拉  2016年1.4T 手动 18T 两驱都市进取型', 0, '后保险杠', 1, 1, '', '', 2, 1504078068, 1, 5.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (18, '', 0, '', 21, 21, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '前大灯', 1, 1, '', 'qweqe345', 2, 1504079525, 1, 15.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (19, '', 0, '', 22, 22, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2015 1.5T 双离合 20T 两驱精英型', 0, '前大灯', 1, 1, '', 'qweqe345', 2, 1504079371, 1, 10.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (20, '', 0, '', 21, 21, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '前大灯', 2, 1, '', 'qweqe345', 2, 1504079525, 1, 15.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (21, '', 0, '', 23, 23, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '前大灯', 1, 1, '', 'qweqe345', 2, 1504079272, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (22, '', 0, '', 21, 21, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '左后视镜', 1, 1, '', '', 2, 1504079525, 1, 15.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (23, '', 0, '', 23, 23, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '左后视镜', 1, 1, '', '', 2, 1504079272, 1, 10.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (24, '', 0, '', 22, 22, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2015 1.5T 双离合 20T 两驱精英型', 0, '左后视镜', 1, 1, '', '', 2, 1504079371, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (25, '', 0, '', 22, 22, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2015 1.5T 双离合 20T 两驱精英型', 0, '后保险杠', 1, 1, '', '', 2, 1504079371, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (26, '', 0, '', 21, 21, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '后保险杠', 1, 1, '', '', 2, 1504079525, 1, 15.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (27, '', 0, '', 23, 23, 'zaqwsxe1234567890', '别克 上汽通用别克 昂科威 2016 1.5T 双离合 20T 两驱领先型', 0, '后保险杠', 1, 1, '', '', 2, 1504079272, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (28, '', 0, '', 21, 21, '', '别克 上汽通用别克 昂科拉 2015 1.4T 手动 两驱都市进取型', 0, '前档风玻璃', 1, 1, '', '', 2, 1504169725, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (29, '', 0, '20170831095321_0000000219_qkwycb', 21, 21, '', '别克  上汽通用别克  昂科拉  2016年1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 3, 1, '', '', 2, 1504169664, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (30, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (31, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前保', 1, 1, '', 'oe', 2, 1504161981, 2, 50.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (32, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (33, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (34, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前保险杠', 3, 1, '', 'oe-123-test-001', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (35, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前保', 1, 1, '', 'oe', 2, 1504161981, 1, 100.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (36, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (37, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (38, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (39, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前保险杠', 3, 1, '', 'oe-123-test-001', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (40, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (41, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (42, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保险杠', 1, 1, '', 'oe-123-test-001', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (43, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保电眼', 1, 3, '', 'oe-123-test-002', 2, 1504160678, 2, 80.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (44, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保电眼', 1, 3, '', 'oe-123-test-002', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (45, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前保电眼', 1, 3, '', '', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (46, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保电眼', 3, 3, '', 'oe-123-test-002', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (47, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保电眼', 1, 3, '', 'oe-123-test-002', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (48, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保电眼', 3, 3, '', 'oe-123-test-002', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (49, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保电眼', 1, 3, '', 'oe-123-test-002', 2, 1504160678, 1, 100.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (50, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前保电眼', 1, 3, '', '', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (51, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保电眼', 1, 3, '', 'oe-123-test-002', 2, 1504160678, 3, 200.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (52, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前保电眼', 1, 3, '', 'oe-123-test-002', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (53, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前保电眼', 3, 3, '', 'oe-123-test-002', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (54, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '中网', 3, 1, '', '', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (55, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '中网', 3, 1, '', '', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (56, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '中网', 3, 1, '', '', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (57, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '中网', 3, 1, '', '', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (58, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '中网', 3, 1, '', '', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (59, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '中网', 3, 1, '', '', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (60, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '中网', 3, 1, '', '', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (61, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '中网', 3, 1, '', '', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (62, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '中网标', 1, 1, '', '', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (63, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '中网标', 1, 1, '', '', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (64, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '中网标', 1, 1, '', '', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (65, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '中网标', 1, 1, '', '', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (66, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '中网标', 1, 1, '', '', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (67, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '中网标', 1, 1, '', '', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (68, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '中网标', 1, 1, '', '', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (69, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '中网标', 1, 1, '', '', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (70, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '进气格珊', 1, 1, '', '', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (71, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '进气格珊', 3, 1, '', '', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (72, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '进气格珊', 1, 1, '', '', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (73, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '进气格珊', 3, 1, '', '', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (74, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '进气格珊', 1, 1, '', '', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (75, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '进气格珊', 1, 1, '', '', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (76, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '进气格珊', 3, 1, '', '', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (77, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '进气格珊', 1, 1, '', '', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (78, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '水箱框架', 1, 1, '', '', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (79, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '水箱框架', 1, 1, '', '', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (80, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '水箱框架', 1, 1, '', '', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (81, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '水箱框架', 1, 1, '', '', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (82, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '水箱框架', 1, 1, '', '', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (83, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '水箱框架', 1, 1, '', '', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (84, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '水箱框架', 1, 1, '', '', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (85, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '水箱框架', 1, 1, '', '', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (86, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前大灯（左）', 1, 1, '', '', 2, 1504159615, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (87, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前大灯（左）', 1, 1, '', '', 2, 1504161981, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (88, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前大灯（左）', 1, 1, '', '', 2, 1504160678, 2, 80.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (89, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前大灯（左）', 1, 1, '', '', 2, 1504159615, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (90, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前大灯（左）', 1, 1, '', '', 2, 1504160678, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (91, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市时尚型', 0, '前大灯（左）', 1, 1, '', '', 2, 1504159615, 3, 300.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (92, '', 0, '', 22, 22, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱精英版', 0, '前大灯（左）', 1, 1, '', '', 2, 1504161981, 2, 50.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (93, '', 0, '', 21, 21, '12345678901234567', '别克 别克(进口) 昂科雷 2013 3.6 手自一体 四驱旗舰版', 0, '前大灯（左）', 1, 1, '', '', 2, 1504160678, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (94, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保', 1, 1, '', 'sf23432432', 2, 1504168751, 2, 10.00, 1, 0, 0.00, '3M', '');
INSERT INTO `new_quotation` VALUES (95, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保', 1, 1, '', 'sf23432432', 2, 1504168751, 4, 10.00, 1, 0, 0.00, '3M', '');
INSERT INTO `new_quotation` VALUES (96, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保', 1, 1, '', 'sf23432432', 2, 1504168751, 1, 20.00, 1, 0, 0.00, '3M', '');
INSERT INTO `new_quotation` VALUES (97, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保', 1, 1, '', 'sf23432432', 2, 1504168751, 3, 100.00, 1, 0, 0.00, '3M', '');
INSERT INTO `new_quotation` VALUES (98, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '11000-5846', 2, 1504168751, 2, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (99, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '11000-5846', 2, 1504168751, 4, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (100, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '11000-5846', 2, 1504168751, 1, 20.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (101, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '11000-5846', 2, 1504168751, 3, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (102, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '引擎盖', 3, 1, '', '110565-12sdf', 2, 1504168751, 3, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (103, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '引擎盖', 3, 1, '', '110565-12sdf', 2, 1504168751, 2, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (104, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '引擎盖', 3, 1, '', '110565-12sdf', 2, 1504168751, 4, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (105, '', 0, '', 20, 20, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '引擎盖', 3, 1, '', '110565-12sdf', 2, 1504168751, 1, 20.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (106, '', 0, '', 20, 20, '', '别克 上汽通用别克 昂科拉 2013 1.4T 手自一体 GS 四驱全能旗舰型', 0, '后保', 1, 1, '', '', 2, 1504168789, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (107, '', 0, '', 21, 21, '', '别克 上汽通用别克 昂科拉 2013 1.4T 手自一体 GS 四驱全能旗舰型', 0, '后保', 1, 1, '', 'test-001', 2, 1504169476, 1, 10.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (108, '', 0, '', 21, 21, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市领先型', 0, '配件1', 1, 1, '', '', 2, 1504169848, 2, 20.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (109, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 1, 1, '', '1222222', 2, 1504173319, 1, 100.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (110, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 1, 1, '', '1222222', 2, 1504173319, 3, 200.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (111, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 2, 1, '', '111111', 2, 1504173319, 2, 20.00, 1, 0, 0.00, '夺', '');
INSERT INTO `new_quotation` VALUES (112, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 1, 1, '', '1222222', 2, 1504173319, 2, 20.00, 2, 2, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (113, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 2, 1, '', '111111', 2, 1504173319, 1, 100.00, 1, 0, 0.00, '夺', '');
INSERT INTO `new_quotation` VALUES (114, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '前保险杠', 2, 1, '', '111111', 2, 1504173319, 3, 200.00, 1, 0, 0.00, '夺', '');
INSERT INTO `new_quotation` VALUES (115, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '', 2, 1504173319, 2, 20.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (116, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '', 2, 1504173319, 1, 100.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (117, '', 0, '', 22, 22, '12345678901234567', '别克 上汽通用别克 昂科拉 2016 1.4T 手自一体 18T 两驱都市精英型', 0, '中网', 1, 1, '', '', 2, 1504173319, 3, 200.00, 1, 0, 0.00, '', '');
INSERT INTO `new_quotation` VALUES (118, '2017092115085_00000003_aaaa1111', 3, '2017092115085_00000003_hvybks66', 65, 153, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 4, '前保险杠', 1, 1, '', 'oe-test-001', 2, 1504251150, 1, 80.00, 1, 0, 12.00, '', '');
INSERT INTO `new_quotation` VALUES (119, '2017092115085_00000003_aaaa1112', 4, '2017092115085_00000003_hvybks66', 66, 152, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 4, '前保险杠', 1, 1, '', 'oe-test-001', 2, 1504251150, 3, 200.00, 1, 0, 11.00, '', '');
INSERT INTO `new_quotation` VALUES (120, '2017092115085_00000003_aaaa1113', 5, '2017092115085_00000003_hvybks66', 67, 154, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 4, '前保险杠', 1, 1, '', 'oe-test-001', 2, 1504251150, 2, 40.00, 1, 0, 22.00, '', '');
INSERT INTO `new_quotation` VALUES (121, '2017092115085_00000003_aaaa1111', 3, '2017092115085_00000003_hvybks66', 65, 153, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 5, '中网', 3, 1, '烤漆', '', 2, 1504251150, 2, 40.00, 1, 0, 11.00, '义海嘉诚', '');
INSERT INTO `new_quotation` VALUES (122, '2017092115085_00000003_aaaa1112', 4, '2017092115085_00000003_hvybks66', 66, 152, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 5, '中网', 1, 1, '', '', 2, 1504251150, 2, 40.00, 2, 2, 22.00, '', '');
INSERT INTO `new_quotation` VALUES (123, '2017092115085_00000003_aaaa1113', 5, '2017092115085_00000003_hvybks66', 67, 154, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 5, '中网', 3, 1, '烤漆', '', 2, 1504251150, 1, 80.00, 1, 0, 22.00, '义海嘉诚', '');
INSERT INTO `new_quotation` VALUES (124, '2017092115085_00000003_aaaa1111', 3, '2017092115085_00000003_hvybks66', 65, 153, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 5, '中网', 3, 1, '烤漆', '', 2, 1504251150, 3, 200.00, 1, 0, 11.00, '义海嘉诚', '');
INSERT INTO `new_quotation` VALUES (125, '2017092115085_00000003_aaaa1112', 4, '2017092115085_00000003_hvybks66', 66, 152, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 5, '中网', 1, 1, '', '', 2, 1504251150, 1, 80.00, 2, 2, 22.00, '', '');
INSERT INTO `new_quotation` VALUES (126, '2017092115085_00000003_aaaa1113', 5, '2017092115085_00000003_hvybks66', 67, 154, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 5, '中网', 1, 1, '', '', 2, 1504251150, 3, 200.00, 2, 2, 12.00, '', '');
INSERT INTO `new_quotation` VALUES (127, '2017092115085_00000003_aaaa1111', 3, '2017092115085_00000003_hvybks66', 65, 153, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 6, '引擎盖', 3, 1, '', '', 2, 1504251150, 1, 80.00, 1, 0, 22.00, '', '');
INSERT INTO `new_quotation` VALUES (128, '2017092115085_00000003_aaaa1112', 4, '2017092115085_00000003_hvybks66', 66, 152, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 6, '引擎盖', 3, 1, '', '', 2, 1504251150, 3, 200.00, 1, 0, 11.00, '', '');
INSERT INTO `new_quotation` VALUES (129, '2017092115085_00000003_aaaa1113', 5, '2017092115085_00000003_hvybks66', 67, 154, '12345678901234567', '别克 上汽通用别克 GL8 2015 2.4 手自一体 尊享版[豪华商务车]', 6, '引擎盖', 3, 1, '', '', 2, 1504251150, 2, 40.00, 1, 0, 22.00, '', '');
INSERT INTO `new_quotation` VALUES (256, '20171031171109_mTtp3eFm_930289', 0, '2017092115085_10000003_hvybks65', 431, 152, '12345678901234567', '别克 上汽通用别克 君威 2015 2.0 手自一体 精英时尚型', 11, '前保', 1, 1, 'dsfg', '34456765', 2, 1509441069, 1, 0.00, 1, 0, 457.00, '地方附近', '{\"1\":\"66\",\"2\":\"55\",\"3\":\"65\",\"4\":\"77\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (257, '20171031171109_mTtp3eFm_930289', 0, '2017092115085_10000003_hvybks65', 431, 152, '12345678901234567', '别克 上汽通用别克 君威 2015 2.0 手自一体 精英时尚型', 12, '中网', 2, 1, '回家看了', '11000-5846', 2, 1509441069, 1, 0.00, 1, 0, 235.00, '返回键', '{\"1\":\"66\",\"2\":\"55\",\"3\":\"65\",\"4\":\"77\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (258, '20171031171109_mTtp3eFm_930289', 0, '2017092115085_10000003_hvybks65', 431, 152, '12345678901234567', '别克 上汽通用别克 君威 2015 2.0 手自一体 精英时尚型', 12, '中网', 1, 1, 'uilkkjj', '11000-5846', 2, 1509441069, 1, 0.00, 2, 3, 456.00, '二货就赶快', '{\"1\":\"66\",\"2\":\"55\",\"3\":\"65\",\"4\":\"77\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (259, '20171031171109_mTtp3eFm_930289', 0, '2017092115085_10000003_hvybks65', 431, 152, '12345678901234567', '别克 上汽通用别克 君威 2015 2.0 手自一体 精英时尚型', 13, '引擎盖', 3, 1, '大富大贵话题的', '110565-12sdf', 2, 1509441069, 1, 0.00, 1, 0, 435.00, '多风格', '{\"1\":\"66\",\"2\":\"55\",\"3\":\"65\",\"4\":\"77\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (260, '20171101112810_vFLN9HkR_000848', 0, '20171101112611_RPZUQtPL_421484', 65, 152, '98657485964563214', '博纳动态二电厂', 261, '东方文化他已经将', 1, 5, '第三方合同苦苦', '34567898765', 2, 1509506890, 1, 0.00, 1, 0, 3434.00, '多风格就', '{\"1\":\"34\",\"2\":\"34\",\"3\":\"34\",\"4\":\"34\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (267, '20171101175550_WFgybZKn_123398', 15, '20171101155111_VYqCAyWY_515218', 71, 152, '62145832674512658', '宝马xxx5', 266, '梵蒂冈和', 1, 2, '', '35675456756', 2, 1509530150, 1, 0.00, 1, 0, 744.00, '对方是个好', '{\"1\":\"66\",\"2\":\"55\",\"3\":\"77\",\"4\":\"88\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (268, '20171101175550_WFgybZKn_123398', 15, '20171101155111_VYqCAyWY_515218', 71, 152, '62145832674512658', '宝马xxx5', 267, '的方式格瑞特看', 3, 3, '然后看', '', 2, 1509530150, 1, 0.00, 2, 3, 564.00, '', '{\"1\":\"66\",\"2\":\"55\",\"3\":\"77\",\"4\":\"88\",\"5\":\"\"}');
INSERT INTO `new_quotation` VALUES (269, '20171102185337_FD2m235o_057795', 19, '20171102185254_qL4uMD9d_789349', 65, 152, '', '宝马 博鳌吗非法个人', 269, '发生过好', 1, 1, '烦的很反感接口', '3445676875', 2, 1509620017, 1, 0.00, 2, 4, 678.00, '分和他们共和国', '{\"1\":\"44\",\"2\":\"55\",\"3\":\"44\",\"4\":\"55\",\"5\":\"\"}');

-- ----------------------------
-- Table structure for q_i_relation
-- ----------------------------
DROP TABLE IF EXISTS `q_i_relation`;
CREATE TABLE `q_i_relation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `q_shop_id` int(11) NOT NULL DEFAULT 0 COMMENT '供货商id',
  `s_shop_id` int(11) NOT NULL DEFAULT 0 COMMENT '供货商客服',
  `brandname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作品牌',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '供货商品牌对应关系表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of q_i_relation
-- ----------------------------
INSERT INTO `q_i_relation` VALUES (1, 105, 145, '别克');
INSERT INTO `q_i_relation` VALUES (2, 105, 146, '别克');
INSERT INTO `q_i_relation` VALUES (3, 66, 105, '宝马');
INSERT INTO `q_i_relation` VALUES (4, 11, 66, '宝马');
INSERT INTO `q_i_relation` VALUES (5, 66, 105, '别克');
INSERT INTO `q_i_relation` VALUES (6, 66, 66, '大众');

SET FOREIGN_KEY_CHECKS = 1;
