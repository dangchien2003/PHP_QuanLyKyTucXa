-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 27, 2023 lúc 01:08 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php_qlkytucxa`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `id` int(11) NOT NULL,
  `chucDanh` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`id`, `chucDanh`) VALUES
(1, 'Tài Khoản'),
(2, 'Quản lý phương tiện'),
(3, 'Quản lý sinh viên'),
(4, 'Quản lý phòng'),
(5, 'Quản lý hoá đơn'),
(6, 'Quản lý hợp đồng'),
(7, 'Quản lý hợp đồng'),
(8, 'Thống kê'),
(9, 'Quản lý nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadondiennuoc`
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

--
-- Đang đổ dữ liệu cho bảng `hoadondiennuoc`
--

INSERT INTO `hoadondiennuoc` (`maHoaDon`, `kyHieu`, `toi`, `soDienCu`, `soDienMoi`, `soNuocCu`, `soNuocMoi`, `ngayChot`, `tongTien`, `tinhtrang`) VALUES
(1, 'HDDN', 101, 1020, 1251, 125, 145, '2023-12-01', 0, 5),
(2, 'HDDN', 102, 1020, 1252, 125, 146, '2023-12-01', 0, 6),
(3, 'HDDN', 103, 1020, 1253, 125, 147, '2023-12-01', 0, 5),
(4, 'HDDN', 104, 1020, 1254, 125, 148, '2023-12-01', 0, 5),
(5, 'HDDN', 201, 1020, 1255, 125, 149, '2023-12-01', 0, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonguixe`
--

CREATE TABLE `hoadonguixe` (
  `maHoaDon` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'HDX',
  `idTheXe` int(11) DEFAULT NULL,
  `tongTien` int(11) NOT NULL,
  `ngayChot` date DEFAULT NULL,
  `tinhTrang` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadonguixe`
--

INSERT INTO `hoadonguixe` (`maHoaDon`, `kyHieu`, `idTheXe`, `tongTien`, `ngayChot`, `tinhTrang`) VALUES
(1, 'HDX', 1, 100000, '2023-12-01', 5),
(2, 'HDX', 2, 100000, '2023-12-01', 6),
(3, 'HDX', 3, 100000, '2023-12-01', 5),
(4, 'HDX', 4, 100000, '2023-12-01', 5),
(5, 'HDX', 5, 100000, '2023-12-01', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonphong`
--

CREATE TABLE `hoadonphong` (
  `maHoaDon` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'HDP',
  `toi` int(11) DEFAULT NULL,
  `giaPhong` int(11) DEFAULT NULL,
  `giaVeSinh` int(11) DEFAULT NULL,
  `soThang` int(11) NOT NULL,
  `ngayChot` date DEFAULT NULL,
  `tongTien` int(11) DEFAULT NULL,
  `tinhtrang` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadonphong`
--

INSERT INTO `hoadonphong` (`maHoaDon`, `kyHieu`, `toi`, `giaPhong`, `giaVeSinh`, `soThang`, `ngayChot`, `tongTien`, `tinhtrang`) VALUES
(1, 'HDP', 1, 500000, 50000, 6, '2023-12-01', 3300000, 5),
(2, 'HDP', 2, 500000, 50000, 6, '2023-12-01', 3300000, 6),
(3, 'HDP', 3, 500000, 50000, 6, '2023-12-01', 3300000, 5),
(4, 'HDP', 4, 500000, 50000, 6, '2023-12-01', 3300000, 5),
(5, 'HDP', 5, 500000, 50000, 6, '2023-12-01', 3300000, 6),
(6, 'HDP', 6, 500000, 50000, 6, '2023-12-01', 3300000, 5),
(7, 'HDP', 7, 500000, 50000, 6, '2023-12-01', 3300000, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
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

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`maHD`, `kyHieu`, `giaPhong`, `giaDien`, `giaNuoc`, `giaVeSinh`, `tienCoc`, `ngayCoc`, `nguoiCoc`, `thoiGianBatDau`, `thoiGianHieuLuc`, `tinhTrang`) VALUES
(1, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2022-10-15', 'Phạm Văn A', '2022-10-20', '2024-10-20', 17),
(2, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2022-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(3, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(4, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(5, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(6, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(7, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(8, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(9, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17),
(10, 'HDCN', 500000, 2500, 15000, 50000, 500000, '2023-05-10', 'Lê Quang B', '2023-05-25', '2025-05-25', 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'NV',
  `hoTen` varchar(30) DEFAULT NULL,
  `anh` varchar(100) NOT NULL,
  `gioiTinh` tinyint(1) DEFAULT NULL,
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

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `kyHieu`, `hoTen`, `anh`, `gioiTinh`, `ngaySinh`, `queQuan`, `chucVu`, `email`, `sdt`, `user`, `ngayVao`, `ngayNghi`, `tinhTrang`) VALUES
(1, 'NV', 'Anh Ðức', 'NV1.png', 1, '1990-05-15', 'Hải Dương', 1, NULL, '0333747420', 'user1', '2022-11-20', NULL, 8),
(2, 'NV', 'Ðức Quang', 'NV2.png', 1, '1989-08-12', 'Hải Dương', 2, NULL, '0333747421', 'user2', '2022-11-20', NULL, 8),
(3, 'NV', 'Bình Yên', 'NV3.png', 1, '1995-04-25', 'Hải Dương', 3, NULL, '0333747422', 'user3', '2022-11-20', NULL, 8),
(4, 'NV', 'Hoàng Khải', 'NV4.png', 1, '1989-08-12', 'Hải Dương', 4, NULL, '0333747423', 'user4', '2022-11-20', NULL, 8),
(5, 'NV', 'Huân Võ', 'NV5.png', 1, '1990-05-15', 'Hải Dương', 5, NULL, '0333747424', 'user5', '2022-11-20', NULL, 8),
(6, 'NV', 'Phương Chi', 'NV6.png', 0, '1995-04-25', 'Hải Dương', 6, NULL, '0333747425', 'user6', '2022-11-20', NULL, 8),
(7, 'NV', 'Thu Ngọc', 'NV7.png', 0, '1989-08-12', 'Hải Dương', 7, NULL, '0333747426', 'user7', '2022-11-20', NULL, 8),
(8, 'NV', 'Quế Phương', 'NV8.png', 0, '1995-04-25', 'Hải Dương', 8, NULL, '0333747427', 'user8', '2022-11-20', NULL, 8),
(9, 'NV', 'Hiếu Khanh', 'NV9.png', 0, '1990-05-15', 'Hải Dương', 9, NULL, '0333747428', 'user9', '2022-11-20', NULL, 8),
(10, 'NV', 'Trúc Đào', 'NV10.png', 0, '1995-04-25', 'Hải Dương', 9, NULL, '0333747429', 'user10', '2022-11-20', NULL, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `maPhong` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'P',
  `tang` int(11) DEFAULT NULL,
  `tinhTrang` int(11) NOT NULL DEFAULT 18,
  `sucChua` int(11) NOT NULL DEFAULT 6,
  `nguoiDaiDien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`maPhong`, `kyHieu`, `tang`, `tinhTrang`, `sucChua`, `nguoiDaiDien`) VALUES
(2, 'P', 1, 18, 1, NULL),
(101, 'P', 1, 15, 6, 1),
(102, 'P', 1, 15, 6, 3),
(103, 'P', 1, 15, 6, 4),
(104, 'P', 1, 15, 6, 5),
(201, 'P', 2, 19, 6, 8),
(202, 'P', 2, 18, 4, NULL),
(301, 'P', 1, 18, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `idQuyen` int(11) NOT NULL,
  `quanLy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`idQuyen`, `quanLy`) VALUES
(2, 3),
(3, 3),
(1, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyenchinh`
--

CREATE TABLE `quyenchinh` (
  `user` varchar(20) NOT NULL,
  `quyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyenchinh`
--

INSERT INTO `quyenchinh` (`user`, `quyen`) VALUES
('user1', 1),
('user1', 3),
('user2', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyentruycap`
--

CREATE TABLE `quyentruycap` (
  `user` varchar(20) NOT NULL,
  `userAdmin` varchar(20) NOT NULL,
  `quyen` int(11) NOT NULL,
  `thoiGianCap` datetime NOT NULL,
  `thoiGianThuHoi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyentruycap`
--

INSERT INTO `quyentruycap` (`user`, `userAdmin`, `quyen`, `thoiGianCap`, `thoiGianThuHoi`) VALUES
('user1', 'user2', 2, '2023-12-27 11:10:54', '2023-12-27 00:00:00'),
('user1', 'user4', 4, '2023-12-27 11:15:14', '2023-12-27 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'SV',
  `anh` varchar(100) DEFAULT NULL,
  `maPhong` int(11) DEFAULT NULL,
  `hoTen` varchar(30) DEFAULT NULL,
  `gioiTinh` tinyint(1) DEFAULT NULL,
  `namSinh` date DEFAULT NULL,
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

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `kyHieu`, `anh`, `maPhong`, `hoTen`, `gioiTinh`, `namSinh`, `sdt`, `soCCCD`, `queQuan`, `ngheNghiep`, `truong`, `tinhTrang`, `ngayVao`, `ngayRa`, `maHD`) VALUES
(1, 'SV', 'SV1', 101, 'Kim Mai', 0, '2003-01-20', '0333757421', '302037752668', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2022-10-20', '0000-00-00', 1),
(2, 'SV', 'SV2', 101, 'Quỳnh Trang', 0, '2002-06-15', '0333787422', '302037752669', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 2),
(3, 'SV', 'SV3', 102, 'Kim Anh', 0, '2000-07-15', '0333787423', '302037752670', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 1, '2023-05-25', '2023-12-20', 3),
(4, 'SV', 'SV4', 103, 'Phương Chi', 0, '2004-06-18', '0333787424', '302037752671', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 4),
(5, 'SV', 'SV5', 104, 'Thuý Mai', 0, '2001-12-21', '0333787425', '302037752672', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 5),
(6, 'SV', 'SV6', 201, 'Tùng Lâm', 1, '2001-12-21', '0333787426', '302037752673', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 6),
(7, 'SV', 'SV7', 201, 'Khánh Hoàn', 1, '2001-12-21', '0333787427', '302037752674', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 7),
(8, 'SV', 'SV8', 201, 'Đức Quang', 1, '2001-12-21', '0333787428', '302037752675', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 8),
(9, 'SV', 'SV9', 201, 'Hoài Vỹ', 1, '2001-12-21', '0333787429', '302037752676', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 9),
(10, 'SV', 'SV10', 102, 'Thanh Minh', 1, '2001-12-21', '0333787430', '302037752677', 'Hải Dương', 'Sinh viên', 'ĐH Công Nghệ Đông Á', 2, '2023-05-25', NULL, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `user` varchar(20) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `quyen` int(11) DEFAULT NULL,
  `tinhTrang` int(11) NOT NULL DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`user`, `pass`, `quyen`, `tinhTrang`) VALUES
('user1', '1', 1, 15),
('user10', '1', 9, 14),
('user2', '1', 2, 15),
('user3', '1', 3, 15),
('user4', '1', 4, 15),
('user5', '1', 5, 15),
('user6', '1', 6, 15),
('user7', '1', 7, 15),
('user8', '1', 8, 15),
('user9', '1', 9, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thexe`
--

CREATE TABLE `thexe` (
  `id` int(11) NOT NULL,
  `kyHieu` varchar(5) DEFAULT 'TX',
  `chuXe` int(11) DEFAULT NULL,
  `bienSo` varchar(12) DEFAULT NULL,
  `tenXe` varchar(20) DEFAULT NULL,
  `tinhTrang` int(11) DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thexe`
--

INSERT INTO `thexe` (`id`, `kyHieu`, `chuXe`, `bienSo`, `tenXe`, `tinhTrang`) VALUES
(1, 'TX', 1, '34MD1 4097', 'Xe máy điện Xmen', 11),
(2, 'TX', 4, '34MD1 4096', 'Wave 120CC', 15),
(3, 'TX', 2, '34MD1 4095', 'Dream', 14),
(4, 'TX', 5, '34MD1 4094', 'Xe máy điện Xmen', 15),
(5, 'TX', 7, '34MD1 4093', 'Winner 150', 15),
(6, 'TX', 1, '34MD1 40979', 'Xe máy điện Xmen', 11),
(7, 'TX', 4, '34MD1 40969', 'Wave 120CC', 15),
(8, 'TX', 2, '34MD1 40959', 'Dream', 14),
(9, 'TX', 5, '34MD1 40949', 'Xe máy điện Xmen', 15),
(10, 'TX', 7, '34MD1 40939', 'Winner 150', 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinhtrang`
--

CREATE TABLE `tinhtrang` (
  `id` int(11) NOT NULL,
  `tinhTrang` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tinhtrang`
--

INSERT INTO `tinhtrang` (`id`, `tinhTrang`) VALUES
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
(18, 'Trống'),
(19, 'Đang sửa chữa'),
(20, 'Không sử dụng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `url`
--

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `indata` bit(1) NOT NULL,
  `quyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `url`
--

INSERT INTO `url` (`id`, `url`, `indata`, `quyen`) VALUES
(1, 'sodophong.php', b'0', 1),
(2, 'thongtinsv.php', b'1', 2),
(3, 'themphong.php', b'0', 1),
(4, 'ádsadsff', b'0', 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoadondiennuoc`
--
ALTER TABLE `hoadondiennuoc`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `toi` (`toi`),
  ADD KEY `tinhtrang` (`tinhtrang`);

--
-- Chỉ mục cho bảng `hoadonguixe`
--
ALTER TABLE `hoadonguixe`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `idTheXe` (`idTheXe`),
  ADD KEY `tinhTrang` (`tinhTrang`);

--
-- Chỉ mục cho bảng `hoadonphong`
--
ALTER TABLE `hoadonphong`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `toi` (`toi`),
  ADD KEY `tinhtrang` (`tinhtrang`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`maHD`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tinhTrang` (`tinhTrang`),
  ADD KEY `chucVu` (`chucVu`),
  ADD KEY `user` (`user`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`maPhong`),
  ADD KEY `tinhTrang` (`tinhTrang`),
  ADD KEY `phong_ibfk_2` (`nguoiDaiDien`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`idQuyen`),
  ADD KEY `quanly_fk1` (`quanLy`);

--
-- Chỉ mục cho bảng `quyenchinh`
--
ALTER TABLE `quyenchinh`
  ADD KEY `user_fk1` (`user`),
  ADD KEY `quyen_fk2` (`quyen`);

--
-- Chỉ mục cho bảng `quyentruycap`
--
ALTER TABLE `quyentruycap`
  ADD KEY `useradmin_fk1` (`userAdmin`),
  ADD KEY `user_fk2` (`user`),
  ADD KEY `quyen_fk3` (`quyen`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maPhong` (`maPhong`),
  ADD KEY `maHD` (`maHD`),
  ADD KEY `sinhvien_ibfk_3` (`tinhTrang`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`user`),
  ADD KEY `quyen` (`quyen`),
  ADD KEY `taikhoan_tinhtrang_1` (`tinhTrang`);

--
-- Chỉ mục cho bảng `thexe`
--
ALTER TABLE `thexe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuXe` (`chuXe`),
  ADD KEY `tinhTrang` (`tinhTrang`);

--
-- Chỉ mục cho bảng `tinhtrang`
--
ALTER TABLE `tinhtrang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quyen_fk1` (`quyen`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `hoadondiennuoc`
--
ALTER TABLE `hoadondiennuoc`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `hoadonguixe`
--
ALTER TABLE `hoadonguixe`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `hoadonphong`
--
ALTER TABLE `hoadonphong`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `maHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `idQuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `thexe`
--
ALTER TABLE `thexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tinhtrang`
--
ALTER TABLE `tinhtrang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `url`
--
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hoadondiennuoc`
--
ALTER TABLE `hoadondiennuoc`
  ADD CONSTRAINT `hoadondiennuoc_ibfk_1` FOREIGN KEY (`toi`) REFERENCES `phong` (`maPhong`),
  ADD CONSTRAINT `hoadondiennuoc_ibfk_2` FOREIGN KEY (`tinhtrang`) REFERENCES `tinhtrang` (`id`);

--
-- Các ràng buộc cho bảng `hoadonguixe`
--
ALTER TABLE `hoadonguixe`
  ADD CONSTRAINT `hoadonguixe_ibfk_1` FOREIGN KEY (`idTheXe`) REFERENCES `thexe` (`id`),
  ADD CONSTRAINT `hoadonguixe_ibfk_2` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Các ràng buộc cho bảng `hoadonphong`
--
ALTER TABLE `hoadonphong`
  ADD CONSTRAINT `hoadonphong_ibfk_1` FOREIGN KEY (`toi`) REFERENCES `sinhvien` (`id`),
  ADD CONSTRAINT `hoadonphong_ibfk_2` FOREIGN KEY (`tinhtrang`) REFERENCES `tinhtrang` (`id`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_2` FOREIGN KEY (`chucVu`) REFERENCES `chucvu` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_3` FOREIGN KEY (`user`) REFERENCES `taikhoan` (`user`);

--
-- Các ràng buộc cho bảng `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `phong_ibfk_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`),
  ADD CONSTRAINT `phong_ibfk_2` FOREIGN KEY (`nguoiDaiDien`) REFERENCES `sinhvien` (`id`);

--
-- Các ràng buộc cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quanly_fk1` FOREIGN KEY (`quanLy`) REFERENCES `chucvu` (`id`);

--
-- Các ràng buộc cho bảng `quyenchinh`
--
ALTER TABLE `quyenchinh`
  ADD CONSTRAINT `quyen_fk2` FOREIGN KEY (`quyen`) REFERENCES `quyen` (`idQuyen`),
  ADD CONSTRAINT `user_fk1` FOREIGN KEY (`user`) REFERENCES `taikhoan` (`user`);

--
-- Các ràng buộc cho bảng `quyentruycap`
--
ALTER TABLE `quyentruycap`
  ADD CONSTRAINT `quyen_fk3` FOREIGN KEY (`quyen`) REFERENCES `quyen` (`idQuyen`),
  ADD CONSTRAINT `user_fk2` FOREIGN KEY (`user`) REFERENCES `taikhoan` (`user`),
  ADD CONSTRAINT `useradmin_fk1` FOREIGN KEY (`userAdmin`) REFERENCES `taikhoan` (`user`);

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`maPhong`) REFERENCES `phong` (`maPhong`),
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`maHD`) REFERENCES `hopdong` (`maHD`),
  ADD CONSTRAINT `sinhvien_ibfk_3` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`quyen`) REFERENCES `chucvu` (`id`),
  ADD CONSTRAINT `taikhoan_tinhtrang_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Các ràng buộc cho bảng `thexe`
--
ALTER TABLE `thexe`
  ADD CONSTRAINT `thexe_ibfk_1` FOREIGN KEY (`chuXe`) REFERENCES `sinhvien` (`id`),
  ADD CONSTRAINT `thexe_ibfk_2` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang` (`id`);

--
-- Các ràng buộc cho bảng `url`
--
ALTER TABLE `url`
  ADD CONSTRAINT `quyen_fk1` FOREIGN KEY (`quyen`) REFERENCES `quyen` (`idQuyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
