create database php_qlkytucxa;
use php_qlkytucxa;
CREATE TABLE `TaiKhoan` (
  `user` varchar(20) PRIMARY KEY,
  `pass` varchar(30),
  `quyen` int
);

CREATE TABLE `Phong` (
  `maPhong` int PRIMARY KEY,
  `kyHieu` varchar(5),
  `tang` int,
  `tinhTrang` int NOT NULL,
  `soNguoi` int,
  `nguoiDaiDien` varchar(30)
);

CREATE TABLE `SinhVien` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `anh` varchar(100),
  `maPhong` int,
  `hoTen` varchar(30),
  `namSinh` int,
  `sdt` char(10),
  `soCCCD` varchar(12),
  `queQuan` varchar(100),
  `ngheNghiep` varchar(20),
  `truong` varchar(100),
  `maHD` int
);

CREATE TABLE `HopDong` (
  `maHD` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `giaPhong` int,
  `giaDien` int,
  `giaNuoc` int,
  `giaVeSinh` int,
  `tienCoc` int,
  `ngayCoc` date,
  `nguoiCoc` varchar(30),
  `thoiGianBatDau` date,
  `thoiGianHieuLuc` date
);

CREATE TABLE `HoaDonPhong` (
  `maHoaDon` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `toi` int,
  `giaPhong` int,
  `giaVeSinh` int,
  `ngayChot` date,
  `tongTien` int,
  `tinhtrang` int
);

CREATE TABLE `HoaDonDienNuoc` (
  `maHoaDon` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `toi` int,
  `soDienCu` int,
  `soDienMoi` int,
  `soNuocCu` int,
  `soNuocMoi` int,
  `ngayChot` date,
  `tongTien` int,
  `tinhtrang` int
);

CREATE TABLE `NhanVien` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `hoTen` varchar(30),
  `tuoi` int,
  `ngaySinh` date,
  `queQuan` varchar(100),
  `chucVu` int,
  `email` varchar(50),
  `sdt` varchar(11),
  `user` varchar(20),
  `tinhTrang` int
);

CREATE TABLE `ChucVu` (
  `quyen` int PRIMARY KEY AUTO_INCREMENT,
  `chucDanh` varchar(30)
);

CREATE TABLE `TheXe` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `chuXe` int,
  `bienSo` varchar(10),
  `tenXe` varchar(20),
  `tinhTrang` int
);

CREATE TABLE `HoaDonGuiXe` (
  `maHoaDon` int PRIMARY KEY AUTO_INCREMENT,
  `kyHieu` varchar(5),
  `idTheXe` int,
  `ngayChot` date,
  `tinhTrang` int
);

CREATE TABLE `TinhTrang` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `tinhTrang` varchar(30)
);

CREATE TABLE `QuyenTruyCap` (
  `user` varchar(20),
  `userAdmin` varchar(20),
  `quyen` int,
  `thoiGianCap` datetime,
  `thoiGianThuHoi` datetime
);

CREATE TABLE `URL` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `url` varchar(200),
  `quyen` int
);

ALTER TABLE `SinhVien` ADD FOREIGN KEY (`maPhong`) REFERENCES `Phong` (`maPhong`);

ALTER TABLE `HoaDonGuiXe` ADD FOREIGN KEY (`idTheXe`) REFERENCES `TheXe` (`id`);

ALTER TABLE `TheXe` ADD FOREIGN KEY (`chuXe`) REFERENCES `SinhVien` (`id`);

ALTER TABLE `HoaDonPhong` ADD FOREIGN KEY (`toi`) REFERENCES `SinhVien` (`id`);

ALTER TABLE `HoaDonDienNuoc` ADD FOREIGN KEY (`toi`) REFERENCES `Phong` (`maPhong`);

ALTER TABLE `HoaDonGuiXe` ADD FOREIGN KEY (`tinhTrang`) REFERENCES `TinhTrang` (`id`);

ALTER TABLE `TheXe` ADD FOREIGN KEY (`tinhTrang`) REFERENCES `TinhTrang` (`id`);

ALTER TABLE `HoaDonPhong` ADD FOREIGN KEY (`tinhtrang`) REFERENCES `TinhTrang` (`id`);

ALTER TABLE `HoaDonDienNuoc` ADD FOREIGN KEY (`tinhtrang`) REFERENCES `TinhTrang` (`id`);

ALTER TABLE `Phong` ADD FOREIGN KEY (`tinhTrang`) REFERENCES `TinhTrang` (`id`);

ALTER TABLE `SinhVien` ADD FOREIGN KEY (`maHD`) REFERENCES `HopDong` (`maHD`);

ALTER TABLE `NhanVien` ADD FOREIGN KEY (`tinhTrang`) REFERENCES `TinhTrang` (`id`);

ALTER TABLE `NhanVien` ADD FOREIGN KEY (`chucVu`) REFERENCES `ChucVu` (`quyen`);

ALTER TABLE `NhanVien` ADD FOREIGN KEY (`user`) REFERENCES `TaiKhoan` (`user`);

ALTER TABLE `QuyenTruyCap` ADD FOREIGN KEY (`user`) REFERENCES `TaiKhoan` (`user`);

ALTER TABLE `QuyenTruyCap` ADD FOREIGN KEY (`userAdmin`) REFERENCES `TaiKhoan` (`user`);

ALTER TABLE `URL` ADD FOREIGN KEY (`quyen`) REFERENCES `ChucVu` (`quyen`);

ALTER TABLE `QuyenTruyCap` ADD FOREIGN KEY (`quyen`) REFERENCES `ChucVu` (`quyen`);

ALTER TABLE `TaiKhoan` ADD FOREIGN KEY (`quyen`) REFERENCES `ChucVu` (`quyen`);
