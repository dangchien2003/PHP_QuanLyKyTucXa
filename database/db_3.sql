-- thêm cột
ALTER TABLE `taikhoan` ADD `tinhTrang` INT NOT NULL AFTER `quyen`;

-- thêm khoá ngoại
ALTER TABLE `taikhoan` ADD CONSTRAINT `taikhoan_tinhtrang_1` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- thêm cột
ALTER TABLE `sinhvien` ADD `tinhTrang` INT NOT NULL AFTER `truong`;

--  thêm khoá ngoại
ALTER TABLE `sinhvien` ADD CONSTRAINT `sinhvien_ibfk_3` FOREIGN KEY (`tinhTrang`) REFERENCES `tinhtrang`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- inser tinhtrang
INSERT INTO `tinhtrang` (`id`, `tinhTrang`) VALUES (NULL, 'Đã rời đi'), (NULL, 'Đang ở'), (NULL, 'Sắp chuyển đến'), (NULL, 'Sắp chuyển đi'), (NULL, 'Chờ thanh toán'), (NULL, 'Đã thanh toán'), (NULL, 'Đã nghỉ việc'), (NULL, 'Đang công tác'), (NULL, 'Đang cấp lại'), (NULL, 'Báo mất'), (NULL, 'Đã huỷ'), (NULL, 'Đã hết hạn'), (NULL, 'Còn hiệu lực'), (NULL, 'Khoá'), (NULL, 'Đang hoạt động'), (NULL, 'Chờ duyệt'), (NULL, 'Chưa có hiệu lực'), (NULL, 'Trống');

-- thêm cột và default
ALTER TABLE `hopdong` ADD `tinhTrang` INT NOT NULL DEFAULT '17' AFTER `thoiGianHieuLuc`;

-- default

ALTER TABLE `hoadondiennuoc` CHANGE `tinhtrang` `tinhtrang` INT(11) NULL DEFAULT '5';

ALTER TABLE `hoadonguixe` CHANGE `tinhtrang` `tinhtrang` INT(11) NULL DEFAULT '5';

ALTER TABLE `hoadonphong` CHANGE `tinhtrang` `tinhtrang` INT(11) NULL DEFAULT '5';

ALTER TABLE `nhanvien` CHANGE `tinhTrang` `tinhTrang` INT(11) NULL DEFAULT '8';

ALTER TABLE `phong` CHANGE `tinhTrang` `tinhTrang` INT(11) NOT NULL DEFAULT '18';

ALTER TABLE `sinhvien` CHANGE `tinhTrang` `tinhTrang` INT(11) NOT NULL DEFAULT '3';

ALTER TABLE `taikhoan` CHANGE `tinhTrang` `tinhTrang` INT(11) NOT NULL DEFAULT '15';

ALTER TABLE `thexe` CHANGE `tinhTrang` `tinhTrang` INT(11) NOT NULL DEFAULT '15';


ALTER TABLE `phong` CHANGE `soNguoi` `sucChua` INT(11) NOT NULL DEFAULT '6';






