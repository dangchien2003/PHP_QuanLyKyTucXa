-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 10:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_qlkytucxa`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `quyen` int(11) NOT NULL,
  `chucDanh` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hoadondiennuoc`
--

CREATE TABLE `hoadondiennuoc` (
  `maHoaDon` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'HDDN',
  `toi` int(11) DEFAULT NULL,
  `soDienCu` int(11) DEFAULT NULL,
  `soDienMoi` int(11) DEFAULT NULL,
  `soNuocCu` int(11) DEFAULT NULL,
  `soNuocMoi` int(11) DEFAULT NULL,
  `ngayChot` date DEFAULT NULL,
  `tongTien` int(11) DEFAULT NULL,
  `tinhtrang` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hoadonguixe`
--

CREATE TABLE `hoadonguixe` (
  `maHoaDon` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'HDX',
  `idTheXe` int(11) DEFAULT NULL,
  `ngayChot` date DEFAULT NULL,
  `tinhTrang` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hoadonphong`
--

CREATE TABLE `hoadonphong` (
  `maHoaDon` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'HDP',
  `toi` int(11) DEFAULT NULL,
  `giaPhong` int(11) DEFAULT NULL,
  `giaVeSinh` int(11) DEFAULT NULL,
  `ngayChot` date DEFAULT NULL,
  `tongTien` int(11) DEFAULT NULL,
  `tinhtrang` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hopdong`
--

CREATE TABLE `hopdong` (
  `maHD` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'HDCN',
  `giaPhong` int(11) DEFAULT NULL,
  `giaDien` int(11) DEFAULT NULL,
  `giaNuoc` int(11) DEFAULT NULL,
  `giaVeSinh` int(11) DEFAULT NULL,
  `tienCoc` int(11) DEFAULT NULL,
  `ngayCoc` date DEFAULT NULL,
  `nguoiCoc` varchar(30) DEFAULT NULL,
  `thoiGianBatDau` date DEFAULT NULL,
  `thoiGianHieuLuc` date DEFAULT NULL,
  `tinhTrang` int(11) NOT NULL DEFAULT 17
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'NV',
  `hoTen` varchar(30) DEFAULT NULL,
  `tuoi` int(11) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `queQuan` varchar(100) DEFAULT NULL,
  `chucVu` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sdt` varchar(11) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `ngayVao` date NOT NULL,
  `ngayNghi` date DEFAULT NULL,
  `tinhTrang` int(11) DEFAULT 8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `maPhong` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'P',
  `tang` int(11) DEFAULT NULL,
  `tinhTrang` int(11) NOT NULL DEFAULT 18,
  `sucChua` int(11) NOT NULL DEFAULT 6,
  `nguoiDaiDien` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quyentruycap`
--

CREATE TABLE `quyentruycap` (
  `user` varchar(20) DEFAULT NULL,
  `userAdmin` varchar(20) DEFAULT NULL,
  `quyen` int(11) DEFAULT NULL,
  `thoiGianCap` datetime DEFAULT NULL,
  `thoiGianThuHoi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'SV',
  `anh` varchar(100) DEFAULT NULL,
  `maPhong` int(11) DEFAULT NULL,
  `hoTen` varchar(30) DEFAULT NULL,
  `namSinh` int(11) DEFAULT NULL,
  `sdt` char(10) DEFAULT NULL,
  `soCCCD` varchar(12) DEFAULT NULL,
  `queQuan` varchar(100) DEFAULT NULL,
  `ngheNghiep` varchar(20) DEFAULT NULL,
  `truong` varchar(100) DEFAULT NULL,
  `tinhTrang` int(11) NOT NULL DEFAULT 3,
  `ngayVao` date NOT NULL,
  `ngayRa` date DEFAULT NULL,
  `maHD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `user` varchar(20) NOT NULL,
  `pass` varchar(30) DEFAULT NULL,
  `quyen` int(11) DEFAULT NULL,
  `tinhTrang` int(11) NOT NULL DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `thexe`
--

CREATE TABLE `thexe` (
  `id` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'TX',
  `chuXe` int(11) DEFAULT NULL,
  `bienSo` varchar(10) DEFAULT NULL,
  `tenXe` varchar(20) DEFAULT NULL,
  `tinhTrang` int(11) DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tinhtrang`
--

CREATE TABLE `tinhtrang` (
  `id` int(11) NOT NULL,
  `tinhTrang` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tinhtrang`
--

INSERT DELAYED IGNORE INTO `tinhtrang` (`id`, `tinhTrang`) VALUES
(1, 'Đã rời đi'),
(2, 'Đang ở'),
(3, 'Sắp chuyển đến'),
(4, 'Sắp chuyển đi'),
(5, 'Chờ thanh toán'),
(6, 'Đã thanh toán'),
(7, 'Đã nghỉ việc'),
(8, 'Đang công tác'),
(9, 'Đang cấp lại'),
(10, 'Báo mất'),
(11, 'Đã huỷ'),
(12, 'Đã hết hạn'),
(13, 'Còn hiệu lực'),
(14, 'Khoá'),
(15, 'Đang hoạt động'),
(16, 'Chờ duyệt'),
(17, 'Chưa có hiệu lực'),
(18, 'Trống');
(19, 'Đang sửa chữa');
(20, 'Không sử dụng');

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `quyen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`quyen`);

--
-- Indexes for table `hoadondiennuoc`
--
ALTER TABLE `hoadondiennuoc`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `toi` (`toi`),
  ADD KEY `tinhtrang` (`tinhtrang`);

--
-- Indexes for table `hoadonguixe`
--
ALTER TABLE `hoadonguixe`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `idTheXe` (`idTheXe`),
  ADD KEY `tinhTrang` (`tinhTrang`);

--
-- Indexes for table `hoadonphong`
--
ALTER TABLE `hoadonphong`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `toi` (`toi`),
  ADD KEY `tinhtrang` (`tinhtrang`);

--
-- Indexes for table `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`maHD`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tinhTrang` (`tinhTrang`),
  ADD KEY `chucVu` (`chucVu`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`maPhong`),
  ADD KEY `tinhTrang` (`tinhTrang`);

--
-- Indexes for table `quyentruycap`
--
ALTER TABLE `quyentruycap`
  ADD KEY `user` (`user`),
  ADD KEY `userAdmin` (`userAdmin`),
  ADD KEY `quyen` (`quyen`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maPhong` (`maPhong`),
  ADD KEY `maHD` (`maHD`),
  ADD KEY `sinhvien_ibfk_3` (`tinhTrang`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`user`),
  ADD KEY `quyen` (`quyen`),
  ADD KEY `taikhoan_tinhtrang_1` (`tinhTrang`);

--
-- Indexes for table `thexe`
--
ALTER TABLE `thexe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuXe` (`chuXe`),
  ADD KEY `tinhTrang` (`tinhTrang`);

--
-- Indexes for table `tinhtrang`
--
ALTER TABLE `tinhtrang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quyen` (`quyen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `quyen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadondiennuoc`
--
ALTER TABLE `hoadondiennuoc`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadonguixe`
--
ALTER TABLE `hoadonguixe`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadonphong`
--
ALTER TABLE `hoadonphong`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `maHD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thexe`
--
ALTER TABLE `thexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tinhtrang`
--
ALTER TABLE `tinhtrang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `url`
--
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoadondiennuoc`
--
ALTER TABLE `hoadondiennuoc`
  ADD CONSTRAINT `hoadondiennuoc_ibfk_1` FOREIGN KEY (`toi`) REFERENCES `phong` (`maPhong`),
  ADD CONSTRAINT `hoadondiennuoc_ibfk_2` FOREIGN KEY (`tinhtrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `hoadonguixe`
--
ALTER TABLE `hoadonguixe`
  ADD CONSTRAINT `hoadonguixe_ibfk_1` FOREIGN KEY (`idTheXe`) REFERENCES `thexe` (`id`),
  ADD CONSTRAINT `hoadonguixe_ibfk_2` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `hoadonphong`
--
ALTER TABLE `hoadonphong`
  ADD CONSTRAINT `hoadonphong_ibfk_1` FOREIGN KEY (`toi`) REFERENCES `sinhvien` (`id`),
  ADD CONSTRAINT `hoadonphong_ibfk_2` FOREIGN KEY (`tinhtrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_2` FOREIGN KEY (`chucVu`) REFERENCES `chucvu` (`quyen`),
  ADD CONSTRAINT `nhanvien_ibfk_3` FOREIGN KEY (`user`) REFERENCES `taikhoan` (`user`);

--
-- Constraints for table `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `phong_ibfk_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `quyentruycap`
--
ALTER TABLE `quyentruycap`
  ADD CONSTRAINT `quyentruycap_ibfk_1` FOREIGN KEY (`user`) REFERENCES `taikhoan` (`user`),
  ADD CONSTRAINT `quyentruycap_ibfk_2` FOREIGN KEY (`userAdmin`) REFERENCES `taikhoan` (`user`),
  ADD CONSTRAINT `quyentruycap_ibfk_3` FOREIGN KEY (`quyen`) REFERENCES `chucvu` (`quyen`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`maPhong`) REFERENCES `phong` (`maPhong`),
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`maHD`) REFERENCES `hopdong` (`maHD`),
  ADD CONSTRAINT `sinhvien_ibfk_3` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`quyen`) REFERENCES `chucvu` (`quyen`),
  ADD CONSTRAINT `taikhoan_tinhtrang_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `thexe`
--
ALTER TABLE `thexe`
  ADD CONSTRAINT `thexe_ibfk_1` FOREIGN KEY (`chuXe`) REFERENCES `sinhvien` (`id`),
  ADD CONSTRAINT `thexe_ibfk_2` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Constraints for table `url`
--
ALTER TABLE `url`
  ADD CONSTRAINT `url_ibfk_1` FOREIGN KEY (`quyen`) REFERENCES `chucvu` (`quyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
