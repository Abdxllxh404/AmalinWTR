-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 04:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amalin_wtr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc`
--

CREATE TABLE `tbl_acc` (
  `id_acc` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `fname_acc` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `lname_acc` varchar(50) NOT NULL COMMENT 'นามสกุล',
  `email_acc` varchar(100) NOT NULL COMMENT 'อีเมลล์',
  `pass_acc` varchar(255) NOT NULL COMMENT 'รหัสผ่านบัญชี',
  `tel_acc` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `id_addr` varchar(255) DEFAULT NULL COMMENT 'รหัสที่อยู่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_acc`
--

INSERT INTO `tbl_acc` (`id_acc`, `fname_acc`, `lname_acc`, `email_acc`, `pass_acc`, `tel_acc`, `id_addr`) VALUES
(1, 'Testcode', 'GncMiler1', 'dev@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1234567890', '1'),
(4, 'dav1', 'lname', '1@g.c', 'e10adc3949ba59abbe56e057f20f883e', '0100000000', '1.'),
(5, '2dev', 'lname2', '2@g.c', 'e10adc3949ba59abbe56e057f20f883e', '0200000000', '2'),
(6, '3dev999', 'lname', '3@g.c', '4297f44b13955235245b2497399d7a93', '0300000000', '3'),
(7, '4dev', 'lname', '4@g.c', 'e10adc3949ba59abbe56e057f20f883e', '0400000000', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL COMMENT 'รหัสเจ้าหน้าที่ระบบ',
  `fname_admin` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `lname_admin` varchar(50) NOT NULL COMMENT 'นามสกุล',
  `user_admin` varchar(25) NOT NULL COMMENT 'ชื่อผู้ใช้(สำหรับlogin)',
  `pass_admin` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `tel_admin` varchar(10) NOT NULL COMMENT 'เบอร์โทร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `fname_admin`, `lname_admin`, `user_admin`, `pass_admin`, `tel_admin`) VALUES
(1, 'First', 'Person', 'admin', '4297f44b13955235245b2497399d7a93', '0010000000'),
(2, 'second', 'Person', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '0020000000'),
(3, 'third', 'Person', 'admin3', 'e10adc3949ba59abbe56e057f20f883e', '0030000000'),
(4, 'Fourth', 'Person', 'ad1', 'e10adc3949ba59abbe56e057f20f883e', '0004000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_ord` int(11) NOT NULL COMMENT 'รหัสการสั่ง',
  `date_tsp_ord` varchar(15) NOT NULL COMMENT 'วันที่ต้องการให้ส่ง',
  `status_ord` varchar(15) NOT NULL COMMENT 'สถานะออร์เดอร์\r\npending = รอยืนยัน\r\nprocess = กำลังผลิต\r\ndeliver = กำลังส่ง\r\nsuccess = สำเร็จ\r\ncancel = ยกเลิก',
  `detail_ord` varchar(255) NOT NULL COMMENT 'รายละเอียดรายการสั่ง',
  `all_size_ord` int(11) NOT NULL COMMENT 'ขนาดปริมาณรวม',
  `all_price_ord` int(11) NOT NULL COMMENT 'ราคารวม',
  `date_d_ord` varchar(15) NOT NULL COMMENT 'วันที่สั่ง',
  `date_m_ord` varchar(15) NOT NULL COMMENT 'เดือนที่สั่ง',
  `date_y_ord` varchar(5) NOT NULL COMMENT 'ปีที่สั่ง',
  `date_ord` varchar(50) NOT NULL COMMENT 'วันที่(สำหรับตรวจสอบ)',
  `id_acc` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `id_admin` int(11) DEFAULT NULL COMMENT 'รหัสผู้ดูแล (สถานะการสั่งซื้อ)',
  `lat_loca` varchar(100) NOT NULL COMMENT 'ละติจูด',
  `long_loca` varchar(100) NOT NULL COMMENT 'ลองติจูด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_ord`, `date_tsp_ord`, `status_ord`, `detail_ord`, `all_size_ord`, `all_price_ord`, `date_d_ord`, `date_m_ord`, `date_y_ord`, `date_ord`, `id_acc`, `id_admin`, `lat_loca`, `long_loca`) VALUES
(1, '2021-09-29', 'success', '138/1 ตรงข้ามมาสด้า', 600, 2950, '01', '08', '2021', '01-08-2021', 1, 1, '7.6173008', '100.07296679999999'),
(2, '2021-09-28', 'deliver', '138/1 ตรงข้ามมาสด้า', 600, 2950, '02', '08', '2021', '02-08-2021', 1, 1, '7.6173008', '100.07296679999999'),
(3, '2021-09-29', 'success', '138/1 ตรงข้ามมาสด้า', 600, 2950, '03', '08', '2021', '03-08-2021', 1, NULL, '7.6173008', '100.07296679999999'),
(4, '2021-09-29', 'cancel', '138/1 ตรงข้ามมาสด้า', 600, 2950, '01', '2021-07', '2021', '01-09-2021', 1, 1, '7.6173008', '100.07296679999999'),
(5, '2021-09-30', 'success', '138/1 ตรงข้ามมาสด้า', 600, 2950, '02', '2021-08', '2021', '02-09-2021', 1, 1, '7.6173008', '100.07296679999999'),
(6, '2021-09-29', 'success', '138/1 ตรงข้ามมาสด้า', 600, 2950, '2021-09-28', '2021-09', '2021', '03-09-2021', 1, 1, '7.6173008', '100.07296679999999'),
(7, '2021-09-30', 'process', '138/1 ตรงข้ามมาสด้า', 600, 2950, '2021-09-29', '2021-09', '2021', '01-10-2022', 1, NULL, '7.6173008', '100.07296679999999'),
(13, '2021-09-30', 'deliver', 'Usisis', 9999, 19000, '2021-09-30', '2021-09', '2021', '30-09-2021', 1, 1, '7.580541943824936', '100.0499432586292'),
(14, '2021-09-30', 'deliver', 'Usisis', 9999, 19000, '2021-09-30', '2021-09', '2021', '30-09-2021', 1, NULL, '7.580541943824936', '100.0499432586292'),
(15, '2021-09-30', 'cancel', '1922', 33620, 340, '2021-09-30', '2021-09', '2021', '30-09-2021', 1, NULL, '7.002046', '100.45739'),
(16, '2021-10-03', 'cancel', '5', 20, 90, '2021-09-30', '2021-09', '2021', '30-09-2021', 1, NULL, '7.580877', '100.051956'),
(17, '2021-10-04', 'pending', '151', 6720, 50, '2021-09-30', '2021-09', '2021', '30-09-2021', 1, NULL, '7.580877', '100.051956'),
(18, '2021-09-30', 'pending', '9999', 20, 90, '2021-09-30', '2021-09', '2021', '30-09-2021', 4, NULL, '7.002046', '100.45739'),
(19, '2021-10-04', 'pending', '9ajeejesj', 6720, 50, '2021-09-30', '2021-09', '2021', '30-09-2021', 4, NULL, '7.002046', '100.45739');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_list`
--

CREATE TABLE `tbl_order_list` (
  `id_ord_list` int(11) NOT NULL COMMENT 'รหัสลิสรายการสั่ง',
  `name_ord_list` varchar(50) NOT NULL COMMENT 'ชื่อสินค้า',
  `size_ord_list` int(11) NOT NULL COMMENT 'ขนาด',
  `price_ord_list` int(11) NOT NULL COMMENT 'ราคา',
  `qty_ord_list` int(11) NOT NULL COMMENT 'จำนวน',
  `id_ord` int(11) NOT NULL COMMENT 'รหัสการสั่ง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_list`
--

INSERT INTO `tbl_order_list` (`id_ord_list`, `name_ord_list`, `size_ord_list`, `price_ord_list`, `qty_ord_list`, `id_ord`) VALUES
(1, 'วิวหลักล้าน', 100, 500, 5, 1),
(2, 'ห้องสมุด', 20, 90, 5, 1),
(3, 'laptop 13 นิ้ว', 9999, 19000, 1, 2),
(4, 'น้ำแพ็ค', 6720, 50, 1, 2),
(5, 'แมว 3 D', 200, 2500, 1, 3),
(6, 'แมว 3 D', 200, 2500, 1, 4),
(7, 'น้ำแพ็ค', 6720, 50, 1, 5),
(8, 'น้ำแพ็ค', 6720, 50, 1, 6),
(9, 'laptop 13 นิ้ว', 9999, 19000, 1, 7),
(10, 'laptop 13 นิ้ว', 9999, 19000, 1, 13),
(11, 'น้ำแพ็ค', 6720, 50, 5, 15),
(12, 'ห้องสมุด', 20, 90, 1, 15),
(13, 'ห้องสมุด', 20, 90, 1, 16),
(14, 'น้ำแพ็ค', 6720, 50, 1, 17),
(15, 'ห้องสมุด', 20, 90, 1, 18),
(16, 'น้ำแพ็ค', 6720, 50, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id_pdc` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `name_pdc` varchar(50) NOT NULL COMMENT 'ชื่อสินค้า',
  `size_pdc` int(11) NOT NULL COMMENT 'ขนาดเป็นมิลลิลิตรเท่านั้น',
  `detail_pdc` varchar(255) NOT NULL COMMENT 'รายละเอียดสินค้า',
  `price_pdc` int(11) NOT NULL COMMENT 'ราคา',
  `pic_pdc` varchar(255) NOT NULL COMMENT 'รูป'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id_pdc`, `name_pdc`, `size_pdc`, `detail_pdc`, `price_pdc`, `pic_pdc`) VALUES
(1, 'น้ำแพ็ค', 6720, 'น้ำดื่ม', 50, 'productUpdate20210926140136.png'),
(3, 'ห้องสมุด', 20, 'รูปเบลอ', 90, 'product20210907160809.jpg'),
(4, 'แมว 3 D', 200, 'แมวตัว 1 ', 2500, 'product20210907160934.gif'),
(12, 'laptop 13 นิ้ว', 9999, 'laptop รุ่น 1', 19000, 'product20210907190348.png'),
(13, 'แมวอ้วน', 4500, 'แมว', 5, 'productUpdate20210927113302.jpg'),
(14, 'วิวหลักล้าน', 100, 'วิวคาเฟ่ แห่งหนึ่ง', 500, 'productUpdate20210926140203.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acc`
--
ALTER TABLE `tbl_acc`
  ADD PRIMARY KEY (`id_acc`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_ord`);

--
-- Indexes for table `tbl_order_list`
--
ALTER TABLE `tbl_order_list`
  ADD PRIMARY KEY (`id_ord_list`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id_pdc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acc`
--
ALTER TABLE `tbl_acc`
  MODIFY `id_acc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลูกค้า', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเจ้าหน้าที่ระบบ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_ord` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสั่ง', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_order_list`
--
ALTER TABLE `tbl_order_list`
  MODIFY `id_ord_list` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลิสรายการสั่ง', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id_pdc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
