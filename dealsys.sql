/*
 Navicat Premium Data Transfer

 Source Server         : koprasiwanitausahamandiri.com
 Source Server Type    : MySQL
 Source Server Version : 100221
 Source Host           : 83.136.216.91:3306
 Source Schema         : u6018530_dealsys

 Target Server Type    : MySQL
 Target Server Version : 100221
 File Encoding         : 65001

 Date: 29/04/2019 17:57:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mastercustomer
-- ----------------------------
DROP TABLE IF EXISTS `mastercustomer`;
CREATE TABLE `mastercustomer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noktp` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kodepos` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tempatlahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgllahir` date NOT NULL,
  `notlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `notlp2` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jnskelamin` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nokk` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mastercustomer
-- ----------------------------
INSERT INTO `mastercustomer` VALUES (1, '12345678', 'JL. PADALARANG DS. PASIR HALANG KP. CIKARANG MULYA RT 3 RW 5', '57135', 'Surakarta - Kota', '2019-02-20', '123456', NULL, NULL, NULL, '', 'admin', '2019-02-22 00:00:00.000000', 'Adi Sebastiano');
INSERT INTO `mastercustomer` VALUES (3, '67871923879', 'Jln Wonogiri No.019,', '123123', 'Surakarta - Kota', '2019-02-23', '081', NULL, NULL, NULL, '', 'admin', '2019-02-23 00:00:00.000000', 'Francisco');
INSERT INTO `mastercustomer` VALUES (4, '3311902938400201', 'Jln Solo-Wonogiri no 18', '57571', 'wonogiri', '1990-11-22', '081234688778', NULL, NULL, NULL, '', 'admin', '2019-04-01 00:00:00.000000', 'Singgih Nurcahyanto');

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglnota` date NULL DEFAULT NULL,
  `tglterima` date NULL DEFAULT NULL,
  `vendorid` int(11) NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pembelian
-- ----------------------------
INSERT INTO `pembelian` VALUES (1, 'NT001', '2019-02-20', '2019-02-20', 1, 'admin', '2019-02-20 00:00:00.000000');
INSERT INTO `pembelian` VALUES (2, 'NT001', '2019-02-22', '2019-02-22', 1, 'admin', '2019-02-22 00:00:00.000000');

-- ----------------------------
-- Table structure for pembeliandetail
-- ----------------------------
DROP TABLE IF EXISTS `pembeliandetail`;
CREATE TABLE `pembeliandetail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pembelianid` int(11) NULL DEFAULT NULL,
  `stockid` int(11) NULL DEFAULT NULL,
  `qtybeli` int(11) NULL DEFAULT NULL,
  `hrgbeli` decimal(19, 2) NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pembeliandetail
-- ----------------------------
INSERT INTO `pembeliandetail` VALUES (1, 1, 1, 2, 123123.00, 'admin', '2019-02-20 00:00:00.000000');
INSERT INTO `pembeliandetail` VALUES (3, 2, 1, 2, 124124.00, 'admin', '2019-02-22 00:00:00.000000');
INSERT INTO `pembeliandetail` VALUES (4, 2, 1, 2, 124124.00, 'admin', '2019-02-22 00:00:00.000000');
INSERT INTO `pembeliandetail` VALUES (5, 2, 1, 2, 124124.00, 'admin', '2019-02-22 00:00:00.000000');
INSERT INTO `pembeliandetail` VALUES (6, 2, 1, 2, 124124.00, 'admin', '2019-02-22 00:00:00.000000');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NULL DEFAULT NULL,
  `nonota` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglnota` datetime(6) NULL DEFAULT NULL,
  `alamatkirim` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tempo` int(11) NULL DEFAULT NULL COMMENT 'dalam bulan',
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  `tgljatuhtempo` date NULL DEFAULT NULL,
  `jenistrx` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES (1, 1, 'NT0001', '2019-04-01 00:00:00.000000', 'sementara', 12, 'admin', '2019-04-01 00:00:00.000000', '2020-04-01', 'K');
INSERT INTO `penjualan` VALUES (2, 1, 'NT0002', '2019-04-01 00:00:00.000000', 'sementara', 12, 'admin', '2019-04-01 00:00:00.000000', '2020-04-01', 'K');
INSERT INTO `penjualan` VALUES (3, 3, 'NT0003', '2019-04-01 00:00:00.000000', 'sementara', 35, 'admin', '2019-04-01 00:00:00.000000', '2022-03-01', 'K');
INSERT INTO `penjualan` VALUES (4, 1, 'NT0004', '2019-04-01 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 36, 'admin', '2019-04-01 00:00:00.000000', '2022-04-01', 'K');
INSERT INTO `penjualan` VALUES (5, 4, 'NT0005', '2019-04-01 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 36, 'admin', '2019-04-01 00:00:00.000000', '2022-04-01', 'K');
INSERT INTO `penjualan` VALUES (6, 4, 'NT0006', '2019-04-01 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 35, 'admin', '2019-04-01 00:00:00.000000', '2022-03-01', 'K');
INSERT INTO `penjualan` VALUES (7, 1, 'NT0007', '2019-04-01 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 35, 'admin', '2019-04-01 00:00:00.000000', '2022-03-01', 'K');
INSERT INTO `penjualan` VALUES (8, 1, 'NT0008', '2019-04-01 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 35, 'admin', '2019-04-01 00:00:00.000000', '2022-03-01', 'K');
INSERT INTO `penjualan` VALUES (9, 3, 'NT0009', '2019-04-01 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 30, 'admin', '2019-04-01 00:00:00.000000', '2021-10-01', 'K');
INSERT INTO `penjualan` VALUES (10, 4, 'NT00010', '2019-04-02 00:00:00.000000', 'Jln Solo-Wonogiri no 18', 36, 'admin', '2019-04-02 00:00:00.000000', '2022-04-02', 'K');

-- ----------------------------
-- Table structure for penjualandetail
-- ----------------------------
DROP TABLE IF EXISTS `penjualandetail`;
CREATE TABLE `penjualandetail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penjualanid` int(11) NULL DEFAULT NULL,
  `stockid` int(11) NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `hrgotr` decimal(19, 2) NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of penjualandetail
-- ----------------------------
INSERT INTO `penjualandetail` VALUES (1, 1, 1, 1, 17000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (2, 2, 1, 1, 17000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (3, 3, 1, 1, 25000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (4, 4, 1, 1, 27950000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (5, 5, 2, 1, 27950000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (6, 6, 1, 1, 20000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (7, 7, 1, 1, 20000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (8, 8, 2, 1, 30000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (9, 9, 1, 1, 19000000.00, 'admin', '2019-04-01 00:00:00.000000');
INSERT INTO `penjualandetail` VALUES (10, 10, 2, 1, 26000000.00, 'admin', '2019-04-02 00:00:00.000000');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` int(11) NOT NULL,
  `permissionname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ico` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (0, 'Master Customer', '#', 'icon-comment');
INSERT INTO `permission` VALUES (1, 'Tambah Stock', 'pbview.php', 'icon-pencil');
INSERT INTO `permission` VALUES (2, 'Nota Penjualan', 'pjview.php', 'icon-shopping-cart');
INSERT INTO `permission` VALUES (3, 'Angsuran', 'ptgview.php', 'icon-money');
INSERT INTO `permission` VALUES (4, 'Master Barang', 'stockview.php', 'icon-plus-sign');
INSERT INTO `permission` VALUES (6, 'User', 'userview.php', 'icon-user-md');
INSERT INTO `permission` VALUES (7, 'Laporan Penjualan', 'laporanpenjualanview.php', 'icon-bar-chart');
INSERT INTO `permission` VALUES (8, 'Laporan Angsuran', 'laporanpiutangview.php', 'icon-credit-card');
INSERT INTO `permission` VALUES (9, 'Master Customer', 'custview.php', 'icon-comment');

-- ----------------------------
-- Table structure for permission_copy1
-- ----------------------------
DROP TABLE IF EXISTS `permission_copy1`;
CREATE TABLE `permission_copy1`  (
  `id` int(11) NOT NULL,
  `permissionname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ico` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permission_copy1
-- ----------------------------
INSERT INTO `permission_copy1` VALUES (0, 'Master Customer', '#', 'icon-comment');
INSERT INTO `permission_copy1` VALUES (1, 'Nota Pembelian', 'pbview.php', 'icon-pencil');
INSERT INTO `permission_copy1` VALUES (2, 'Nota Penjualan', 'pjview.php', 'icon-shopping-cart');
INSERT INTO `permission_copy1` VALUES (3, 'Angsuran', 'ptgview.php', 'icon-money');
INSERT INTO `permission_copy1` VALUES (4, 'Master Stock', 'stockview.php', 'icon-plus-sign');
INSERT INTO `permission_copy1` VALUES (5, 'Master Vendor', 'vendorview.php', 'icon-flag');
INSERT INTO `permission_copy1` VALUES (6, 'User', 'userview.php', 'icon-user-md');
INSERT INTO `permission_copy1` VALUES (7, 'Laporan Penjualan', 'laporanpenjualanview.php', 'icon-bar-chart');
INSERT INTO `permission_copy1` VALUES (8, 'Laporan Angsuran', 'laporanpiutangview.php', 'icon-credit-card');
INSERT INTO `permission_copy1` VALUES (9, 'Master Customer', 'custview.php', 'icon-comment');

-- ----------------------------
-- Table structure for permissionrole
-- ----------------------------
DROP TABLE IF EXISTS `permissionrole`;
CREATE TABLE `permissionrole`  (
  `roleid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissionrole
-- ----------------------------
INSERT INTO `permissionrole` VALUES (1, 1);
INSERT INTO `permissionrole` VALUES (1, 2);
INSERT INTO `permissionrole` VALUES (1, 3);
INSERT INTO `permissionrole` VALUES (1, 4);
INSERT INTO `permissionrole` VALUES (1, 5);
INSERT INTO `permissionrole` VALUES (1, 6);
INSERT INTO `permissionrole` VALUES (1, 7);
INSERT INTO `permissionrole` VALUES (1, 8);
INSERT INTO `permissionrole` VALUES (2, 3);
INSERT INTO `permissionrole` VALUES (2, 8);
INSERT INTO `permissionrole` VALUES (3, 1);
INSERT INTO `permissionrole` VALUES (3, 4);
INSERT INTO `permissionrole` VALUES (3, 5);
INSERT INTO `permissionrole` VALUES (4, 2);
INSERT INTO `permissionrole` VALUES (4, 7);
INSERT INTO `permissionrole` VALUES (1, 9);
INSERT INTO `permissionrole` VALUES (4, 9);

-- ----------------------------
-- Table structure for piutang
-- ----------------------------
DROP TABLE IF EXISTS `piutang`;
CREATE TABLE `piutang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NULL DEFAULT NULL,
  `debet` decimal(19, 2) NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  `penjualanid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of piutang
-- ----------------------------
INSERT INTO `piutang` VALUES (1, 1, 17000000.00, 'admin', '2019-04-01 00:00:00.000000', 1);
INSERT INTO `piutang` VALUES (2, 1, 17000000.00, 'admin', '2019-04-01 00:00:00.000000', 2);
INSERT INTO `piutang` VALUES (3, 3, 25000000.00, 'admin', '2019-04-01 00:00:00.000000', 3);
INSERT INTO `piutang` VALUES (4, 1, 27950000.00, 'admin', '2019-04-01 00:00:00.000000', 4);
INSERT INTO `piutang` VALUES (5, 4, 27950000.00, 'admin', '2019-04-01 00:00:00.000000', 5);
INSERT INTO `piutang` VALUES (6, 4, 20000000.00, 'admin', '2019-04-01 00:00:00.000000', 6);
INSERT INTO `piutang` VALUES (7, 1, 20000000.00, 'admin', '2019-04-01 00:00:00.000000', 7);
INSERT INTO `piutang` VALUES (8, 1, 30000000.00, 'admin', '2019-04-01 00:00:00.000000', 8);
INSERT INTO `piutang` VALUES (9, 3, 19000000.00, 'admin', '2019-04-01 00:00:00.000000', 9);
INSERT INTO `piutang` VALUES (10, 4, 26000000.00, 'admin', '2019-04-02 00:00:00.000000', 10);

-- ----------------------------
-- Table structure for piutangdetail
-- ----------------------------
DROP TABLE IF EXISTS `piutangdetail`;
CREATE TABLE `piutangdetail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `piutangid` int(11) NULL DEFAULT NULL,
  `kredit` decimal(19, 2) NULL DEFAULT NULL,
  `tgljatuhtempo` date NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  `src` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `denda` decimal(19, 2) NULL DEFAULT NULL,
  `tgltrx` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of piutangdetail
-- ----------------------------
INSERT INTO `piutangdetail` VALUES (1, 1, 2000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (2, 2, 2000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (8, 3, 5000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (9, 1, 1550000.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (10, 3, 971429.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (11, 3, 1117143.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (12, 2, 1550000.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (13, 2, 1550000.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (14, 2, 1343333.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (15, 2, 1136667.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (16, 1, 1550000.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (17, 4, 4800000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (18, 5, 4800000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (19, 4, 1335389.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (20, 4, 1335389.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (21, 4, 1335389.00, '2019-06-01', '', '2020-06-02 00:00:00.000000', 'KAS', 6677.00, '2020-06-02');
INSERT INTO `piutangdetail` VALUES (22, 4, 23943833.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (23, 6, 4000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (24, 5, 1335389.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (25, 5, 1335389.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (26, 6, 971429.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (27, 7, 4000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (29, 6, 971429.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (30, 7, 971429.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (31, 7, 971429.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (32, 7, 971429.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (33, 7, 777143.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (34, 8, 5000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (35, 8, 1214286.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (36, 8, 1214286.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (37, 8, 1214286.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (38, 8, 1214286.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (39, 8, 1214286.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (40, 9, 2000000.00, '2019-04-01', 'admin', '2019-04-01 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (41, 9, 906667.00, '2019-05-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (42, 9, 906667.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (43, 9, 906667.00, '2019-06-01', '', '2019-04-01 00:00:00.000000', 'KAS', 0.00, '2019-04-01');
INSERT INTO `piutangdetail` VALUES (44, 9, 906667.00, '2019-06-01', '', '2019-04-02 00:00:00.000000', 'KAS', 0.00, '2019-04-02');
INSERT INTO `piutangdetail` VALUES (45, 1, 1550000.00, '2019-06-01', '', '2019-04-02 00:00:00.000000', 'KAS', 0.00, '2019-04-02');
INSERT INTO `piutangdetail` VALUES (46, 10, 6000000.00, '2019-04-02', 'admin', '2019-04-02 00:00:00.000000', 'DP', NULL, NULL);
INSERT INTO `piutangdetail` VALUES (47, 10, 955556.00, '2019-05-02', '', '2019-04-02 00:00:00.000000', 'KAS', 0.00, '2019-04-02');
INSERT INTO `piutangdetail` VALUES (48, 10, 955556.00, '2019-06-02', '', '2019-04-02 00:00:00.000000', 'KAS', 0.00, '2019-04-02');
INSERT INTO `piutangdetail` VALUES (49, 10, 955556.00, '2019-06-02', '', '2019-04-02 00:00:00.000000', 'KAS', 0.00, '2019-04-02');
INSERT INTO `piutangdetail` VALUES (50, 1, 1550000.00, '2019-06-01', '', '2019-04-29 00:00:00.000000', 'KAS', 0.00, '2019-04-29');
INSERT INTO `piutangdetail` VALUES (51, 10, 955556.00, '2019-06-02', '', '2019-04-29 00:00:00.000000', 'KAS', 0.00, '2019-04-29');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL,
  `rolename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'manager');
INSERT INTO `roles` VALUES (2, 'piutang');
INSERT INTO `roles` VALUES (3, 'pembelian');
INSERT INTO `roles` VALUES (4, 'penjualan');

-- ----------------------------
-- Table structure for stok
-- ----------------------------
DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namabarang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `warna` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomesin` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `norangka` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qtystok` int(11) NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of stok
-- ----------------------------
INSERT INTO `stok` VALUES (1, 'N-MAX', 'BLACK', 'MS-01029102', 'MR-PAO19339', '2017', NULL, 'admin', '2019-02-16 00:00:00.000000');
INSERT INTO `stok` VALUES (2, 'VIXION', 'MERAH', 'MR0122231', 'MR-PAC018223', '2018', NULL, 'admin', '2019-04-01 00:00:00.000000');

-- ----------------------------
-- Table structure for tabelstok
-- ----------------------------
DROP TABLE IF EXISTS `tabelstok`;
CREATE TABLE `tabelstok`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notransaksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgltransaksi` date NULL DEFAULT NULL,
  `barangid` int(11) NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `hrgbrg` decimal(19, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tabelstok
-- ----------------------------
INSERT INTO `tabelstok` VALUES (1, 'NT0005', '2019-04-01', 1, 10, 0.00);
INSERT INTO `tabelstok` VALUES (2, 'NT0004', '2019-04-01', 2, 15, 0.00);

-- ----------------------------
-- Table structure for userrole
-- ----------------------------
DROP TABLE IF EXISTS `userrole`;
CREATE TABLE `userrole`  (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userrole
-- ----------------------------
INSERT INTO `userrole` VALUES (5, 1);
INSERT INTO `userrole` VALUES (7, 4);
INSERT INTO `userrole` VALUES (9, 4);
INSERT INTO `userrole` VALUES (10, 1);
INSERT INTO `userrole` VALUES (11, 1);
INSERT INTO `userrole` VALUES (12, 1);
INSERT INTO `userrole` VALUES (13, 1);
INSERT INTO `userrole` VALUES (14, 3);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(99) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (5, 'admin', 'Prasetyo Aji Wibowo', '0192023a7bbd73250516f069df18b500', 'System', '2019-02-15 00:00:00.000000');
INSERT INTO `users` VALUES (6, 'piut01', 'piutang', '0192023a7bbd73250516f069df18b500', 'System', '2019-02-15 00:00:00.000000');
INSERT INTO `users` VALUES (7, 'PJL01', 'penjualan', '0192023a7bbd73250516f069df18b500', 'System', '2019-02-15 00:00:00.000000');
INSERT INTO `users` VALUES (8, 'PJL01', 'Penjualan', '0192023a7bbd73250516f069df18b500', 'System', '2019-02-15 00:00:00.000000');
INSERT INTO `users` VALUES (9, 'PJL02', 'Penjualan 2', '0192023a7bbd73250516f069df18b500', 'System', '2019-02-16 00:00:00.000000');
INSERT INTO `users` VALUES (10, 'admin2', 'admin2', '0192023a7bbd73250516f069df18b500', 'System', '2019-02-16 00:00:00.000000');
INSERT INTO `users` VALUES (11, 'admin3', 'asd', '21232f297a57a5a743894a0e4a801fc3', 'System', '2019-02-16 00:00:00.000000');
INSERT INTO `users` VALUES (12, 'admin5', 'asd', '21232f297a57a5a743894a0e4a801fc3', 'System', '2019-02-16 00:00:00.000000');
INSERT INTO `users` VALUES (13, 'adming', 'sadasd', '21232f297a57a5a743894a0e4a801fc3', 'System', '2019-02-16 00:00:00.000000');
INSERT INTO `users` VALUES (14, 'stok', 'stok', '47f7fa8ae602858dc064642059932fe1', 'System', '2019-04-01 00:00:00.000000');

-- ----------------------------
-- Table structure for vendor
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodevendor` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namavendor` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamatvendor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `notlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of vendor
-- ----------------------------
INSERT INTO `vendor` VALUES (1, 'VD-001', 'YAMAHA', 'JL. RAYA CILEBUT, BOJONG GEDE NO. 03', '021', 'admin', '2019-02-16 00:00:00.000000');
INSERT INTO `vendor` VALUES (2, 'VD-002', 'ASM', 'solo', '123', 'admin', '2019-02-21 00:00:00.000000');

SET FOREIGN_KEY_CHECKS = 1;
